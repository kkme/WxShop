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
			$this->display('regist_4');
		}
		//设置基本信息处理函数
		public function setPersonPro(){
			$auth = session('auth');
			$data['id'] = $auth['store_id'];
			$data['shoper_name'] = I('post.shoper_name');
			$data['shoper_ID'] = I('post.shoper_ID');
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
		 * 注册第五步，添加商店信息
		 */
		
		//图片上传
		public function imgUpload(){
			$upload = new \Think\Upload();// 实例化上传类
		    $upload->maxSize   =     3145728 ;// 设置附件上传大小
		    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		    $upload->savePath  =     './avatar/';// 设置附件上传目录,Uploads目录下
		    $upload->autoSub   =     false; //使用子目录上传
		    // 上传文件 
		    $info   =   $upload->uploadOne($_FILES['pic']);
		    $path = $info['savepath'].$info['savename'];
		    //　将头像图片存入数据库
		    $auth = session('auth');
		    $data['id'] = $auth['store_id'];
		    $data['avatar'] = $info['savename'];
		    $data['time'] = time();
		    M('Store')->save($data);
		    //　剪裁图片
		    $this->imgCut("./Uploads/avatar/".$info['savename']);
		}

		//对图片进行缩略，并强制控制大小
		public function imgCut($imgPath){
			$image = new \Think\Image(); 
			$image->open($imgPath);
			$image->thumb(93, 93,\Think\Image::IMAGE_THUMB_FIXED)->save($imgPath);
		}

		// 对前端头像图片请求进行响应
		public function imgResponse(){
			$auth = session('auth');
			$data['id'] = $auth['store_id'];
			$store = M('Store')->where($data)->find();
			$this->ajaxReturn($store['avatar']);
		}

		//　处理商家信息
		public function setStorePro(){
			$auth = session('auth');
			$data['id'] = $auth['store_id'];
			$data['title'] = I('post.title');
			$data['intro'] = I('post.intro');
			$is_up = M('Store')->save($data);
			if (!is_up) {
				$ret['status'] = false;
				$ret['info'] = '未知错误，错误代码：006，请联系客服解决';
				goto end;
			}
			//初始化第一件商品
			$goods['store_id'] = $auth['store_id'];
			$goods['name'] = '自动添加的商品，请删除';
			$goods['type_id'] = 0;
			$goods['originalPrice'] = 9.9;
			$goods['retailPrice'] = 9.9;
			$goods['headerImg'] = 'example.jpg';
			$goods['description'] = '这是系统自动添加的商品，请及时删除';
			$goods['quantity'] = 7;
			$goods['remainingQuantity'] = 1;
			$goods['time'] = time();
			$goods['status'] = 1;
			$is_goods_add = M('Goods')->add($goods);
			if (!$is_goods_add) {
				$ret['status'] = false;
				$ret['info'] = '未知错误，错误代码：007 请联系客服解决';
				goto end;
			}

			$ret['status'] = true;
			$ret['info'] = '添加微店基本信息成功';
			$store = M('Store')->where(array('id'=>$data['id']))->find();
			session('store',$store);
			end:
			$this->ajaxReturn($ret);
		}

		/**
		 * 用户登陆处理
		 */
		public function loginPro(){
			$data['shoper_phone'] = I('shoper_phone');
			$data['password'] = I('password','','md5');
			$store = M('Store')->where($data)->find();
			if (empty($store)) {
				$ret['status'] = false;
				$ret['info'] = '用户名或密码错误';
				goto end;
			}
				$ret['status'] = true;
				$ret['info'] = '用户登陆成功';
				session('store',$store);
			end:
			$this->ajaxReturn($ret);
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
			// $auth = session('auth');
			// var_dump($auth);
			$avatar_path = cookie('avatar_path');
			var_dump($avatar_path);
		}
	}

 ?>