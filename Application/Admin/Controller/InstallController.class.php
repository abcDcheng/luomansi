<?php
namespace Admin\Controller;
use Think\Controller;
class InstallController extends Controller {
    public function index(){
    	if (isset($_SESSION['admin_id']) && ($_SESSION['group'] == 99 || $_SESSION['group'] == 3)) {
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
                $count = $Model_data->table('saleman_install')->where('status!=1 '.$csql)->count();
                $order = $Model_data->table('saleman_install')->where('status!=1 '.$csql)->order('enTime desc')->limit($first,$pageNum)->getField('id,saleman,serName,serPhone,name,phone,area,address,enTime,status,msg,statusTime');
                
                $res = array('num'=>$count,'order'=>$order,'page'=>$page,'pageNum'=>$pageNum);
                //var_dump($res);
                $this->ajaxReturn($res);
            } else {
                $Model_data = M('install');
                $saleman = $Model_data->where('status!=1')->group('salemanId')->getField('salemanId,saleman,salemanPhone');
                $this->assign('saleman',$saleman);
                $this->display();
            }
    		
    	} else {
    		$this->error("未登录或未授权",U("Login/index"),1);
    	}
    }

    public function update(){
        if (isset($_SESSION['admin_id']) && ($_SESSION['group'] == 99 || $_SESSION['group'] == 3)) {
            if (isset($_REQUEST['mod'])) {
                $mod = $_REQUEST['mod'];
            } else {
                $mod = 'index';
            }
            if (IS_AJAX) {
                $id = I('id');
                
                $status = intval(I('status'));
                $msg = I('msg');
                $data = array(
                              'status'=>$status,
                              'msg'=>$msg
                            );
                if ($status) {
                    $data['statusTime'] = date('Y-m-d H:i:s');
                    $data['statusUser'] = isset($_SESSION['username'])?$_SESSION['username']:'';
                }
                $Model_data = M('install');
                $res = $Model_data->where('id='.$id)->data($data)->save();
                if ($res === false) {
                    $this->error('更新失败');
                } elseif ($res === 0) {
                    $this->success('数据无变化',U("Install/".$mod));
                } else {
                    $this->success('数据更新成功',U("Install/".$mod));
                }
            } else {
                if (isset($_GET['id'])) {
                    $id = intval($_GET['id']);
                    if ($id) {
                        $Model_data = M();
                        $order = $Model_data->table('saleman_install')->where('id='.$id)->find();
                        if (!empty($order)) {
                            $this->assign('mod',$mod);
                            $this->assign('info',$order);
                            $this->display();
                        } else {
                            $this->error("查无该数据",U("Order/".$mod),1);
                        }
                    } else {
                        $this->error("查无该数据",U("Order".$mod),1);
                    }
                } else {
                    $this->error("查无数据",U("Order/".$mod),1);
                }
                
            }
        } else {
            $this->error("未登录或未授权",U("Login/index"),1);
        }
    }

    public function history(){
        if (isset($_SESSION['admin_id']) && ($_SESSION['group'] == 99 || $_SESSION['group'] == 3)) {
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
                $count = $Model_data->table('saleman_install')->where('status=1 '.$csql)->count();
                $order = $Model_data->table('saleman_install')->where('status=1 '.$csql)->order('enTime desc')->limit($first,$pageNum)->getField('id,saleman,serName,serPhone,name,phone,area,address,enTime,status,msg,statusTime');
                
                $res = array('num'=>$count,'order'=>$order,'page'=>$page,'pageNum'=>$pageNum);
                //var_dump($res);
                $this->ajaxReturn($res);
            } else {
                $Model_data = M('install');
                $saleman = $Model_data->where('status!=1')->group('salemanId')->getField('salemanId,saleman,salemanPhone');
                $this->assign('saleman',$saleman);
                $this->display();
            }
            
        } else {
            $this->error("未登录或未授权",U("Login/index"),1);
        }     
    }
}