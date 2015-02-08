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
            "id" => 1,
            "title" => "hello"
        ],
        [
            "id" => 2,
            "title" => "Laravel5"
        ]
    ];

    /**
     * @param string $title
     * @return mixed
     */
    public function store($title)
    {
        $data = $this->all();
        $result = array_merge($data, [["id" => count($data) + 1, "title" => $title]]);
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

    /**
     * @param $id
     * @return mixed
     */
    public function remove($id)
    {
        $result = \Session::get($this->key);
        foreach($result as $row => $value) {
            if($value['id'] === (int)$id) {
                unset($result[$row]);
            }
        }
        \Session::set($this->key, $result);
        return $this->all();
    }

}
