<?php

namespace App\Http\Controllers;
use App\Model\ModelTodoBase;

class TodoController extends Controller{
    public $modelTodo;
    public $filter=array('startTime','endTime','title','note','level','useTime');
    public function __construct(){
        parent::__construct();
        $this->modelTodo=new ModelTodoBase();

    }
    public function add(){
        $res = $this->modelTodo->addTodo($this->params);
        $this->success($res);
    }
    public function gettodo(){
        $res = $this->modelTodo->getTodo($this->params);
        $this->success($res);
    }
    public function edittodo(){
        $res = $this->modelTodo->edittodo($this->params);
        $this->success($res) ;
    }
    function getlist(){
        $this->success($this->modelTodo->getList());
    }
}


