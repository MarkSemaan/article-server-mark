<?php

$apis = [
    '/articles'         => ['controller' => 'ArticleController', 'method' => 'getAll'],
    '/article/{id}'         => ['controller' => 'ArticleController', 'method' => 'get'],
    '/article/create'         => ['controller' => 'ArticleController', 'method' => 'create'],
    '/article/update/{id}'         => ['controller' => 'ArticleController', 'method' => 'update'],
    '/article/delete/{id}'         => ['controller' => 'ArticleController', 'method' => 'delete'],
    '/delete_articles'         => ['controller' => 'ArticleController', 'method' => 'deleteAll'],
    '/article/{id}/category' => ['controller' => 'ArticleController', 'method' => 'getCategory'],

    '/categories'         => ['controller' => 'CategoryController', 'method' => 'getAll'],
    '/category/{id}'         => ['controller' => 'CategoryController', 'method' => 'get'],
    '/category/create'         => ['controller' => 'CategoryController', 'method' => 'create'],
    '/category/update/{id}'         => ['controller' => 'CategoryController', 'method' => 'update'],
    '/category/delete/{id}'         => ['controller' => 'CategoryController', 'method' => 'delete'],
    '/category/{id}/articles' => ['controller' => 'CategoryController', 'method' => 'getArticles'],

    '/login'         => ['controller' => 'AuthController', 'method' => 'login'],
    '/register'         => ['controller' => 'AuthController', 'method' => 'register'],

];
