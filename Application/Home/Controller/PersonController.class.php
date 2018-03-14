<?php
namespace Home\Controller;
use Think\Controller;
class PersonController extends Controller {
    //个人中心页
    public function index(){
        if (isset($_SESSION['admin_id'])) {
        	$admin_id = $_SESSION['admin_id'];
            $Model_Data = M('SysAdmin');
            $info = $Model_Data->field('username,name,phone,province,city,address')->where(array('id'=>$admin_id))->find();
            if (!empty($info)) {
            	//var_dump($info);
                $ad = A('Login');
            $ad = $ad->getAD();
            $this->assign('ad',$ad);
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
    //修改密码
    public function changePwd(){
    	if (isset($_SESSION['admin_id'])) {
        	$admin_id = $_SESSION['admin_id'];
        	$newpwd = I('newpwd');
        	$oldpwd = I('oldpwd');
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

    public function getYZM(){
        if (isset($_POST['telCode']) && isset($_SESSION['admin_id'])) {
            $admin_id = intval($_SESSION['admin_id']);
            $info = M('SysAdmin')->where('id='.$admin_id)->find();
            if (!empty($info) || !$info['phone']) {
                $tel = $info['phone'];
                $code = rand(100000,999999);
                $data = json_decode(file_get_contents("http://shenzhen.luomansizs.com/api/aliyunsms/api_demo/pwd_yzm.php?tel=$tel&code=$code"),true);
                if ($data['code'] == 'OK') {
                    session('telcode',$code);
                    session('tel',$tel);
                    $telStr = substr_replace($tel, '****', 3, 4);
                    $arr = array('tel'=>$telStr,'code'=>1);
                    $this->ajaxReturn($arr);
                } else {
                    file_put_contents("./Application/Error/telcode.txt", 
                        "时间：".date('Y-m-s H:i:s')."\n".
                        "手机号：".$tel."\n".
                        "返回结果：".$data['code']."   ".$data['msg']."\n\n",
                        FILE_APPEND);
                    if ($data['code'] == 'isv.BUSINESS_LIMIT_CONTROL') {
                        $this->error('获取验证码次数过多，请稍后再试');
                    } else {
                        $this->error('获取验证码失败，请重试或联系管理员解决');
                    }
                    
                }
            } else {
                $this->error('未能获取您的手机号，请重新登录或联系管理员解决');
            }
        } else {
            $this->error('未知的操作');
        }
    }
}