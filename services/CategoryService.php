<?php



class CategoryService

{
    public static function categoriesToArray($categories)
    {
        $categories_array = [];
        foreach ($categories as $category) {
            $categories_array[] = [
                "id" => $category->id,
                "name" => $category->name
            ];
        }
        return $categories_array;
    }
}
