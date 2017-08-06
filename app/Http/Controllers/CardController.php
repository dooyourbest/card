<?php

namespace App\Http\Controllers;
use App\Card;
class CardController extends Controller{
    public function getcardList(){
        $card=new Card();
        $res=$card->getCardTypeList();
        return z_true(trans_array($res));
    }
    public function card(){
        $card = new Card();
        $this->verify();
        $user=$this->user_session();
        $res=$card->insertCard($user['us_id'],$_POST['ct_id']);
        if($res){
            return z_true($res);
        }else{
            return z_false($res);
        }
    }
    function getMonthDate(){
        $user=$this->user_session();
        $card = new Card();
        $res=$card->getMonthDate($user['us_id'],1);//todo
        if(!$res){
            return z_false('查询失败');
        }
        $res=trans_array($res);
        return z_true($res);
    }
    function countByHour(){
        $user=$this->user_session();
        $card = new Card();
        $res=$card->countHour($user['us_id'],1);//todo
        if(!$res){
            return z_false('查询失败');
        }
        $res=trans_array($res);
        return z_true($res);
    }


}

