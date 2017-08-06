<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class Member extends Model{
    public static function test(){
        return 'this is test';
    }
    public static function checkUser($id){
        $res=DB::table('user')->where('us_id',$id)->get();
        return $res;
    }
    public function verifyUserByUsname($us_name,$password){
        $res=DB::table('user')
            ->where('us_name',$us_name)
            ->where('us_pwd',$password)
            ->get();
        return $res;
    }
    public function addUser($us_name, $password, $regtime, $mobile ,$email){
        $res=DB::table('user')
            ->insertGetId(['us_name'=>$us_name,'us_pwd'=>$password,'us_reg_time'=>$regtime,'us_mobile'=>$mobile,'us_email'=>$email]);
        return $res;
    }
    public function getUserByName($us_name){
        $res=DB::table('user')
            ->where('us_name',$us_name)
            ->get();
        return $res;
    }
}