<?php
namespace App\Repositories;

/**
 * Interface MarkdownRepositoryInterface
 * @package App\Repositories
 */
interface MarkdownRepositoryInterface
{

    /**
     * @param $path
     * @return $this
     */
    public function file($path);

    /**
     * @return mixed
     */
    public function read();

    /**
     * @param $text
     * @return mixed
     */
    public function put($text);

}
