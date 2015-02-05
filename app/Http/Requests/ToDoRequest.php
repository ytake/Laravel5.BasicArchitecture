<?php
namespace App\Http\Requests;

/**
 * Class ToDoRequest
 * @package App\Http\Requests
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class ToDoRequest extends Request
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            "title" => "required"
        ];
    }

    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

}
