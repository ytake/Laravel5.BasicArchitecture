<?php
namespace App\Repositories;

/**
 * Class MarkdownRepository
 * @package App\Repositories
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class MarkdownRepository implements MarkdownRepositoryInterface
{

    /** @var null  */
    public $path;

    /**
     * @param $path
     * @return $this
     */
    public function file($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return string
     */
    public function read()
    {
        return \File::get($this->path);
    }

    /**
     * @param $text
     * @return int
     */
    public function put($text)
    {
        return \File::put($this->path, $text);
    }

}
