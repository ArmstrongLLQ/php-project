<?php 
namespace Admin\Controller;
use Think\Controller;
class DocController extends Controller{
	public function add(){
		if(IS_POST){
			// 处理提交
			$post = I('post.');
			$model = D('Doc');
			$result = $model->saveData($post, $_FILES['file']);
			if($result){
				$this->success('添加成功', U('showList'), 3);
			}else{
				$this->error('添加失败');
			}
		}else{
			// display
			$this->display();
		}
	}

	public function showList(){
		$model = M('Doc');
		$data = $model->select();
		$this->assign('data', $data);
		$this->display();
	}

	public function edit(){
		if(IS_POST){
			$post = I('post.');
			$model = D('Doc');
			$result = $model->updateData($post, $_FILES['file']);
			if($result !== false){
				$this->success('修改成功', U('showList'), 3);
			}else{
				$this->error('修改失败');
			}
		}else{
			$id = I('get.id');
			$model = M('Doc');
			$data = $model->find($id);	
			$this->assign('data', $data);
			$this->display();
		}
	}

	public function download(){
		$id = I('get.id');
		$model = M('Doc');
		$data = $model->find($id);
		$file = WORKING_PATH . $data['filepath'];

		// 输出文件
		header("Content-type: application/octet-stream");
		header('Content-Disposition: attachment; filename="' . basename($file) . '"');
		header("Content-Length: " . filesize($file));
		// 输出缓存区
		readfile($file);
	}

	public function showContent(){
		$id = I('get.id');
		$model = M('Doc');
		$data = $model->find($id);
		echo htmlspecialchars_decode($data['content']);
	}
}
?>

