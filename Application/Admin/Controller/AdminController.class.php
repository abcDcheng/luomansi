<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends Controller {
    //专员管理界面
    public function index(){
    	if (isset($_SESSION['admin_id']) && $_SESSION['group'] == 99) {
    		//查询所有专员信息
            $Model_data = M('SysAdmin');
    		$info = $Model_data->where('`group` in (2,3,4)')->getField('id,`group`,username,is_status,createTime');
    		$groupName = array(2=>'订单专员',3=>'客服专员',4=>'仓库专员');
    		foreach ($info as $key=>$value) {
    			$info[$key]['groupName'] = $groupName[$value['group']];
    		}
    		//var_dump($info);
    		$this->assign('info',$info);
    		$this->display();
    	} else {
    		$this->error("未登录",U("Login/index"),1);
    	}
    }

    //添加账户信息
    public function add(){
        if (isset($_SESSION['admin_id']) && $_SESSION['group'] == 99) {
            if (IS_AJAX) {
                $username = I('username');
                $pwd = md5(I('pwd'));
                $group = intval(I('group'));
                $phone = I('phone');
                $Model_data = M('SysAdmin');
                //判断专员账号是否已注册
                $count = $Model_data->where("username='$username'")->count();
                if ($count > 0) {
                    $this->error('该用户名已存在',U('Admin/index'));
                } else {
                    $count = $Model_data->where("phone='$phone'")->count();
                    if ($count > 0) {
                        $this->error('该手机号已绑定其它账号',U('Admin/index'));
                        exit();
                    }
                    $insertData = array('username'=>$username,
                                        'password'=>$pwd,
                                        'phone'=>$phone,
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
            $this->error("未授权",U("Login/index"),3);
        }
    }

    //修改账户信息
    public function update(){
        if (isset($_SESSION['admin_id']) && $_SESSION['group'] == 99) {
            if (isset($_REQUEST['id'])) {
                $id = intval(I('id'));
                //查询专员账号信息
                $Model_data = M('SysAdmin');
                $info = $Model_data->where('id='.$id)->find();
                if (!empty($info)) {
                    if (IS_AJAX) {
                        $repwd = intval(I('repwd'));
                        $group = intval(I('group'));
                        $is_status = intval(I('status'));
                        $phone = I('phone');
                        //若前端勾选了重置密码，则重置密码为a123456，否则照旧
                        if ($repwd) {
                            $password = md5("a123456");
                        } else {
                            $password = $info['password'];
                        }
                        $count = $Model_data->where("phone='$phone' and id !=$id")->count();
                        if ($count > 0) {
                            $this->error('该手机号已绑定其它账号',U('Admin/index'));
                            exit();
                        }
                        $data = array('password'=>$password,'group'=>$group,'phone'=>$phone,'is_status'=>$is_status);
                        $res = $Model_data->where('id='.$id)->save($data);
                        if ($res === false) {
                            $this->error('数据更新失败，请重试或联系技术人员解决');
                        } else {
                            $this->success('更新成功',U("Admin/index"));
                        }
                    } else {
                        $this->assign('id',$id);
                        $this->assign('info',$info);
                        $this->display();
                    }
                } else {
                    $this->error("查无该账户数据",U("Admin/index"),3);
                }
            } else {
                $this->error("查无数据",U("Admin/index"),3);
            }
        } else {
            $this->error("未授权",U("Login/index"),3);
        }
    }

    //删除专员账户 
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
                        $this->success('删除成功',U("Admin/index"));
                    }
                } else {
                    $this->error("查无数据",U("Admin/index"),3);
                }
            } else {
                $this->error("未授权",U("Admin/index"),3);
            }
        }
    }
    //查询代理商下属人员信息
    public function servicer(){
        if (isset($_SESSION['admin_id']) && $_SESSION['group'] == 99) {
            if (IS_AJAX) {
                $csql='';
                $ra=array();
                $page=1;
                //是否按代理商查询
                if(isset($_POST['saleman'])){
                    $saleman=intval($_POST['saleman']);
                    if($saleman){
                        $csql.="and salemanId='$saleman' ";
                    }
                }
                if(isset($_POST['page'])){
                    $page=$_POST['page'];
                }
                //echo $csql;
                $pageNum = 12;//分页每页数目
                $first = $pageNum * ($page - 1);
                $Model_data = M();
                //查询的数据总数
                $count = $Model_data->table('saleman_service_admin')->where('1 '.$csql)->count();
                //查询对应数据
                $order = $Model_data->table('saleman_service_admin')->where('1 '.$csql)->order('salemanId asc')->limit($first,$pageNum)->getField('id,salemanId,saleman,username,name,IDcard,status,enTime');
                $res = array('num'=>$count,'order'=>$order,'page'=>$page,'pageNum'=>$pageNum);
                //var_dump($res);
                $this->ajaxReturn($res);
            } else {
                $Model_data = M('SysAdmin');
                $saleman = $Model_data->where('`group`=1')->order('province asc,city asc')->field('id,name,province,city')->select();
                $salemanArr = array();
                foreach ($saleman as $key => $value) {
                    $salemanArr[] = array('value'=>$value['name'],'label'=>$value['name'].'('.$value['province'].$value['city'].')','id'=>$value['id']);
                }
                $saleman = json_encode($salemanArr);
                $this->assign('saleman',$saleman);
                $this->display();
            }
        } else {
            $this->error("未登录或未授权",U("Login/index"),3);
        }
    }
    //添加代理商下属员工
    public function serviceAdd(){
        if (isset($_SESSION['admin_id']) && $_SESSION['group'] == 99) {
            if (IS_AJAX) {
                //查询代理商信息
                $salemanId = intval(I('saleman'));
                $saleman = M('SysAdmin')->where('id='.$salemanId)->find();
                if (!empty($saleman)) {
                    //查询已有代理商下属人员数量，最多不能超过5个
                     $Model_data = M('ServiceAdmin');
                    // $count = $Model_data->where("salemanId='$salemanId'")->count();
                    // if ($count>=5) {
                    //     $this->error('每位代理商限定只能有5个下属人员账户');
                    // }
                    $username = I('username');
                    $pwd = md5(I('pwd'));
                    $name = I('name');
                    $phone = I('phone');
                    $IDcard = I('IDcard');
                    //查询下属人员账号是否存在
                    $count = $Model_data->where("username='$username'")->count();
                    if ($count > 0) {
                        $this->error('该账户名已存在');
                    } else {
                            $insertData = array('username'=>$username,
                                        'password'=>$pwd,
                                        'name'=>$name,
                                        'phone'=>$username,
                                        'IDcard'=>$IDcard,
                                        'salemanId'=>$salemanId,
                                        'saleman'=>$saleman['name'],
                                        'salemanPhone'=>$saleman['phone'],
                                        'status'=>1,
                                        'enTime'=>date('Y-m-d H:i:s'));
                        //var_dump($insertData);
                        $res = $Model_data->add($insertData);
                        if ($res) {
                            $this->success('提交成功',U('Admin/servicer'),'add');
                        } else {
                            $this->error('添加失败，请重试或联系技术人员解决');
                        }
                    }
                } else {
                    $this->error('查不到该经销商的信息，请重试');
                }
            } else {
                $Model_data = M('SysAdmin');
                $saleman = $Model_data->where('`group`=1')->order('province asc,city asc')->field('id,name,province,city')->select();
                $salemanArr = array();
                foreach ($saleman as $key => $value) {
                    $salemanArr[] = array('value'=>$value['name'],'label'=>$value['name'].'('.$value['province'].$value['city'].')','id'=>$value['id']);
                }
                $saleman = json_encode($salemanArr);
                $this->assign('saleman',$saleman);
                $this->display();
            }
        } else {
            $this->error("不可用的授权",U("Login/index"),3);
        }
    }
    //代理商下属员工信息更新
    public function serviceUpdate(){
        if (isset($_SESSION['admin_id']) && $_SESSION['group'] == 99) {
            if (isset($_REQUEST['id'])) {
                $id = intval(I('id'));
                if (IS_AJAX) {
                    $pwd = I('pwd');
                    $username = trim(I('username'));
                    $oldUser = I('username');
                    if ($username != $oldUser) {
                        $Model_data = M('ServiceAdmin');
                        //查询下属人员账号是否存在
                        $count = $Model_data->where("username='$username'")->count();
                        if ($count > 0) {
                            $this->error('该账户名已存在');
                            exit();
                        }
                    }
                    $name = I('name');
                    $idcard = I('IDcard');
                    $modelId = I('goodsInfo');
                    $status = intval(I('status'));
                    $salemanId = intval(I('saleman'));
                    $oldSaleman = intval(I('salemanId'));
                    $data = array(
                                  'name'=>$name,
                                  'username'=>$username,
                                  'phone'=>$username,
                                  'IDcard'=>$idcard,
                                  'status'=>$status);
                    //若原归属代理商更改
                    if ($salemanId != $oldSaleman) {
                        // $count = M('ServiceAdmin')->where('salemanId='.$salemanId)->count();
                        // if ($count >= 5) {
                        //     $this->error('该代理商已有5个下属人员账户');
                        //     exit();
                        // }
                        $saleInfo = M('SysAdmin')->where('id='.$salemanId)->find();
                        if (!empty($saleInfo)) {
                            $data['salemanId'] = $salemanId;
                            $data['saleman'] = $saleInfo['name'];
                            $data['salemanPhone'] = $saleInfo['phone'];
                        } else {
                            $this->error('查找不到该代理商信息，请重试');
                        }
                    }
                    //若修改密码
                    if ($pwd) {
                        $data['password'] = md5($pwd);
                    }
                    $Model_data = M('ServiceAdmin');
                    $res = $Model_data->where('id='.$id)->save($data);
                    if ($res === false) {
                        $this->error('数据更新失败，请重试或联系技术人员解决');
                    } else {
                        $this->success('更新成功',U("Admin/servicer"));
                    }
                } else {
                    $Model_data = M('ServiceAdmin');
                    $info = $Model_data->where('id='.$id)->find();
                    $this->assign('id',$id);
                    $this->assign('info',$info);
                    $Model_data = M('SysAdmin');
                    $saleman = $Model_data->where('`group`=1')->order('province asc,city asc')->field('id,name,province,city')->select();
                    $salemanArr = array();
                    foreach ($saleman as $key => $value) {
                        $salemanArr[] = array('value'=>$value['name'],'label'=>$value['name'].'('.$value['province'].$value['city'].')','id'=>$value['id']);
                    }
                    $saleman = json_encode($salemanArr);
                    $this->assign('saleman',$saleman);
                    $this->display();
                }
                
            } else {
                $this->error("查无数据",U("Admin/index"),3);
            }
        } else {
            $this->error("不可用的授权",U("Login/index"),3);
        }
    }

    public function ad(){
        if (isset($_SESSION['admin_id']) && $_SESSION['group'] == 99) {
            if (IS_AJAX) {
                $ad = I('ad');
                $ad = str_replace("\r\n", "<br/>", $ad);
                $res = M('ad')->where('id=1')->data(array('ad'=>$ad,'enTime'=>date('Y-m-d H:i:s')))->save();
                if ($res) {
                    $this->success('更新成功',U("Admin/ad"));
                } else {
                    echo mysql_error();
                    $this->error("更新失败");
                }
            } else {
                $ad = M('ad')->where('id=1')->find();
                $ad = str_replace("<br/>", "\r\n", $ad);
                $this->assign('ad',$ad);
                $this->display();
            }
        } else {
            $this->error("不可用的授权",U("Login/index"),3);
        }
    }

    public function phone() {
        if (isset($_SESSION['admin_id']) && $_SESSION['group'] == 99) {
            $admin_id = intval($_SESSION['admin_id']);
            if (IS_AJAX) {
                $phone = I('phone');
                $yzm = I('yzm');
                $code = isset($_SESSION['telcode'])?$_SESSION['telcode']:'';
                if (!$code) {
                    $this->error('请先获取手机验证码');
                    exit();
                }
                if ($code != $yzm) {
                    $this->error('手机验证码错误');
                    exit();
                }
                if ($phone) {
                    $data = array('phone'=>$phone);
                    $res = M('SysAdmin')->where('id='.$admin_id)->save($data);
                    if ($res === false) {
                        $this->error('修改失败');
                    } else {
                        unset($_SESSION['telcode']);
                        $this->success('修改成功',U('Admin/phone'));
                    }
                } else {
                    $this->error('请填写新绑定手机号');
                }
            } else {
                $info = M('SysAdmin')->where('id='.$admin_id)->find();
                if (!empty($info)) {
                    $oldphone = $info['phone'];
                    $phone = substr_replace($info['phone'], '****', 3, 4);
                    $this->assign('oldphone',$oldphone);
                    $this->assign('phone',$phone);
                    $this->display();
                } else {
                    $this->error("未能查询到您的信息，请重新登录",U("Login/index"),3);
                }
            }
        } else {
            $this->error("不可用的授权",U("Login/index"),3);
        }
    }
}