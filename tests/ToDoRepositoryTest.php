<?php

class ToDoRepositoryTest extends \TestCase
{
    /** @var  \App\Repositories\ToDoRepository */
    protected $repository;
    public function setUp()
    {
        parent::setUp();
        $this->repository = new \App\Repositories\ToDoRepository();
    }

    public function testAll()
    {
        $this->assertInternalType("array", $this->repository->all());
        $this->assertCount(2, $this->repository->all());
    }

    public function testStore()
    {
        $this->repository->store("testing");
        foreach($this->repository->all() as $row) {
            $this->assertContains($row['title'], ["hello", "Laravel5", "testing"]);
        }
        $this->assertCount(3, $this->repository->all());
    }
}
