<?php
/**
 * Created by PhpStorm.
 * User: zhangziang
 * Date: 2019/1/5
 * Time: 下午12:03
 */
namespace App\Lib\Utils;
use Mockery\Exception;

class Encrypt{
    public static function passwdEncode($passwd){
        return md5($passwd);
    }
}
