<?php
/**
 * Created by PhpStorm.
 * User: zhangziang
 * Date: 2018/10/17
 * Time: 上午12:38
 */

namespace App\Model;
use App\Dao\DaoUser;
use App\Lib\Utils\Encrypt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use APP\Dao\DaoTodoBase;
class ModelUser{

    public function __construct(){
        $this->objDao = new DaoUser();
    }
    public function getUserid(){
        $this->objDao->getUserInfo();
    }
    public function getUserInfoByUsername($username){
        $this->objDao->getUserInfo($username);
    }
    public function login($username,$passwd){
        $passwd=Encrypt::passwdEncode($passwd);
        $res = $this->objDao->getuserInfoByNameAndPasswd($username,$passwd);
        if($res){
            unset($res['passwd']);
        }
        return $res;
    }
    public function addUser($params){
        $res = $this->objDao->getUserInfo($params['username']);
        if($res){
            throw new \Exception("用户已存在");
        }
        $passwd = Encrypt::passwdEncode($params['passwd']);
        return $this->objDao->addOne($username=$params['username'], $passwd=$passwd,  $nickname=$params['nickname'] );
    }
}