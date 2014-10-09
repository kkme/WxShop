<?php 
	
	namespace Home\Controller;
	use Think\Controller;
	class RegistController extends Controller{
		/**
		 * 注册第一步，向目标手机发送短信验证码
		 * @return boolen
		 */
		public function sendCode(){
			$phone = I('post.phone');
			// $rand_num = rand(1000,9999);
			   $rand_num = 111;
			// 判断是否已经注册
			if(M('Store')->where(array('shoper_phone'=>$phone))->find()){
				$ret['status'] = false;
				$ret['info'] = '该用户已经注册请直接登陆';
				goto end;
			}

			// 短信发送不成功
			if (!$this->sendMessage($phone,$rand_num)) {
				$ret['status'] = false;
				$ret['info'] = '未知错误,错误代码:0002，请联系客服解决';
				goto end;
			}

			//写入session
			session('code',$rand_num);
			if (!session('code')) {
				$ret['status'] = false;
				$ret['info'] = '未知错误,错误代码:0001，请联系客服解决';
				goto end;
			}

			// 通过所有验证
			$ret['status'] = true;
			$ret['info'] = '验证码发送成功';
			
			end:
			$this->ajaxReturn($ret);
		}

		/**
		 * 注册第二步，比对验证码
		 * @return boolen
		 */
		public function checkCode(){
			$input_code = I('post.code');
			$server_code = session('code');
			$phone = I('post.phone');	

			if ($server_code != $input_code) {
				$ret['status'] = false;
				$ret['info'] = '验证码不正确';
				goto end;
			}

			//验证通过
			$ret['status'] = true;
			$ret['info'] = '验证成功';
			//清除session
			session('code',NULL);
			//将用户信息写入session方便下一步判断
			session('auth',array('shoper_phone'=>$phone));
			end:
			$this->ajaxReturn($ret);
		}

		/**
		 * 注册第三步，设置密码
		 */

		//修改密码显示页面，判断页面来源
		public function setPassDis(){
			$auth = session('auth');
			if (empty($auth)) {
				$this->redirect('Regist/welcome');
			}
			$this->display('regist_3');
		}

		public function setPass(){
			$auth = session('auth');
			$auth['password'] = I('post.password','','md5');
			$auth['time'] = time();
			$auth['title'] = '我的微信小店';
			$auth['intro'] = '这是我的微信小店，欢迎光临';
			$auth['status'] = 1;
			$is_add = M('Store')->add($auth);
			if ($is_add) {
				$ret['status'] = true;
				$ret['info'] = '添加密码成功';
				//重新记录auth信息,只记录id即可
				session('auth',array('store_id'=>$is_add));
			}else{
				$ret['status'] = false;
				$ret['info'] = '未知错误，错误代码：003，请联系客服解决';
			}
			$this->ajaxReturn($ret);

		}


		/**
		 * 注册第四步，填写基本信息
		 */
		//设置基本信息显示页面
		public function setPersonDis(){
			$auth = session('auth');	
			$this->display('regist_4');
		}


		/**
		 * 发送短信函数
		 * @return boolen
		 */
		public function sendMessage($phone,$content){
			//TO-DO
			return true;
		}

		/**
		 * 测试函数
		 */
		public function test(){
			$a = 11;
			if ($a > 10) goto a;
			else goto b;
			
			b:
			echo "小于１０";

			a:
			echo "大于１０";
		}
	}

 ?>