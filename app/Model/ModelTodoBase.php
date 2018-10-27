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
use App\Dao\DaoTodoBase;
class ModelTodoBase extends ModelBase{
    const STAGE_AWAIT=0; //等待进行
    const STAGE_RUNNING=1;//进行中
    const STAGE_FINISHED=2;//已完成
    const STAGE_STOP=3;//已停止
    const STAGE_PAUSE=4;//暂停中

    const STATUS_NORMAL=0;
    const STATUS_DEL=1;

    const PID_DEFAULT=0;
    const ISCHANGE_DEFAULT=0;

    public $daoTodo;
    public $modelUser;

    public function __construct(){
        parent::__construct();
        $this->daoTodo=new DaoTodoBase();
        $this->modelUser=new ModelUser();
    }
    //add todo
    public function addTodo($params){
        $userid = $this->modelUser->getUserid();
        $timestart = $params['startTime'];
        $timeend = $params['endTime'];
        $title = $params['title'];
        $note = $params['note'];
        $level = $params['level']; //todo
        $tag = $params['tag']; //todo
        if(isset($params['useTime'])){
            $usetime = $params['useTime'];
        }else{
            $usetime = $timeend-$timestart;
        }
        if(empty($tag)){
            $tag='';
        }
        return $this->daoTodo->addOne($userid, $timestart, $timeend, $title, $note, $usetime,$tag,self::STATUS_NORMAL,self::STAGE_AWAIT,$level,self::PID_DEFAULT,self::ISCHANGE_DEFAULT );
    }

    public function changeTodo(){
        $this->daoTodo->update();
    }
    public function getTodo($params){
        if(isset($params['id'])){
            return  $this->daoTodo->getTodoByid($params['id']);
        }
    }
    public function edittodo($params){
        $list=["startTime","endTime","title","note","level","tag","useTime",'id'];
        foreach ($params as $key=>$val){
            if(in_array($key,$list)){
                $setArr[$key]=$val;
            }
        }
        return $this->daoTodo->edit($setArr);
    }
    public function getList(){
        $userid=$this->modelUser->getUserid();
        return $this->daoTodo->getList($userid);
    }
//    public function getList(){
//        return $this->daoTodo->
//    }
}