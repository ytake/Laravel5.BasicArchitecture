<?php

class MarkdwonCommandTest extends \TestCase
{
    /** @var  \App\Commands\MarkdownCommand */
    protected $command;
    public function setUp()
    {
        parent::setUp();
        $this->command = new \App\Commands\MarkdownCommand("testing");
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function test()
    {
        $stubFile = base_path("tests/resources/testing.md");
        $repository = new \App\Repositories\MarkdownRepository;
        $path = $repository->file($stubFile);
        $this->command->handle($path);
        $this->assertSame("testing", $repository->read());
    }

}