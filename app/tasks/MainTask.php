<?php
/**
 * Created by PhpStorm.
 * Project :zhaofangapi
 * Date : 2019/1/11
 * Time : 13:56
 */
use Phalcon\Cli\Task;
use Utils;
class MainTask extends Task{
    public function mainAction(){
        echo "this is the default task and a defualt action ".PHP_EOL;
    }
}