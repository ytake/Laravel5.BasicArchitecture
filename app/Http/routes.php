<?php
/** @var \Illuminate\Routing\Router $router */
$router->controller("legacy", "LegacyController", [
    "getForm" => 'legacy.form',
    "postConfirm" => 'legacy.confirm',
    "postApply" => 'legacy.apply'
]);
$router->group(["namespace" => "App\Http\Controllers"], function ($router) {
    $router->get('', ['uses' => "HomeController@index", 'as' => 'index']);
    $router->get("todo", ['uses' => "ToDoController@index", 'as' => 'todo.front.index']);
    $router->get("markdown", ['uses' => "MarkdownController@index", 'as' => 'markdown.index']);

    $router->group(['prefix' => 'api/v1', "namespace" => "Api"], function ($router) {
        $router->resource("todo", "ToDoController", [
            "names" => [
                "index" => "api.todo.index",
                "store" => "api.todo.store",
                "destroy" => "api.todo.destroy"
            ],
            "only" => [
                "index", "store", "destroy"
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
});
