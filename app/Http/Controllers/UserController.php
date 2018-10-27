<?php
namespace App\Http\Controllers;
use App\Member;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    public function login(){
        $us_name = $_POST['name'];
        $password = $_POST['pwd'];
        $member=new Member();
        $password = md5($password);
        $res=$member->verifyUserByUsname($us_name,$password);
        if($res){
            $res=trans_array($res);
            unset($res['us_pwd']);
            $this->user_session($res);
            $this->add_cookie($_POST['name'],$_POST['pwd']);
            return ['status'=>true,'info'=>"登陆成功"];
        }else{
            return ['status'=>false,'info'=>'查询用户信息失败'];
        }
    }
    public function register(){
        $us_name=$_POST['name'];
        $password=$_POST['pwd'];
        $mobile=$_POST['mobile'];
        $email=$_POST['email'];
        $mem = new Member();
        $check_usname=$mem->getUserByName($us_name);
        if($check_usname){
            return z_false('名称被占用!');
        }
        $regtime=time();
        $password = md5($password);
        $res = $mem->addUser($us_name, $password, $regtime, $mobile ,$email);
        if(!$res){
            return  z_false('注册失败');
        }else{
            $res=$mem->verifyUserByUsname($us_name,$password);
            $user = trans_array($res);
            $this->user_session($user);
            $this->add_cookie($_POST['name'],$_POST['pwd']);
            return  z_true('注册成功');
        }
    }
    public function checkName($us_name){
        $mem = new Member();
        $check_usname=$mem->getUserByName($us_name);
        if($check_usname){
            return z_false('名称被占用!');
        }else{
            return z_true('名字很是骚气啊！');
        }
    }
    function test1(){
      $a=array(
          "cardname1"=>'1jiaoyohbao',"cardprice"=>"13",
          "cardname2"=>'1jiaoyohbao',"cardprice"=>"13",
          "cardname3"=>'1jiaoyohbao',"cardprice"=>"13",
          "cardname4"=>'1jiaoyohbao',"cardprice"=>"13",
          "cardname5"=>'1jiaoyohbao',"cardprice"=>"13",
          "cardname6"=>'1jiaoyohbao',"cardprice"=>"13",
      );
      $funtion_name=$_GET['callback'];
      echo "$funtion_name".'('.json_encode($a).')';
    }
    function test2(){
        dump($this->user_session()) ;
    }
    function add_cookie($username,$pwd){
        setcookie('name',$username,time()+86400*30,'/');
        setcookie('password',$pwd,time()+86400*30,'/');
    }

}