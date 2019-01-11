<?php
/**
 * Created by PhpStorm.
 * Project :zhaofangapi
 * Date : 2019/1/11
 * Time : 13:53
 */
use Phalcon\Di\FactoryDefault\Cli as CliDI;
use Phalcon\Cli\Console as ConsoleApp;
use Phalcon\Loader;
// 使用CLI工厂默认服务容器
$di = new CliDI();
/**
 * 注册自动加载器并告诉它注册任务目录
 */
$loader = new Loader();
$loader->registerDirs(
    [
        __DIR__ . '/tasks',
    ]
);
$loader->register();
// 加载配置文件（如果有）
$configFile = __DIR__ . '/config/config.php';
if (is_readable($configFile)) {
    $config = include $configFile;
    $di->set('config', $config);
}
// 创建控制台应用程序
$console = new ConsoleApp();
$console->setDI($di);
/**
 * 处理控制台参数
 */
$arguments = [];
foreach ($argv as $k => $arg) {
    if ($k === 1) {
        $arguments['task'] = $arg;
    } elseif ($k === 2) {
        $arguments['action'] = $arg;
    } elseif ($k >= 3) {
        $arguments['params'][] = $arg;
    }
}
try {
// 处理传入的参数
    $console->handle($arguments);
} catch (\Phalcon\Exception $e) {
// Phalcon在这里做了相关的事情
// ..
    fwrite(STDERR, $e->getMessage() . PHP_EOL);
    exit(1);
} catch (\Throwable $throwable) {
    fwrite(STDERR, $throwable->getMessage() . PHP_EOL);
    exit(1);
}