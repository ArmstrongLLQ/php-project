<?php 
namespace Admin\Controller;
use Think\Controller;
class PublicController extends Controller{
	public function login(){
		$this->display();
	}

	public function captcha(){
		// 配置
		$cfg = array(
            'fontSize'  =>  12,              // 验证码字体大小(px)
            'useCurve'  =>  false,            // 是否画混淆曲线
            'useNoise'  =>  false,            // 是否添加杂点
            'imageH'    =>  38,               // 验证码图片高度
            'imageW'    =>  80,               // 验证码图片宽度
            'length'    =>  4,               // 验证码位数
            'fontttf'   =>  '4.ttf',              // 验证码字体，不设置随机获取
		);
		//实例化验证码类
		$verify = new \Think\Verify($cfg);
		//输出验证码
		$verify->entry();
	}

	public function checkLogin(){
		$post = I('post.');
		$verify = new \Think\Verify();
		$result = $verify->check($post['captcha']);
		// dump($result);
		if($result){
			// 验证码正确，继续处理用户名和密码
			$model = M('User');
			// 删除验证码元素
			unset($post['captcha']);
			// 查询
			$data = $model->where($post)->find();
			// 判断是否存在用户
			if($data){
				// 存在，用户信息保存到session中，跳转到后台首页
				session('id', $data['id']);
				session('username', $data['username']);
				session('role_id', $data['role_id']);

				$this->success('登录成功@~@', U('Index/index'), 3);
			}else{
				// 不存在
				$this->error('用户名或密码错误');
			}
		}
	}

	public function logout(){
		// 清除session
		session(null);
		$this->success('退出成功', U('login'), 3);
	}
}
?>
