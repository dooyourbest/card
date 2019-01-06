<?php
/**
 * Created by PhpStorm.
 * User: zhangziang
 * Date: 2019/1/5
 * Time: 下午12:03
 */
namespace App\Lib\Utils;
use Mockery\Exception;
use PhpParser\Node\Expr\Array_;

class Filter{
    public  static $fieldType = array('int','string','float','number',"required");

    /**
     * @param $filterConf 配置的过滤字段
     * @param $arr 数据
     */
    public static function filterParam(array $filterConf, $arr, $getConfArr=false){

        $returnArr=array();

        foreach ($filterConf as $key=>$val){
            if(!is_array($val)){
                throw new \Exception('配置数组');
            }
            foreach ($val as $row){
                if(!in_array($row,self::$fieldType)){
                    throw new Exception("判断类型错误");
                }
                switch ($row){
                    case 'int':
                        $returnRes=is_int($arr[$key])?true:false;break;
                    case 'string':
                        $returnRes=(isset($arr[$key]) && trim($arr[$key])!="")?true:false;break;
                    case 'float':
                        $returnRes=is_float($arr[$key])?true:false;break;
                    case 'number':
                        $returnRes=is_numeric($arr[$key])?true:false;break;
                    case 'required':
                        $returnRes=is_numeric($arr[$key])?true:false;break;
                    default:
                        $returnRes=true;
                }
                if(!$returnRes){
                    throw new Exception($key."字段需要为".$row);
                }
            }

            if($getConfArr){
                $returnArr[$key]=$arr[$key];
            }

        }
        if(!$getConfArr){
            $returnArr =$arr;
        }
        return $returnArr;
    }
}
