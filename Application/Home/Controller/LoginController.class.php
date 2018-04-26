<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
    //代理商登录
    public function login(){
        if (IS_AJAX) {
    		$Model_Data = M('SysAdmin');
            $username = trim(I('username'));
            $password = trim(I('password'));
            $cookie = intval(I('cookie'));
            $user = $Model_Data->where(array('username'=>$username,'group'=>1))->find();
            //empty($user) && $this->error('账号密码错误，请重新输入!');
            if (empty($user)) {
                $user = $Model_Data->where(array('phone'=>$username))->find();
                empty($user) && $this->error('账号密码错误，请重新输入!');
            }
            $user['password'] !== md5($password) && $this->error('账号密码错误，请重新输入!');
            $user['is_status'] == 0  && $this->error('此账号已被禁用，请联系超级管理员!');
            //$log = array('username' => $user['username'], 'source' => get_client_ip(), 'add_time' => date("Y-m-d H:i:s"));
            //M('SysAdminlog')->add($log);
            $Model_Data->where(array('id'=>$user['id']))->setInc('login_num');
            session('admin_id', $user['id']);
            session('group', $user['group']);
            if ($cookie) {
                cookie('username',$username,array('expire'=>3600 * 24 * 100));
            } else {
                cookie('username',null);
            }
            $this->success('登录成功，正在进入系统...', '','login');
    	} else {
            $username = cookie('username');
            if ($username) {
                $cookie = 1;
            } else {
                $cookie = 0;
            }
            $ad = $this->getAD();
            $this->assign('username',$username);
            $this->assign('cookie',$cookie);
            $this->assign('ad',$ad);
    		$this->display();
    	}
    }

    //中间过渡页，以防使用者不小心按返回键回到登录页得重新登录
    public function indexredirect() {
        //redirect(U("Shop/index"));
        $this->display();
    }

    //安装管理登录页
    public function installLogin() {
        // if (isset($_SESSION['service_id'])) {
        //     redirect(U("Install/index"));
        // } else {
            $username = cookie('username1');
            if ($username) {
                $cookie = 1;
            } else {
                $cookie = 0;
            }
            $ad = $this->getAD();
            $this->assign('username',$username);
            $this->assign('cookie',$cookie);
            $this->assign('ad',$ad);
            $this->display();
        //}
        
    }
    //维护管理登录页
    public function maintainLogin() {
        $username = cookie('username2');
        if ($username) {
            $cookie = 1;
        } else {
            $cookie = 0;
        }
        $ad = $this->getAD();
        $this->assign('ad',$ad);
        $this->assign('username',$username);
        $this->assign('cookie',$cookie);
        $this->display();
        // if (isset($_SESSION['service_id'])) {
        //     redirect(U("Maintain/index"));
        // } else {
            
        // }
    }
    //安装维护管理登录
    public function serviceAdmin1() {
        if (IS_AJAX) {
            $Model_Data = M('ServiceAdmin');
            $username = trim(I('username'));
            $password = trim(I('password'));
            $cookie = intval(I('cookie'));
            $user = $Model_Data->where(array('username'=>$username,'group'=>2))->find();
            //empty($user) && $this->error('账号密码错误，请重新输入!');
            if (empty($user)) {
                $user = $Model_Data->where(array('phone'=>$username))->find();
                empty($user) && $this->error('账号密码错误，请重新输入!');
            }
            $user['password'] !== md5($password) && $this->error('账号密码错误，请重新输入!');
            $user['status'] == 0  && $this->error('此账号已被禁用，请联系超级管理员!');
            //$log = array('username' => $user['username'], 'source' => get_client_ip(), 'add_time' => date("Y-m-d H:i:s"));
            //M('SysAdminlog')->add($log);
            $Model_Data->where(array('id'=>$user['id']))->setInc('login_num');
            session('service_id', $user['id']);
            if ($cookie) {
                cookie('username1',$username,array('expire'=>3600 * 24 * 100,'path'=>$_SERVER['HTTP_REFERER']));
            } else {
                cookie('username1',null);
            }
            $this->success('登录成功，正在进入系统...', '','login');
        } else {
            $this->display();
        }
    }
    //中间过渡页，以防使用者不小心按返回键回到登录页得重新登录
    public function installredirect() {
        //redirect(U("Shop/index"));
        $this->display();
    }

    //安装维护管理登录
    public function serviceAdmin2() {
        if (IS_AJAX) {
            $Model_Data = M('ServiceAdmin');
            $username = trim(I('username'));
            $password = trim(I('password'));
            $cookie = intval(I('cookie'));
            $user = $Model_Data->where(array('username'=>$username,'group'=>2))->find();
            //empty($user) && $this->error('账号密码错误，请重新输入!');
            if (empty($user)) {
                $user = $Model_Data->where(array('phone'=>$username))->find();
                empty($user) && $this->error('账号密码错误，请重新输入!');
            }
            $user['password'] !== md5($password) && $this->error('账号密码错误，请重新输入!');
            $user['status'] == 0  && $this->error('此账号已被禁用，请联系超级管理员!');
            //$log = array('username' => $user['username'], 'source' => get_client_ip(), 'add_time' => date("Y-m-d H:i:s"));
            //M('SysAdminlog')->add($log);
            $Model_Data->where(array('id'=>$user['id']))->setInc('login_num');
            session('service_id', $user['id']);
            if ($cookie) {
                cookie('username2',$username,array('expire'=>3600 * 24 * 100));
            } else {
                cookie('username2',null);
            }
            $this->success('登录成功，正在进入系统...', '','login');
        } else {
            $this->display();
        }
    }

//中间过渡页，以防使用者不小心按返回键回到登录页得重新登录
    public function maintainredirect() {
        //redirect(U("Shop/index"));
        $this->display();
    }

    //获取广告语
    public function getAD(){
        $con = M('ad')->where('id=1')->getField('ad');
        return $con;
    }

}