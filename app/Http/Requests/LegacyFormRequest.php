<?php
namespace App\Http\Requests;

/**
 * Class LegacyFormRequest
 * @package App\Http\Requests
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class LegacyFormRequest extends Request
{

    /** @var string  */
    protected $redirectRoute = "legacy.form";

    /**
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "required",
            "email" => "required|email"
        ];
    }

    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * custom error message
     * @return array
     */
    public function messages()
    {
        return [
            "name.required" => "名前を入力してください",
            "email.required" => "メールアドレスを入力してください",
            "email.email" => "メールアドレスを正しく入力してください",
        ];
    }

}
