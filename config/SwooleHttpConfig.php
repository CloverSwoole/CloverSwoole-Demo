<?php
namespace Config;
use Illuminate\Container\Container;
use Itxiao6\Framework\Facade\SwooleHttp\ConfigInterface;

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
                'daemonize'=>true,
                'pid_file'=>'/Users/itxiao6/Desktop/object/Framework/Temp/http_swoole_pid.pid',
            ],
        ];
    }
}