<?php
namespace Home\Controller;

use Think\Controller;
use Think\Log;

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
        $uid = session('uid');

        $a_model = D('activity');
        //p.province,ct.city,a.area,
        $activity_detail = $a_model->get_activity_detail($aid);
            // print_r($activity_detail);
            // echo $activity_model->getLastSql();
            // return ;
        if( !is_null($activity_detail) && count($activity_detail)>0 ){
            $activity_comment_model = D('activity_comment');
                        
            $acomments = $activity_comment_model->get_activity_parent_comments($aid);

            $ua_model = D('UserActivity');
            //116.419338,39.959874
            if(is_null($uid)){
                $us_status = C('UA_NONE');
            }else{
                //is follow
                
                //echo $uid.',A:'.$aid."\n";
                $us_status = $ua_model->check_relation($uid,$aid);
                
                if ( !$us_status ){
                    $err = '数据库查询错误';
                }
            }
            $activity_members = $ua_model->get_activity_member($aid);
            $activity_creator = $a_model->get_activity_initor($aid);
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
            $this->assign('us_status',$us_status);
            $this->assign('activity_members',$activity_members);
            $this->assign('activity_creator', $activity_creator);
            //$this->assign('initor',$initor);
            $this->assign('title', $activity_detail[0]['activity_name']);
            $this->display();
        }
        return;


    }

    /**
     * 关注活动
     * 1.添加 user_activity
     * 2.增加cnt
     */
    public function follow(){
        $aid = I('param.aid');
        $type = I('param.type');
        //echo 'act'.$aid."\n";
        $err = '';
        $activity_model = D('Activity');
        $uid = session('uid');
        $follow_cnt = 0;
        if( is_null($uid) ){
            $err = '未登录';
        }else{
            if(  !$activity_model->check_exist($aid) ){
                $err = '活动不存在';
            }else{
                $user_activity_model = D('UserActivity');
            //echo $uid.',A:'.$aid."\n";
                $uaid = $user_activity_model->check_follow($uid,$aid);
                if ( $uaid ){
                    //already followed,refresh
                    //$err = '已经关注';
                    $this->redirect('activity/detail/'.$aid);
                }else{
                    $data['uid'] = $uid;
                    $data['aid'] = $aid;
                    //if($type === C('UA_FOLLOW') || $type === C('UA_TAKE')){
                    $data['type'] = C('UA_FOLLOW');

                    $user_activity_model->startTrans();
                    $activity_model->startTrans();
                    
                    $res_add_ua = $user_activity_model->data($data)->add();
                    $res_add_fcnt = $activity_model->incr_follow_cnt($aid);

                    if( $res_add_ua && $res_add_fcnt ){
                        $user_activity_model->commit();
                        $activity_model->commit();
                        $follow_cnt = $res_add_fcnt[1];
                        Log::write('follow cnt:'.$res_add_fcnt[1],'DEBUG');
                    } else {
                        Log::write(__CLASS__.__METHOD__.':res_add_ua:'.$res_add_ua.',res_add_fcnt:'.$res_add_fcnt,'DEBUG' );
                        $user_activity_model->rollback();
                        $activity_model->rollback();
                        $err = '添加失败';
                    }
                }
                // else{
                //     $err = '参数类型错误';
                    
                // }
            }
        }
        //$data['status']  = 1;
        
        if(strlen($err)>0){
            $data['error'] = $err;
            $data['msg'] = '关注失败';
        }else{
            $data['msg'] = '关注成功';
            $data['follow_cnt'] = $follow_cnt;
        }
        $this->ajaxReturn($data);
    }

    /*
    activity/unfollow/aid
    */
    public function unfollow(){
        $aid = I('param.aid');
        //echo 'act'.$aid."\n";
        $err = '';
        $activity_model = D('Activity');
        $uid = session('uid');
        $follow_cnt = 0;
        if( is_null($uid) ){
            $err = '未登录';
            //$next_url = 'login';
        }else{
            $user_activity_model = D('UserActivity');
            //echo $uid.',A:'.$aid."\n";
            $uaid = $user_activity_model->check_follow($uid,$aid);
            if ( $uaid ){
                $user_activity_model->startTrans();
                $activity_model->startTrans();
                
                $res_decr_ua = $user_activity_model->delete($uaid);
                $res_decr_fcnt = $activity_model->decr_follow_cnt($aid);

                if( $res_decr_ua && $res_decr_fcnt ){
                    $user_activity_model->commit();
                    $activity_model->commit();
                    $follow_cnt = $res_decr_fcnt[1];
                } else {
                    $user_activity_model->rollback();
                    $activity_model->rollback();
                    $err = '取消关注失败';
                }
            } else {
                //$err = '尚未关注！';
                //重新加载页面
                $this->redirect('activity/detail/'.$aid);
            }
        }

        if(strlen($err)>0){
            $data['error'] = $err;
            $data['msg'] = '取消失败';
        }else{
            $data['msg'] = '取消成功';
            $data['follow_cnt'] = $follow_cnt;
        }
        $this->ajaxReturn($data);
    }

    public function take(){
        $aid = I('param.aid');
        $err = '';
        $activity_model = D('Activity');
        $uid = session('uid');
        $take_cnt = 0;
        $follow_cnt = 0;
        if( is_null($uid) ){
            $err = '未登录';
        }else{
            if(  !$activity_model->check_exist($aid) ){
                $err = '活动不存在';
            }else{
                $user_activity_model = D('UserActivity');
                
                $uaid_f = $user_activity_model->check_follow($uid,$aid);
                $uaid_t = $user_activity_model->check_take($uid,$aid);
                if ( $uaid_f ){
                    //already followed, update UA type ,deincr follow cnt,incr take cnt
                    $user_activity_model->startTrans();
                    $activity_model->startTrans();

                    $user_activity_model->type = C('UA_TAKE');

                    $res_ua_up = $user_activity_model->where('uaid='.$uaid_f )->save();
                    $res_a_f_decr = $activity_model->decr_follow_cnt($aid);
                    $res_a_t_incr = $activity_model->incr_take_cnt($aid);

                    if($res_ua_up && $res_a_f_decr && $res_a_t_incr ){
                        $user_activity_model->commit();
                        $activity_model->commit();
                        $follow_cnt = $res_a_f_decr[1];
                        $take_cnt = $res_a_t_incr[1];
                    }else{
                        Log::write(__CLASS__.__METHOD__.':res_ua_up:'.$res_ua_up.',res_a_f_decr:'.$res_a_f_decr.',res_a_t_incr:'.$res_a_t_incr,'DEBUG' );
                        $user_activity_model->rollback();
                        $activity_model->rollback();
                    }
                }else if($uaid_t){
                    //already taked
                    //$err = '';
                    $this->redirect( 'activity/detail/'.$aid );
                }else if( !$uaid_t && !$uaid_f ){
                    //no follow,no take
                    $data['uid'] = $uid;
                    $data['aid'] = $aid;
                    //if($type === C('UA_FOLLOW') || $type === C('UA_TAKE')){
                    $data['type'] = C('UA_TAKE');

                    $user_activity_model->startTrans();
                    $activity_model->startTrans();
                    
                    $res_add_ua = $user_activity_model->data($data)->add();
                    $res_add_tcnt = $activity_model->incr_take_cnt($aid);

                    if( $res_add_ua && $res_add_tcnt ){
                        $user_activity_model->commit();
                        $activity_model->commit();
                        $take_cnt = $res_add_tcnt[1];
                        $follow_cnt = 'N';
                    } else {
                        Log::write(__CLASS__.__METHOD__.':res_add_ua:'.$res_add_ua.',res_add_fcnt:'.$res_add_tcnt,'DEBUG' );
                        $user_activity_model->rollback();
                        $activity_model->rollback();
                        $err = '添加失败';
                    }
                }else{
                    $err = '参数错误';
                }
            }
        }
        //$data['status']  = 1;
        
        if(strlen($err)>0){
            $data['error'] = $err;
            $data['msg'] = '关注失败';
        }else{
            $data['msg'] = '关注成功';
            $data['follow_cnt'] = $follow_cnt;
            $data['take_cnt'] = $take_cnt;
        }
        $this->ajaxReturn($data);
    }

    /**
     * 
     */
    public function untake(){
        $aid = I('param.aid');
        //echo 'act'.$aid."\n";
        $err = '';
        $activity_model = D('Activity');
        $uid = session('uid');
        $take_cnt = 0;
        if( is_null($uid) ){
            $err = '未登录';
            //$next_url = 'login';
        }else{
            $user_activity_model = D('UserActivity');
            //echo $uid.',A:'.$aid."\n";
            $uaid = $user_activity_model->check_take($uid,$aid);
            if ( $uaid ){
                $user_activity_model->startTrans();
                $activity_model->startTrans();

                $res_decr_ua = $user_activity_model->delete($uaid);
                $res_decr_tcnt = $activity_model->decr_take_cnt($aid);

                if( $res_decr_ua && $res_decr_tcnt ){
                    $user_activity_model->commit();
                    $activity_model->commit();
                    $take_cnt = $res_decr_tcnt[1];
                } else {
                    Log::write(__CLASS__.__METHOD__.':res_decr_ua:'.$res_decr_ua.',res_decr_fcnt:'.$res_decr_tcnt, 'DEBUG' );
                    $user_activity_model->rollback();
                    $activity_model->rollback();
                    $err = '取消参加失败';
                }
            } else {
                //$err = '尚未关注！';
                //重新加载页面
                $this->redirect('activity/detail/'.$aid);
            }
        }

        if(strlen($err)>0){
            $data['error'] = $err;
            $data['msg'] = '取消失败';
        }else{
            $data['msg'] = '取消成功';
            $data['take_cnt'] = $take_cnt;
        }
        $this->ajaxReturn($data);
    }

    /**
     * 创建
     */
    public function create(){
        $uid = session('uid');
        if(is_null($uid)){
            $err = '未登录';
        }else{
            if( I('param.method','page')==='page' ){

                $s_model = D('Sport');

                $activity_type = $s_model->get_sport_type();
                $l_model = D('Location');
                $province = $l_model->get_provinces();

                $u_model = D('User');

                $map_init = $u_model->get_pos($uid);
                //$map_init = new stdClass;

                //$sport_sub_type = $s_model->get_sport_sub_type();

                //$sport_sub_type = $s_model->get_sport_sub_type();
                //$activity_types = 
                $this->assign('activity_types',$activity_type);
                $this->assign('provinces',$province);
                $this->assign('map_init', $map_init);
                //$this->assign('province',$sport_type);
                //$this->assign('sport_sub_type',$sport_sub_type);

                $this->assign('title','创建活动');
                $this->display();
                return ;
            }else{
                $a_model = D('Activity');
                $aid = get_pk();
            }
        }
        

        if(strlen($err)>0){
            
            $this->assign('msg',$err);
            $this->display('public/error');
        }else{
            
        }

    }

    public function test(){
        //$activity_model = D('Activity');
        // echo $activity_model->init_follow_cnt_cache(3);
        // echo $activity_model->getlastsql();
        //echo "res".$activity_model->add_follow_cnt(3);
        //echo $activity_model->get_follow_cnt(4);

        //$ua_model = D('UserActivity');
        $s_model = D('Sport');
        $l_model = D('Location');
        //print_r( $l_model->get_provinces() );
        $u_model = D('User');

        print_r( $u_model->get_pos(1) );

        //print_r( $l_model->get_area('110100') );
        //print_r( $s_model->get_sport_sub_type(2) );
        //print_r( $ua_model->get_activity_member(3,C('UA_FOLLOW')) );
        //$a_model = D('Activity');

        //echo $ua_model->check_relation(2,4);
        //echo $a_model->update_follow_cnt(3);

    }


}