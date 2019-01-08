<?php
namespace App\Http\Controller;


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
        $this -> response -> getRawResponse() -> header('Content-type','application/json;charset=utf-8');
//        $this -> response -> endResponse();
//        $res = \App\Models\Users::take(1) -> get();
        $res = [1=>2];
        $this->ReturnJosn($res);
//        $this -> response -> endResponse();
    }
}