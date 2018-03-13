<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function index(){
    	if (IS_AJAX) {
    		$Model_Data = M('SysAdmin');
            $username = trim(I('username'));
            $password = trim(I('password'));
            $cookie = intval(I('cookie'));
            $user = $Model_Data->where(array('username'=>$username))->find();
            empty($user) && $this->error('账号密码错误，请重新输入!');
            $user['password'] !== md5($password) && $this->error('账号密码错误，请重新输入!');
            $user['is_status'] == 0  && $this->error('此账号已被禁用，请联系超级管理员!');
            //$log = array('username' => $user['username'], 'source' => get_client_ip(), 'add_time' => date("Y-m-d H:i:s"));
            //M('SysAdminlog')->add($log);
            $Model_Data->where(array('id'=>$user['id']))->setInc('login_num');
            session('admin_id', $user['id']);
            session('group',$user['group']);
            session('username',$user['username']);
            if ($cookie) {
                cookie('username',$username,3600 * 24 * 100);
            } else {
                cookie('username',null);
            }
            $this->success('登录成功', U('Index/index'),'login');
    	} else {
            $username = cookie('username');
            if ($username) {
                $cookie = 1;
            } else {
                $cookie = 0;
            }
            $ad = M('ad')->where('id=1')->find();
            $ad = str_replace("<br/>", "\r\n", $ad);
            $this->assign('ad',$ad);
            $this->assign('username',$username);
            $this->assign('cookie',$cookie);
    		$this->display();
    	}
        
    }
}