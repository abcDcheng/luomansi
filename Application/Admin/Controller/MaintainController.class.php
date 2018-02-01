<?php
namespace Admin\Controller;
use Think\Controller;
class MaintainController extends Controller {
    public function index(){
    	if (isset($_SESSION['admin_id']) && ($_SESSION['group'] == 99 || $_SESSION['group'] == 3)) {
            if (isset($_REQUEST['p'])) {
                $page = intval(I('p'));
            } else {
                $page = 1;
            }
            $data = 'status!=1 ';
            if (isset($_REQUEST['startTime']) && $_REQUEST['startTime'] !='') {
                $data .= " and enTime>'".$_REQUEST['startTime']."'";
            }
            if (isset($_REQUEST['endTime']) && $_REQUEST['endTime'] !='') {
                $data .= " and enTime<'".$_REQUEST['endTime']."'";
            }
            if (isset($_REQUEST['saleman']) && $_REQUEST['saleman'] !='') {
                $data .= " and saleman='".$_REQUEST['saleman']."'";
            }
            $pageNum = 12;
            $username = $_SESSION['username'];
            $Model_data = M('maintain');
            $info = $Model_data->where($data)->order('id desc')->limit($pageNum,($page-1)*$pageNum)->select();
            $count = $Model_data->count();
            $Pages = new \Think\Page($count, $pageNum);
            $pageHtml = $Pages -> show();
            $this->assign('page',$pageHtml);
            $this->assign('info',$info);
    		$this->display();
    	} else {
    		$this->error("未登录或未授权",U("Login/index"),1);
    	}
    }

    public function add(){
    	//session('admin_id', null);
        if (isset($_SESSION['admin_id']) && ($_SESSION['group'] == 99 || $_SESSION['group'] == 3)) {
            if (IS_AJAX) {
                $name = I('name');
                $phone = I('phone');
                $address = I('address');
                $goods = I('goods');
                $msg = I('msg');
                $salemanId = intval(I('saleman'));
                $username = $_SESSION['username'];
                $Model_data = M();
                $info = $Model_data->table('saleman_sys_admin')->where('id='.$salemanId)->getField('id,name,phone');
                if (!empty($info)) {
                    $data = array(
                        'username'      => $username,
                        'name'          => $name,
                        'phone'         => $phone,
                        'address'       => $address,
                        'goods'         => $goods,
                        'msg'           => $msg,
                        'salemanId'     => $salemanId,
                        'saleman'       => $info[$salemanId]['name'],
                        'salemanPhone'  => $info[$salemanId]['phone'],
                        'enTime'        => date('Y-m-d H:i:s')
                        );
                    $res = $Model_data->table('saleman_maintain')->data($data)->add();
                    if ($res) {
                        $this->success('成功生成维护订单',U('Maintain/index'));
                    } else {
                        $this->error('生成维护订单失败');
                    }
                } else {
                    $this->error('查找不到负责代理商的信息，请重试');
                }
            } else {
                $Model_data = M('SysAdmin');
                $saleman = $Model_data->where('`group`=1')->order('id asc')->getField('id,name,phone');
                $this->assign('saleman',$saleman);
                $this->assign('username',$_SESSION['username']);
                $this->display();
            }
        } else {
            $this->error("未登录或未授权",U("Login/index"),1);
        }
    }

    public function update(){
        if (isset($_SESSION['admin_id']) && ($_SESSION['group'] == 99 || $_SESSION['group'] == 3)) {
            if (isset($_REQUEST['id'])) {
                $id = intval($_REQUEST['id']);
                if (IS_AJAX) {
                    $name = I('name');
                    $phone = I('phone');
                    $address = I('address');
                    $goods = I('goods');
                    $msg = I('msg');
                    $salemanId = intval(I('saleman'));
                    $oldSaleman = intval(I('oldSaleman'));
                    $status = intval(I('status'));
                    $data = array(
                        'name'          => $name,
                        'phone'         => $phone,
                        'address'       => $address,
                        'goods'         => $goods,
                        'msg'           => $msg,
                        'enTime'        => date('Y-m-d H:i:s')
                        );
                    $Model_data = M();
                    if ($salemanId != $oldSaleman) {
                        $info = $Model_data->table('saleman_sys_admin')->where('id='.$salemanId)->getField('id,name,phone');
                        if (!empty($info)) {
                            $data['salemanId'] = $salemanId;
                            $data['saleman'] = $info[$salemanId]['name'];
                            $data['salemanPhone'] = $info[$salemanId]['phone'];
                            $data['serviceId'] = '';
                            $data['serviceName'] = '';
                            $data['servicePhone'] = '';
                            $data['serviceStatus'] = 0;
                        } else {
                            $this->error('查找不到负责代理商的信息，请重试');
                        }
                    }
                    if ($status == 2) {
                        $data['serviceStatus'] = 1;
                        $data['serEndTime'] = "0000-00-00 00:00:00";
                        $data['endTime'] = "0000-00-00 00:00:00";
                    } elseif ($status == 1) {
                        $data['endTime'] = date('Y-m-d H:i:s');
                    }
                    $data['status'] = $status;
                    
                    $res = $Model_data->table('saleman_maintain')->where('id='.$id)->data($data)->save();
                    if ($res) {
                        $this->success('修改成功',U('Maintain/index'));
                    } else {
                        $this->error('修改失败');
                    }
                } else {
                    $Model_data = M('SysAdmin');
                    $saleman = $Model_data->where('`group`=1')->order('id asc')->getField('id,name,phone');
                    $Model_data = M('maintain');
                    $info = $Model_data->where('id='.$id)->find();
                    if (!empty($info)) {
                        $this->assign('saleman',$saleman);
                        $this->assign('info',$info);
                        $this->display();
                    } else {
                        $this->error('查无此数据',U('Maintain/index'),3);
                    }
                }
            } else {
                $this->error('查无数据',U('Maintain/index'),3);
            }
        }
    }

    public function del(){
        if (isset($_SESSION['admin_id']) && ($_SESSION['group'] == 99 || $_SESSION['group'] == 3)) {
            if (isset($_GET['id'])) {
                $id = intval($_GET['id']);
                $Model_data = M('maintain');
                $res = $Model_data->where('id='.$id)->delete();
                if ($res === false) {
                    $this->error('数据删除失败，请刷新页面重试');
                } elseif ($res === 0) {
                    $this->error('查无该数据，请刷新页面检查');
                } else {
                    $this->success('删除成功',U("Login/index"));
                }
            }
        }
    }

    public function salemanIndex(){
        if (isset($_SESSION['admin_id']) && $_SESSION['group'] == 1) {
            if (isset($_REQUEST['p'])) {
                $page = intval(I('p'));
            } else {
                $page = 1;
            }
            $admin_id = $_SESSION['admin_id'];
            $data = "salemanId='$admin_id' ";
            if (isset($_REQUEST['startTime']) && $_REQUEST['startTime'] !='') {
                $data .= " and enTime>'".$_REQUEST['startTime']."'";
            }
            if (isset($_REQUEST['endTime']) && $_REQUEST['endTime'] !='') {
                $data .= " and enTime<'".$_REQUEST['endTime']."'";
            }
            if (isset($_REQUEST['saleman']) && $_REQUEST['saleman'] !='') {
                $data .= " and saleman='".$_REQUEST['saleman']."'";
            }
            $pageNum = 12;
            
            $Model_data = M('maintain');
            $info = $Model_data->where($data)->order('id desc')->limit($pageNum,($page-1)*$pageNum)->select();
            $count = $Model_data->count();
            $Pages = new \Think\Page($count, $pageNum);
            $pageHtml = $Pages -> show();
            
            $this->assign('page',$pageHtml);
            $this->assign('info',$info);
            $this->display();
        } else {
            $this->error("未登录或未授权",U("Login/index"),1);
        }
    }

    public function salemanUpdate(){
        if (isset($_SESSION['admin_id']) && $_SESSION['group'] == 1) {
            if (isset($_REQUEST['id'])) {
                $id = intval($_REQUEST['id']);
                if (IS_AJAX) {
                    $admin_id = $_SESSION['admin_id'];
                    $serviceId = I('servicer');
                    $oldServicer = I('oldServicer');
                    $Model_data = M();
                    //echo $serviceId."   ".$oldServicer;
                    if ($serviceId != $oldServicer) {
                        //查找新维护人员信息
                        $info = $Model_data->table('saleman_service_admin')->where('id='.$serviceId)->find();
                        if (!empty($info)) {
                            $data = array(
                                'serviceName'     => $info['name'],
                                'servicePhone'    => $info['phone'],
                                'serviceId'       => $serviceId
                                );
                            $res = $Model_data->table('saleman_maintain')->where('id='.$id)->data($data)->save();
                            if ($res > 0) {
                                $this->success('修改成功',U('Maintain/salemanIndex'));
                            } else {
                                $this->error('修改失败');
                            }
                        } else {
                            $this->error('查无该维护人员信息，请重试');
                        }
                        
                    } else {
                        $this->success('数据无修改',U('Maintain/salemanIndex'));
                    }
                    
                } else {
                    $admin_id = $_SESSION['admin_id'];
                    $Model_data = M('ServiceAdmin');
                    $servicer = $Model_data->where('salemanId='.$admin_id)->order('id asc')->getField('id,name,phone');
                    $Model_data = M('maintain');
                    $info = $Model_data->where('id='.$id)->find();
                    if (!empty($info)) {
                        $this->assign('servicer',$servicer);
                        $this->assign('info',$info);
                        $this->display();
                    } else {
                        $this->error('查无此数据',U('Maintain/index'),3);
                    }
                }
            } else {
                $this->error('查无数据',U('Maintain/index'),3);
            }
        } else {
            $this->error("未登录或未授权",U("Login/index"),1);
        }
    }

    //完成订单历史数据
    public function history(){
        if (isset($_SESSION['admin_id']) && ($_SESSION['group'] == 99 || $_SESSION['group'] == 3)) {
            if (isset($_REQUEST['p'])) {
                $page = intval(I('p'));
            } else {
                $page = 1;
            }
            $data = 'status=1 ';
            if (isset($_REQUEST['startTime']) && $_REQUEST['startTime'] !='') {
                $data .= " and enTime>'".$_REQUEST['startTime']."'";
            }
            if (isset($_REQUEST['endTime']) && $_REQUEST['endTime'] !='') {
                $data .= " and enTime<'".$_REQUEST['endTime']."'";
            }
            if (isset($_REQUEST['saleman']) && $_REQUEST['saleman'] !='') {
                $data .= " and saleman='".$_REQUEST['saleman']."'";
            }
            $pageNum = 12;
            $username = $_SESSION['username'];
            $Model_data = M('maintain');
            $info = $Model_data->where($data)->order('id desc')->limit($pageNum,($page-1)*$pageNum)->select();
            $count = $Model_data->count();
            $Pages = new \Think\Page($count, $pageNum);
            $pageHtml = $Pages -> show();
            $this->assign('page',$pageHtml);
            $this->assign('info',$info);
            $this->display();
        }
    }
}