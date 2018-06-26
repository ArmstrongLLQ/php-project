<?php 
namespace Admin\Controller;

class EmailController extends CommonController{
	public function send(){
		if(IS_POST){
			// 处理数据
			$post = I('post.');
			$model = D('Email');
			$result = $model->addData($post, $_FILES['file']);
			if($result){
				$this->success('邮件发送成功', U('sendBox'), 3);
			}else{
				$this->error('邮件发送失败');
			}
		}else{
			// 展示模版
			// 查询收件人的信息
			$id = session('id');
			$data = M('User')->field('id, truename')->where('id != '.$id)->select();
			$this->assign('data', $data);
			$this->display();
		}
	}

	public function sendBox(){
		if(IS_POST){

		}else{
			// select t1.*, t2.truename as truename from sp_email as t1, sp_user as t2 where t1.to_id=t2.id
			$model = M();
			$data = $model->field('t1.*, t2.truename as truename')->table('sp_email as t1, sp_user as t2')->where('t1.to_id=t2.id and t1.from_id='.session('id'))->select();
			$this->assign('data', $data);
			$this->display();
		}
	}

	public function recBox(){
		if(IS_POST){

		}else{
			// select t1.*, t2.truename as truename from sp_email as t1, sp_user as t2 where t1.to_id=t2.id
			$model = M();
			$data = $model->field('t1.*, t2.truename as truename')->table('sp_email as t1, sp_user as t2')->where('t1.from_id=t2.id and t1.to_id='.session('id'))->select();
			$this->assign('data', $data);
			$this->display();
		}
	}

	public function download(){
		$id = I('get.id');
		$model = M('Email');
		$data = $model->find($id);
		$file = WORKING_PATH . $data['file'];

		// 输出文件
		header("Content-type: application/octet-stream");
		header('Content-Disposition: attachment; filename=' . basename($file));
		header("Content-Length: " . filesize($file));
		// 输出缓存区
		readfile($file);
	}

	public function showContent(){
		$id = I('get.id');
		$model = M('Email');
		$data = $model->where("to_id=".session('id'))->find($id);
		// 如果data为真，则修改邮件的状态
		if($data['isread'] == '0'){
			// 修改状态
			$model->save(array('id'=>$id, 'isread'=>1));
		}
		echo htmlspecialchars_decode($data['content']);
	}

	public function getCount(){
		if(IS_AJAX){
			$model = M('Email');
			$count = $model->where('isread = 0 and to_id = '.session('id'))->count();
			echo $count;
		}
	}
}
?>