<?php
namespace Home\Controller;
use Think\Controller;
class InstallController extends Controller {
    public function index(){
        if (isset($_SESSION['service_id'])) {
        	//$service_id = intval($_SESSION['service_id']);
        	$this->display();
        } else {
            redirect(U("Login/installLogin"));
        }
    }

    public function record(){
    	if (isset($_SESSION['service_id']) && IS_AJAX) {
    		$service_id = intval($_SESSION['service_id']);
    		if ($service_id) {
    			$name = I('name');
	    		$phone = I('phone');
	    		$area = I('area');
	    		$address = I('address');
	    		$data = array('serviceId' => $service_id,
	    					  'name'      => $name,
                              'phone'     => $phone,
	    					  'area'	  => $area,
	    					  'address'	  => $address,
	    					  'enTime'	  => date('Y-m-d H:i:s')
	    					  );
	    		$res = M('install')->add($data);
	    		if ($res) {
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