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
    public function addone(){

    }
    public function getUserInfo(){

    }
}