<?php
namespace Config;
/**
 * 自定义数据库配置
 * Class Datbases
 * @package Config
 */
class Databases implements \Itxiao6\Framework\Facade\Databases\ConfigInterface
{
    public function boot(?\Illuminate\Container\Container $container = null)
    {
        if(!($container instanceof \Illuminate\Container\Container)){
            $container = new \Illuminate\Container\Container();
        }
        $container['config']['database'] = [
            'driver'=>'mysql',
            'host'=>'127.0.0.1',
            'database'=>'test',
            'username'=>'root',
            'password'=>'123456',
            'charset'=>'utf8',
            'collation'=>'utf8_general_ci',
            'prefix'=>''
        ];
    }
}