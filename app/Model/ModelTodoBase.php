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
        return $this->daoTodo->addOne($userid, $timestart, $timeend, $title, $note, $usetime,$tag,DaoTodoBase::STATUS_NORMAL,DaoTodoBase::STAGE_AWAIT,$level,DaoTodoBase::PID_DEFAULT,DaoTodoBase::ISCHANGE_DEFAULT );
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
    public function delTodo($id){

    }
    public function getTodayTodo(){
        $startTime = strtotime(date("Y-m-d",time()));
        $endTime =$startTime + 86400;
        return $this->daoTodo->getTodoByTime($startTime, $endTime);
    }

    public function deleteTodo(){
        if(isset($this->params['id'])){
            return  $this->daoTodo->deltodo($this->params['id']);
        }
    }
}