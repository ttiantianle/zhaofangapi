<?php
/**
 * Class CFunc 存放公共方法的类
 * @package app\common\utils
 */
class CFunc{
    /**
     * @return array
     */
    public static function params(){
        $params = [];
        if($_REQUEST){
            $params = $_REQUEST;
        }
        return $params;
    }
    public static function returnjson($errCode = "0",$message = '',$arr = []){
        $res = [];
        $res['errCode'] = $errCode;
        $res['msg'] = $message;
        $res['data'] = $arr;
        $call = isset($_REQUEST['callback']) ? $_REQUEST['callback'] : '';
//         echo json_encode($res);
        echo $call."(".json_encode($res).")";
    }
    /**
     * @param $arr
     * @return array
     */
    public static function decode_params($arr){
        if(!is_array($arr)){
            echo '参数不合法';
            exit();
        }
        foreach ($arr as $k => $val){
            $arr[$k] =self::_decrypt($val);
        }
        return $arr;
    }
}