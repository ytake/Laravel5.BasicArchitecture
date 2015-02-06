<?php
/** @var \Illuminate\Routing\Router $router */
$router->get('', ['uses' => "HomeController@index", 'as' => 'index']);
$router->get("todo", ['uses' => "ToDoController@index", 'as' => 'todo.front.index']);

$router->group(['prefix' => 'api/v1', "namespace" => "Api"], function ($router) {
    $router->resource("todo", "ToDoController", [
        "names" => [
            "index" => "todo.index",
            "store" => "todo.store"
        ],
        "only" => [
            "index", "store"
        ]
    ]);
});
