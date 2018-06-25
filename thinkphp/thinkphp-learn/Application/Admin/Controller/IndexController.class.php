<?php
namespace Admin\Controller;

class IndexController extends CommonController{
	public function index(){
		$this->display();
	}

	public function home(){
		$this->display();
	}

	public function _empty(){
		echo '页面不存在';
	}

}