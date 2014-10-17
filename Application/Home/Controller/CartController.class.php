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
	}


 ?>