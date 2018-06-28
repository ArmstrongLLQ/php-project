<?php 
namespace Admin\Model;
use Think\Model;
class DeptModel extends Model{
	// 开启批量验证
	protected $patchValidate = true;
	// 自动验证定义
	protected $_validate = array(
			// 部门名称验证规则，必填，不能重复
			array('name', 'require', '部门名称不能为空'),
			array('name', '', '部门已经存在', 0, 'unique'),
			// 排序字段验证规则，必须为数字
			array('sort', 'number', '排序必须为数字'),
		);
}
?>
