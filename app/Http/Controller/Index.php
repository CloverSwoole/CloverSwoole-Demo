<?php
namespace App\Http\Controller;
use Itxiao6\Framework\Facade\SwooleHttp\EasySwoole\Http\Controller;

/**
 *
 * Class Index
 * @package App\Http\Controller
 */
class Index extends Controller
{

    function index()
    {
        $res = \App\Models\Users::take(1) -> get();

        $this->ReturnJosn($res);
    }

    function actionNotFound($action): void
    {
        $this->response()->write("{$action} not found");
    }
    protected function onException(\Throwable $throwable): void
    {
        $this->response()->write($throwable->getMessage());
    }

    protected function gc()
    {
        parent::gc();
//        var_dump('class :'.static::class.' is recycle to pool');
    }
}