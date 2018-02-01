<?php
namespace Admin\Controller;
use Think\Controller;
class GoodsController extends Controller {
    //产品展示
    public function index(){
    	if (isset($_SESSION['admin_id']) && $_SESSION['group'] == 99) {
            $Model_data = M('Goods');
            $info = $Model_data->order('id asc')->getField('id,goodsName,goodsImg,hasHand,hasLock,status');
            //var_dump($info);
            $this->assign('info',$info);
            $this->display();
        } else {
            $this->error("未登录或未授权",U("Login/index"),1);
        }
    }

    //产品添加
    public function goodsAdd(){
        if (isset($_SESSION['admin_id']) && $_SESSION['group'] == 99) {
            if (IS_AJAX) {
                $username = I('username');
                $pwd = md5(I('pwd'));
                $group = intval(I('group'));
                $Model_data = M('SysAdmin');
                $count = $Model_data->where("username='$username'")->count();
                if ($count > 0) {
                    $this->error('该用户名已存在',U('Admin/index'));
                } else {
                    $insertData = array('username'=>$username,
                                        'password'=>$pwd,
                                        'group'=>$group,
                                        'createTime'=>date('Y-m-d H:i:s'));
                    //var_dump($insertData);
                    $res = $Model_data->add($insertData);
                    if ($res) {
                        $this->success('提交成功',U('Admin/index'),'add');
                    } else {
                        $this->error('添加失败，请重试或联系技术人员解决');
                    }
                }
                
            } else {
                $this->display();
                
            }
        } else {
            $this->error("未登录或未授权",U("Login/index"),1);
        }
    }


    //产品规格展示
    public function goodsModel(){
        if (isset($_SESSION['admin_id']) && $_SESSION['group'] == 99) {
            if (isset($_GET['id'])) {
                $id = intval(I('id'));
                $Model_data = M();
                $goods = $Model_data->table('saleman_goods')->where('id='.$id)->getField('id,goodsName,hasHand,hasLock');
                if (!empty($goods)) {
                    $this->assign('goods',$goods[$id]);
                    $goodsInfo = $Model_data->table('saleman_goods_info')->where('goodsId='.$id)->order('id asc')->getField('id,goodsColor,colorCode,hand,falseLock,status');
                    //var_dump($goodsInfo);
                    $this->assign('id',$id);
                    $this->assign('info',$goodsInfo);
                    $this->display();
                } else {
                    $this->error("查无该产品",U("Goods/index"),1);
                }
                
            }
        } else {
            $this->error("未登录或未授权",U("Login/index"),1);
        }
    }

    public function modelAdd(){
        if (isset($_SESSION['admin_id']) && $_SESSION['group'] == 99) {
            if (IS_AJAX) {

            } else {
                if (isset($_GET['id'])) {
                    $id = intval(I('id'));
                    $Model_data = M('goods');
                    $goods = $Model_data->where('id='.$id)->find();
                    if (!empty($goods)) {
                        $this->assign('goods',$goods);
                        $this->display();
                    } else {
                        $this->error('查不到产品数据',U('Goods/index'),3);
                    }
                } else {
                    $this->error('查不到产品数据',U('Goods/index'),3);
                }
            }
        }
    }
}