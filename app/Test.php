<?php
/**
 * Created by PhpStorm.
 * User: saber
 * Date: 2017/8/5
 * Time: 11:40
 */
namespace App;
use Illuminate\Database\Eloquent\Model;

class Test extends Model{
    public static function test(){
        return 'this is test';
    }
}