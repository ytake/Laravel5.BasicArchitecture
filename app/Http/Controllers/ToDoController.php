<?php
namespace App\Http\Controllers;

/**
 * Class ToDoController
 * @package App\Http\Controllers
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class ToDoController extends Controller
{

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $encrypt = app("Illuminate\Contracts\Encryption\Encrypter");
        return view('todo.index')->with('token', $encrypt->encrypt(csrf_token()));
    }
}
