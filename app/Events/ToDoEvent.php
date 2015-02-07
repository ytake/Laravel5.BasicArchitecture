<?php
namespace App\Events;

use Carbon\Carbon;
use Illuminate\Contracts\Logging\Log;

/**
 * Class ToDoEvent
 * @package App\Events
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class ToDoEvent extends Event
{

    /** @var Log */
    protected $log;

    /**
     * @param Log $log
     */
    public function __construct(Log $log)
    {
        $this->log = $log;
    }

    /**
     * @return void
     */
    public function handle()
    {
        $this->log->useFiles(storage_path('logs/todo.log'));
        $this->log->info("added new Task", ["created" => Carbon::now()->getTimestamp()]);
    }

}
