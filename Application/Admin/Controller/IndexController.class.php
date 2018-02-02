<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	if (isset($_SESSION['admin_id'])) {
    		$this->display();
    	} else {
    		$this->error("未登录",U("Login/index"),1);
    	}
    }

    public function pwd(){
        if (isset($_SESSION['admin_id'])) {
            if (IS_AJAX) {
                $id = $_SESSION['admin_id'];
                $oldpwd = I('oldpwd');
                $pwd = I('pwd');
                if ($oldpwd != $pwd) {
                    $Model_data = M('SysAdmin');
                    $info = $Model_data->where('id='.$id)->getField('password');
                    if (md5($oldpwd) == $info) {
                        $res = $Model_data->where('id='.$id)->data(array('password'=>md5($pwd)))->save();
                        if ($res) {
                            session_destroy();
                            $this->success('修改成功，请重新登录',U("Login/index"));
                        } else {
                            $this->error("修改失败");
                        }
                    } else {
                        $this->error("原密码不正确");
                    }
                } else {
                    $this->error("新旧密码不能一致");
                }
            } else {
                $this->display();
            }
        } else {
            $this->error("未登录",U("Login/index"),1);
        }
    }

    public function loginout(){
    	//session('admin_id', null);
    	session_destroy();
        redirect(U("Login/index"));
    }
}