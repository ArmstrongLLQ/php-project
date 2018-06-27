<?php
namespace Admin\Controller;
use Think\Controller;

class DeptController extends Controller{
	public function add(){
		$this->display();
	}

	public function showList(){
		if(IS_POST){

		}else{
			$model = M('Dept');
			$data = $model->order('sort asc')->select();
			foreach ($data as $key => $value) {
				$info = $model->find($value['pid']);
				$data[$key]['deptname'] = $info['name'];
			}
			load('@/tree');
			$data = getTree($data);
			$this->assign('data', $data);
			$this->display();
		}
	}
}
?>