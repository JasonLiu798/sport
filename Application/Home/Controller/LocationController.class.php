<?php
namespace Home\Controller;

use Think\Controller;
use Think\Log;

class LocationController extends Controller {


    public function city(){
        $pid = I('param.pid');
        $err = '';
        if(is_null($pid)){
            $err = '参数错误';
        }else{

            $l_model = D('Location');

            $city = $l_model->get_city($pid);
        }

        if(strlen($err)>0){
            $data['error'] = $err;
            $data['msg'] = '获取失败';
        }else{
            //$data['msg'] = '获取成功';
            $data['cities'] = $city;
        }
        $this->ajaxReturn($data);
    }

    public function area($cid){
        $cid = I('param.cid');
        $err = '';
        if(is_null($cid)){
            $err = '参数错误';
        }else{

            $l_model = D('Location');

            $area = $l_model->get_area($cid);
        }

        if(strlen($err)>0){
            $data['error'] = $err;
            $data['msg'] = '获取失败';
        }else{
            //$data['msg'] = '获取成功';
            $data['areas'] = $area;
        }
        $this->ajaxReturn($data);

    }
}