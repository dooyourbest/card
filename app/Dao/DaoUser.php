<?php
/**
 * Created by PhpStorm.
 * User: zhangziang
 * Date: 2018/10/17
 * Time: 上午12:38
 */


namespace App\Dao;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class DaoUser extends Model{
    public $objDao;
    public function __construct(array $attributes = []){
        parent::__construct($attributes);
        $this->objDao=DB::table('user');
    }

    /**
     * @param $username
     * @param $passwd
     * @param $mail
     * @param $nickname
     * @param $openid
     * @return mixed
     */
    public function addOne($username, $passwd, $nickname, $email='', $mobile='', $openid=''){
        $mtime=$ctime=time();
        $insertmsg=array(
            'username'=>$username,
            'passwd'=>$passwd,
            'mobile'=>$passwd,
            'mobile'=>$mobile,
            'email'=>$email,
            'nickname'=>$nickname,
            'openid'=>$openid,
            'mtime'=>$mtime,
            'ctime'=>$ctime,

        );
        return $this->objDao->insertGetId($insertmsg);
    }

    /**
     * @param $username
     * @return mixed 获取用户信息
     */
    public function getUserInfo($username){
        return $this->objDao->where('username',"=",$username)->get();
    }
    public function getuserInfoByNameAndPasswd($username,$passwd){
       return $this->objDao->where('username',"=",$username)->where('passwd','=',$passwd)->first();
    }

}