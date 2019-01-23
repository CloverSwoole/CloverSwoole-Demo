#!/usr/bin/env php
<?php
include __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';
use CloverSwoole\CloverSwoole\Bootstrap;
/**
 * 获取框架实例
 */
$app = \CloverSwoole\CloverSwoole\Framework::getContainerInterface();
/**
 * 绑定启动器
 */
$app -> bind(\CloverSwoole\CloverSwoole\BootstrapInterface::class,Bootstrap::class);
/**
 * 初始化框架
 */
$app -> make(\CloverSwoole\CloverSwoole\BootstrapInterface::class) -> init($app);

/**
 * <=================== 自定义操作 ===========================>
 */
/**
 * 加载环境配置
 */
$app -> make('environment') -> boot($app,__DIR__.DIRECTORY_SEPARATOR);
/**
 * 注入数据库配置(自定义配置)
 */
$app -> bind(\CloverSwoole\CloverSwoole\Facade\Databases\ConfigInterface::class,\Config\Databases::class);
/**
 * 注入swoole HTTP 组件配置(自定义配置)
 */
$app -> bind(\CloverSwoole\CloverSwoole\Facade\SwooleHttp\ConfigInterface::class,\Config\SwooleHttpConfig::class);
/**
 * Swoole Socket 配置注入(自定义配置)
 */
$app -> bind(\CloverSwoole\CloverSwoole\Facade\SwooleSocket\ConfigInterface::class,\Config\SwooleSocketConfig::class);
/**
 * Swoole Socket 定义事件模型
 */
$app -> bind(\CloverSwoole\CloverSwoole\Facade\SwooleSocket\ServerEventInterface::class,\App\Event\SwooleSocketEvent::class);
/**
 * Swoole Http 自定义事件模型
 */
$app -> bind(\CloverSwoole\CloverSwoole\Facade\SwooleHttp\ServerEventInterface::class,\App\Event\SwooleHttpEvent::class);

/**
 * <=================== 启动组件 =====================>
 */

/**
 * 启动swoole socket
 */
$app -> make('swoole_socket') -> boot($app);
