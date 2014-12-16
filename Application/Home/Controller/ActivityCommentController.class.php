<?php
namespace Home\Controller;

use Think\Controller;
use Think\Log;

class ActivityCommentController extends Controller {

    public function create(){
        //echo "method:".I('param.method','page');    
        if( I('param.method','page')==='page' ){
            $aid = I('param.aid');
            if(is_null($aid)){
                $err = '参数错误';
            }else{
                $a_model = D('Activity');
                $a_title = $a_model->get_title($aid);
                if($a_title){
                    $this->assign( 'title', '关于"'.$a_title.'"的讨论' );
                    $this->assign('a_name',$a_title);
                    $this->assign('aid',$aid);
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
            
        }

        if(strlen($err)>0){
            $this->assign('msg',$err);
            $this->display('public/error');
        }else{
            // $this->assign('comments',$acomments);
            // $this->assign('activity_detail',$activity_detail[0]);
            // $this->assign('us_status',$us_status);
            // $this->assign('title', $activity_detail[0]['activity_name']);
            // $this->display();
        }
        return;
    }
    
}