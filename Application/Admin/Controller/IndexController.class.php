<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    //系统首页
    public function index(){
    	if (isset($_SESSION['admin_id'])) {
            $username = isset($_SESSION['username'])?$_SESSION['username']:'';
            $this->assign('username',$username);
            $this->display();
        } else {
            $this->error("未登录",U("Login/index"),1);
        }
    }
    //修改密码
    public function pwd(){
        if (isset($_SESSION['admin_id'])) {
            if (IS_AJAX) {
                $id = intval($_SESSION['admin_id']);
                $oldpwd = I('oldpwd');
                $pwd = I('pwd');
                $yzm = I('yzm');
                $code = isset($_SESSION['telcode'])?$_SESSION['telcode']:'';
                if (!$code) {
                    $this->error('请先获取手机验证码');
                    exit();
                }
                if ($code != $yzm) {
                    $this->error('手机验证码错误');
                    exit();
                }
                if ($oldpwd != $pwd) {
                    $Model_data = M('SysAdmin');
                    $info = $Model_data->where('id='.$id)->getField('password');
                    if (md5($oldpwd) == $info) {    //判断原密码是否正确
                        $res = $Model_data->where('id='.$id)->data(array('password'=>md5($pwd)))->save();
                        if ($res) {
                            session_destroy();
                            $this->success('修改成功，请重新登录',U("Login/index"));
                        } else {
                            $this->error("修改失败");
                        }
                    } else {
                        $this->error("原密码不正确");
                    }
                } else {
                    $this->error("新旧密码不能一致");
                }
            } else {
                $admin_id = intval($_SESSION['admin_id']);
                $info = M('SysAdmin')->where('id='.$admin_id)->find();
                if (!empty($info)) {
                    $phone = substr_replace($info['phone'], '****', 3, 4);
                    $this->assign('phone',$phone);
                    $this->display();
                } else {
                    $this->error("未能查询到您的信息，请重新登录",U("Login/index"),1);
                }
                
            }
        } else {
            $this->error("未登录",U("Login/index"),1);
        }
    }
    //退出登录
    public function loginout(){
    	//session('admin_id', null);
    	session_destroy();
        redirect(U("Login/index"));
    }
    //（前端定时）获取新订单和新用户数据
    public function getNew(){
        if (isset($_SESSION['admin_id'])) {
            if (isset($_POST['getOrder'])) {
                $getOrder = intval($_POST['getOrder']);
            } else {
                $getOrder = 0;
            }
            if (isset($_POST['getInstall'])) {
                $getInstall = intval($_POST['getInstall']);
            } else {
                $getInstall = 0;
            }
            //$Model_data = M();
            if ($getOrder) {
                $orderNum = M('order')->where('isNew=0')->count();
            }
            if ($getInstall) {
                $installNum = M('install')->where('isNew=0')->count();
            }
            $res = array('code'=>1,'orderNum'=>$orderNum,'installNum'=>$installNum);
            $this->ajaxReturn($res);
        } else {
            $this->error('无权限');
        }
    }
}