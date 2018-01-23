<?php
namespace Home\Controller;
use Think\Controller;
class ShopController extends Controller {
    public function index(){
        if (isset($_SESSION['admin_id'])) {
            $Model_Data = M('goods');
            $goods = $Model_Data->order('id asc')->getField('id,goodsName');
            //var_dump($goods);
            $this->assign('goods',$goods);
            $this->display();
        } else {
            redirect(U("Login/login"));
        }
    }

    public function goodsInfo(){
        if (IS_AJAX && isset($_SESSION['admin_id'])) {
            $goodsId = intval(I('goodsId'));
            $Model_Data = M('GoodsInfo');
            $goodsInfo = $Model_Data->field('id,goodsColor,colorCode,hand,falseLock')->where(array('goodsId'=>$goodsId))->order('id asc')->select();
            var_dump($goodsInfo);
        } else {
            $this->error("未能识别的访问，请重试");
        }
    }
}