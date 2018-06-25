<?php
namespace Admin\Controller;

class UserController extends CommonController{
	public function showList(){
		$model = M('User');
		$count = $model->count();
		$page = new \Think\Page($count, 10);

		// rollPage表示的是中间的滚动页有几页
		$page->rollPage = 5;
		$page->lastSuffix = false;
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$page->setConfig('last', '末页');
		$page->setConfig('first', '首页');

		$show = $page->show();

		$data = $model->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign('data', $data);
		$this->assign('show', $show);
		$this->assign('page', $page);
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

	public function edit(){
		if(IS_POST){
			$post = I('post.');
			$model = M('User');
			$result = $model->save($post);
			if($result !== false){
				$this->success('修改成功', U('showList'), 3);
			}else{
				$this->error('修改失败');
			}
		}else{
			$id = I('get.id');
			$model = M('User');
			$data = $model->find($id);
			$info = $model->where("id != $id")->select();
			$this->assign('data', $data);
			$this->assign('info', $info);
			$this->display();
		}
	}

	public function del(){
		$id = I('get.id');
		$model = M('User');
		$result = $model->delete($id);
		if($result){
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		}
	}

	public function charts(){
		$model = M();
		$data = $model->field('t2.name as deptname,count(*) as count')->table('sp_user as t1, sp_dept as t2')->where('t1.dept_id = t2.id')->group('deptname')->select();
		$str = '[';
		foreach ($data as $key => $value) {
			$str .= "['" . $value['deptname'] . "'," . $value['count'] . "],";
		}
		$str = rtrim($str, ',') . "]";
		$this->assign('str', $str);
		$this->display();
	}
}