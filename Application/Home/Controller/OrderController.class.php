<?php
namespace Home\Controller;
use Think\Controller;
class OrderController extends Controller {
    public function index(){
        if (isset($_SESSION['admin_id'])) {
        	$admin_id = $_SESSION['admin_id'];
        	$Model_data = M();
        }
    }
}