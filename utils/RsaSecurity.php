<?php
/**
 * Class RsaSecurity
 * @package app\common\utils
 */
class RsaSecurity{
    /**
     * @var array 公钥私钥
     */
    private $_config = [
        'public_key'  => '',
        'private_key' => ''
    ];
    /**
     * RsaSecurity constructor.
     * @param $private_key_filepath 私钥路径
     * @param $public_key_filepath 公钥路径
     * @desc 初始化私钥公钥
     */
    public function __construct($private_key_filepath,$public_key_filepath){
        $this->_config['private_key'] = $this->_getContents($private_key_filepath);
        $this->_config['public_key'] = $this->_getContents($public_key_filepath);
    }
    /**
     * @param $file_path 文件路径
     * @return string
     * @desc 获取文件内容
     */
    public function _getContents($file_path){
        file_exists($file_path) or die('私钥或公钥的文件路径错误');
        return file_get_contents($file_path);
    }
    /**
     * @return mixed 返回解析过的key 供其他函数使用
     * @desc 获取私钥
     */
    public function _getPrivateKey(){
        $priv_key = $this->_config['private_key'];
        return openssl_pkey_get_private($priv_key);
    }
    /**
     * @return resource
     * @desc 获取公钥
     */
    public function _getPublicKey(){
        $public_key = $this->_config['public_key'];
        return openssl_pkey_get_public($public_key);
    }
    /**
     * @param string $data 加密数据
     * @return null|string 加密后的字符串
     * @desc 私钥加密，注意加密只能加密字符串
     */
    public function privEncrypt($data = ''){
        if(!is_string($data)){
            return null;
        }
        return openssl_private_encrypt($data,$encrypted,$this->_getPrivateKey()) ? base64_encode($encrypted):null;
    }
    /**
     * @param string $data 加密数据
     * @return null|string
     * @desc 公钥加密
     */
    public function publicEncrypt($data = ''){
        if(!is_string($data)){
            return null;
        }
        return openssl_public_encrypt($data,$encrypted,$this->_getPublicKey())?base64_encode($encrypted):null;
    }
    /**
     * @param string $encrypted
     * @return null
     * @desc 私钥解密
     */
    public function privDecrypt($encrypted = ''){
        if (!is_string($encrypted)){
            return null;
        }
        return openssl_private_decrypt(base64_decode($encrypted),$decrypted,$this->_getPrivateKey()) ? $decrypted : null;
    }
    /**
     * @param string $encrypted
     * @return null
     * @desc 公钥解密
     */
    public function publicDecrypt($encrypted = ''){
        if (!is_string($encrypted)){
            return null;
        }
        return openssl_public_decrypt(base64_decode($encrypted),$decrypted,$this->_getPublicKey()) ? $decrypted : null;
    }
}