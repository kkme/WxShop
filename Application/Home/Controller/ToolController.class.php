<?php 
	namespace Home\Controller;
	use Think\Controller;
	class ToolController extends Controller{
		public function sessionSet(){
			$key = I('post.key');
			$value = I('post.value');
			if ($value == 'NULL') {
				session($key,NULL);
			}else{
				session($key,$value);
			}
			$this->ajaxReturn(session($key));
		}
		public function sessionGet(){
			$key = I('post.key');
			$this->ajaxReturn(session($key));
		}
	}


 ?>