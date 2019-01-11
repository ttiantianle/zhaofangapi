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
        APP_PATH . '/common/utils/',
        APP_PATH . '/common/controllers/',
        APP_PATH . '/common/models/',
        //后端模块
        APP_PATH . '/backend/controllers/',
        APP_PATH . '/backend/models/',
        //前端模块
        APP_PATH.'/frontend/models/',
        APP_PATH.'/frontend/controllers/',
    ]
);
$loader->registerNamespaces([
    //公共模块
    'Common\Utils' =>APP_PATH.'/common/utils/',
    'Common\Controllers' =>APP_PATH.'/common/controllers/',
    'Common\Models' =>APP_PATH.'/common/models/',
    //后端模块
    'Home\Models' => APP_PATH.'/backend/models/',
//    'Home\Service' => APP_PATH.'/service/',
    'Home\Controllers' => APP_PATH.'/backend/controllers/',
    //front 前端模块
    'Front\Models' => APP_PATH.'/frontend/models/',
//    'Front\Service' => BASE_PATH.'/front/service/',
    'Front\Controllers' => APP_PATH.'/frontend/controllers/',
]);

$loader->register();