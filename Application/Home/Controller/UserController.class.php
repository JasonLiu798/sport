<?php
namespace Home\Controller;

use Think\Controller;
use Home\Model\UserModel;

class UserController extends Controller {



  public function index(){
    $this->show('Home-User-Index','utf-8');
  }

  public function regist(){
    //echo "method:".I('param.method','page');    
    if( I('param.method','page')==='page' ){
      $this->assign('title','注册');
      $this->display();
    }else{
      $user = D('User');
      $data['username'] = I('param.reg_username');
      $data['password'] = I('param.reg_password');
      $data['email'] = I('param.reg_email');
      $redis = new \Org\Util\TpRedis;
      $data['uid'] = $redis->get('uid');
      $err = '';
        //register valicate
      if (!$user->create($data)){ 
        $err = $user->getError();
      }
      
      if(strlen($err)>0){
        $this->assign('reg_email_save', $data['email'] );
        $this->assign('reg_username_save', $data['username']);
        $this->assign('title','注册');
        $this->assign('err',$err);
        $this->display('regist');
      }else{
        $this->assign('next_url',U('Activity/index'));
        $this->display('regist_success');
        //$this->redirect('');
      }
      
    }
    return;
  }

  public function doregist(){
    	//echo U('Public/bower_components/jquery/dist/jquery.min.js');
   
    	// $user->username = 'sdff';
    	// $user->password = 'asdf';
    	// $user->repassword = 'asdf';
    	// $user->email = 'ss@sdf.djkf';
  //   	$data['uid'] = $redis->get('uid');
  //   	$data['username'] = 'sdkl_df';
		// $data['email'] = 'Think@maisfdsklj.com';
		// $data['password'] 	= '123456';
		// $data['repassword'] = '1234856';
		// $data = getData();
		// http://www.sport.com/home/user/doregister?username=sdff&password=123456&repassword=1234556&email=a@df.dj
		/*
    	
		//$res = $user->register();

		$redis->close();
	*/

		
  //   	$redis = new \Org\Util\TpRedis;
		// $uid = $redis->get('uid');
		
     	//print "uid:$res";
  		//$redis = new \Org\Util\TPRedis;
  //   	//print_r($res);
    	//$this->show('register');
  }
}