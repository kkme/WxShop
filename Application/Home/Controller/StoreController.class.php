<?php 
	namespace Home\Controller;
	use Think\Controller;
	class StoreController extends Controller{
		/**
		 * 商家产品分类展示
		 */
		public function shopDis(){
			$store = session('store');
			//获取店家的基本信息
			$this->store = M('Store')->where(array('id'=>$store['id']))->find();
			//获取该商家的所有商品
			$this->goods = M('Goods')->where(array('store_id'=>$store['id'],'status'=>1))->order('time desc')->select();
			// var_dump($auth);
			$this->display('shop');
		}

		/**
		 * 商家店铺预览
		 */
		public function shopViewDis($store_id){
			//获取店家的基本信息
			$this->store = M('Store')->where(array('id'=>$store_id))->find();
			//获取该商家的所有商品
			$this->goods = M('Goods')->where(array('store_id'=>$store_id,'status'=>1))->order('time desc')->select();
			$this->display('shopView');
		}

		/**
		 * 商品展示
		 */
		public function goodsDis($goods_id){
			$this->goods = M('Goods')->where(array('id'=>$goods_id))->find();
			$this->display('goods');
		}
	}

 ?>