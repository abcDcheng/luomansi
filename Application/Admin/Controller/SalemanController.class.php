<?php
namespace Admin\Controller;
use Think\Controller;
class SalemanController extends Controller {
    public function index(){
        if (isset($_SESSION['admin_id'])) {
            if (isset($_GET['p'])) {
                $page = intval(I('p'));
            } else {
                $page = 1;
            }
            $pageNum = 12;
            $Model_data = M('SysAdmin');
            $info = $Model_data->where('`group` = 1')->limit($pageNum,($page-1)*$pageNum)->getField('id,`group`,username,name,phone,is_status,createTime');
            $count = $Model_data->where('`group` = 1')->count();
            $Pages = new \Think\Page($count, $pageNum);
            $pageHtml = $Pages -> show();
            // $groupName = array(2=>'订单专员',3=>'客服专员');
            // foreach ($info as $key=>$value) {
            //     $info[$key]['groupName'] = $groupName[$value['group']];
            // }
            //var_dump($info);
            $this->assign('page',$pageHtml);
            $this->assign('info',$info);
            $this->display();
        } else {
            $this->error("未登录",U("Login/index"),1);
        }
    }

    public function add(){
        if (isset($_SESSION['admin_id']) && $_SESSION['group'] == 99) {
            if (IS_AJAX) {
                $username = I('username');
                $pwd = md5(I('pwd'));
                $name = I('name');
                $phone = I('phone');
                $address = I('address');
                $modelId = I('goodsInfo');
                $Model_data = M('SysAdmin');
                $count = $Model_data->where("username='$username'")->count();
                if ($count > 0) {
                    $this->error('该用户名已存在',U('Admin/index'));
                } else {
                    $insertData = array('username'=>$username,
                                        'password'=>$pwd,
                                        'name'=>$name,
                                        'phone'=>$phone,
                                        'address'=>$address,
                                        'group'=>1,
                                        'createTime'=>date('Y-m-d H:i:s'));
                    //var_dump($insertData);
                    $res = $Model_data->add($insertData);
                    if ($res) {
                        if (!empty($modelId)) {
                            $modelId = implode(',', $modelId);
                        } else {
                            $modelId = '';
                        }
                        $Model_data = M('GoodsPermission');
                        $data = array('salemanId'=>$res,'goodsInfoId'=>$modelId,'enTime'=>date('Y-m-d H:i:s'));
                        $res = $Model_data->add($data);
                        if ($res) {
                            $this->success('提交成功',U('Saleman/index'),'add');
                        } else {
                            $this->error('添加失败，请重试或联系技术人员解决');
                        }
                        
                    } else {
                        $this->error('添加失败，请重试或联系技术人员解决');
                    }
                }
                
            } else {
                $goods = $this->getGoods();
                //var_dump($goods[3]);
                $this->assign('goods',$goods);
                $this->display();
            }
        } else {
            $this->error("不可用的授权",U("Login/index"),3);
        }
    }

    public function update(){
        if (isset($_SESSION['admin_id']) && $_SESSION['group'] == 99) {
            if (isset($_REQUEST['id'])) {
                $id = intval(I('id'));
                $Model_data = M('SysAdmin');
                $info = $Model_data->where('id='.$id)->find();
                if (!empty($info)) {
                    if (IS_AJAX) {
                        $repwd = intval(I('repwd'));
                        $group = intval(I('group'));
                        $name = I('name');
                        $phone = I('phone');
                        $address = I('address');
                        $modelId = I('goodsInfo');
                        $is_status = intval(I('status'));
                        if ($repwd) {
                            $password = md5("123456");
                        } else {
                            $password = $info['password'];
                        }
                        $data = array('password'=>$password,
                                      'name'=>$name,
                                      'phone'=>$phone,
                                      'address'=>$address,
                                      'is_status'=>$is_status);
                        $res = $Model_data->where('id='.$id)->save($data);
                        if ($res === false) {
                            $this->error('数据更新失败，请重试或联系技术人员解决');
                        } else {
                            if (!empty($modelId)) {
                                $modelId = implode(',', $modelId);
                            } else {
                                $modelId = '';
                            }
                            $Model_data = M('GoodsPermission');
                            $data = array('goodsInfoId'=>$modelId,'enTime'=>date('Y-m-d H:i:s'));
                            $res = $Model_data->where('salemanId='.$id)->save($data);
                            $this->success('更新成功',U("Saleman/index"));
                        }
                    } else {
                        $Model_data = M('GoodsPermission');
                        $goodsInfoId = $Model_data->where('salemanId='.$id)->getField('goodsInfoId');
                        if ($goodsInfoId) {
                            $Model_Data = M();
                            $goodsper = $Model_Data->query("SELECT id 
                                        FROM saleman_goods
                                        WHERE id
                                        IN (
                                        SELECT DISTINCT goodsId
                                        FROM saleman_goods_info
                                        WHERE id
                                        IN (".$goodsInfoId.")
                                        ) and status = 1 order by id asc");
                            $tmp = array();
                            for($i=0;$i<count($goodsper);$i++){
                                $tmp[] = $goodsper[$i]['id'];
                            }
                            $goodsInfoId = explode(",", $goodsInfoId);
                        } else {
                            $goodsInfoId = array();
                            $goodsper = array();
                        }
                        $info['goodsInfoId'] = $goodsInfoId;
                        $info['goodsper'] = $tmp;
                        $goods = $this->getGoods();
                        $this->assign('id',$id);
                        $this->assign('saleman',$info);
                        $this->assign('goods',$goods);
                        $this->display();
                    }
                } else {
                    $this->error("查无该账户数据",U("Admin/index"),3);
                }
            } else {
                $this->error("查无数据",U("Admin/index"),3);
            }
        } else {
            $this->error("不可用的授权",U("Login/index"),3);
        }
    }

    //删除账户 
    public function del(){
        if (isset($_SESSION['admin_id']) && $_SESSION['group'] == 99) {
            if (IS_AJAX) {
                if (isset($_POST['id'])) {
                    $id = intval(I('id'));
                    $Model_data = M('SysAdmin');
                    $res = $Model_data->where('id='.$id)->delete();
                    if ($res === false) {
                        $this->error('数据删除失败，请刷新页面重试');
                    } elseif ($res === 0) {
                        $this->error('查无该账户数据，请刷新页面检查');
                    } else {
                        $Model_data = M('ServiceAdmin');
                        $res = $Model_data->where('salemanId='.$id)->delete();
                        $this->success('删除成功',U("Login/index"));
                    }
                } else {
                    $this->error("查无数据",U("Admin/index"),3);
                }
            } else {
                $this->error("不可用的授权",U("Admin/index"),3);
            }
        }
    }

    public function getGoods(){
        $Model_data = M();
        $ids = array();
        $goods = $Model_data->table('saleman_goods')->order('id asc')->getField('id,goodsName,hasHand,hasLock');
        if (!empty($goods)) {
            foreach ($goods as $key => $value) {
                $ids[] = $key;
                
                $goods[$key]['model'] = array();
            }
        }
        
        if (!empty($ids)) {
            $idStr = implode(',', $ids);
            $goodsInfo = $Model_data->table('saleman_goods_info')->where("goodsId in($idStr)")->select();
            if (!empty($goodsInfo)) {
                for($i = 0;$i<count($goodsInfo);$i++){
                    $goodsId = $goodsInfo[$i]['goodsid'];
                    $model = $goodsInfo[$i]['goodscolor'];
                    if ($goods[$goodsId]['hashand']) {
                        if ($goodsInfo[$i]['hand']) {
                            $model .= '带下拉手';
                        } else {
                            $model .= '不带下拉手';
                        }
                    }
                    if ($goods[$goodsId]['haslock'] && $goodsInfo[$i]['falselock']) {
                        $model .= '假锁';
                    }
                    $goods[$goodsId]['model'][] = array($goodsInfo[$i]['id'],$model);
                }
            }
        }

        return $goods;
    }
}