<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class Login extends Controller
{
    const LOGIN_USERNAME_PASSWD="web";
    const LOGIN_TOKEN="client";
    public $loginType;
    public $userName;
    public $nickname;
    public $passwd;
    public $token;
    public $filter=array("logintype");
   public function login(){
       $param=$this->getParam();
       $this->loginType = $param["logintype"];
       if(self::LOGIN_TOKEN==$this->loginType){
          return  $this->verifyToken($param);
       }else{
          return  $this->verifyUser($param);
       }
   }
   public function verifyToken($arr){
      $res = $this->filterParam($arr,["token"]);
      if($res){
//          todo token登录
      }

   }
    public function verifyUser($arr){
        $res = $this->filterParam($arr,["user","passwd"]);
    }

}
