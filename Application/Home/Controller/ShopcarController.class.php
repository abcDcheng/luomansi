<?php
namespace Home\Controller;
use Think\Controller;
class ShopcarController extends Controller {
    public function index(){
    	if (isset($_SESSION['admin_id'])) {
    		$admin_id = intval($_SESSION['admin_id']);
	    	$Model_data = M('goods');
	    	$goods = $Model_data->order('id asc')->getField('id,goodsImg,goodsName');
	 		$Model_data = M('shopcar');
	 		$shopcar = $Model_data->where(array('salemanId'=>$admin_id,'orderId'=>0))->order('id asc')->getField('id,goodsId,goodsModel,goodsNum,enTime');
	 		if (empty($shopcar)) {
	 			foreach ($shopcar as $key => $value) {
	 				$shopcar[$key]['goodsImg'] = __UPLOAD__.$goods[$shopcar[$key]['goodsId']];
	 			}
	 		}
	 		$this->assign('shopcar',$shopcar);
	    	//var_dump($goods);
	        $this->display();
	    } else {
            redirect(U("Login/login"));
        }
    }

    public function goodsDel(){
    	if (isset($_SESSION['admin_id']) && isset($_GET['i'])) {
    		$id = intval(I('i'));
    		if ($id) {
    			$Model_data = M('shopcar');
    			$res = $Model_data->delete($id);
    			if ($res) {
    				redirect(U("Shopcar/index"));
    			} elseif ($res === 0) {
    				$this->error('查无该数据',U("Shopcar/index"));
    			} else {
    				$this->error('删除失败',U("Shopcar/index"));
    			}
    		} else {
    			$this->error('未知的参数',U("Shopcar/index"));
    		}
    		
    	}
    }

    public function orderRecord(){
    	if (isset($_SESSION['admin_id']) && IS_AJAX) {
    		$admin_id = intval($_SESSION['admin_id']);
    		$bak = I('bak');
    		$orderCode = $this->getCode();
    		$Model_data = M();
    		$saleman = $Model_data->query("select name,phone,address from saleman_sys_admin where id=$admin_id limit 1");
    		if (!empty($saleman)) {
    			$id = $Model_data->table('saleman_order')->
    				  data(array('salemanId' => $admin_id,
    				  			 'saleman'   => $saleman[0]['name'],
    				  			 'phone'     => $saleman[0]['phone'],
    				  			 'address'   => $saleman[0]['address'],
    				  			 'orderCode' => $orderCode,
    				  			 'orderBak'	 => $bak,
    				  			 'enTime'    => date('Y-m-d H:i:s')
    				  ))->add();
    			if ($id) {
    				$res = $Model_data->table('saleman_shopcar')->where(array('salemanId'=>$admin_id,'orderId'=>0))->setField('orderId',$id);
    				if ($res) {
    					$this->success('下单成功，请等待客服受理');
    				} else {
    					$this->error('下单失败，请检查购物车是否有商品');
    				}
    			} else {
    				$this->error('下单失败，请重试');
    			}
    		} else {
    			$this->error('查不到用户信息，请重新登录');
    		}

    		
    	}
    }

    public function getCode(){
    	$code = 'LMS000';
    	$code .= date("YmdHis");
    	$code .= rand(1000,9999);
    	return $code;
    }
}