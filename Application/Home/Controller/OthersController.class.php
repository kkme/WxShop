<?php 
	/**
	 * 杂项控制器
	 */
	namespace Home\Controller;
	use Think\Controller;
	class OthersController extends Controller{
		/**
		 * 检查更新
		 */
		public function checkUpdate(){
			$now_version = I('post.now_version');
			//获取最新版本
			$lasted_version = M('Version')->order('time desc')->find();
			if (!$lasted_version) {
				$ret['status'] = false;
				$ret['info']   = '获取版本号失败';
			}else{
				$ret['status'] = true;
				$ret['info'] = ($now_version == $lasted_version['code'])? '当前为最新版本':'有新版本，请及时更新';
			}
			$this->ajaxReturn($ret);
		}

		/**
		 * 查看商家是否是供货商
		 */
		public function inSellerMarket(){
			//to-do：需要信息不明
		}
	}


 ?>