<?php
namespace Admin\Controller;
use Think\Controller;
class SalemanController extends Controller {
    //代理商页面
    public function index(){
        if (isset($_SESSION['admin_id']) && $_SESSION['group'] == 99 ) {
            if (isset($_GET['p'])) {
                $page = intval(I('p'));
            } else {
                $page = 1;
            }
            $pageNum = 12;
            //查询代理商信息（group为1代表代理商）
            $Model_data = M('SysAdmin');
            $info = $Model_data->where('`group` = 1')->limit($pageNum,($page-1)*$pageNum)->getField('id,`group`,username,name,phone,province,city,is_status,createTime');
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
    //新增代理商账户
    public function add(){
        if (isset($_SESSION['admin_id']) && $_SESSION['group'] == 99) {
            if (IS_AJAX) {
                $username = I('username');
                $pwd = md5(I('pwd'));
                $name = I('name');
                $phone = I('phone');
                $province = I('province');
                $city = I('city');
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
                                        'province'=>$province,
                                        'city'=>$city,
                                        'address'=>$address,
                                        'group'=>1,
                                        'createTime'=>date('Y-m-d H:i:s'));
                    //var_dump($insertData);
                    $res = $Model_data->add($insertData);
                    if ($res) {
                        //新增完代理商后，赋予下单权限（值为产品规格ID）
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
    //修改代理商账户
    public function update(){
        if (isset($_SESSION['admin_id']) && $_SESSION['group'] == 99) {
            if (isset($_REQUEST['id'])) {
                $id = intval(I('id'));
                $Model_data = M('SysAdmin');
                $info = $Model_data->where('id='.$id)->find();
                if (!empty($info)) {
                    if (IS_AJAX) {
                        $repwd = intval(I('repwd'));
                        $name = I('name');
                        $phone = I('phone');
                        $address = I('address');
                        $province = I('province');
                        $city = I('city');
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
                                      'province'=>$province,
                                      'city'=>$city,
                                      'address'=>$address,
                                      'is_status'=>$is_status);
                        $res = $Model_data->where('id='.$id)->save($data);
                        if ($res === false) {
                            $this->error('数据更新失败，请重试或联系技术人员解决');
                        } else {
                            //修改产品规格权限
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
                        //获取代理商下单产品权限
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

    //删除代理商账户 
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
                        $Model_data = M('GoodsPermission');
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
    //获取代理商下属员工信息
    public function staff(){
        if (isset($_SESSION['admin_id']) && $_SESSION['group'] == 1) {
            $admin_id = $_SESSION['admin_id'];
            $Model_data = M('ServiceAdmin');
            $info = $Model_data->where('salemanId='.$admin_id)->getField('id,username,name,phone,IDcard,status,enTime');
            $this->assign('info',$info);
            $this->display();
        } else {
            $this->error("未登录或未授权",U("Login/index"),1);
        }
    }
    //新增代理商下属人员账户
    public function staffAdd(){
        if (isset($_SESSION['admin_id']) && $_SESSION['group'] == 1) {
            if (IS_AJAX) {
                $admin_id = intval($_SESSION['admin_id']);
                $Model_data = M('ServiceAdmin');
                //查询已有代理商人员账户数量
                $count = $Model_data->where("salemanId='$admin_id'")->count();
                if ($count>=5) {
                    $this->error('每位代理商限定只能有5个下属人员账户');
                }
                $username = I('username');
                $pwd = md5(I('pwd'));
                $name = I('name');
                $phone = I('phone');
                $IDcard = I('IDcard');
                
                $count = $Model_data->where("username='$username'")->count();
                if ($count > 0) {
                    $this->error('该用户名已存在',U('Admin/index'));
                } else {
                    $saleman = M('SysAdmin')->where('id='.$admin_id)->find();
                    if (!empty($saleman)) {
                            $insertData = array('username'=>$username,
                                        'password'=>$pwd,
                                        'name'=>$name,
                                        'phone'=>$username,
                                        'IDcard'=>$IDcard,
                                        'salemanId'=>$admin_id,
                                        'saleman'=>$saleman['name'],
                                        'salemanPhone'=>$saleman['phone'],
                                        'status'=>1,
                                        'enTime'=>date('Y-m-d H:i:s'));
                        //var_dump($insertData);
                        $res = $Model_data->add($insertData);
                        if ($res) {
                            $this->success('提交成功',U('Saleman/staff'),'add');
                        } else {
                            $this->error('添加失败，请重试或联系技术人员解决');
                        }
                    } else {
                        $this->error('查不到您的信息，请重新登录');
                    }

                }
                
            } else {
                $this->display();
            }
        } else {
            $this->error("不可用的授权",U("Login/index"),3);
        }
    }
    //修改代理商下属人员账户
    public function staffUpdate(){
        if (isset($_SESSION['admin_id']) && $_SESSION['group'] == 1) {
            if (isset($_REQUEST['id'])) {
                $id = intval(I('id'));
                if (IS_AJAX) {
                    $pwd = I('pwd');

                    $username = trim(I('username'));
                    $name = I('name');
                    $idcard = I('IDcard');
                    $modelId = I('goodsInfo');
                    $status = intval(I('status'));
                    $data = array(
                                  'name'=>$name,
                                  'username'=>$username,
                                  'phone'=>$username,
                                  'IDcard'=>$idcard,
                                  'status'=>$status);
                    if ($pwd) {
                        $data['password'] = md5($pwd);
                    }
                    $Model_data = M('ServiceAdmin');
                    $res = $Model_data->where('id='.$id)->save($data);
                    if ($res === false) {
                        $this->error('数据更新失败，请重试或联系技术人员解决');
                    } else {
                        $this->success('更新成功',U("Saleman/staff"));
                    }
                } else {
                    $Model_data = M('ServiceAdmin');
                    $info = $Model_data->where('id='.$id)->find();
                    $this->assign('id',$id);
                    $this->assign('info',$info);
                    $this->display();
                }
                
            } else {
                $this->error("查无数据",U("Admin/index"),3);
            }
        } else {
            $this->error("不可用的授权",U("Login/index"),3);
        }
    }

    //删除代理商下属人员账户 
    public function staffDel(){
        if (isset($_SESSION['admin_id']) && ($_SESSION['group'] == 1 || $_SESSION['group'] == 99) ) {
            if (IS_AJAX) {
                if (isset($_POST['id'])) {
                    $id = intval(I('id'));
                    $Model_data = M('ServiceAdmin');
                    $res = $Model_data->where('id='.$id)->delete();
                    if ($res === false) {
                        $this->error('数据删除失败，请刷新页面重试');
                    } elseif ($res === 0) {
                        $this->error('查无该账户数据，请刷新页面检查');
                    } else {
                        
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
    //获取产品信息
    public function getGoods(){
        $Model_data = M();
        $ids = array();
        //获取产品大类属性，用于后续的拼接
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
                    //若产品有下拉手属性，显示带不带下拉手
                    if ($goods[$goodsId]['hashand']) {
                        if ($goodsInfo[$i]['hand']) {
                            $model .= '带下拉手';
                        } else {
                            $model .= '不带下拉手';
                        }
                    }
                    //若产品有下拉手属性，显示是否有假锁
                    if ($goods[$goodsId]['haslock'] && $goodsInfo[$i]['falselock']) {
                        $model .= '假锁';
                    }
                    $goods[$goodsId]['model'][] = array($goodsInfo[$i]['id'],$model);
                }
            }
        }

        return $goods;
    }
    //代理商安装管理信息查询
    public function installIndex(){
        if (isset($_SESSION['admin_id']) && $_SESSION['group'] == 1) {
            $admin_id = $_SESSION['admin_id'];
            if (IS_AJAX) {
                $csql='';
                $ra=array();
                $page=1;
                
                if(isset($_POST['firsttime'])){
                    $firsttime=$_POST['firsttime'];
                    if($firsttime){
                        $firsttime=str_replace(".", "-", $firsttime);
                        $csql.="and enTime>='$firsttime' ";
                    }
                    
                }
                if(isset($_POST['lasttime'])){
                    $lastttime=$_POST['lasttime'];
                    if($lastttime){
                        $lastttime=str_replace(".", "-", $lastttime);
                        $lastttime=strtotime($lastttime)+86400;
                        $lastttime=date("Y-m-d",$lastttime);
                        $csql.="and enTime<='$lastttime' ";
                    }
                }
                if(isset($_POST['page'])){
                    $page=$_POST['page'];
                }
                //echo $csql;
                $pageNum = 2;
                $first=$pageNum*($page - 1);
                $Model_data = M();
                $count = $Model_data->table('saleman_install')->where('salemanId='.$admin_id.' '.$csql)->count();
                $order = $Model_data->table('saleman_install')->where('salemanId='.$admin_id.' '.$csql)->order('enTime desc')->limit($first,$pageNum)->getField('id,saleman,serName,serPhone,name,phone,area,address,enTime,status,msg,statusTime');
                
                $res = array('num'=>$count,'order'=>$order,'page'=>$page,'pageNum'=>$pageNum);
                //var_dump($res);
                $this->ajaxReturn($res);
            } else {
                $this->display();
            }
            
        } else {
            $this->error("未登录或未授权",U("Login/index"),1);
        }
    }
}