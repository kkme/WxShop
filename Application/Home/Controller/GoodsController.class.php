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
		 * 商品添加处理
		 */
		public function goodsAddPro(){
			$store = session('store');
			$headerImg = I('post.headerImg');
			if ($headerImg) {
				$data['headerImg'] = $headerImg;
			}

			$data['name'] = I('post.name');
			$data['description'] = I('post.description');
			$data['retailPrice'] = I('post.retailPrice');
			$data['remainingQuantity'] = I('post.remainingQuantity');
			$data['type_id'] = I('post.type_id');
			$data['store_id'] = $store['id'];
			$data['status'] = 1;
			$data['time'] = time();
			if ($data['type_id'] == -1) {
				$ret['status'] = false;
				$ret['info'] = '请选择分类';
				goto end;
			}
			$is_add = M('Goods')->add($data);
			if (!$is_add) {
				$ret['status'] = false;
				$ret['info'] = '商品添加失败，请联系管理员';
				goto end;
			}
			$ret['status'] = true;
			$ret['info'] = '商品添加成功';
			end:
			$this->ajaxReturn($ret);
		}

		/**
		 * 商品修改展示页面
		 */
		public function goodsUpdateDis($goods_id){
			$store = session('store');
			//获取分类
			$this->cat = M('type')->where(array('store_id'=>$store['id']))->select();
			//获取商品
			$this->goods = M('Goods')->where(array('id'=>$goods_id))->find();
			$this->display('goodsUpdate');
		}

		/**
		 * 商品修改处理函数
		 */
		public function goodsUpdatePro(){
			$store = session('store');
			$headerImg = I('post.headerImg');
			if ($headerImg) {
				$data['headerImg'] = $headerImg;
			}
			$data['id']                = I('post.id');
			$data['name']              = I('post.name');
			$data['description']       = I('post.description');
			$data['retailPrice']       = I('post.retailPrice');
			$data['remainingQuantity'] = I('post.remainingQuantity');
			$data['type_id']           = I('post.type_id');
			$data['store_id']          = $store['id'];
			$data['status']            = 1;
			$data['time']              = time();

			$is_add = M('Goods')->save($data);
			if (!$is_add) {
				$ret['status'] = false;
				$ret['info'] = '商品修改失败，请联系管理员';
				goto end;
			}
			$ret['status'] = true;
			$ret['info'] = '商品修改成功';
			//清除图片session
			session('headerImg',NULL);
			end:
			$this->ajaxReturn($ret);
		}

		/**
		 * 分类展示页面
		 */
		public function categoryAddDis(){
			$store = session('store');
			$this->cat = M('Type')->where(array('store_id'=>$store['id']))->select();
			$this->display('categoryAdd');
		}

		/**
		 * 添加分类处理方法
		 */
		public function categoryAddPro(){
			$type = I('post.cat');
			//获取商家
			$store = session('store');
			$data['name']     = $type;
			$data['store_id'] = $store['id'];
			$data['time']     = time();
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

		/**
		 * 删除分类处理方法
		 */
		public function categoryDelPro(){
			$cat_id = I('post.cat_id');
			$store = session('store');
			$data['id'] = $cat_id;
			$data['store_id'] = $store['id'];
			$is_del = M('Type')->where($data)->delete();
			if (!$is_del) {
				$ret['status'] = false;
				$ret['info'] = '删除分类错误';
				goto end;
			}

			$ret['status'] = true;
			$ret['info'] = '删除分类成功';

			end:
			$this->ajaxReturn($ret);
		}

	}

 ?>