<?php
namespace Home\Controller;
use Think\Controller;
class ShopController extends Controller {
    //我要下单页
    public function index(){
        if (isset($_SESSION['admin_id'])) {
            $admin_id = intval($_SESSION['admin_id']);
            $Model_Data = M('GoodsPermission');
            $goods = array();
            //获取代理商可下单产品大类信息
            $goodsInfoId = $Model_Data->field('goodsInfoId')->where(array('salemanId'=>$admin_id))-> find();
            if (!empty($goodsInfoId)) {
                //var_dump($goodsInfoId);
                //根据可下单产品规格id查询出大类产品
                session('goodsInfoId',$goodsInfoId['goodsinfoid']);
                $Model_Data = M();
                $goods = $Model_Data->query("SELECT id,goodsName,goodsImg,hasHand,hasLock 
                            FROM saleman_goods
                            WHERE id
                            IN (
                            SELECT DISTINCT goodsId
                            FROM saleman_goods_info
                            WHERE id
                            IN (".$goodsInfoId['goodsinfoid'].")
                            ) and status = 1 order by id asc");
            }
            //$goods = $Model_Data->order('id asc')->getField('id,goodsName');
            //var_dump($goods);
            $model = array();
            foreach ($goods as $key => $value) {
                $model[$value['id']] = array('hasHand'=>$value['hashand'],'hasLock'=>$value['haslock']);
            }
            //var_dump($model);
            $this->assign('model',$model);
            $this->assign('goods',$goods);
            $ad = A('Login');
            $ad = $ad->getAD();
            $this->assign('ad',$ad);
            $this->display();
        } else {
            redirect(U("Login/login"));
        }
    }
    //获取产品规格
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
            $goodsInfo = $Model_Data->query("select id,goodsColor,colorCode,hand,falseLock from saleman_goods_info where goodsId=$goodsId and id in ($goodsInfoId) and status=1");
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

    //将选取的产品加入购物车
    public function goodsRecord(){
        if (isset($_SESSION['admin_id']) && IS_AJAX) {
            $admin_id = intval($_SESSION['admin_id']);
            $goodsId = intval(I('goodsId'));
            $goodsName = I('goodsName');
            $goodsColor = I('goodsColor');
            $hasHand = intval(I('hasHand'));
            $hand = intval(I('hand'));
            $hasLock = intval(I('hasLock'));
            $falseLock = intval(I('falseLock'));
            $goodsNum = intval(I('goodsNum'));
            $goodsModel = $goodsColor;
            //拼接产品规格信息
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
            $goodsImg = M('goods')->where('id='.$goodsId)->getField('goodsImg');
            $info = array('salemanId'=>$admin_id,'goodsId'=>$goodsId,'goodsName'=>$goodsName,'goodsImg'=>$goodsImg,'goodsColor'=>$goodsColor,'hand'=>$hand,'falseLock'=>$falseLock,'goodsModel'=>$goodsModel,'goodsNum'=>$goodsNum,'enTime'=>date('Y-m-d H:i:s'));
            $Model_Data = M('shopcar');
            $res = $Model_Data->add($info);
            if ($res) {
                $this->success('已将产品添至购物车，提交订单请在购物车操作');
            } else {
                $this->error("添加失败");
            }
        } else {
            $this->error("未能识别的访问，请重试");
        }
    }

    //修改单个商品订单页面
    public function update(){
        if (isset($_SESSION['admin_id']) && isset($_GET['id'])) {
            $id = intval(I('id'));
            $Model_Data = M();
            $shop = $Model_Data->table('saleman_shopcar')->where('id='.$id)->find();
            if (!empty($shop)) {
                //var_dump($shop);
                //exit();
                $goodsId = $shop['goodsid'];
                $goods = $Model_Data->table('saleman_goods')->where('id='.$goodsId)->find();
                if (empty($goods)) {
                    $this->error('该商品已下架',U('Shopcar/index'));
                }
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
                
                $goodsInfo = $Model_Data->query("select id,goodsColor,colorCode,hand,falseLock from saleman_goods_info where goodsId=$goodsId and id in ($goodsInfoId) and status=1");
                if (!empty($goodsInfo)) {
                    // $res = array('info'=>$goodsInfo,'code'=>1,'msg'=>'');
                    // //var_dump($res);
                    // $this->ajaxreturn($res);
                    $info = json_encode($goodsInfo);
                    $this->assign('info',$info);
                    $this->assign('shop',$shop);
                    $this->assign('goods',$goods);
                    $ad = A('Login');
                    $ad = $ad->getAD();
                    $this->assign('ad',$ad);
                    $this->display();
                } else {
                    $this->error('该商品已下架',U('Shopcar/index'));
                }
            } else {
                $this->error('暂无该商品款式',U('Shopcar/index'));
            }
        }
    }
    //修改单个商品订单
    public function goodsUpdate(){
        if (isset($_SESSION['admin_id']) && IS_AJAX) {
            $admin_id = intval($_SESSION['admin_id']);
            $id = intval(I('id'));
            $goodsId = intval(I('goodsId'));
            $goodsName = I('goodsName');
            $goodsColor = I('goodsColor');
            $hasHand = intval(I('hasHand'));
            $hand = intval(I('hand'));
            $hasLock = intval(I('hasLock'));
            $falseLock = intval(I('falseLock'));
            $goodsNum = intval(I('goodsNum'));
            $goodsModel = $goodsColor;
            //拼接产品规格信息
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
            $goodsImg = M('goods')->where('id='.$goodsId)->getField('goodsImg');
            $info = array('salemanId'=>$admin_id,'goodsId'=>$goodsId,'goodsName'=>$goodsName,'goodsImg'=>$goodsImg,'goodsColor'=>$goodsColor,'hand'=>$hand,'falseLock'=>$falseLock,'goodsModel'=>$goodsModel,'goodsNum'=>$goodsNum,'enTime'=>date('Y-m-d H:i:s'));
            $Model_Data = M('shopcar');
            $res = $Model_Data->where('id='.$id)->save($info);
            if ($res) {
                $this->success('修改成功');
            } else {
                $this->error("添加失败");
            }
        } else {
            $this->error("未能识别的访问，请重试");
        }
    }
}