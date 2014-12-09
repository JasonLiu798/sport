<?php
namespace Home\Controller;
use Think\Controller;
class ActivityController extends Controller {

    public function index(){
        //显示所有活动
        $activities = D('Activity');
        $res = $activities->field('aid,aname,create_time,start_time,alocation,vlocation,sport_type,follow_cnt,aimin_url')
        ->join(array(
            ' LEFT JOIN venue ON venue.vid = activity.aid ',
            ' LEFT JOIN sport ON sport.sid = activity.sport_type'))
        ->where("status='P'")
        ->select();
        print_r($res);
        echo 'Activity Index';


    }
}