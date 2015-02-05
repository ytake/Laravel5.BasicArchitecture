<?php
namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;

/**
 * Class TokenController
 * @package App\Controllers\Api
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class TokenController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $array = [
            'token' => \Session::getToken()
        ];
        return response($array);
    }

}
