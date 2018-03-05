<?php
namespace Admin\Controller;
use Think\Controller;
class CodeController extends Controller {
    public function index(){
        if (isset($_SESSION['admin_id']) && $_SESSION['group'] == 99) {
            if (IS_AJAX) {
                $csql='';
                $ra=array();
                $page=1;
                //按安装码查询
                if(isset($_POST['goodsCode'])){
                    $goodsCode=trim($_POST['goodsCode']);
                    if($goodsCode){
                        $csql.="and goodsCode like '%$goodsCode%' ";
                    }
                }
                if(isset($_POST['page'])){
                    $page=$_POST['page'];
                }
                //echo $csql;
                $pageNum = 12;//分页每页数量
                $first=$pageNum*($page - 1);
                $Model_data = M();
                //查询数据总数
                $count = $Model_data->table('saleman_code')->where('goodsCode!="" '.$csql)->count();
                //查询数据
                $order = $Model_data->table('saleman_code')->where('goodsCode!="" '.$csql)->order('id desc')->limit($first,$pageNum)->getField('id,goods,goodsModel,goodsCode');
                
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

    //新增产品码
    public function add(){
        if (isset($_SESSION['admin_id']) && $_SESSION['group'] == 99) {
            if (IS_AJAX) {
                $goods = I('goods');
                $goodsModel = I('goodsModel');
                $goodsCode = I('goodsCode');
                $Model_data = M('code');
                //判断产品码是否已注册
                $count = $Model_data->where("goodsCode='$goodsCode'")->count();
                if ($count > 0) {
                    $this->error('该产品码已存在',U('Code/add'));
                } else {
                    $insertData = array('goods'=>$goods,
                                        'goodsModel'=>$goodsModel,
                                        'goodsCode'=>$goodsCode,
                                        'createTime'=>date('Y-m-d H:i:s'));
                    //var_dump($insertData);
                    $res = $Model_data->add($insertData);
                    if ($res) {
                        $this->success('提交成功',U('Code/index'),'add');
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
    // public function update(){
    //     if (isset($_SESSION['admin_id']) && $_SESSION['group'] == 99) {
    //         if (isset($_REQUEST['id'])) {
    //             $id = intval(I('id'));
    //             //查询专员账号信息
    //             $Model_data = M('SysAdmin');
    //             $info = $Model_data->where('id='.$id)->find();
    //             if (!empty($info)) {
    //                 if (IS_AJAX) {
    //                     $repwd = intval(I('repwd'));
    //                     $group = intval(I('group'));
    //                     $is_status = intval(I('status'));
    //                     //若前端勾选了重置密码，则重置密码为123456，否则照旧
    //                     if ($repwd) {
    //                         $password = md5("123456");
    //                     } else {
    //                         $password = $info['password'];
    //                     }
    //                     $data = array('password'=>$password,'group'=>$group,'is_status'=>$is_status);
    //                     $res = $Model_data->where('id='.$id)->save($data);
    //                     if ($res === false) {
    //                         $this->error('数据更新失败，请重试或联系技术人员解决');
    //                     } else {
    //                         $this->success('更新成功',U("Admin/index"));
    //                     }
    //                 } else {
    //                     $this->assign('id',$id);
    //                     $this->assign('info',$info);
    //                     $this->display();
    //                 }
    //             } else {
    //                 $this->error("查无该账户数据",U("Admin/index"),3);
    //             }
    //         } else {
    //             $this->error("查无数据",U("Admin/index"),3);
    //         }
    //     } else {
    //         $this->error("未授权",U("Login/index"),3);
    //     }
    // }

    //数据删除
    public function del(){
        if (isset($_SESSION['admin_id']) && ($_SESSION['group'] == 99 || $_SESSION['group'] == 3)) {
            if (isset($_GET['id'])) {
                $id = intval($_GET['id']);
                $Model_data = M('code');
                $res = $Model_data->where('id='.$id)->delete();
                if ($res === false) {
                    $this->error('数据删除失败，请刷新页面重试');
                } elseif ($res === 0) {
                    $this->error('查无该数据，请刷新页面检查');
                } else {
                    $this->success('删除成功',U("Code/index"));
                }
            }
        }
    }
}