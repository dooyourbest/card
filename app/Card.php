<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Card extends Model{
    public function insertCard($usid,$cactid,$ca_note=''){
        for($i=1;$i<10;$i++){
            $time=time()+$i*86400+rand(10000,20000);
            $month=date('m',$time);
            $day=date('d',$time);
            $hour=date('H',$time);
            $minute=date('i',$time);
            DB::table('card')->insertGetId(
                [
                    'ca_usid'=>$usid,
                    'ca_time'=>$time,
                    'ca_ctid'=>$cactid,
                    'ca_note'=>$ca_note,
                    'ca_month'=>$month,
                    'ca_hour'=>$hour,
                    'ca_minute'=>$minute,
                    'ca_day'=>$day,
                ]
            );
        }

    }
    public function getCardListByUsidAndType($usid,$type){
        return DB::table('card')
            ->where('ca_usid',$usid)
            ->where('ca_ctid',$type)
            ->get();
    }
    public function getCardTypeList(){
        return DB::table('card_type')
            ->where('ct_status','normal')
            ->get();
    }
    public function getMonthDate($usid,$ca_ctid){
        return DB::table('card')
            ->where('ca_usid',$usid)
            ->where('ca_ctid',$ca_ctid)
            ->get();
    }
    public function countHour($usid,$ca_ctid){
        return DB::table('card')
            ->select(DB::raw('*,count(ca_hour) as num'))
            ->where('ca_usid',$usid)
            ->where('ca_ctid',$ca_ctid)
            ->groupBy('ca_hour')
            ->get();
    }
}