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
                        "类型：验证码"."\r\n".
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
                        "时间：".date('Y-m-s H:i:s')."\r\n".
                        "类型：验证码"."\r\n".
                        "手机号：".$tel."\r\n".
                        "返回结果：".$data['code']."   ".$data['msg']."\r\n",
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

    public function maintainYZM($tel){
        if (isset($_SESSION['admin_id']) && $tel) {
            $data = json_decode(file_get_contents("http://shenzhen.luomansizs.com/api/aliyunsms/api_demo/maintain_sms.php?tel=$tel"),true);
            if ($data['code'] == 'OK') {
                //$telStr = substr_replace($tel, '****', 3, 4);
                $arr = array('tel'=>$tel,'code'=>1);
                //$this->ajaxReturn($arr);

            } else {
                $arr = array();
                file_put_contents("./Application/Error/telcode.txt", 
                    "时间：".date('Y-m-s H:i:s')."\r\n".
                    "类型：维护通知"."\r\n".
                    "手机号：".$tel."\r\n".
                    "返回结果：".$data['code']."   ".$data['msg']."\r\n\r\n",
                    FILE_APPEND);
                if ($data['code'] == 'isv.BUSINESS_LIMIT_CONTROL') {
                    $arr['msg'] = '发送短信频率超过限制，请另行通知';
                } else {
                    $arr['msg'] = '发送短信失败，请另行通知';
                }
                $arr['code'] = 0;
            }
            return $arr;
        }
    }

    public function downloadFile($file,$filename){
        if (isset($_SESSION['admin_id'])) {
            if ($file) {
                //导入下载类
                //import('Org.Net.Http');
               //Http::download($file,$filename);
                $res = new \Org\Net\Http;
                $res->download($file,$filename);
            } else {
                $this->error('未获取到文件，请重试');
            }
        } else {
            $this->error('未知的操作');
        }
    }

    public function getsaleman(){
        $arr = array(array('title'=>1),array('title'=>2));
        $this->ajaxReturn($arr);
    }
}