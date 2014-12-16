<?php
namespace Home\Model;

use Think\Model;
use Think\Log;
//use \Org\Util\TPRedis;

class UserActivityModel extends Model {
    
    protected $tableName = 'user_activity';
    protected $pk     = 'uaid';
    
    public function check_follow($uid,$aid){
        $res = $this->field('uaid')->where("aid=%d AND uid=%d AND type='F'",array($aid,$uid))->find();
        //echo $this->getLastSql();   
        if($res){
            return $res['uaid'];
        }else{// if(is_null($res)){
            return false;
        }
    }

    public function check_take($uid,$aid){
        $res = $this->field('uaid')->where("aid=%d AND uid=%d AND type='T'",array($aid,$uid))->find();
        //echo $this->getLastSql();
        if($res){
            return $res['uaid'];
        }else{
            return false;
        }
    }

    public function check_relation($uid,$aid){
        //res = null 未关注；F 关注；T 参加
        $res = $this->field('type')->where("aid=%d AND uid=%d ",array($aid,$uid))->find();
        if( $res ){
            return $res['type'];
        }else if(is_null($res)){
            return C('UA_NONE');
        }else{
            //sql error
            Log::write(__CLASS__.' SQL Error:'.$this->getlastsql(),'ERR');
            return false;
        }
    }

    
}