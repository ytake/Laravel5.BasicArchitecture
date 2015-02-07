<?php
/** @var \Illuminate\Routing\Router $router */
$router->get('', ['uses' => "HomeController@index", 'as' => 'index']);
$router->get("todo", ['uses' => "ToDoController@index", 'as' => 'todo.front.index']);
$router->get("markdown", ['uses' => "MarkdownController@index", 'as' => 'markdown.index']);

$router->group(['prefix' => 'api/v1', "namespace" => "Api"], function ($router) {
    $router->resource("todo", "ToDoController", [
        "names" => [
            "index" => "api.todo.index",
            "store" => "api.todo.store"
        ],
        "only" => [
            "index", "store"
        ]
    ]);
    $router->resource("markdown", "MarkdownController", [
        "names" => [
            "index" => "api.markdown.index",
            "store" => "api.markdown.store"
        ],
        "only" => [
            "index", "store"
        ]
    ]);
});
