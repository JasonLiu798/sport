<?php
namespace Home\Model;

use Think\Model;


class ActivityModel extends Model {
    protected $tableName = 'activity';
    protected $pk     = 'aid';

    public function check_exist($aid){
        //$activity_model = M('Activity');
        $res = $this->field('count(*) cnt')->where('aid=%d',array($aid))->find();
        if($res['cnt']>0){
            return true;
        }else{
            return false;
        }
    }

    public function init_follow_cnt_cache($aid){
        //key: afcnt[aid] value:follow_cnt
        //select count(*) cnt from user_activity where aid = 3;
        $res = $this->table('user_activity')->field('count(*) cnt')->where('aid=%d',array($aid))->find();
        $redis = new \Org\Util\TpRedis;
        $redis->set('uid');
        return $res['cnt'];
    }

    public function get_follow_cnt($aid){
        $res = $this->field('follow_cnt')->where('aid=%d',array($aid))->find();
        if($res){
            return $res['follow_cnt'];
        }else{
            return false;
        }
    }

    public function get_take_cnt($aid){
        $res = $this->field('take_cnt')->where('aid=%d',array($aid))->find();
        if($res){
            return $res['take_cnt'];
        }else{
            return false;
        }
    }

    public function incr_follow_cnt($aid){
        $cnt = $this->get_follow_cnt($aid);
        $this->follow_cnt = $cnt + 1;
        //$data['follow_cnt'] = $cnt + 1;
        $res = $this->where('aid='.$aid)->save();
        if($res){
            return array( true,  $cnt+1  );
        }else{
            return false;
        }
    }

    public function incr_take_cnt($aid){
        $cnt = $this->get_take_cnt($aid);
        $this->take_cnt = $cnt + 1;
        $res = $this->where('aid='.$aid)->save();
        if($res){
            return array(true, $cnt+1);
        }else{
            return false;
        }
    }

    public function decr_follow_cnt($aid){
        $cnt = $this->get_follow_cnt($aid);
        // if($cnt <=0 ){
        //     $res_cnt = $this->update_follow_cnt($aid);
        //     if($res_cnt <= 0 ){
        //         return false;
        //     }else{
        //         $cnt = $res_cnt;
        //     }
        // }
        $this->follow_cnt = $cnt - 1;
        $res = $this->where('aid='.$aid)->save($data);
        if($res){
            return array(true,$cnt -1);
        }else{
            return false;
        }
    }

    public function decr_take_cnt($aid){
        $cnt = $this->get_take_cnt($aid);
        //$data['take_cnt'] = $cnt - 1;
        $this->take_cnt = $cnt - 1;
        $res = $this->where('aid='.$aid)->save($data);
        if($res){
            return array( true , $cnt-1);
        }else{
            return false;
        }
    }
    /**
    * update follow_cnt from table user_activity 
    */
    public function update_follow_cnt($aid){
        $user_activity_model = D('UserActivity');
        $follow_cnt = $user_activity_model->where("aid=%d AND type='%s' ",array($aid,C('UA_FOLLOW'))->count();
        if($follow_cnt){
            $this->follow_cnt = $follow_cnt;
            $res = $this->where('aid='.$aid)->save();
            return $res;
        }else{
            return false;
        }
    }
    
    // public function update_follow_cnt($aid){
    //     $this->get_follow_cnt($aid);
    //     $this->
    // }
}
