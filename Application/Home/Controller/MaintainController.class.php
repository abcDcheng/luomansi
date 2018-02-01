<?php
namespace Home\Controller;
use Think\Controller;
class MaintainController extends Controller {
    public function index(){
        if (isset($_SESSION['service_id'])) {
        	$admin_id = intval($_SESSION['service_id']);
        	$Model_data = M('maintain');
        	$info = $Model_data->where("serviceStatus=0 and serviceId=".$admin_id)->order('id desc')->select();
        	//var_dump($info);
        	$this->assign('info',$info);
        	$this->display();
        } else {
            redirect(U("Login/maintainLogin"));
        }
    }
}