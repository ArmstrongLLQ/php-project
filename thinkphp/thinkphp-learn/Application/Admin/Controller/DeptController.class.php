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
}
?>