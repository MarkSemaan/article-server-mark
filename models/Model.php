<?php
abstract class Model
{

    protected static string $table;
    protected static string $primary_key = "id";


    public function toArray()
    {
        // Base toArray method - should be overridden by child classes
        return get_object_vars($this);
    }

    public static function find(mysqli $mysqli, int $id)
    {
        $sql = sprintf(
            "Select * from %s WHERE %s = ?",
            static::$table,
            static::$primary_key
        );

        $query = $mysqli->prepare($sql);
        $query->bind_param("i", $id);
        $query->execute();

        $data = $query->get_result()->fetch_assoc();

        return $data ? new static($data) : null;
    }

    public static function all(mysqli $mysqli)
    {
        $sql = sprintf("Select * from %s", static::$table);

        $query = $mysqli->prepare($sql);
        $query->execute();

        $data = $query->get_result();

        $objects = [];
        while ($row = $data->fetch_assoc()) {
            $objects[] = new static($row); //creating an object of type "static" / "parent" and adding the object to the array
        }

        return $objects; //we are returning an array of objects!!!!!!!!
    }

    public static function create(mysqli $mysqli, array $data)
    {
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), '?'));
        $stmt = $mysqli->prepare("INSERT INTO " . static::$table . " ({$columns}) VALUES ({$placeholders})");
        $values = array_values($data);
        $types = self::get_param_types($values);
        $stmt->bind_param($types, ...$values);
        if ($stmt->execute()) {
            return $mysqli->insert_id;
        } else {
            throw new Exception("Error creating record: " . $stmt->error);
        }
    }

    public static function update(mysqli $mysqli, int $id, array $data)
    {
        if (empty($data)) {
            return false;
        }
        $set_columns = [];
        $values = [];

        foreach ($data as $column => $value) {
            $set_columns[] = "{$column} = ?";
            $values[] = $value;
        }
        $set_columns = implode(", ", $set_columns);
        $sql = "UPDATE " . static::$table . " SET {$set_columns} WHERE id = ?";
        $stmt = $mysqli->prepare($sql);
        $values[] = $id;
        $types = self::get_param_types($values);
        $stmt->bind_param($types, ...$values);
        if ($stmt->execute()) {
            return $stmt->affected_rows > 0;
        } else {
            throw new Exception("Failed to update record: " . $stmt->error);
        }
    }

    public static function delete(mysqli $mysqli, int $id)
    {
        $stmt = $mysqli->prepare("DELETE FROM" . static::$table . "WHERE id = ?");
        if ($stmt->execute()) {
            return true;
        } else {
            throw new Exception("Error deleting record: " . $stmt->error);
        }
    }
    public static function deleteAll(mysqli $mysqli)
    {
        $stmt = $mysqli->prepare("DELETE FROM " . static::$table);
        if ($stmt->execute()) {
            return true;
        } else {
            throw new Exception("Error deleting record: " . $stmt->error);
        }
    }
    public static function findBy(mysqli $mysqli, string $column, string $value)
    {
        $sql = "SELECT * FROM " . static::$table . " WHERE {$column} = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("s", $value);
        $stmt->execute();
        $data = $stmt->get_result()->fetch_assoc();
        return $data ? new static($data) : null;
    }

    protected static function get_param_types(array $values): string
    {
        //Get the types of the values for dynamic binding
        $types = '';
        foreach ($values as $value) {
            switch (true) {
                case is_int($value):
                    $types .= 'i'; // Integer
                    break;
                case is_float($value):
                    $types .= 'd'; // Float
                    break;
                case is_string($value):
                    $types .= 's'; // String
                    break;
                case is_bool($value):
                    $types .= 'b'; // Boolean
                    break;
                default:
                    $types .= 's'; // Default to string for any other type
            }
        }
        return $types;
    }

    //you have to continue with the same mindset
    //Find a solution for sending the $mysqli everytime... 
    //Implement the following: 
    //1- update() -> non-static function 
    //2- create() -> static function
    //3- delete() -> static function 
}
