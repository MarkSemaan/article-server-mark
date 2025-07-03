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
            "description" => "Articles related to technology and innovation."
        ]);
        $category2 = Category::create($mysqli, [
            "name" => "Science",
            "description" => "Articles related to science and research."
        ]);
        $category3 = Category::create($mysqli, [
            "name" => "Health",
            "description" => "Articles related to health and wellness."
        ]);
        $category4 = Category::create($mysqli, [
            "name" => "Business",
            "description" => "Articles related to business and entrepreneurship."
        ]);
        $category5 = Category::create($mysqli, [
            "name" => "Entertainment",
            "description" => "Articles related to entertainment and culture."
        ]);
    }
}
