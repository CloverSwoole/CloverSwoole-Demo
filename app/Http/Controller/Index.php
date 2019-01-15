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
        $res = \App\Models\Users::take(1) -> get();
        $this->ReturnJosn($res);
    }
}