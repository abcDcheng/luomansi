<?php
namespace Home\Controller;
use Think\Controller;
class ShopcarController extends Controller {
    //购物车页，orderid为0的表示未下单产品
    public function index(){
    	if (isset($_SESSION['admin_id'])) {
    		$admin_id = intval($_SESSION['admin_id']);
	    	$Model_data = M('goods');
	    	$goods = $Model_data->order('id asc')->getField('id,goodsImg,goodsName');
	 		$Model_data = M('shopcar');
	 		$shopcar = $Model_data->where(array('salemanId'=>$admin_id,'orderId'=>0))->order('id asc')->getField('id,goodsId,goodsName,goodsImg,goodsModel,goodsNum,enTime');
	 		if (!empty($shopcar)) {
                $hasShop = 1;
	 			// foreach ($shopcar as $key => $value) {
	 			// 	$shopcar[$key]['goodsImg'] = $goods[$shopcar[$key]['goodsid']]['goodsimg'];
     //                $shopcar[$key]['goodsName'] = $goods[$shopcar[$key]['goodsid']]['goodsname'];
	 			// }
	 		} else {
                $hasShop = 0;
            }
            $ad = A('Login');
            $ad = $ad->getAD();
            $this->assign('ad',$ad);
            //var_dump($shopcar);
            $this->assign('hasShop',$hasShop);
	 		$this->assign('shopcar',$shopcar);
	    	//var_dump($goods);
	        $this->display();
	    } else {
            redirect(U("Login/login"));
        }
    }
    //删除购物车产品
    public function goodsDel(){
    	if (isset($_SESSION['admin_id']) && isset($_GET['delId'])) {
    		$id = intval(I('delId'));
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
    //完成下单（创建订单号后将id值赋予购物车产品orderId）
    public function orderRecord(){
    	if (isset($_SESSION['admin_id']) && IS_AJAX) {
    		$admin_id = intval($_SESSION['admin_id']);
    		$bak = I('bak');
    		$orderCode = $this->getCode();
    		$Model_data = M();
            $count = $Model_data->table('saleman_shopcar')->where(array('salemanId'=>$admin_id,'orderId'=>0))->count();
            if ($count > 0) {
                $saleman = $Model_data->query("select name,phone,address from saleman_sys_admin where id=$admin_id limit 1");
                if (!empty($saleman)) {
                    $id = $Model_data->table('saleman_order')->
                          data(array('salemanId' => $admin_id,
                                     'saleman'   => $saleman[0]['name'],
                                     'phone'     => $saleman[0]['phone'],
                                     'address'   => $saleman[0]['address'],
                                     'orderCode' => $orderCode,
                                     'orderBak'  => $bak,
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
            } else {
                $this->error('您的购物车是空的，请先添加产品或前往订单查询确认是否已下单');
            }
    	}
    }
    //生成订单号
    public function getCode(){
    	$code = 'LMS000';
    	$code .= date("YmdHis");
    	$code .= rand(1000,9999);
    	return $code;
    }
}