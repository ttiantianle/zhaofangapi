<?php
namespace Home\Controllers;
use Home\Controllers\ControllerBase;
use Common\Utils\CFunc;
class IndexController extends ControllerBase
{

    public function indexAction()
    {

    }
    public function textAction(){
        $ne = new CFunc();
        CFunc::returnjson('0','没有错误！你好世界！');
//        echo "hello world";
    }

}

