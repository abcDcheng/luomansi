<?php
namespace Home\Controller;
use Think\Controller;
class InstallController extends Controller {
    public function index(){
        if (isset($_SESSION['admin_id'])) {
        	$admin_id = intval($_SESSION['admin_id']);
        	
        } else {
            redirect(U("Login/installLogin"));
        }
    }

    public function record(){
    	if (isset($_SESSION['admin_id']) && IS_AJAX) {
    		$admin_id = intval($_SESSION['admin_id']);
    		if ($admin_id) {
    			$name = I('name');
	    		$phone = I('phone');
	    		$procince = I('province');
	    		$city = I('city');
	    		$address = I('address');
	    		$data = array('serviceId' => $admin_id,
	    					  'name'      => $name,
	    					  'phone'	  => $phone,
	    					  'province'  => $province,
	    					  'city'	  => $city,
	    					  'address'	  => $address,
	    					  'enTime'	  => date('Y-m-d H:i:s')
	    					  );
	    		$res = M('install')->add($data);
	    		if ($res) {
	    			$this->success('登记成功');
	    		} else {
	    			$this->error('登记失败');
	    		}
    		} else {
    			$this->error('安装人员信息有误，请重新登录');
    		}
    		
    	}
    }
}