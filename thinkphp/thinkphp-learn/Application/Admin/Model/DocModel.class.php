<?php
namespace Admin\Model;
use Think\Model;
class DocModel extends Model{
	public function saveData($post, $file){
		// 判断是否有文件需要处理
		if(!$file['error']){
			// 定义配置
			$cfg = array(
						'rootPath' => WORKING_PATH . UPLOAD_ROOT_PATH
			);
			// 处理上传
			// 实例化上传类
			$upload = new \Think\Upload($cfg);
			// 开始上传
			$info = $upload->uploadOne($file);
			if($info){
				// 上传成功，补全剩余的三个字段
				$post['filepath'] = UPLOAD_ROOT_PATH . $info['savepath'] . $info['savename'];
				$post['filename'] = $info['name'];
				$post['hasfile'] = 1;
			}

		}
		$post['addtime'] = time();

		
		return $this->add($post);
	}

	public function updateData($post, $file){
		// 如果有文件则处理文件
		if($file['error'] == '0'){
			$cfg = array('rootPath' => WORKING_PATH . UPLOAD_ROOT_PATH);
			// 实例化上传类
			$upload = new \Think\Upload($cfg);
			$info = $upload->uploadOne($file);
			if($info){
				// 上传成功，补全剩余的三个字段
				$post['filepath'] = UPLOAD_ROOT_PATH . $info['savepath'] . $info['savename'];
				$post['filename'] = $info['name'];
				$post['hasfile'] = 1;
			}
		}
		$post['addtime'] = time();
		return $this->save($post);
	}
} 
?>