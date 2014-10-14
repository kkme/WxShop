<?php 
	
	/**
	 * 商品类，对商品进行编辑
	 */
	namespace Home\Controller;
	use Think\Controller;
	class GoodsController extends BaseController{
		
		/**
		 * 商品删除方法
		 * @return boolean
		 */
		public function goodsDel(){
			$store = session('store');
			$goods_id = I('post.id');
			$store_id = $store['id'];
			$is_del = M('goods')->where(array('id'=>$goods_id,'store_id'=>$store_id))->delete();
			if (!$is_del) {
				$ret['status'] = false;
				$ret['info'] = '删除失败';
				goto end;
			}
				$ret['status'] = true;
				$ret['info'] = '删除成功';
			end:
			$this->ajaxReturn($ret);

		}

		/**
		 * 商品添加显示方法
		 */
		public function goodsAddDis(){
			//获取分类
			$store = session('store');
			$this->cat = M('type')->where(array('store_id'=>$store['id']))->select();
			$this->display('goodsAdd');
		}


		/**
		 * 分类展示页面
		 */
		public function categoryAddDis(){
			$store = session('store');
			$this->cat = M('type')->where(array('store_id'=>$store['id']))->select();
			$this->display('categoryAdd');
		}

		/**
		 * 添加分类处理方法
		 */
		public function categoryAddPro(){
			$type = I('post.cat');
			//获取商家
			$store = session('store');
			$data['name'] = $type;
			$data['store_id'] = $store['id'];
			$data['time'] = time();
			$is_add = M('Type')->add($data);
			if (!$is_add) {
				$ret['status'] = false;
				$ret['info'] = '添加分类错误';
				goto end;
			}

			$ret['status'] = true;
			$ret['info'] = '添加分类成功';

			end:
			$this->ajaxReturn($ret);
		}
	}

 ?>