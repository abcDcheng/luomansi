<?php
namespace Home\Controller;
use Think\Controller;
class PersonController extends Controller {
    public function index(){
        if (isset($_SESSION['admin_id'])) {
        	$admin_id = $_SESSION['admin_id'];
            $Model_Data = M('SysAdmin');
            $info = $Model_Data->field('username,name,phone,address')->where(array('id'=>$admin_id))->find();
            if (!empty($info)) {
            	//var_dump($info);
	            $this->assign('info',$info);
	            $this->display();
            } else {
            	$this->error("未查到登录数据，请重新登录",U("Login/login"),3);
            	exit();
            }
        } else {
            redirect(U("Login/login"));
        }
    }

    public function changePwd(){
    	if (isset($_SESSION['admin_id'])) {
        	$admin_id = $_SESSION['admin_id'];
        	$newpwd = I('newpwd');
        	$oldpwd = I('oldpwd');
            $Model_Data = M('SysAdmin');
            $password = $Model_Data->where(array('id'=>$admin_id))->getField('password');
            if (!empty($password)) {
            	if($password == $oldpwd) {
            		$res = $Model_Data->where(array('id'=>$admin_id))->setField('password',$newpwd);
            		if($res!== false){
            			session_destroy();
            			$this->success('修改成功!','');
            		} else {
            			$this->error('修改失败!','');
            		} 
            	} else {
            		$this->error("旧密码错误,请重新输入",'');
            	}
            } else {
            	$this->error("未查到登录数据，请重新登录",'');
            	exit();
            }
        } else {
            $this->error("未查到登录数据，请重新登录",U("Login/login"),3);
        }
    }
}