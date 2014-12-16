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
      
      $err = '';
        //register valicate
      if (!$user->create($data)){ 
        $err = $user->getError();
      }else{
        $redis = new \Org\Util\TpRedis;
        $data['uid'] = $redis->incr('uid');
        $redis->close();
        $data['create_time'] = date('Y-m-d H:i:s',time());
        $data['user_status'] = 0;
        $data['permission'] = 'N';
        $data['credit'] = 0;
        $user->add($data);
      }
      
      if(strlen($err)>0){
        $this->assign('reg_email_save', $data['email'] );
        $this->assign('reg_username_save', $data['username']);
        $this->assign('title','注册');
        $this->assign('err',$err);
        $this->display('regist');
      }else{
        $this->assign('next_url',U('Activity/index'));
        $this->assign('msg','注册成功');
        $this->display('public/success');
      }
    }
    return;
  }

  public function login(){
    //echo "method:".I('param.method','page');    
    if( I('param.method','page')==='page' ){
      //$value = session('name');
      $this->assign('title','登录');
      $this->display();
    }else{
      $user_model = D('User');
      $data['password'] = I('param.login_password');
      $data['email'] = I('param.login_email');
      $chk_res = $user_model->login_check( $data['email'],$data['password']);
      if( strlen( $chk_res ) >0 ){//验证失败
        $err = $chk_res;
      }else{
        //$res = $user->where("password='%s' AND email='%s'", array($data['password'] ,$data['email'] ))->getField('uid,username',1);
        
        $res = $user_model->field('uid,username,permission')->where("password='%s' AND email='%s' AND user_status>5", array($data['password'] ,$data['email']))->limit(1)->select();
        
        
        if($res){
          //Login success
          //echo $user_model->getlastsql();
          //print_r($res);
          session('uid',$res[0]['uid']); 
          session('username',$res[0]['username']);
          session('permission',$res[0]['permission']);

        }else if(is_null($res)){
          $err='密码错误！';
        }else if($res==false){
          $err = '数据库异常！';
        }
      }
      
      if(strlen($err)>0){
        $this->assign('login_email_save', $data['email'] );
        $this->assign('login_pass_save', $data['password']);
        $this->assign('title','登录');
        $this->assign('err',$err);
        $this->display();
      }else{
        //$this->assign('next_url',U('Activity/index'));
        // $this->display('public/success');
        $this->redirect('Activity/index');
      }
      
    }//end of do login
    return;
  }

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