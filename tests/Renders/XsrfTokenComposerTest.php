<?php

use App\Renders\XsrfTokenComposer;

class XsrfTokenComposerTest extends \TestCase
{
    /** @var \App\Renders\XsrfTokenComposer */
    protected $composer;

    public function setUp()
    {
        parent::setUp();
        $this->composer = new XsrfTokenComposer(
            \App::make("Illuminate\Contracts\Encryption\Encrypter")
        );
    }

    public function testViewComposer()
    {
        /** @var Illuminate\View\Factory $factory */
        $factory = app('Illuminate\Contracts\View\Factory');
        $response = new \Illuminate\Http\Response($factory->make('markdown.index'));
        $this->assertArrayHasKey('xsrf_token', $response->original->getData());
    }
}