<?php
/**
 * Created by PhpStorm.
 * User: zhangziang
 * Date: 2018/10/17
 * Time: 上午12:38
 */

namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use APP\Dao\DaoTodoBase;
class ModelUser{

    public function __construct(){

    }
    public function getUserid(){
        return 1;
    }
    public function getUserInfo(){
    }
}