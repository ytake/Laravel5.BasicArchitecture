<?php
namespace App\Repositories;

/**
 * Interface ToDoRepositoryInterface
 * @package App\Repositories
 */
interface ToDoRepositoryInterface
{

    /**
     * @param string $title
     * @return mixed
     */
    public function store($title);

    /**
     * @return array
     */
    public function all();

    /**
     * @param $id
     * @return mixed
     */
    public function remove($id);

}
