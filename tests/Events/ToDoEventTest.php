<?php

use App\Events\ToDoEvent;

class ToDoEventTest extends \TestCase
{
    /** @var \App\Events\ToDoEvent  */
    protected $events;
    /** @var  \Illuminate\Filesystem\Filesystem */
    protected $file;
    public function setUp()
    {
        parent::setUp();
        $this->events = new ToDoEvent(\App::make('log'));
        $this->file = new \Illuminate\Filesystem\Filesystem;
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function testHandler()
    {
        $this->events->handle();
        $this->assertTrue($this->file->exists(storage_path('logs/todo.log')));
    }
}