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
}