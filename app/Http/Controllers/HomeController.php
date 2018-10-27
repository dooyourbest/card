<?php
namespace App\Http\Controllers;

use App\Member;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Route;

class HomeController extends BaseController
{
    const NO_PARAMS=100;
    public $params;
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct(){
        $this->getParam();
//        $this->filter();
    }

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
    function getParam(){
        //todo add filter
        $this->params=array_merge($_POST,$_GET);
    }
    function filter(){
        if(!empty($this->filter) && is_array($this->filter)){
            foreach ($this->filter as $row){
                if(!isset($this->params[$row])){
                    throw new \Exception('no params '.$row,self::NO_PARAMS);
                }
            }
        }
    }
    function success($data){
        if(isset($this->params['callback'])){
            echo $this->params['callback'].'('.json_encode($data).')';
        }else{
            $arr=['errno'=>0,'data'=>$data];
            echo json_encode($arr);
        }

    }
    //select
    function select(){


    }
}
