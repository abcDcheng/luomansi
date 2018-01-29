<?php
namespace Home\Controller;
use Think\Controller;
class MaintainController extends Controller {
    public function index(){
        if (isset($_SESSION['admin_id'])) {
        	$admin_id = intval($_SESSION['admin_id']);
        	
        } else {
            redirect(U("Login/maintainLogin"));
        }
    }
}