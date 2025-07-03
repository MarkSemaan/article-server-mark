<?php

require(__DIR__ . "/../models/Article.php");
require(__DIR__ . "/../models/Category.php");
require(__DIR__ . "/../connection/connection.php");
require(__DIR__ . "/../services/ArticleService.php");
require(__DIR__ . "/../services/ResponseService.php");

class ArticleController
{
    public function get()
    {
        global $mysqli;
        $id = $_GET["id"];
        $article = Article::find($mysqli, $id)->toArray();
        $responseService = new ResponseService();
        echo $responseService->success_response($article);
        return;
    }

    public function getAll()
    {
        global $mysqli;
        $articles = Article::all($mysqli);
        $articles_array = ArticleService::articlesToArray($articles);
        $responseService = new ResponseService();
        echo $responseService->success_response($articles_array);
        return;
    }

    public function create()
    {
        global $mysqli;
        $data = json_decode(file_get_contents("php://input"), true);
        if (empty($data["name"]) || empty($data["author"]) || empty($data["description"])) {
            $responseService = new ResponseService();
            echo $responseService->error_response("Missing required fields", 400);
            return;
        }
        $article_id = Article::create($mysqli, $data);
        $responseService = new ResponseService();
        echo $responseService->success_response(["id" => $article_id]);
        return;
    }
    public function update()
    {
        global $mysqli;
        $data = json_decode(file_get_contents("php://input"), true);
        $id = $_GET["id"];
        if (empty($data["name"]) || empty($data["author"]) || empty($data["description"])) {
            $responseService = new ResponseService();
            echo $responseService->error_response("Missing required fields", 400);
            return;
        }
        $article = Article::update($mysqli, $id, $data);
        $responseService = new ResponseService();
        if ($article) {
            echo $responseService->success_response(["message" => "Article updated successfully"]);
        } else {
            echo $responseService->error_response("Failed to update article", 500);
        }
    }

    public function deleteAll()
    {
        global $mysqli;
        $articles = Article::deleteAll($mysqli);
        $responseService = new ResponseService();
        if ($articles) {
            echo $responseService->success_response(["message" => "All articles deleted successfully"]);
        } else {
            echo $responseService->error_response("Failed to delete articles", 500);
        }
    }
    public function delete()
    {
        global $mysqli;
        $id = $_GET["id"];
        $article = Article::delete($mysqli, $id);
        $responseService = new ResponseService();
        if ($article) {
            echo $responseService->success_response(["message" => "Article deleted successfully"]);
        } else {
            echo $responseService->error_response("Failed to delete article", 500);
        }
    }
    public function getCategory()
    {
        global $mysqli;
        $id = $_GET["id"];
        $article = Article::find($mysqli, $id);
        $category_id = $article->getCategoryId();
        $category = Category::find($mysqli, $category_id);
        $responseService = new ResponseService();
        echo $responseService->success_response($category);
    }
}

//To-Do:

//1- Try/Catch in controllers ONLY!!! 
//2- Find a way to remove the hard coded response code (from ResponseService.php)
//3- Include the routes file (api.php) in the (index.php) -- In other words, seperate the routing from the index (which is the engine)
//4- Create a BaseController and clean some imports 