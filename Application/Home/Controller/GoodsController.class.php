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
			$headerImg = session('headerImg');

			$data['name'] = I('post.name');
			$data['description'] = I('post.description');
			$data['retailPrice'] = I('post.retailPrice');
			$data['remainingQuantity'] = I('post.remainingQuantity');
			$data['headerImg'] = $headerImg;
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
			$headerImg = session('headerImg');
			
			$data['id'] = I('post.id');
			$data['name'] = I('post.name');
			$data['description'] = I('post.description');
			$data['retailPrice'] = I('post.retailPrice');
			$data['remainingQuantity'] = I('post.remainingQuantity');
			$data['headerImg'] = $headerImg;
			$data['type_id'] = I('post.type_id');
			$data['store_id'] = $store['id'];
			$data['status'] = 1;
			$data['time'] = time();
			if ($data['type_id'] == -1) {
				$ret['status'] = false;
				$ret['info'] = '请选择分类';
				goto end;
			}
			$is_add = M('Goods')->save($data);
			if (!$is_add) {
				$ret['status'] = false;
				$ret['info'] = '商品修改失败，请联系管理员';
				goto end;
			}
			$ret['status'] = true;
			$ret['info'] = '商品修改成功';
			end:
			$this->ajaxReturn($ret);
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

		//图片上传
		public function imgUpload(){
			$upload = new \Think\Upload();// 实例化上传类
		    $upload->maxSize   =     3145728 ;// 设置附件上传大小
		    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		    $upload->savePath  =     './goodsImg/';// 设置附件上传目录,Uploads目录下
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
		    $this->imgCut("./Uploads/goodsImg/".$info['savename']);
		    //将图片写入session，以便在前台调用
		    sleep(2);
		    session('headerImg',$info['savename']);
		}

		//对图片进行缩略，并强制控制大小
		public function imgCut($imgPath){
			$image = new \Think\Image(); 
			$image->open($imgPath);
			$image->thumb(100, 100,\Think\Image::IMAGE_THUMB_FIXED)->save($imgPath);
		}

		// 对前端头像图片请求进行响应
		public function imgResponse(){
			$this->ajaxReturn(session('headerImg'));
		}
	}

 ?>