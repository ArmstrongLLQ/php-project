<?php
namespace Admin\Controller;
use Think\Controller;

class DeptController extends Controller{
	public function add(){
		if(IS_POST){
			$model = D('Dept');
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
			// 查询出顶级部门
			$model = M('Dept');
			$data = $model->where('pid = 0')->select();
			$this->assign('data', $data);
			$this->display();
		}
	}

	public function showList(){
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

	public function edit(){
		if(IS_POST){
			$model = D('Dept');
			$data = $model->create();
			if($data){
				$result = $model->save();
				if ($result !== false) {
					$this->success('修改成功', U('showList'), 3);
				}else{
					$this->error('修改失败');
				}
				
			}else{
				$id = I('get.id');
				$data = $model->find($id);
				$info = $model->where("id != $id")->select();
				$this->assign('data', $data);
				$this->assign('info', $info);
				$this->assign('error', $model->getError());
				$this->display();
			}
		}else{
			$id = I('get.id');
			$model = M('Dept');
			$data = $model->find($id);
			$info = $model->where("id != $id")->select();
			$this->assign('data', $data);
			$this->assign('info', $info);
			$this->display();
		}
	}

	public function del(){
		$id = I('get.id');
		$model = M('Dept');
		$result = $model->delete($id);
		if($result){
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		}
	}
}
?>