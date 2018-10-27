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
class ModelBase{
    public $params;
    public function __construct(){
        $this->getParams();
    }
    public function getParams(){
        //todo filter
        $params=array_merge($_GET,$_POST);
        $this->params = $params;
    }
}