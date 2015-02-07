<?php
namespace App\Http\Controllers;

/**
 * Class MarkdownController
 * @package App\Http\Controllers
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class MarkdownController extends Controller
{

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('markdown.index');
    }

}
