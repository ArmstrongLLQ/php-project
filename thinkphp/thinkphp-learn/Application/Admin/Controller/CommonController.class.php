<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller{
	public function _initialize(){
		// 判断用户是否登录
		$id = session('id');
		if(empty($id)){
			// 没有登录，跳转到登录页面
			// $this->error('请先登录...', U('Public/login'), 3);exit;

			// 编写javascript代码
			$url = U('Public/login');
			echo "<script>alert('您未登录或登录超时，请重新登录...');top.location.href='$url'</script>;";exit;
		}

		// RBAC部分
		$role_id = session('role_id');	// 获取当前用户的角色id
		$rbac_role_auths = C('RBAC_ROLE_AUTHS');	// 获取全部的用户组的权限
		$currRoleAuth = $rbac_role_auths[$role_id];	// 获取到当前用户对应权限

		// 使用常量获取当前路由中的控制器名和方法名
		$controller = strtolower(CONTROLLER_NAME);
		$action = strtolower(ACTION_NAME);

		// 判断是否具有权限
		if($role_id > 1){
			// 当用户不是超级管理员的时候进行权限判断
			if(!in_array($controller.'/'.$action, $currRoleAuth) && !in_array($controller.'/*', $currRoleAuth)){
				// 用户没有权限
				$this->error('您没有权限', U('Index/home'), 3);exit;
			}
		}
	}
} 
?>