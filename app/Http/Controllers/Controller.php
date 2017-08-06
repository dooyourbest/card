<?php

namespace App\Http\Controllers;

use App\Member;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Route;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    function verify(){
        $user=$this->user_session();
        if($user){
            return true;
        }else{
            if(!$_COOKIE){
                z_redirect('login');
            }else{
                $name = $_COOKIE['name'];
                $pwd = $_COOKIE['password'];
                $mem = new Member();
                $res = $mem->verifyUserByUsname($name, $pwd);
                if($res){
                    $this->user_session($res);
                    return true;
                }else{
                    z_redirect('login');
                }
            }
        }
    }

    function user_session($user=''){
        $user_name='user';
        if($user===null){
            session()->put($user_name,null);
            return $user;
        }else if($user===''){
            return session()->get($user_name);
        }else if($user){
            session()->put($user_name,$user);
            return $user;
        }
        return false;
    }
}
