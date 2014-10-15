<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->display();
    }
    public function admin(){
    	$name=I('post.name');
    	$password=I('post.password');

    	$pass=M('Admin')->where($name)->find();
    	var_dump($pass);
    	exit;
    	if ($pass==$password) {
    		$this->redirect('Index/index');
    		exit;
    	}else{
    		$this->redirect('Index/admin');
    	}
        $this->display();
    }
    public function user(){
        $this->display();
    }
}