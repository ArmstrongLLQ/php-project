<?php 
namespace Admin\Model;
use Think\Model;

class EmailModel extends Model{
	public function addData($post, $file){
		if($file['error'] == '0'){
			// 有文件需要处理
			$cfg = array('rootPath' => WORKING_PATH . UPLOAD_ROOT_PATH);
			// 实例化上传类
			$upload = new \Think\Upload($cfg);
			$info = $upload->uploadOne($file);
			if($info){
				// 上传成功，需要处理数据表中需要的字段
				$post['file'] = UPLOAD_ROOT_PATH . $info['savepath'] . $info['savename'];
				$post['hasfile'] = '1';
				$post['filename'] = $info['name'];
			}
		}
		// 补充字段from_id, addtime
		$post['from_id'] = session('id');
		$post['addtime'] = time();

		return $this->add($post);
	}
}
?>
