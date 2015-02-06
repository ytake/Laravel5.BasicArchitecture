<?php
namespace App\Blade;

/**
 * Class ExtensionCompiler
 * @package App\Blade
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class ExtensionCompiler
{

    /** @var array  */
    protected $extensions = [
        "compileXsrfToken",
    ];

    /**
     * register blade extension
     */
    public function registerExtensions()
    {
        foreach($this->extensions as $extension) {
            call_user_func([$this, $extension]);
        }
    }

    /**
     * for X-XSRF-TOKEN(@xsrf_token)
     *
     */
    protected function compileXsrfToken()
    {
        \Blade::extend(function($view, $compiler) {
            $encrypt = app("Illuminate\Contracts\Encryption\Encrypter");
            $pattern = $compiler->createPlainMatcher("xsrf_token");
            $replace = "<?php echo '{$encrypt->encrypt(csrf_token())}' ?>";
            return preg_replace($pattern, '$1'.$replace, $view);
        });
    }
}