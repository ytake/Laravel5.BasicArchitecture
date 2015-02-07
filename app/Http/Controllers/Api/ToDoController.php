<?php
namespace App\Http\Controllers\Api;

use App\Http\Requests\ToDoRequest;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Events\Dispatcher;
use App\Repositories\TodoRepositoryInterface;

/**
 * Class ToDoController
 * @package App\Http\Controllers
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class ToDoController extends Controller
{

    /** @var TodoRepositoryInterface  */
    protected $todo;

    /**
     * @param TodoRepositoryInterface $todo
     */
    public function __construct(TodoRepositoryInterface $todo)
    {
        $this->todo = $todo;
    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return response($this->todo->all());
    }

    /**
     * @param ToDoRequest $request
     * @param Dispatcher $dispatcher
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function store(ToDoRequest $request, Dispatcher $dispatcher)
    {
        $this->todo->store(
            $request->get("title")
        );
        $dispatcher->fire('todo.add');
        return response($this->todo->all());
    }
}
