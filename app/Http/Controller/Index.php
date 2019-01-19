<?php
namespace App\Http\Controller;
use App\Models\Users;
use Itxiao6\Framework\Facade\Http\Abstracts\Controller;
/**
 *
 * Class Index
 * @package App\Http\Controller
 */
class Index extends Controller
{

    function index()
    {
        try{
            Users::login($this -> __getRequest() -> getPostParam() -> getPost('username'),$this -> __getRequest() -> getPostParam() -> getPost('password'));
            $this -> returnJosn(['status'=>200,'msg'=>'登录成功']);
        }catch (\Throwable $throwable){
            $this -> returnJosn(['status'=>400,'msg'=>$throwable -> getMessage()]);
        }
    }
}