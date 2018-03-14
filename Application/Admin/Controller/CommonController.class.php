<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller {
    public function index(){
        
    }

    public function getYZM(){
    	if (isset($_POST['telCode']) && isset($_SESSION['admin_id'])) {
            $admin_id = intval($_SESSION['admin_id']);
            $info = M('SysAdmin')->where('id='.$admin_id)->find();
            if (!empty($info) || !$info['phone']) {
                $tel = $info['phone'];
                $code = rand(100000,999999);
                if (isset($_POST['model'])) {
                    $model = $_POST['model'];
                } else {
                    $model = 'pwd_yzm';
                }
                $data = json_decode(file_get_contents("http://shenzhen.luomansizs.com/api/aliyunsms/api_demo/$model.php?tel=$tel&code=$code"),true);
                if ($data['code'] == 'OK') {
                    session('telcode',$code);
                    session('tel',$tel);
                    $telStr = substr_replace($tel, '****', 3, 4);
                    $arr = array('tel'=>$telStr,'code'=>1);
                    $this->ajaxReturn($arr);
                } else {
                    file_put_contents("./Application/Error/telcode.txt", 
                        "时间：".date('Y-m-s H:i:s')."\r\n".
                        "手机号：".$tel."\r\n".
                        "返回结果：".$data['code']."   ".$data['msg']."\r\n\r\n",
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

    public function staffYZM(){
    	if (isset($_POST['telCode']) && isset($_SESSION['admin_id'])) {
            $tel = I('tel');
            if ($tel) {
               	//$tel = $info['phone'];
                $code = rand(100000,999999);
                $data = json_decode(file_get_contents("http://shenzhen.luomansizs.com/api/aliyunsms/api_demo/pwd_yzm.php?tel=$tel&code=$code"),true);
                if ($data['code'] == 'OK') {
                    session('telcode1',$code);
                    session('tel1',$tel);
                    //$telStr = substr_replace($tel, '****', 3, 4);
                    $arr = array('tel'=>$tel,'code'=>1);
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
                $this->error('未能获取您的手机号，请重试');
            }
        } else {
        	$this->error('未知的操作');
        }
    }
}