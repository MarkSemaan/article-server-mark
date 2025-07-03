<?php

class Category extends Model
{
    private int $id;
    private string $name;
    protected static string $table = "categories";

    public function toArray()
    {
        return [$this->id, $this->name];
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
}
