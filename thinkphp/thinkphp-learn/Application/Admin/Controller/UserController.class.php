<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller{
	public function showList(){
		$model = M('User');
		$data = $model->select();
		$this->assign('data', $data);
		$this->display();
	}

	public function add(){
		if(IS_POST){
			$model = M('User');
			$data = $model->create();
			$data['addtime'] = time();
			$result = $model->add($data);
			if($result){
				$this->success('添加成功', U('showList'), 3);
			}else{
				$this->error('添加失败');
			}
		}else{
			$data = M('Dept')->field('id, name')->select();
			$this->assign('data', $data);
			$this->display();
		}
	}
}