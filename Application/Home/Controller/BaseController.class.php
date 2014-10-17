<?php 
	namespace Home\Controller;
	use Think\Controller;
	class BaseController extends Controller{
		function _initialize(){
			//判断登陆
			$store = session('store');
			if (empty($store['id'])) {
				$this->error('请登陆后再操作',U('Home/Regist/welcome'));
			}
		}
	}

 ?>