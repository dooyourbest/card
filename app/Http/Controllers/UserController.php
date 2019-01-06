<?php
namespace App\Http\Controllers;
use App\Member;
use App\Model\ModelUser;
use Faker\Provider\File;
use Illuminate\Support\Facades\Session;
use App\Lib\Utils\Filter;

class UserController extends Controller{
    public $userName;
    public $userLevel;
    public $userGroup;
    public $filterParam=array(

    );


    public function __construct(){
        parent::__construct();
        $this->userModel = new ModelUser();
    }

    public function login(){
        $field=array(
            'username'=>array('string'),
            'passwd'=>array('string'),
        );
        $params=Filter::filterParam($field,$this->params,true);
        $res = $this->userModel->login($params['username'], $params['passwd']);
        $this->success($res);
    }
    public function register(){
        $filedConf=array(
            'username'=>array('string'),
            'passwd'=>array('string'),
            'nickname'=>array('string'),
        );
        $params = Filter::filterParam($filedConf,$this->params,true);
        return $this->userModel->addUser($params);
    }


}