<?php

require(__DIR__ . "/../models/Category.php");
require(__DIR__ . "/../connection/connection.php");
require(__DIR__ . "/../services/ResponseService.php");
require(__DIR__ . "/../services/CategoryService.php");

class CategoryController
{
    public function get()
    {
        global $mysqli;
        $id = $_GET["id"];
        $category = Category::find($mysqli, $id);
        $responseService = new ResponseService();
        echo $responseService->success_response($category);
        return;
    }

    public function getAll()
    {
        global $mysqli;
        $categories = Category::all($mysqli);
        $categories_array = CategoryService::categoriesToArray($categories);
        $responseService = new ResponseService();
        echo $responseService->success_response($categories_array);
        return;
    }

    public function create()
    {
        global $mysqli;
        $data = json_decode(file_get_contents("php://input"), true);
        if (empty($data["name"]) || empty($data["description"])) {
            $responseService = new ResponseService();
            echo $responseService->error_response("Missing required fields", 400);
            return;
        }
        $category_id = Category::create($mysqli, $data);
        $responseService = new ResponseService();
        echo $responseService->success_response(["id" => $category_id]);
        return;
    }

    public function update()
    {
        global $mysqli;

        try {
            $id = $_GET["id"];
            $data = $_POST;
            $responseService = new ResponseService();

            if (empty($data["name"]) || empty($data["description"])) {
                echo $responseService->error_response("Missing required fields", 400);
                return;
            }

            $category = Category::update($mysqli, $id, $data);
            if ($category) {
                echo $responseService->success_response(["message" => "Category updated successfully"]);
                return;
            } else {
                echo $responseService->error_response("Failed to update category", 500);
                return;
            }
        } catch (Exception $e) {
            $responseService = new ResponseService();
            echo $responseService->error_response($e->getMessage(), 500);
            return;
        }
    }

    public function deleteAll()
    {
        global $mysqli;
        $categories = Category::deleteAll($mysqli);
        $responseService = new ResponseService();
        if ($categories) {
            echo $responseService->success_response(["message" => "All categories deleted successfully"]);
        } else {
            echo $responseService->error_response("Failed to delete articles", 500);
        }
    }
    public function delete()
    {
        global $mysqli;
        $id = $_GET["id"];
        $category = Category::delete($mysqli, $id);
        $responseService = new ResponseService();
        if ($category) {
            echo $responseService->success_response(["message" => "Category deleted successfully"]);
        } else {
            echo $responseService->error_response("Failed to delete category", 500);
        }
    }
    public function getArticles()
    {
        global $mysqli;
        $id = $_GET["id"];
        $articles = Article::findBy($mysqli, "category_id", $id);
        $responseService = new ResponseService();
        echo $responseService->success_response($articles);
    }
}

//To-Do:

//1- Try/Catch in controllers ONLY!!! 
//2- Find a way to remove the hard coded response code (from ResponseService.php)
//3- Include the routes file (api.php) in the (index.php) -- In other words, seperate the routing from the index (which is the engine)
//4- Create a BaseController and clean some imports 