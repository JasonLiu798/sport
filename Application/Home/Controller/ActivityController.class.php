<?php
namespace Home\Controller;

use Think\Controller;

class ActivityController extends Controller {
    
    /**
     * 首页
     */
    public function index(){
        //显示所有活动

        $activity_model = D('Activity');
        //热门内容
        $apop = $activity_model->field('aid,activity_name,aimin_url')->order('follow_cnt')->where("status='P'")->limit(4)->select();
        
        
        //print_r($alist);
        //echo $alist[0]["duration"]==='';
        //return;
        //类别
        $sport_model = D('Activity');
        $types = $sport_model->field("count(activity.aid) activity_cnt,ccontent,cvalue")->where("module=1")
            ->join(array(' LEFT JOIN constants c ON c.cvalue = activity.activity_type'))
            ->group('cvalue')->order("activity_cnt desc")->limit(5)
            ->select();

        if(!is_null($types[0])){
            $types[0]['choose']=1;

            $alist = $activity_model->field("aid,activity_name,duration,start_time,end_time,alocation,c.ccontent atype,follow_cnt,aimin_url")
            ->join(array(' LEFT JOIN constants c ON c.cvalue = activity.activity_type'))
            ->where("status='P' AND c.module=1 AND activity.activity_type=%d ",array($types[0]['cvalue'] ))
            ->select();
        }else{
            $alist = null;
        }
        // print_r($alist);
        // return;
        // echo $sport_model->getLastSql();
        

        // print_r($apop);
        // return;
        $this->assign('title','首页');
        $this->assign('apop', $apop);

        $this->assign('alist', $alist);
        $this->assign('types', $types);
        $this->display();
        return;
        //print_r($res);
        //echo 'Activity Index';
    }
    /**
     * 详情
     */
    public function detail(){
        //qecho 'adetail';
        //$user['status']

        $aid = I('param.aid');
        $err = '';
        $activity_model = D('activity');
        //p.province,ct.city,a.area,
        $activity_detail = $activity_model->field("aid,activity_name,duration,start_time,end_time,alocation,lon,lat,c.ccontent atype,cityarea2show,price,pricetype,acontent,s.sport_name,follow_cnt,take_cnt,equipment_take,equipment_got,aimax_url,u.username")
            ->join(array(
                ' LEFT JOIN constants c ON c.cvalue = activity.activity_type',
                ' LEFT JOIN user u ON u.uid = activity.creator',
                ' LEFT JOIN sport s ON s.sid = activity.sport_type',
                /*' LEFT JOIN provinces p ON p.provinceid = activity.aprovince',
                ' LEFT JOIN cities ct ON ct.cityid = activity.acity',
                ' LEFT JOIN areas a ON a.areaid = activity.aarea'*/))
            ->where("activity.status='P' AND c.module=1 AND activity.aid=%d ",array($aid ))
            ->select();
            // print_r($activity_detail);
            // echo $activity_model->getLastSql();
            // return ;
        if( !is_null($activity_detail) && count($activity_detail)>0 ){
            $activity_comment_model = D('activity_comment');
            /*
                SELECT activity_comment.acid,u.username,
                activity_comment.accontent,activity_comment.create_time,ac.acid,ac.deleted
                FROM activity_comment
                LEFT JOIN user u ON u.uid = activity_comment.uid 
                LEFT JOIN activity_comment ac ON ac.pid = activity_comment.acid 
                WHERE activity_comment.deleted=0 AND activity_comment.aid=3 AND activity_comment.pid=0
                AND (ac.deleted=0 or ac.deleted is null)
            */
            $acomments = $activity_comment_model->field("activity_comment.acid,u.username,activity_comment.accontent,activity_comment.create_time,count(ac.acid) fcnt")
                ->join(array(
                    ' LEFT JOIN user u ON u.uid = activity_comment.uid',
                    ' LEFT JOIN activity_comment ac ON ac.pid = activity_comment.acid',
                    ))
                ->where("activity_comment.deleted=0 AND (ac.deleted=0 OR ac.deleted is null)AND activity_comment.aid=%d AND activity_comment.pid=0 ",array($aid))
                ->group('activity_comment.acid')
                ->select();
            
            // echo $activity_comment_model->getLastSql();
            // print_r($acomments);
            // return;
            //116.419338,39.959874
        }else{
            $err = '活动不存在';
        }
       
        //echo $activity_model->getLastSql();
        if(strlen($err)>0){
            $this->assign('msg',$err);
            $this->display('public/error');
        }else{
            $this->assign('comments',$acomments);
            $this->assign('activity_detail',$activity_detail[0]);
            $this->assign('title', $activity_detail[0]['activity_name']);
            $this->display();
        }
        return;


    }


    public function test(){
        $time1 = floor(strtotime(date("y-m-d")));
        //date('Y-m-d H:i:s',time());
        $time2 = strtotime("2014-12-11 08:45:34");
        echo 'T1:'.date("Y-m-d H:i:s",$time1)."\n";
        echo 'T2:'.date("Y-m-d H:i:s",$time2)."\n";
        echo 'C:'.floor(($time2-$time1)/86400)."\n";
    }



}