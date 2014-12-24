<?php
namespace Home\Controller;

use Think\Controller;
use Think\Log;
use Home\Model\ActivityCommentModel;

class ActivityCommentController extends Controller {

    


    public function create(){
        //echo "method:".I('param.method','page');    
        $uid = session('uid');

        if(is_null($uid)){
            $err = '未登录';
        }else{
            if( I('param.method','page')==='page' ){
                $aid = I('param.aid');
                //$pid = I('param.pid');
                if(is_null($aid)){
                    $err = '参数错误';
                }else{
                    $a_model = D('Activity');
                    $a_title = $a_model->get_title($aid);
                    if($a_title){
                        $this->assign( 'title', '关于"'.$a_title.'"的讨论' );
                        $this->assign('a_name',$a_title);
                        $this->assign('aid',$aid);
                        $this->assign('pid',$pid);
                        $this->display('create');
                        return;
                    }else{
                        $err = '获取活动标题失败';
                    }
                }
            }else{
                //do create
                $comment_title = I('param.comment_title');
                $comment_content = I('param.comment_content');
                $aid = I('param.aid');
                $ac_model = D('ActivityComment');
                $pid = I('param.pid');
                $pk = $ac_model->get_pk();
                if($pk){
                    $ac_model->acid = $pk;
                    $ac_model->aid = $aid;
                    $ac_model->uid = $uid;
                    $ac_model->actitle = $comment_title;
                    $ac_model->accontent = $comment_content;
                    $ac_model->create_time = date('Y-m-d H:i:s',time());
                    $ac_model->approved = 0;
                    $ac_model->deleted = 0;
                    $ac_model->pid = $pid;
                    $ac_model->add();
                }else{
                    $err = '主键创建失败';
                }
            }
        }
        

        if(strlen($err)>0){
            $this->assign('msg',$err);
            $this->display('public/error');
        }else{
            //$this->assign('comments',$acomments);
            // $this->assign('activity_detail',$activity_detail[0]);
            // $this->assign('us_status',$us_status);
            // $this->assign('title', $activity_detail[0]['activity_name']);
            // $this->display();
            if($pid==0){//父节点
                $this->redirect('activitycomment/comments/'.$pk);
            }else{//子节点
                $this->redirect('activitycomment/comments/'.$pid.'#comment'.$pk);
            }
        }
        return;
    }

    public function discuss(){
        
    }

    public function comments(){
        $acid = I('param.acid');
        //$acid = I('param.acid');
        $err = '';
        if(is_null($acid)){
            $err = '主题不存在';
        }else{
            $ac_model = D('ActivityComment');
            $pcomment = $ac_model->get_parent_comment($acid);
            // print_r($pcomment);
            // return;


            if($pcomment){
                $title = $pcomment['actitle'];
            }
            //print_r($pcomment);
            $comments = $ac_model->get_child_comments($acid);
            //print_r($comments);
            //return;
        }
        
        if(strlen($err)>0){
            $this->assign('msg',$err);
            $this->display('public/error');
        }else{
            $this->assign('pcomment',$pcomment);
            $this->assign('comments',$comments);
            $this->assign('title',$title);
            $this->display();
        }
        return;






    }



    
}