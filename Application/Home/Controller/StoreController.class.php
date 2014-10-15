<?php 
	namespace Home\Controller;
	use Think\Controller;
	class StoreController extends Controller{
		/**
		 * [商家部分]商家面板
		 */
		public function dashboardDis(){
			$store = session('store');
			//如果没有登陆，跳转到登陆页面
			$store = session('store');
			if (empty($store['id'])) {
				$this->error('请登陆后再进行操作',U('Home/Regist/login'));
			}
			$this->display('dashboard');
		}

		/**
		 * [商家部分]商家产品分类展示
		 */
		public function shopDis(){
			$store = session('store');
			//如果没有登陆，跳转到登陆页面
			$store = session('store');
			if (empty($store['id'])) {
				$this->error('请登陆后再进行操作',U('Home/Regist/login'));
			}
			//获取店家的基本信息
			$this->store = M('Store')->where(array('id'=>$store['id']))->find();
			//获取该商家的所有商品
			$this->goods = M('Goods')->where(array('store_id'=>$store['id'],'status'=>1))->order('time desc')->select();
			// var_dump($auth);
			$this->display('shop');
		}

		/**
		 * [商家部分]修改商家店铺信息模板页
		 */
		public function storeEditDis(){
			//如果没有登陆，跳转到登陆页面
			$store = session('store');
			if (empty($store['id'])) {
				$this->error('请登陆后再进行操作',U('Home/Regist/login'));
			}
			//session信息过期，跟新session
			$store = M("Store")->where(array('id'=>$store['id']))->find();
			$this->assign('store',$store);
			$this->display('storeEdit');
		}
		/**
		 * [商家部分]处理商家修改
		 */
		public function storeEditPro(){
			//如果没有登陆，跳转到登陆页面
			$store = session('store');
			if (empty($store['id'])) {
				$this->error('请登陆后再进行操作',U('Home/Regist/login'));
			}
			$avatar = session('avatar');
			if (!empty($avatar)) {
				$data['avatar'] = $avatar;
			}
			$data['id']    = $store['id'];
			$data['title'] = I('post.title');
			$data['intro'] = I('post.intro');
			$data['time'] = time();
			$is_update = M('store')->save($data);
			if (!$is_update) {
				$ret['status'] = false;
				$ret['intro'] = '编辑店铺失败';
				goto end;
			}
			$ret['status'] = true;
			$ret['intro'] = '编辑店铺成功';
			session('avatar',NULL);
			end:
			$this->ajaxReturn($ret);
		}

		/**
		 * [用户部分]商家店铺预览
		 */
		public function shopViewDis($store_id){
			//获取店家的基本信息
			$this->store = M('Store')->where(array('id'=>$store_id))->find();
			//获取该商家的所有商品
			$this->goods = M('Goods')->where(array('store_id'=>$store_id,'status'=>1))->order('time desc')->select();
			$this->display('shopView');
		}

		/**
		 * [用户部分]商品展示
		 */
		public function goodsDis($goods_id){
			$this->goods = M('Goods')->where(array('id'=>$goods_id))->find();
			// 获取商家信息
			$store_id = $this->goods['store_id'];
			$this->store = M('Store')->where(array('id'=>$store_id))->find();
			$this->display('goods');
		}

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
		    //将图片写入session，以便在前台调用
		    session('avatar',$info['savename']);
		}

		//对图片进行缩略，并强制控制大小
		public function imgCut($imgPath){
			$image = new \Think\Image(); 
			$image->open($imgPath);
			$image->thumb(93, 93,\Think\Image::IMAGE_THUMB_FIXED)->save($imgPath);
		}

		// 对前端头像图片请求进行响应
		public function imgResponse(){
			$this->ajaxReturn(session('avatar'));
		}

	}

 ?>