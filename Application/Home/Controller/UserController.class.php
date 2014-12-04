<?php
namespace Home\Controller;

use Think\Controller;
use Home\Model\UserModel;

class UserController extends Controller {



    public function index(){
        $this->show('Home-User-Index','utf-8');
    }


    public function register(){
    	$user = D('User');
		$res = $user->register();
  //   	$redis = new \Org\Util\TpRedis;
		// $uid = $redis->get('uid');
		// $redis->close();
     	print "uid:$res";
  		//$redis = new \Org\Util\TPRedis;
  //   	//print_r($res);
    	//$this->show('register');
    }
}