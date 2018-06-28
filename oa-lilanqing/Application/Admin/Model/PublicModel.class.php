<?php 
namespace Admin\Model;
use Think\Model;
class PublicModel extends Model{
	// 开启批量验证
	protected $patchValidate = true;
	// 自动验证定义
	protected $_validate = array(
			array('username', 'require', '用户名不能为空'),
			array('password', 'require', '密码不能为空'),
			// 排序字段验证规则，必须为数字
			array('captcha', 'require', '验证码不能为空'),
		);
}
?>