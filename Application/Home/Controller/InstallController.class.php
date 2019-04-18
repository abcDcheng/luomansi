<?php
namespace Home\Controller;
use Think\Controller;
class InstallController extends Controller {

    public function index(){
        if (isset($_SESSION['service_id'])) {
        	//$service_id = intval($_SESSION['service_id']);
            $jssdk = A('jssdk');
            $signPackage = $jssdk->GetSignPackage();
            //var_dump($signPackage);
            $ad = A('Login');
            $ad = $ad->getAD();
            $this->assign('ad',$ad);
        	$this->assign('jssdk',$signPackage);
            
            $this->display();
        } else {
            redirect(U("Login/installLogin"));
        }
    }
    //记录新用户数据
    public function record(){
    	if (isset($_SESSION['service_id']) && IS_AJAX) {
            $goodsCode = trim(I('goodsCode'));
            $goodsCode1 = str_replace(' ','',I('goodsCode'));
            $goodsCode1 = str_replace('%','',$goodsCode1);
            if (strlen($goodsCode1)<10) {
                $this->error('产品码长度必须大于10');
            }
            $count = M('code')->where(array('goodsCode'=>array('like','%'.$goodsCode1.'%')))->find();
            if (count($count) < 1) {
                $this->error('查找不到该识别码，请确认识别码无误或将识别码发至出厂商确认');
                exit();
            } else {
                if ($count['install']) {
                    $this->error('该产品已安装');
                }
                $codeId = $count['id'];
            }
    		$service_id = intval($_SESSION['service_id']);
    		if ($service_id) {
                //查询安装人员信息
                $Model_data = M('ServiceAdmin');
                $info = $Model_data->where('id='.$service_id)->find();
                if (empty($info)) {
                    $this->error('查无安装人员信息，请重新登录重试');
                }
                $base_img = str_replace('data:image/jpeg;base64,', '', $_POST['imgUrl1']);
                //$base_img = $_POST['imgUrl'];
                $path = "./Application/Upload/";
                $dir1 = "install/photo";
                $prefix='lms_';
                $output_file1 = $prefix.time().rand(100,999).'.jpg';
                $img = $path.$dir1."/".$output_file1;
                if(!file_put_contents($img, base64_decode($base_img))){
                    $this->error('图片保存失败');
                    exit();
                }
                $base_img = str_replace('data:image/jpeg;base64,', '', $_POST['imgUrl2']);
                //$base_img = $_POST['imgUrl'];
                $path = "./Application/Upload/";
                $dir2 = "install/code";
                $prefix='lms_';
                $output_file2 = $prefix.time().rand(100,999).'.jpg';
                $img = $path.$dir2."/".$output_file2;
                if(!file_put_contents($img, base64_decode($base_img))){
                    $this->error('图片保存失败');
                    exit();
                }
			    $name = I('name');
                $phone = I('phone');
                //$imgUrl = I('imgUrl');
                $area = I('area');
                $address = I('address');
                //获取手机IP和地理位置
                $ipClass = A('Getloc');
                $ip = $ipClass->getIP();
                $loc = '';
                if ($ip != '未知') {
                    if (strstr($ip,",")) {
                        $ip = explode(",", $ip);
                        $ip = $ip[0];
                    }
                    $addr = $ipClass->GetIpLookup($ip);
                    if ($addr) {
                        $province = $addr['province'];
                        $city = $addr['city'];
                    }
                    if ($province || $city) {
                        $loc = $province.$city.'（'.$ip.'）';
                    } else {
                        $loc = '未知位置（'.$ip.'）';
                    }
                } else {
                    $loc = '未知IP';
                }
                $data = array('serviceId' => $service_id,
                              'name'      => $name,
                              'phone'     => $phone,
                              'area'      => $area,
                              'address'   => $address,
                              'goodsCode' => $goodsCode,
                              'installphoto'  => $dir1."/".$output_file1,
                              'installimg'  => $dir2."/".$output_file2,
                              'salemanId' => $info['salemanid'],
                              'saleman'   => $info['saleman'],
                              'salemanPhone'=>$info['salemanphone'],
                              'serName'   => $info['name'],
                              'serPhone'  => $info['username'],
                              'enTime'    => date('Y-m-d H:i:s'),
                              'loc'       => $loc
                              );
                $res = M('install')->add($data);
                if ($res) {
                    $r = M('code')->where('id='.$codeId)->save(array('install'=>1));
                    $this->success('产品安装完成，进入保修状态！');
                } else {
                    $this->error('信息提交失败');
                }
    		} else {
    			$this->error('安装人员信息有误，请重新登录');
    		}
    		
    	}
    }
}