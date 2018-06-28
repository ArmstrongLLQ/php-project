<?php
namespace Admin\Controller;
use Think\Controller;

class UserController extends Controller{
	public function add(){
		if(IS_POST){
			$model = D('User');
			$data = $model->create();
			if($data){
				$result = $model->add();
				if ($result) {
					$this->success('添加成功', U('showList'), 3);
				}else{
					$this->error('添加失败');
				}
				
			}else{
				$data = $model->where('pid = 0')->select();
				$this->assign('data', $data);
				$this->assign('error', $model->getError());
				$this->display();
			}
		}else{
			$this->display();
		}
	}

	public function edit(){
		$this->display();
	}

	public function showList(){
		$model = M();
		// select t1.*, t2.name as deptname from sp_user as t1, sp_dept as t2 where t1.dept_id=t2.id
		$data = $model->field('t1.*, t2.name as deptname')->table('sp_user as t1, sp_dept as t2')->where('t1.dept_id=t2.id')->select();
		$this->assign('data', $data);
		$this->display();
	}

	public function del(){
		$this->display();
	}

	public function charts(){
		$this->display();
	}
}