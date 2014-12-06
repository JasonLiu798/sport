<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        echo index;
    }
    
    public function test(){
    	$this->show("test");
    }
}