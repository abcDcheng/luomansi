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
                $photo = I('photo');
                $goodsname = I('goodsname');
                $goodsDes = I('goodsDes');
                $hand = I('hand');
                $falseLock = I('falseLock');
                $Model_data = M('goods');
                $data = array('goodsName'=>$goodsname,
                              'goodsDes'=>$goodsDes,
                              'goodsImg'=>$photo,
                              'hasHand'=>$hand,
                              'hasLock'=>$falseLock,
                              'enTime'=>date('Y-m-d H:i:s')
                        );
                $res = $Model_data->data($data)->add();
                if ($res) {
                    $this->success('添加成功',U('Goods/index'));
                } else {
                    $this->error('添加失败',U('Goods/index'));
                }
            } else {
                $this->display();
                
            }
        } else {
            $this->error("未登录或未授权",U("Login/index"),1);
        }
    }
    //产品大类更新
    public function goodsUpdate(){
        if (isset($_SESSION['admin_id']) && $_SESSION['group'] == 99) {
            if (isset($_REQUEST['id'])) {
                $id = intval(I('id'));  //获取产品对应ID
                if (IS_AJAX) {
                    $photo = I('photo');
                    $oldPhoto = I('oldPhoto');
                    $goodsname = I('goodsname');
                    $goodsDes = I('goodsDes');
                    $hand = I('hand');
                    $falseLock = I('falseLock');
                    $Model_data = M('goods');
                    $data = array('goodsName'=>$goodsname,
                                  'goodsImg'=>$photo,
                                  'goodsDes'=>$goodsDes,
                                  'hasHand'=>$hand,
                                  'hasLock'=>$falseLock,
                                  'enTime'=>date('Y-m-d H:i:s')
                            );
                    $res = $Model_data->where('id='.$id)->data($data)->save();
                    if ($res) {
                        if ($photo != $oldPhoto) {
                            M('shopcar')->where("goodsImg='$oldPhoto'")->save(array('goodsImg'=>$photo));
                            M('maintain')->where("goodsImg='$oldPhoto'")->save(array('goodsImg'=>$photo));
                        }
                        $this->success('修改成功',U('Goods/index'));
                    } else {
                        $this->error('修改失败',U('Goods/index'));
                    }
                } else {
                    $goods = M('goods')->where('id='.$id)->find();
                    if (!empty($goods)) {
                        $this->assign('goods',$goods);
                        $this->display();
                    } else {
                        $this->error("查无产品数据",U("Goods/index"),3);
                    }
                }
            } else {
                $this->error('未知参数',U('Goods/index'));
            }
            
        } else {
            $this->error("未登录或未授权",U("Login/index"),1);
        }        
    }

    //删除产品
    public function del(){
        if (isset($_SESSION['admin_id']) && $_SESSION['group'] == 99) {
            if (IS_AJAX) {
                if (isset($_POST['id'])) {
                    $id = intval(I('id'));
                    $Model_data = M('Goods');
                    $res = $Model_data->where('id='.$id)->delete();
                    if ($res === false) {
                        $this->error('数据删除失败，请刷新页面重试');
                    } elseif ($res === 0) {
                        $this->error('查无该账户数据，请刷新页面检查');
                    } else {
                        M('goodsInfo')->where('goodsId='.$id)->delete();
                        $this->success('删除成功',U('Goods/index'));
                    }
                } else {
                    $this->error("查无数据",U("Goods/index"),3);
                }
            } else {
                $this->error("未知的操作",U("Goods/index"),3);
            }
        }
    }


    //产品规格展示
    public function goodsModel(){
        if (isset($_SESSION['admin_id']) && $_SESSION['group'] == 99) {
            if (isset($_GET['id'])) {   //获取产品大类ID
                $id = intval(I('id'));
                $Model_data = M();
                //获取产品属性
                $goods = $Model_data->table('saleman_goods')->where('id='.$id)->getField('id,goodsName,hasHand,hasLock');
                if (!empty($goods)) {
                    $this->assign('goods',$goods[$id]);
                    //获取规格
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
    //产品规格添加
    public function modelAdd(){
        if (isset($_SESSION['admin_id']) && $_SESSION['group'] == 99) {
            if (IS_AJAX) {
                $goodsId = intval(I('id'));
                $color = I('color');
                $colorCode = I('colorCode');
                $saleman = I('saleman');
                $hand = I('hand');
                $falseLock = I('falseLock');
                $data = array('goodsId'=>$goodsId,
                              'goodsColor'=>$color,
                              'colorCode'=>$colorCode,
                              'hand'=>$hand,
                              'falseLock'=>$falseLock,
                              'status'=>1,
                              'enTime'=>date('Y-m-d H:i:s')
                    );
                $Model_data = M();
                $res = $Model_data->table('saleman_goods_info')->data($data)->add();
                if ($res) {
                    //新增产品添加代理商权限（可购买权限）
                    if (!empty($saleman)) {
                        $saleman = implode(',', $saleman);
                        $res = $Model_data->execute("update saleman_goods_permission 
                        set goodsInfoId = concat_ws(',',goodsInfoId,$res) 
                        where salemanId in ($saleman)");
                    }
                    $this->success('添加成功',U('Goods/goodsModel?id='.$goodsId));
                } else {
                    $this->error('添加失败，请重试或联系技术人员解决');
                }
            } else {
                if (isset($_GET['id'])) {
                    //查询产品大类
                    $id = intval(I('id'));
                    $Model_data = M('goods');
                    $goods = $Model_data->where('id='.$id)->find();
                    if (!empty($goods)) {
                        $Model_data = M('SysAdmin');
                        $saleman = $Model_data->where('`group`=1')->order('province asc,city asc')->field('id,name,province,city')->select();
                        $this->assign('saleman',$saleman);
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
    //产品规格更新
    public function modelUpdate(){
        if (isset($_SESSION['admin_id']) && $_SESSION['group'] == 99) {
            if (isset($_REQUEST['id'])) {
                $id = intval(I('id'));
                if (IS_AJAX) {
                    $color = I('color');
                    $colorCode = I('colorCode');
                    $hand = I('hand');
                    $falseLock = I('falseLock');
                    $status = I('status');
                    $data = array(
                              'goodsColor'=>$color,
                              'colorCode'=>$colorCode,
                              'hand'=>$hand,
                              'falseLock'=>$falseLock,
                              'status'=>$status,
                              'enTime'=>date('Y-m-d H:i:s')
                    );
                    $Model_data = M('goodsInfo');
                    $res = $Model_data->where('id='.$id)->data($data)->save();
                    if ($res) {
                        $goodsId = intval(I('goodsId'));
                        $this->success('数据修改成功',U('Goods/goodsModel?id='.$goodsId));
                    }
                } else {
                    //获取当前产品规格信息
                    $Model_data = M();
                    $model = $Model_data->table('saleman_goods_info')->where('id='.$id)->find();
                    if (!empty($model)) {
                        $goods = $Model_data->table('saleman_goods')->where('id='.$model['goodsid'])->find();
                        if (!empty($goods)) {
                            $this->assign('goods',$goods);
                            $this->assign('model',$model);
                            $this->display();
                        } else {
                            $this->error('查不到产品数据',U('Goods/index'),3);
                        }
                    } else {
                        $this->error('查不到产品数据',U('Goods/index'),3);
                    }
                }
            } else {
                $this->error('查不到产品数据',U('Goods/index'),3);
            }
        } else {
            $this->error("未登录或未授权",U("Login/index"),1);
        }
    }
    //删除产品规格
    public function modelDel(){
        if (isset($_SESSION['admin_id']) && $_SESSION['group'] == 99) {
            if (IS_AJAX) {
                if (isset($_POST['id'])) {
                    $id = intval(I('id'));
                    $Model_data = M('GoodsInfo');
                    $res = $Model_data->where('id='.$id)->delete();
                    if ($res === false) {
                        $this->error('数据删除失败，请刷新页面重试');
                    } elseif ($res === 0) {
                        $this->error('查无该账户数据，请刷新页面检查');
                    } else {
                        $this->success('删除成功');
                    }
                } else {
                    $this->error("查无数据",U("Goods/index"),3);
                }
            } else {
                $this->error("未知的操作",U("Goods/index"),3);
            }
        } else {
            $this->error("您未授权做此操作",U("Goods/index"),3);
        }
    }
    //图片上传
    public function photoUpload(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =      './Application/Upload/goods/'; // 设置附件上传根目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录

        // 上传单个文件 
        $info   =   $upload->uploadOne($_FILES['file']);
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }else{// 上传成功 获取上传文件信息
            $info['code'] = 1;
            echo json_encode($info);
        }
    }
}