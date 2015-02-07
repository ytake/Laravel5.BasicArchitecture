<?php

class ControllersTest extends \TestCase
{
    /** @var Illuminate\Contracts\View\Factory  */
    protected $factory;

    public function setUp()
    {
        parent::setUp();
        /** @var Illuminate\View\Factory $factory */
        $this->factory = app('Illuminate\Contracts\View\Factory');
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function testHomeController()
    {
        $homeController = new \App\Http\Controllers\HomeController();
        $this->assertInstanceOf("Illuminate\View\View", $homeController->index());
        $response = new \Illuminate\Http\Response($this->factory->make('home.index'));
        $this->assertArrayNotHasKey('xsrf_token', $response->original->getData());
        $response = $this->call("GET", "");
        $this->assertSame(200, $response->getStatusCode());
        $response = $this->call("POST", "");
        $this->assertSame(500, $response->getStatusCode());
    }

    public function testToDoController()
    {
        $todoController = new \App\Http\Controllers\ToDoController();
        $this->assertInstanceOf("Illuminate\View\View", $todoController->index());
        $response = new \Illuminate\Http\Response($this->factory->make('todo.index'));
        $this->assertArrayHasKey('xsrf_token', $response->original->getData());
        $response = $this->call("GET", "/todo");
        $this->assertSame(200, $response->getStatusCode());
        $response = $this->call("POST", "/todo");
        $this->assertSame(500, $response->getStatusCode());
    }

    public function testMarkdownController()
    {
        $todoController = new \App\Http\Controllers\MarkdownController();
        $this->assertInstanceOf("Illuminate\View\View", $todoController->index());
        $response = new \Illuminate\Http\Response($this->factory->make('markdown.index'));
        $this->assertArrayHasKey('xsrf_token', $response->original->getData());
        $response = $this->call("GET", "/markdown");
        $this->assertSame(200, $response->getStatusCode());
        $response = $this->call("POST", "/markdown");
        $this->assertSame(500, $response->getStatusCode());
    }

    public function testApiMarkdownController()
    {
        $stubFile = base_path("tests/resources/testing.md");
        $repository = new \App\Repositories\MarkdownRepository;
        $path = $repository->file($stubFile);
        $markdownController = new \App\Http\Controllers\Api\MarkdownController($path);
        $this->assertInstanceOf("Illuminate\Http\Response", $response = $markdownController->index());
        $this->assertInstanceOf("stdClass", json_decode($response->getContent()));
        $request = new \App\Http\Requests\MarkdownRequest;
        $request['markdown'] = "testing";
        $this->assertInstanceOf("Illuminate\Http\Response", $markdownController->store($request));

        $response = $this->call("GET", "/api/v1/markdown");
        $this->assertSame(200, $response->getStatusCode());
        $response = $this->call("POST", "/api/v1/markdown", ["_token" => \Session::token()]);
        $this->assertSame(403, $response->getStatusCode());
        $response = $this->call("POST", "/api/v1/markdown", ["_token" => \Session::token(), 'markdown' => 'testing']);
        $this->assertSame(200, $response->getStatusCode());
    }

    public function testApiToDoController()
    {
        $repository = new \App\Repositories\ToDoRepository();
        $todoController = new \App\Http\Controllers\Api\ToDoController($repository);
        $this->assertInstanceOf("Illuminate\Http\Response", $response = $todoController->index());
        $this->assertInternalType("array", json_decode($response->getContent()));
        $request = new \App\Http\Requests\ToDoRequest;
        $request['title'] = "testing";
        $this->assertInstanceOf("Illuminate\Http\Response",
            $todoController->store($request, \App::make("Illuminate\Contracts\Events\Dispatcher"))
        );

        $response = $this->call("GET", "/api/v1/todo");
        $this->assertSame(200, $response->getStatusCode());
        $response = $this->call("POST", "/api/v1/todo", ["_token" => \Session::token()]);
        $this->assertSame(302, $response->getStatusCode());
        $response = $this->call("POST", "/api/v1/todo", ["_token" => \Session::token(), 'title' => 'testing']);
        $this->assertSame(200, $response->getStatusCode());
    }
}