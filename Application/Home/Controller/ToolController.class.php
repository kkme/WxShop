<?php 
	namespace Home\Controller;
	use Think\Controller;
	class ToolController extends Controller{
		public function sessionSet(){
			$key = I('post.key');
			$value = I('post.value');
			session($key,$value);
			$this->ajaxReturn(session($key));
			// $this->ajaxReturn('sessionSet');
		}
		public function sessionGet(){
			$key = I('post.key');
			$this->ajaxReturn(session($key));
			// $this->ajaxReturn('sessionGet'.$key);
		}
	}


 ?>