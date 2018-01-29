<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends Controller {
    public function index(){
    	if (isset($_SESSION['admin_id'])) {
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

    public function add(){
        if (isset($_SESSION['admin_id']) && $_SESSION['group'] == 99) {
            if (IS_AJAX) {
                $username = I('username');
                $pwd = md5(I('pwd'));
                $group = intval(I('group'));
                $Model_data = M('SysAdmin');
                $count = $Model_data->where("username='$username'")->count();
                if ($count > 0) {
                    $this->error('该用户名已存在');
                } else {
                    $insertData = array('username'=>$username,
                                        'password'=>$pwd,
                                        'group'=>$group,
                                        'createTime'=>date('Y-m-d H:i:s'));
                    //var_dump($insertData);
                    $res = $Model_data->add($insertData);
                    if ($res) {
                        $this->success('添加成功');
                    } else {
                        $this->error('添加失败，请重试或联系技术人员解决');
                    }
                }
                $this->success('提交成功',U('Admin/index'),U('Admin/index'));
            } else {
                $this->display();
            }
        } else {
            $this->error("不可用的授权",U("Login/index"),3);
        }
    }
}