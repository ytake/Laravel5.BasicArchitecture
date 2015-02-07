<?php
namespace App\Http\Requests;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class MarkdownRequest
 * @package App\Http\Requests
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class MarkdownRequest extends Request
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            "markdown" => "required"
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
     * @param array $errors
     * @return JsonResponse
     */
    public function response(array $errors)
    {
        return new JsonResponse($errors, 403);
    }

}
