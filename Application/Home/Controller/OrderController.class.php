<?php
namespace Home\Controller;
use Think\Controller;
class OrderController extends Controller {
    public function index(){
        if (isset($_SESSION['admin_id'])) {
        	$admin_id = $_SESSION['admin_id'];
        	$hasInfo = 1;
        	$Model_data = M();
        	$shop = array();
        	$status = array(0=>0,1=>0,2=>0);
        	$order = $Model_data->table('saleman_order')->where('salemanId='.$admin_id)->order('enTime desc')->getField('id,salemanId,saleman,orderCode,phone,address,orderBak,enTime,status,msg,statusTime');
        	$ids = array();
        	foreach ($order as $key => $value) {
        		$ids[] = $key;
        		$order[$key]['shopNum'] = 0;
        		$order[$key]['detail'] = array();
        		$status[$value['status']]++;
        	}
        	// var_dump($status);
        	// exit();
        	if (!empty($ids)) {
        		$idStr = implode(',', $ids);
        		$shop = $Model_data->table('saleman_shopcar')->where("orderId in ($idStr) and salemanId=$admin_id")->select();
        	} else {
        		$hasInfo = 0;
        	}
        	for ($j = 0;$j < count($shop);$j++) {
        		$order[$shop[$j]['orderid']]['shopNum']++;
        		$order[$shop[$j]['orderid']]['detail'][] = $shop[$j];
        		//var_dump($order[$shop[$j]['orderid']]['detail']);
        	}
        	//var_dump($order);
        	$this->assign('orderStatus',$status);
        	$this->assign('hasInfo',$hasInfo);
        	$this->assign('order',$order);
        	//$this->assign('shop',$shop);
        	$this->display();
        }
    }
}