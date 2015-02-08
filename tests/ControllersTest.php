<?php
use Mockery as m;

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
        m::close();
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
        $this->assertSame(302, $response->getStatusCode());
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
        $this->assertSame(302, $response->getStatusCode());
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
        $this->assertSame(302, $response->getStatusCode());
    }

    public function testApiMarkdownController()
    {
        \App::bind("Illuminate\Contracts\Bus\Dispatcher", "MockCommandBus");
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
        $dispatcher = \App::make("Illuminate\Contracts\Events\Dispatcher");

        $this->assertInstanceOf("Illuminate\Http\Response",
            $todoController->store($request, $dispatcher)
        );

        $response = $this->call("GET", "/api/v1/todo");
        $this->assertSame(200, $response->getStatusCode());
        $response = $this->call("POST", "/api/v1/todo", ["_token" => \Session::token()]);
        $this->assertSame(302, $response->getStatusCode());
        $response = $this->call("POST", "/api/v1/todo", ["_token" => \Session::token(), 'title' => 'testing']);
        $this->assertSame(200, $response->getStatusCode());
        $response = $this->call("DELETE", "/api/v1/todo/1", ["_token" => \Session::token()]);
        $this->assertSame(200, $response->getStatusCode());
    }

    public function testLegacyController()
    {
        $controller = new LegacyController();
        $this->assertInstanceOf("Illuminate\View\View", $controller->getForm());
        $request = new \App\Http\Requests\LegacyFormRequest();
        $this->assertInstanceOf("Illuminate\View\View", $controller->postConfirm($request));
        $this->assertInstanceOf("Illuminate\View\View", $controller->postApply(new \Illuminate\Http\Request()));
        \Illuminate\Support\Facades\Request::setSession(\Session::driver('array'));
        $response = $this->call("GET", "/legacy/form");
        $this->assertSame(200, $response->getStatusCode());
        $response = $this->call("POST", "/legacy/confirm");
        $this->assertSame(302, $response->getStatusCode());
        $response = $this->call("POST", "/legacy/apply");
        $this->assertSame(302, $response->getStatusCode());

        $request = [
            'name' => "mame",
            'email' => 'yuuki.takezawa@comnect.jp.net',
            "_token" => \Session::token()
        ];
        $response = $this->call("POST", "/legacy/confirm", $request);
        $this->assertSame(200, $response->getStatusCode());
        $response = $this->call("POST", "/legacy/apply", $request);
        $this->assertSame(200, $response->getStatusCode());

        $response = $this->call("POST", "/legacy/confirm", [], [], [], ['X-Requested-With' => 'XMLHttpRequest']);
        $this->assertSame(302, $response->getStatusCode());

    }
}


class MockCommandBus implements \Illuminate\Contracts\Bus\Dispatcher
{
    /**
     * Marshal a command and dispatch it to its appropriate handler.
     *
     * @param  mixed $command
     * @param  array $array
     * @return mixed
     */
    public function dispatchFromArray($command, array $array)
    {
        // TODO: Implement dispatchFromArray() method.
    }

    /**
     * Marshal a command and dispatch it to its appropriate handler.
     *
     * @param  mixed $command
     * @param  \ArrayAccess $source
     * @param  array $extras
     * @return mixed
     */
    public function dispatchFrom($command, ArrayAccess $source, array $extras = [])
    {
        // TODO: Implement dispatchFrom() method.
    }

    /**
     * Dispatch a command to its appropriate handler.
     *
     * @param  mixed $command
     * @param  \Closure|null $afterResolving
     * @return mixed
     */
    public function dispatch($command, Closure $afterResolving = null)
    {
        // TODO: Implement dispatch() method.
    }

    /**
     * Dispatch a command to its appropriate handler in the current process.
     *
     * @param  mixed $command
     * @param  \Closure|null $afterResolving
     * @return mixed
     */
    public function dispatchNow($command, Closure $afterResolving = null)
    {
        // TODO: Implement dispatchNow() method.
    }

}
