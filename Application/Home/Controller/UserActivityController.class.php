<?php
namespace Home\Controller;

use Think\Controller;
use Think\Log;

class ActivityController extends Controller {

    /**
     * 首页
     */
    public function taker(){


    }
    public function follower(){
        $aid = I('param.aid');
        

        $activity_model = D('activity');
        if(!$activity_model->check_exist($aid)){
            $err = '活动不存在';
        }else{
            
        }

        $activity_members = $ua_model->get_activity_member($aid);


        if(strlen($err)>0){
            $this->assign('msg',$err);
            $this->display('public/error');
        }else{
            $this->assign('comments',$acomments);
            $this->assign('activity_detail',$activity_detail[0]);
            $this->assign('us_status',$us_status);
            $this->assign('activity_members',$activity_members);
            //$this->assign('initor',$initor);
            $this->assign('title', $activity_detail[0]['activity_name']);
            $this->display();
        }


    }
}