<?php
namespace Admin\Controller;
use Think\Controller;
class TestController extends Controller {
    public function test(){
    	$var = date('Y-m-d H:i:s', time());
    	$this->assign('var', $var);
        $this->display();
    }
    
    public function test1(){
        echo U('index');
    }
    
    public function test2(){
        $this->success('success', U('test'), 10);
    }
}