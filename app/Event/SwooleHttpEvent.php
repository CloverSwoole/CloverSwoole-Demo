<?php
namespace App\Event;

use Illuminate\Container\Container;
use Itxiao6\Framework\Facade\SwooleHttp\HttpServer;

/**
 * 服务事件模型
 * Class SwooleHttpEvent
 * @package Itxiao6\Framework\Facade\SwooleHttp
 */
class SwooleHttpEvent
{
    /**
     * 服务容器
     * @var null|Container
     */
    protected $container = null;

    public function __construct(?Container $container = null)
    {
        /**
         * 判断容器是否有效
         */
        if(!($container instanceof Container)){
            $this -> container = $container;
        }
    }
    /**
     * 服务启动
     * @param \Swoole\Http\Server $server
     * @return mixed|void
     */
    public function onStart(\Swoole\Http\Server $server)
    {
        echo "onStarted\n";
    }
    /**
     * 消息到达
     * @param \swoole_http_request $request
     * @param \swoole_http_response $response
     * @return mixed|void
     */
    public function onRequest(\swoole_http_request $request, \swoole_http_response $response)
    {
        /**
         * 实例化WebServer
         */
        $http_service = new HttpServer($this -> container);
        /**
         * 请求到达
         */
        $http_service -> onRequest($request,$response);
        return ;
    }

    /**
     * 服务关闭
     * @param \Swoole\Http\Server $server
     * @return mixed|void
     */
    public function onShutdown(\Swoole\Http\Server $server)
    {
        echo "onShutdownEd\n";
    }
    /**
     * 服务关闭
     * @param \Swoole\Http\Server $server
     * @param int $fd
     * @return mixed|void
     */
    public function onClose(\Swoole\Http\Server $server,$fd)
    {
        echo "Server Closed\n";
    }

    /**
     * 服务关闭
     * @param \Swoole\Http\Server $server
     * @param \Swoole\Http\Server $request
     * @return mixed|void
     */
    public function onOpen(\Swoole\Http\Server $server, \Swoole\Http\Server $request)
    {
        echo "opOpened\n";
    }
}