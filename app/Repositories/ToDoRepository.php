<?php
namespace App\Repositories;

/**
 * Class ToDoRepository
 * @package App\Repositories
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class ToDoRepository implements ToDoRepositoryInterface
{

    /** @var string  */
    protected $key = "todo.session";

    /** @var array  */
    protected $default = [
        [
            "title" => "hello"
        ],
        [
            "title" => "Laravel5"
        ]
    ];

    /**
     * @param string $title
     * @return mixed
     */
    public function store($title)
    {
        $result = array_merge($this->all(), [["title" => $title]]);
        \Session::set($this->key, $result);
    }

    /**
     * @return array
     */
    public function all()
    {
        $result = \Session::get($this->key);
        if(!count($result)) {
            $result = $this->default;
        }
        return $result;
    }

}
