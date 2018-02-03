<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends Controller {
    public function index(){
    	if (isset($_SESSION['admin_id']) && $_SESSION['group'] == 99) {
    		$Model_data = M('SysAdmin');
    		$info = $Model_data->where('`group` in (2,3)')->getField('id,`group`,username,is_status,createTime');
    		$groupName = array(2=>'订单专员',3=>'客服专员');
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
            $this->error("未授权",U("Login/index"),3);
        }
    }

    //修改账户信息
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
                        $is_status = intval(I('status'));
                        if ($repwd) {
                            $password = md5("123456");
                        } else {
                            $password = $info['password'];
                        }
                        $data = array('password'=>$password,'group'=>$group,'is_status'=>$is_status);
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

    public function servicer(){
        if (isset($_SESSION['admin_id']) && $_SESSION['group'] == 99) {
            if (IS_AJAX) {
                $csql='';
                $ra=array();
                $page=1;
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
                $pageNum = 12;
                $first=$pageNum*($page - 1);
                $Model_data = M();
                $count = $Model_data->table('saleman_service_admin')->where('1 '.$csql)->count();
                $order = $Model_data->table('saleman_service_admin')->where('1 '.$csql)->order('salemanId asc')->limit($first,$pageNum)->getField('id,salemanId,saleman,username,name,IDcard,status,enTime');
                $res = array('num'=>$count,'order'=>$order,'page'=>$page,'pageNum'=>$pageNum);
                //var_dump($res);
                $this->ajaxReturn($res);
            } else {
                $Model_data = M('ServiceAdmin');
                $saleman = $Model_data->group('salemanId')->getField('salemanId,saleman,salemanPhone');
                $this->assign('saleman',$saleman);
                $this->display();
            }
        } else {
            $this->error("未登录或未授权",U("Login/index"),3);
        }
    }
}