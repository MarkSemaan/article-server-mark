<?php
require(__DIR__ . "/../models/Article.php");
require(__DIR__ . "/seeder.php");

class ArticleSeeder extends seeder
{
    public function run(): void
    {
        global $mysqli;
        $article1 = Article::create($mysqli, [
            "id" => 1,
            "name" => "PHP",
            "author" => "John Doe",
            "description" => "PHP is a programming language",
            "category_id" => 1
        ]);
        $article2 = Article::create($mysqli, [
            "id" => 2,
            "name" => "Math Problems",
            "author" => "Jane Doe",
            "description" => "Math problems are hard",
            "category_id" => 2
        ]);
        $article3 = Article::create($mysqli, [
            "id" => 3,
            "name" => "Physics",
            "author" => "John Doe",
            "description" => "Physics is a science that deals with the study of matter and its properties",
            "category_id" => 3
        ]);
        $article4 = Article::create($mysqli, [
            "id" => 4,
            "name" => "Chemistry",
            "author" => "John Doe",
            "description" => "Chemistry is a science that deals with the study of matter and its properties",
            "category_id" => 4
        ]);
        $article5 = Article::create($mysqli, [
            "id" => 5,
            "name" => "Biology",
            "author" => "John Doe",
            "description" => "Biology is a science that deals with the study of life",
            "category_id" => 5
        ]);
    }
}
