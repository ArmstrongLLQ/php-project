<?php 
namespace Admin\Controller;
use Think\Controller;

class PublicController extends Controller{
	private function checkLogin($post){
		$verify = new \Think\Verify();
		$result = $verify->check($post['captcha']);
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

				$this->redirect('Index/index');
			}else{
				// 不存在
				$this->error('用户名或密码错误');
			}
		}else{
			echo "<script>alert('验证码错误');</script>";
		}
	}

	public function login(){
		if(IS_POST){
			$model = D('Public');
			$data = $model->create($post);
			if($data){
				$verify = new \Think\Verify();
				$result = $verify->check($data['captcha']);
				if($result){
					// 验证码正确，继续处理用户名和密码
					$model2 = M('User');
					// 删除验证码元素
					unset($data['captcha']);
					// 查询
					$data = $model->where($post)->find();
					// 判断是否存在用户
					if($data){
						// 存在，用户信息保存到session中，跳转到后台首页
						session('id', $data['id']);
						session('username', $data['username']);
						session('role_id', $data['role_id']);

						$this->redirect('Index/index');
					}else{
						// 不存在
						$this->error('用户名或密码错误');
					}
				}else{
					$error = array('captcha'=>'验证码错误');
					$placeholder = array('username'=>$data['username']);
					$this->assign('placeholder', $placeholder);
					$this->assign('error', $error);
					$this->display();
				}
			}else{
				$this->assign('error', $model->getError());
				$this->display();
			}
		}else{
			$this->display();
		}
	}

	public function captcha(){
		// 配置
		$cfg = array(
            'fontSize'  =>  12,              // 验证码字体大小(px)
            'useCurve'  =>  true,            // 是否画混淆曲线
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

	public function logout(){
		// 清除session
		session(null);
		$this->redirect('login');
	}
}
?>