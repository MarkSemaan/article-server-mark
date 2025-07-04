<?php
require(__DIR__ . "/../models/Category.php");
require(__DIR__ . "/seeder.php");

class CategorySeeder extends seeder
{
    public function run(): void
    {
        global $mysqli;
        $category1 = Category::create($mysqli, [
            "name" => "Technology",
        ]);
        $category2 = Category::create($mysqli, [
            "name" => "Science",
        ]);
        $category3 = Category::create($mysqli, [
            "name" => "Health",
        ]);
        $category4 = Category::create($mysqli, [
            "name" => "Business",
        ]);
        $category5 = Category::create($mysqli, [
            "name" => "Entertainment",
        ]);
    }
}
