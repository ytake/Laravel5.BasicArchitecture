<?php
namespace App\Commands;

use Illuminate\Contracts\Bus\SelfHandling;
use App\Repositories\MarkdownRepositoryInterface;

/**
 * Class MarkdownCommand
 * @package App\Commands
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class MarkdownCommand extends Command implements SelfHandling
{

    /** @var string  */
    protected $markdown;

    /**
     * @param $markdown
     */
    public function __construct($markdown)
    {
        $this->markdown = $markdown;
    }

    /**
     * @param MarkdownRepositoryInterface $markdown
     */
    public function handle(MarkdownRepositoryInterface $markdown)
    {
        $markdown->put($this->markdown);
    }

}
