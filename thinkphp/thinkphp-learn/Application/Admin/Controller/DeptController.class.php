<?php 
namespace Admin\Controller;
use Think\Controller;
class DeptController extends Controller{
	// 展示实例化的结果
	public function shilihua(){
		// 普通实例化方法
		$model = new \Admin\Model\DeptModel();
		dump($model);
	}

	public function tianjia(){
		$model = M('Dept');
		$data = array(
					'name'	=>	'人事部',
					'pid'	=>	'0',
					'sort'	=>	'1',
					'remark'=>	'这是人事部门'
		);
		$result = $model->add($data);
		dump($result);
	}

	public function add(){
		// 判断请求类型
		if(IS_POST){
			$post = I('post.');
			// dump($post);
			$model = M('Dept');
			$result = $model->add($post);
			if ($result) {
				$this->success('添加成功', U('showList'), 1);
			}else{
				$this->error('添加失败');
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
		// 模型实例化
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
			$post = I('post.');
			$model = M('Dept');
			$result = $model->save($post);
			if($result !== false){
				$this->success('修改成功', U('showList'), 3);
			}else{
				$this->error('修改失败');
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

