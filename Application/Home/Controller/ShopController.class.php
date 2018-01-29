<?php
namespace Home\Controller;
use Think\Controller;
class ShopController extends Controller {
    public function index(){
        if (isset($_SESSION['admin_id'])) {
            $admin_id = intval($_SESSION['admin_id']);
            $Model_Data = M('GoodsPermission');
            $goods = array();
            $goodsInfoId = $Model_Data->field('goodsInfoId')->where(array('salemanId'=>$admin_id))-> find();
            if (!empty($goodsInfoId)) {
                //var_dump($goodsInfoId);
                session('goodsInfoId',$goodsInfoId['goodsinfoid']);
                $Model_Data = M();
                $goods = $Model_Data->query("SELECT id,goodsName,hand,falseLock 
                            FROM saleman_goods
                            WHERE id
                            IN (
                            SELECT DISTINCT goodsId
                            FROM saleman_goods_info
                            WHERE id
                            IN (".$goodsInfoId['goodsinfoid'].")
                            ) order by id asc");
            }
            //$goods = $Model_Data->order('id asc')->getField('id,goodsName');
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
            if (isset($_SESSION['goodsInfoId'])) {
                $goodsInfoId = $_SESSION['goodsInfoId'];
            } else {
                $admin_id = intval($_SESSION['admin_id']);
                $Model_Data = M('GoodsPermission');
                $infoId = $Model_Data->field('goodsInfoId')->where(array('salemanId'=>$admin_id))-> find();
                //var_dump($infoId);
                if (!empty($infoId)) {
                    $goodsInfoId = $infoId['goodsinfoid'];
                } else {
                    $goodsInfoId = '0';
                }
            }
            $Model_Data = M();
            $goodsInfo = $Model_Data->query("select id,goodsColor,colorCode,hand,falseLock from saleman_goods_info where goodsId=$goodsId and id in ($goodsInfoId)");
            if (!empty($goodsInfo)) {
                $res = array('info'=>$goodsInfo,'code'=>1,'msg'=>'');
                //var_dump($res);
                $this->ajaxreturn($res);
            } else {
                $this->error('暂无该商品款式');
            }
            //$goodsInfo = $Model_Data->field('id,goodsColor,colorCode,hand,falseLock')->where(array('goodsId'=>$goodsId))->order('id asc')->select();
            //var_dump($goodsInfo);
        } else {
            $this->error("未能识别的访问，请重试");
        }
    }

    public function goodsRecord(){
        if (isset($_SESSION['admin_id']) && IS_AJAX) {
            $admin_id = intval($_SESSION['admin_id']);
            $goodsId = intval(I('goodsId'));
            $goodsColor = I('goodsColor');
            $hasHand = intval(I('hasHand'));
            $hand = intval(I('hand'));
            $hasLock = intval(I('hasLock'));
            $falseLock = intval(I('falseLock'));
            $goodsNum = intval(I('goodsNum'));
            $goodsModel = $goodsColor;
            if ($hasHand) {
                if ($hand) {
                    $goodsModel .= '带下拉手'; 
                } else {
                    $goodsModel .= '不带下拉手'; 
                }
            }
            if ($hasLock && $falseLock) {
                $goodsModel .= '假锁';
            }
            if ($goodsNum <=0) {
                $this->error("商品数量必须大于0且为整数");
                exit();
            }
            $info = array('salemanId'=>$admin_id,'goodsId'=>$goodsId,'goodsModel'=>$goodsModel,'enTime'=>date('Y-m-d H:i:s'));
            $Model_Data = M('shopcar');
            $res = $Model_Data->add($info);
            if ($res) {
                $this->success('已添加进购物车');
            } else {
                $this->error("添加失败");
            }
        } else {
            $this->error("未能识别的访问，请重试");
        }
    }
}