<?php
namespace Home\Controller;
use Think\Controller;
use Org\Util\MessageSend;

class UserController extends Controller {
	/**
	 * 注册第一步，向目标手机发送短信验证码
 	* @return boolen
	 */
	public function sendCode(){
			$phone = I('post.phone');
			$rand_num = rand(1000,9999);
			// 判断是否已经注册
			if(M('User')->where(array('phone'=>$phone))->find()){
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
		 * 发送短信函数
		 * @return boolen
		 */
		public function sendMessage($phone,$content){
			//主帐号,对应开官网发者主账号下的 ACCOUNT SID
			$accountSid= '8a48b551488d07a80148b513ff121279';

			//主帐号令牌,对应官网开发者主账号下的 AUTH TOKEN
			$accountToken= '465e20da24234158a3ec42191922522b';

			//应用Id，在官网应用列表中点击应用，对应应用详情中的APP ID
			//在开发调试的时候，可以使用官网自动为您分配的测试Demo的APP ID
			$appId='aaf98f89488d0aad0148b5146fde1252';

			//请求地址
			//沙盒环境（用于应用开发调试）：sandboxapp.cloopen.com
			//生产环境（用户应用上线使用）：app.cloopen.com
			$serverIP='sandboxapp.cloopen.com';


			//请求端口，生产环境和沙盒环境一致
			$serverPort='8883';

			//REST版本号，在官网文档REST介绍中获得。
			$softVersion='2013-12-26';

			 $rest = new MessageSend($serverIP,$serverPort,$softVersion);
		     $rest->setAccount($accountSid,$accountToken);
		     $rest->setAppId($appId);
		    
		     // 发送模板短信
		     $result = $rest->sendTemplateSMS($phone,array($content,'3'),'1');
		     if($result == NULL ) {
		        return false;
		         break;
		     }
		     if($result->statusCode!=0) {
		         return false;
		     }else{
		        return true;
		     }
			
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
			session('auth',array('phone'=>$phone));
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
			$auth['status'] = 1;
			$is_add = M('User')->add($auth);
			if ($is_add) {
				$ret['status'] = true;
				$ret['info'] = '添加密码成功';
				//重新记录auth信息,只记录open_id即可
				session('auth',array('id'=>$is_add));
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
			$this->display('regist_4');
		}
		//设置基本信息处理函数
		public function setPersonPro(){
			$auth = session('auth');
			$data['id'] = $auth['id'];
			$data['name'] = I('post.name');
			$data['address'] = I('post.address');
			$data['time'] = time();
			$is_up = M('Store')->save($data);
			if (!$is_up) {
				$ret['status'] = false;
				$ret['info'] = '未知错误，错误代码：004，请联系客服解决';
				goto end;
			}
			$ret['status'] = true;
			$ret['info'] = '修改商家信息成功';
			end:
			$this->ajaxReturn($ret);
		}

		/**
		 * 用户登陆处理
		 */
		public function loginPro(){
			$data['phone'] = I('phone');
			$data['password'] = I('password','','md5');
			$user = M('User')->where($data)->find();
			if (empty($user)) {
				$ret['status'] = false;
				$ret['info'] = '用户名或密码错误';
				goto end;
			}
				$ret['status'] = true;
				$ret['info'] = '用户登陆l成功';
				session('user',$user);
			end:
			$this->ajaxReturn($ret);
		}

		/**
		 * 用户信息显示
		 */
		public function myInfoDis(){
			$this->display('myInfo');
		}

}