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

    public function get_parent_comment($acid){
        $res = $this->alias('ac')
            ->field('aid,acid,u.username,u.head_iminurl,u.uid,actitle,accontent,ac.approved,ac.create_time')
            ->join(array(' LEFT JOIN user u ON u.uid = ac.uid'))
            ->where('acid=%d AND pid=0 AND deleted=0',array($acid))
            ->select();
        if($res){
            return $res[0];
        }else{
            return false;
        }
        
    }

    public function get_child_comments($acid){
        $res = $this->alias('ac')
            ->field('aid,acid,u.uid,u.username,u.head_iminurl,ac.uid,accontent,ac.approved,ac.create_time')
            ->join(array(' LEFT JOIN user u ON u.uid = ac.uid'))
            ->where('pid=%d AND deleted=0',array($acid))
            ->order('ac.create_time')
            ->select();
        return $res;
        
    }

    public function get_activity_parent_comments($aid){
        /*
                SELECT activity_comment.acid,u.username,
                activity_comment.accontent,activity_comment.create_time,ac.acid,ac.deleted
                FROM activity_comment
                LEFT JOIN user u ON u.uid = activity_comment.uid 
                LEFT JOIN activity_comment ac ON ac.pid = activity_comment.acid 
                WHERE activity_comment.deleted=0 AND activity_comment.aid=3 AND activity_comment.pid=0
                AND (ac.deleted=0 or ac.deleted is null)
            */
        $res = $this->field("activity_comment.acid,u.username,activity_comment.accontent,activity_comment.create_time,count(ac.acid) fcnt")
            ->join(array(
                ' LEFT JOIN user u ON u.uid = activity_comment.uid',
                ' LEFT JOIN activity_comment ac ON ac.pid = activity_comment.acid',
                ))
            ->where("activity_comment.deleted=0 AND (ac.deleted=0 OR ac.deleted is null)AND activity_comment.aid=%d AND activity_comment.pid=0 ",array($aid))
            ->group('activity_comment.acid')
            ->select();
        return $res;
    }

    
    

    
}


