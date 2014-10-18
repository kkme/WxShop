<?php 
	namespace Home\Controller;
	use Think\Controller;
	class CartController extends Controller{
		/**
		 * 立即购买处理Dis
		 */
		public function buyNowDis($goods_id,$count){
			//获取用户信息
			$user = session('user');
			if (empty($user)) {
				$this->error('您还没有登陆，请登陆',U('Home/User/login'));
			}
			$this->user_info = $user;
			//获取商品信息
			$this->goods_info = M('Goods')->where(array('id'=>$goods_id))->find();
			$this->count = $count;
			$this->display('buyNow');
		}

		/**
		 * 立即购买处理函数
		 */
		public function buyNowPro(){
			$data = I();
			$data['time'] = time();
			$data['status'] = 0;
			$is_add = M('order')->add($data);
			if (!$is_add) {
				$ret['status'] = false;
				$ret['info'] = '订单添加失败';
				goto end;
			}
			$ret['status'] = true;
			$ret['info'] = '订单添加成功';
			end:
			$this->ajaxReturn($ret);
		}

		/**
		 * 加入购物车处理
		 */
		public function addCart(){
			$goods_id = I('post.goods_id');
			$count = I('post.count');
			$user = session('user');
			//跟新session
			$cart = session('cart');
			$cart[] = array('user_id'=>$user['id'],'goods_id'=>$goods_id,'count'=>$count,'cart_time'=>time());
			session('cart',$cart);
			$this->ajaxReturn(count(session('cart')));
		}

		/**
		 * 获取购物车数据
		 */
		public function getCart(){
			$this->ajaxReturn(count(session('cart')));
		}

		/**
		 * 删除购物车中的一条数据
		 */
		public function delCart(){
			$cart_time = I('cart_time');
			$cart = session('cart');
			// for($i = 0 ; $i < count($cart) ; $i++){
			// 	if ($cart[$i]['cart_time'] == $cart_time) {
			// 		unset($cart[$i]);
			// 		$this->ajaxReturn($i);
			// 	}
			// }
			// session('cart',$cart);
			foreach ($cart as $key => $value) {
				if ($value['cart_time'] == $cart_time) {
					unset($cart[$key]);
				}
			}
			session('cart',$cart);
			
		}

		/**
		 * 处理购物车商品
		 */
		public function doCartDis(){
			//获取用户信息
			$user = session('user');
			if (empty($user)) {
				$this->error('您还没有登陆，请登陆',U('Home/User/login'));
			}
			$this->user_info = $user;
			//获取购物商品信息
			$this->cart = session('cart');
			$this->display('doCart');
		}
	}


 ?>