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
        $this->display();
    }
    public function user(){
        $this->display();
    }
}