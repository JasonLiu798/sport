<?php
namespace Home\Model;

use Think\Model;


class ActivityCommentModel extends Model {
    protected $tableName = 'activity_comment';
    protected $pk     = 'acid';

    public function get_pk(){
        $redis = new \Org\Util\TpRedis;
        $pre_pk = $redis->get('acid');
        $pk = 0;
        if(is_null($pre_pk)){
            //init acid
            $ac_model = D('ActivityComment');
            $max_acid = $ac_model->max('acid');
            if($max_acid){
                $res_set = $redis->set('acid',$max_acid);//如无acid,get max acid 设置
                if(!$res_set){
                    return false;
                }
            }
        }
        $pk = $redis->incr('acid');
        $redis = null;
        if($pk){
            return $pk;
        }else{
            return false;
        }
    }
    

    
}


