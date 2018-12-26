<?php
namespace App\Http\Controllers;
use App\Member;
use Illuminate\Support\Facades\Session;

class UserController extends Controller{
    public $userName;
    public $userLevel;
    public $userGroup;

    public function __construct(){
        parent::__construct();
    }

    public function login(){
        $param=$this->getParam();
        if(empty($param["name"])||!empty($param["passwd"])){

        }
    }


}