<?php
namespace Home\Controller;
use Think\Controller;
class MaintainController extends Controller {
    public function index(){
        if (isset($_SESSION['service_id'])) {
        	$admin_id = intval($_SESSION['service_id']);
        	$this->display();
        } else {
            redirect(U("Login/maintainLogin"));
        }
    }
}