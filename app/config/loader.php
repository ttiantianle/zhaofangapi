<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
//$loader->registerDirs(
//    [
//        $config->application->controllersDir,
//        $config->application->modelsDir
//    ]
//)->register();

$loader->registerDirs(
    [
        //公共模块
        BASE_PATH . '/utils/',
        //后端模块
        APP_PATH . '/controllers/',
        APP_PATH . '/models/',
        //前端模块
        BASE_PATH.'/front/models/',
        BASE_PATH.'/front/controllers/',
    ]
);
$loader->registerNamespaces([
    //公共模块
    'Utils' =>BASE_PATH.'/utils/',
    //后端模块
    'Home\Models' => APP_PATH.'/models/',
    'Home\Service' => APP_PATH.'/service/',
    'Home\Controllers' => APP_PATH.'/controllers/',
    //front 前端模块
    'Front\Models' => BASE_PATH.'/front/models/',
    'Front\Service' => BASE_PATH.'/front/service/',
    'Front\Controllers' => BASE_PATH.'/front/controllers/',
]);

$loader->register();