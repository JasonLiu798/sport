<?php
namespace Home\Model;

use Think\Model;


class ActivityModel extends Model {
    protected $tableName = 'activity';
    protected $pk     = 'aid';


    public function get_pk(){
        $redis = new \Org\Util\TpRedis;
        $pre_pk = $redis->get($this->pk);
        $pk = 0;
        if(is_null($pre_pk)){
            //init acid
            $ac_model = D('Activity');
            $max_acid = $ac_model->max($this->pk);
            if($max_acid){
                $res_set = $redis->set($this->pk,$max_acid);//如无acid,get max acid 设置
                if(!$res_set){
                    return false;
                }
            }
        }
        $pk = $redis->incr( $this->pk );
        $redis = null;
        if($pk){
            return $pk;
        }else{
            return false;
        }
    }


    public function check_exist($aid){
        if(is_null($aid)){
            return false;
        }else{

        }
        //$activity_model = M('Activity');
        $res = $this->field('count(*) cnt')->where('aid=%d',array($aid))->find();
        if($res['cnt']>0){
            return true;
        }else{
            return false;
        }
    }

    /*
    public function init_follow_cnt_cache($aid){
        //key: afcnt[aid] value:follow_cnt
        //select count(*) cnt from user_activity where aid = 3;
        $res = $this->table('user_activity')->field('count(*) cnt')->where('aid=%d',array($aid))->find();
        $redis = new \Org\Util\TpRedis;
        $redis->incr('uid');
        $redis->close();
        return $res['cnt'];
    }
    */

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
        $follow_cnt = $user_activity_model->where( "aid=%d AND type='%s' ", array($aid,C('UA_FOLLOW')) )->count();
        if($follow_cnt>=0){
            $this->follow_cnt = $follow_cnt;
            $res = $this->where('aid='.$aid)->save();
            return array(true,$follow_cnt);
        }else{
            return false;
        }
    }

    public function update_take_cnt($aid){
        $user_activity_model = D('UserActivity');
        $take_cnt = $user_activity_model->where( "aid=%d AND type='%s' ", array($aid,C('UA_TAKE')) )->count();
        if( $take_cnt >= 0 ){
            $this->take_cnt = $take_cnt;
            $res = $this->where('aid='.$aid)->save();
            return array(true,$take_cnt);
        }else{
            return false;
        }
    }

    public function get_title($aid){
        $res = $this->field('activity_name')->where( "aid=%d",array($aid))->select();
        if($res){
            return $res[0]['activity_name'];
        }else{
            return false;
        }
    }

    public function get_activity_detail($aid){
        $res = $this->field("aid,activity_name,duration,start_time,end_time,alocation,lon,lat,c.ccontent atype,cityarea2show,price,pricetype,acontent,s.sport_name,follow_cnt,take_cnt,equipment_take,equipment_got,aimax_url,u.username")
        ->join(array(
            ' LEFT JOIN constants c ON c.cvalue = activity.activity_type',
            ' LEFT JOIN user u ON u.uid = activity.creator',
            ' LEFT JOIN sport s ON s.sid = activity.sport_type',
                /*' LEFT JOIN provinces p ON p.provinceid = activity.aprovince',
                ' LEFT JOIN cities ct ON ct.cityid = activity.acity',
                ' LEFT JOIN areas a ON a.areaid = activity.aarea'*/))
        ->where("activity.status='P' AND c.module=1 AND activity.aid=%d ",array($aid ))
        ->select();
        return $res;
    }
    
    public function get_activity_initor($aid){
        $res = $this->field('u.username,u.uid,u.head_iminurl')
        ->alias('a')
        ->where("a.aid=%d ",array($aid))
        ->join(array(
            ' LEFT JOIN user u ON u.uid = a.creator',))
            //' LEFT JOIN activity a ON a.aid = ua.aid',)
        ->limit(1)
        ->select();
        if($res){
            return $res[0];
        }else{
            return false;
        }
    }
    // public function update_follow_cnt($aid){
    //     $this->get_follow_cnt($aid);
    //     $this->
    // }
}
