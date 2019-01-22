<?php
namespace Config;
use Illuminate\Container\Container;
use CloverSwoole\CloverSwoole\Facade\SwooleHttp\ConfigInterface;

/**
 * Swoole Http 配置
 * Class SwooleHttpConfig
 * @package Config
 */
class SwooleHttpConfig implements ConfigInterface
{

    public function boot(?Container $container = null)
    {
        if(!($container instanceof Container)){
            $container = new Container();
        }
        $container['config']['swoole_http'] = [
            'port'=>5200,
            'host'=>'0.0.0.0',
            'server'=>[
                'worker_num'=>50,
                'daemonize'=>false,
                'pid_file'=>__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Temp'.DIRECTORY_SEPARATOR.'swoole_http_pid.pid',
            ],
        ];
    }
}