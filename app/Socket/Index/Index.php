<?php
namespace App\Socket\Index;
use CloverSwoole\CloverSwoole\Facade\Socket\Abstracts\SocketController;

/**
 * Class Index
 * @package App\Socket\Index
 */
class Index extends SocketController
{
    public function index()
    {
        $this -> returnJosn(['status'=>1,'name'=>'戒尺']);
    }
}