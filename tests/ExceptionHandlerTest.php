<?php


class ExceptionHandlerTest extends TestCase
{
    /** @var \App\Exceptions\Handler */
    protected $exception;

    public function setUp()
    {
        parent::setUp();
        $this->exception = new \App\Exceptions\Handler(\App::make('log'));
    }

    public function testRender()
    {
        $exception = $this->exception->render(
            new \Illuminate\Http\Request(),
            new \Illuminate\Session\TokenMismatchException()
        );
        $this->assertInstanceOf("Illuminate\Http\RedirectResponse", $exception);
    }
}