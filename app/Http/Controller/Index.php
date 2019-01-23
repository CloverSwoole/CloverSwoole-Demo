<?php
namespace App\Http\Controller;
use App\Models\Users;
use CloverSwoole\CloverSwoole\Facade\Http\Abstracts\Controller;
use CloverSwoole\CloverSwoole\Facade\Http\Request;
use CloverSwoole\CloverSwoole\Facade\Http\Response;
use CloverSwoole\CloverSwoole\Facade\SwooleHttp\ServerManage;

/**
 *
 * Class Index
 * @package App\Http\Controller
 */
class Index extends Controller
{

    function index()
    {
        $this -> returnJosn(['name'=>'戒尺','age'=>20,'sex'=>'男']);
    }
    function dump()
    {
        Response::dump(Request::getInterface() -> getGetParam() -> getGets());
    }
    function test_login()
    {
        try{
            Users::login($this -> __getRequest() -> getPostParam() -> getPost('username'),$this -> __getRequest() -> getPostParam() -> getPost('password'));
            $this -> returnJosn(['status'=>200,'msg'=>'登录成功']);
        }catch (\Throwable $throwable){
            $this -> returnJosn(['status'=>400,'msg'=>$throwable -> getMessage()]);
        }
    }
    public function db_test()
    {
        $this -> returnJosn(Users::where('id','!=',1) -> get());
    }
    public function server_debug()
    {
        Response::dump(ServerManage::getInterface() -> getRawServer());
    }
    function route()
    {
        $url = $this -> route -> getRequest() -> getRawRequest() -> server['path_info'];
        Response::dump($url);
    }
}