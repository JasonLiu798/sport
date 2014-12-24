<?php
namespace Home\Controller;
use Think\Controller;
class SportController extends Controller {

    public function subtype(){
        $sid = I('param.sid');
        $err = '';
        if(is_null($sid)){
            $err = '参数错误';
        }else{

            $s_model = D('Sport');
 
            $sub_types = $s_model->get_sport_sub_type( $sid );
        }

        if(strlen($err)>0){
            $data['error'] = $err;
            $data['msg'] = '获取失败';
        }else{
            //$data['msg'] = '获取成功';
            $data['sport_types'] = $sub_types;
        }
        $this->ajaxReturn($data);
    }
}