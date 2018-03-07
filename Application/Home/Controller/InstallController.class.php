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
            $goodsCode = I('goodsCode');
            $count = M('code')->where(array('goodsCode'=>$goodsCode))->count();
            if ($count < 1) {
                $this->error('查找不到该产品码，请确认产品码无误或将产品码发至出厂商确认');
                exit();
            }
    		$service_id = intval($_SESSION['service_id']);
    		if ($service_id) {
                //查询安装人员信息
                $Model_data = M('ServiceAdmin');
                $info = $Model_data->where('id='.$service_id)->find();
                if (empty($info)) {
                    $this->error('查无安装人员信息，请重新登录重试');
                }
                $base_img = str_replace('data:image/jpeg;base64,', '', $_POST['imgUrl']);
                //$base_img = $_POST['imgUrl'];
                $path = "./Application/Upload/";
                $dir = "install";
                $prefix='lms_';
                $output_file = $prefix.time().rand(100,999).'.jpg';
                $img = $path.$dir."/".$output_file;
                if(file_put_contents($img, base64_decode($base_img))){
                    $name = I('name');
                    $phone = I('phone');
                    //$imgUrl = I('imgUrl');
                    $area = I('area');
                    $address = I('address');
                    $data = array('serviceId' => $service_id,
                                  'name'      => $name,
                                  'phone'     => $phone,
                                  'area'      => $area,
                                  'address'   => $address,
                                  'goodsCode' => $goodsCode,
                                  'installimg'  => $dir."/".$output_file,
                                  'salemanId' => $info['salemanid'],
                                  'saleman'   => $info['saleman'],
                                  'salemanPhone'=>$info['salemanphone'],
                                  'serName'   => $info['name'],
                                  'serPhone'  => $info['phone'],
                                  'enTime'    => date('Y-m-d H:i:s')
                                  );
                    $res = M('install')->add($data);
                    if ($res) {
                        $this->success('产品安装完成，进入保修状态！');
                    } else {
                        $this->error('信息提交失败');
                    }
                } else {
                    $this->error('图片保存失败');
                }
    			
    		} else {
    			$this->error('安装人员信息有误，请重新登录');
    		}
    		
    	}
    }
}