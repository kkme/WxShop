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
			// var_dump($this->store);
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
			$avatar = I('post.avatar');
			if ($avatar) {
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
		public function shopViewDis($store_id,$type_id = ''){
			
			//获取店家的基本信息
			$this->store = M('Store')->where(array('id'=>$store_id))->find();

			//获取该商家的所有商品
			if ($type_id != '') {
				$data['type_id'] = $type_id;
				//获取该商品的分类
				$this_goods_type = M('Type')->where(array('id'=>$type_id))->find();
				$this->this_goods_type = $this_goods_type['name'];
			}
			$data['store_id'] = $store_id;
			$data['status']   = 1;
			$this->goods = M('Goods')->where($data)->order('time desc')->select();

			//获取该商家的商品分类
			$this->type = M('Type')->where(array('store_id'=>$this->store['id']))->select();
			$this->display('shopView');
		}

		/**
		 * [用户部分]商品展示
		 */
		public function goodsDis($goods_id){
			//获取该商品信息
			$this->goods = M('Goods')->where(array('id'=>$goods_id))->find();
			//获取商家信息
			$store_id = $this->goods['store_id'];
			$this->store = M('Store')->where(array('id'=>$store_id))->find();
			//获取该商家的商品分类
			$this->type = M('Type')->where(array('store_id'=>$this->store['id']))->select();
			$this->display('goods');
		}

	}

 ?>