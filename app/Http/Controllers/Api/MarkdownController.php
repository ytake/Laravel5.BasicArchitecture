<?php
namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Http\Requests\MarkdownRequest;
use App\Repositories\MarkdownRepositoryInterface;
use Illuminate\Foundation\Bus\DispatchesCommands;

/**
 * Class MarkdownController
 * @package App\Http\Controllers\Api
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class MarkdownController extends Controller
{

    use DispatchesCommands;

    /** @var MarkdownRepositoryInterface  */
    protected $markdown;

    /**
     * @param MarkdownRepositoryInterface $markdown
     */
    public function __construct(MarkdownRepositoryInterface $markdown)
    {
        $this->markdown = $markdown;
    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return response(["markdown" => $this->markdown->read()]);
    }

    /**
     * @param MarkdownRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function store(MarkdownRequest $request)
    {
        $this->dispatchFrom("App\Commands\MarkdownCommand", $request);
        return response(["markdown" => $request->markdown]);
    }

}
