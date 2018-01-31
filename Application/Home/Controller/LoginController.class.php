<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function login(){
        if (IS_AJAX) {
    		$Model_Data = M('SysAdmin');
            $username = trim(I('username'));
            $password = trim(I('password'));
            $user = $Model_Data->where(array('username'=>$username,'group'=>2))->find();
            empty($user) && $this->error('账号密码错误，请重新输入!');
            $user['password'] !== md5($password) && $this->error('账号密码错误，请重新输入!');
            $user['is_status'] == 0  && $this->error('此账号已被禁用，请联系超级管理员!');
            //$log = array('username' => $user['username'], 'source' => get_client_ip(), 'add_time' => date("Y-m-d H:i:s"));
            //M('SysAdminlog')->add($log);
            $Model_Data->where(array('id'=>$user['id']))->setInc('login_num');
            session('admin_id', $user['id']);
            session('group', $user['group']);
            $this->success('登录成功，正在进入系统...', '','login');
    	} else {
    		$this->display();
    	}
    }

    public function installLogin() {
        $this->display();
    }

    public function maintainLogin() {
        $this->display();
    }

    public function serviceAdmin() {
        if (IS_AJAX) {
            $Model_Data = M('ServiceAdmin');
            $username = trim(I('username'));
            $password = trim(I('password'));
            $user = $Model_Data->where(array('username'=>$username,'group'=>2))->find();
            empty($user) && $this->error('账号密码错误，请重新输入!');
            $user['password'] !== md5($password) && $this->error('账号密码错误，请重新输入!');
            $user['is_status'] == 0  && $this->error('此账号已被禁用，请联系超级管理员!');
            //$log = array('username' => $user['username'], 'source' => get_client_ip(), 'add_time' => date("Y-m-d H:i:s"));
            //M('SysAdminlog')->add($log);
            $Model_Data->where(array('id'=>$user['id']))->setInc('login_num');
            session('admin_id', $user['id']);
            $this->success('登录成功，正在进入系统...', '','login');
        } else {
            $this->display();
        }
    }
}