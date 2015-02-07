<?php
namespace App\Renders;

use Illuminate\View\View;
use Illuminate\Contracts\Encryption\Encrypter;

/**
 * Class XsrfTokenComposer
 * @package App\Renders
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class XsrfTokenComposer
{

    /** @var Encrypter */
    protected $encrypt;

    /**
     * @param Encrypter $encrypt
     */
    public function __construct(Encrypter $encrypt)
    {
        $this->encrypt = $encrypt;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('xsrf_token', $this->encrypt->encrypt(csrf_token()));
    }
}
