<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	if (isset($_SESSION['admin_id'])) {
    		$this->display();
    	} else {
    		$this->error("未登录","/Login/index",1);
    	}
    }

    public function loginout(){
    	//session('admin_id', null);
    	session_destroy();
        $this->success('退出成功!', '/login.html','login');
    }
}