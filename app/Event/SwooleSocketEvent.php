<?php
namespace App\Event;
use CloverSwoole\CloverSwoole\Facade\SwooleSocket\Exception\Exception;
use CloverSwoole\CloverSwoole\Facade\SwooleSocket\ServerEventInterface;
use CloverSwoole\CloverSwoole\Facade\SwooleSocket\SocketFrame;
use CloverSwoole\CloverSwoole\Facade\SwooleSocket\SocketServer;

/**
 * Swoole Socket 事件模型
 * Class SwooleSocketEvent
 * @package App\Event
 */
class SwooleSocketEvent implements ServerEventInterface
{
    /**
     * 服务关闭
     * @param $server
     * @param int $fd
     * @return mixed|void
     */
    public function onClose($server,$fd)
    {
        try{
            echo "连接关闭:{$fd} \n";
        }catch (\Throwable $exception){
            /**
             * 处理异常
             */
            echo "异常:{$exception -> getMessage()}\n";
        }
    }

    /**
     * 服务关闭
     * @param \swoole_websocket_server $server
     * @param \swoole_http_request $request
     * @return mixed|void
     */
    public function onOpen(\swoole_websocket_server $server, \swoole_http_request $request)
    {
        try{
            echo "连接到达\n";
        }catch (\Throwable $exception){
            echo "异常:{$exception -> getMessage()}\n";
        }
    }

    /**
     * 消息到达
     * @param \swoole_websocket_server $server
     * @param \swoole_websocket_frame $frame
     * @return mixed|void
     */
    public function onMessage(\swoole_websocket_server $server, \swoole_websocket_frame $frame)
    {
        try{
            /**
             * 设置全局访问服务
             */
            (new SocketServer()) -> boot($server) -> setAsGlobal(true);
            /**
             * 设置全局访问消息
             */
            (new SocketFrame()) -> boot($frame) -> setAsGlobal(true);
            /**
             * 判断信息是否正确
             */
            if(!(SocketFrame::getInterface() -> getOpcode() == 1 && SocketFrame::getInterface() -> getFinish() == true && strlen(SocketFrame::getInterface() -> getData()) > 0)){
                throw new Exception('数据非法');
            }
            /**
             * 格式化数据
             */
            $data = json_decode(SocketFrame::getInterface() -> getData(),1);
            /**
             * 应用名过滤
             */
            if((!isset($data['app'])) || strlen($data['app']) < 1){
                $data['app'] = 'Index';
//                throw new Exception('应用不存在');
            }
            /**
             * 模块过滤
             */
            if((!isset($data['controller'])) || strlen($data['controller']) < 1){
                $data['controller'] = 'Index';
//                throw new Exception('模块不存在');
            }
            /**
             * 操作不存在
             */
            if((!isset($data['action'])) || strlen($data['action']) < 1){
                $data['action'] = 'index';
//                throw new Exception('操作不存在');
            }
            /**
             * 获取消息的操作目的
             */
            $class = '\App\Socket\\'.$data['app'].'\\'.$data['controller'];
            /**
             * 判断控制器是否存在
             */
            if(!class_exists($class)){
                throw new Exception('找不到指定控制器:'.$class);
            }
            /**
             * 实例化控制器
             */
            (new $class(SocketServer::getInterface(),SocketFrame::getInterface())) -> __hook($data['action']);
        }catch (\Throwable $exception){
            dump($exception);
            /**
             * 处理异常
             */
            echo "异常:{$exception -> getMessage()}\n";
        }
    }

    /**
     * 消息到达
     * @param \swoole_http_request $request
     * @param \swoole_http_response $response
     * @return mixed|void
     */
    public function onRequest(\swoole_http_request $request, \swoole_http_response $response)
    {
        echo "WebAndSocketOnRequestEd\n";
    }

    /**
     * 服务关闭
     * @param \swoole_websocket_server $server
     * @return mixed|void
     */
    public function onShutdown(\swoole_websocket_server $server)
    {
        echo "WebAndSocketOnShutdownEd\n";
    }

    /**
     * 服务启动
     * @param \swoole_websocket_server $server
     * @return mixed|void
     */
    public function onStart(\swoole_websocket_server $server)
    {
        echo "WebAndSocketOnStarted\n";
    }
}