<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->redirect('activity/index');
    }
    
    public function test(){
    	$this->show("test");
    }
}