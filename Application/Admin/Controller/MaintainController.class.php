<?php
namespace Admin\Controller;
use Think\Controller;
class MaintainController extends Controller {
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
                $pageNum = 12;
                $first=$pageNum*($page - 1);
                $Model_data = M();
                $count = $Model_data->table('saleman_maintain')->where('status!=1 '.$csql)->count();
                $order = $Model_data->table('saleman_maintain')->where('status!=1 '.$csql)->order('enTime desc')->limit($first,$pageNum)->getField('id,saleman,name,phone,address,goods,enTime,serviceName,serviceStatus,status,msg');
                
                $res = array('num'=>$count,'order'=>$order,'page'=>$page,'pageNum'=>$pageNum);
                //var_dump($res);
                $this->ajaxReturn($res);
            } else {
                $Model_data = M('maintain');
                $saleman = $Model_data->where('status!=1')->group('salemanId')->getField('salemanId,saleman,salemanPhone');
                $this->assign('saleman',$saleman);
                $this->display();
            }
            
        } else {
            $this->error("未登录或未授权",U("Login/index"),1);
        }
    }
    //新增维护订单
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
    //维护数据更新
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
                        $data['statusUser'] = isset($_SESSION['username'])?$_SESSION['username']:'';
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
    //数据删除
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
    //代理商查看维护信息
    public function salemanIndex(){
        if (isset($_SESSION['admin_id']) && $_SESSION['group'] == 1) {
            $admin_id = intval($_SESSION['admin_id']);
            if (IS_AJAX) {
                $csql='';
                $ra=array();
                $page=1;
                if(isset($_POST['serviceStatus']) && $_POST['serviceStatus'] !== ''){
                    $serviceStatus=intval($_POST['serviceStatus']);
                    $csql.="and serviceStatus='$serviceStatus' ";
                    
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
                $pageNum = 12;
                $first=$pageNum*($page - 1);
                $Model_data = M();
                $count = $Model_data->table('saleman_maintain')->where('salemanId='.$admin_id.' '.$csql)->count();
                $order = $Model_data->table('saleman_maintain')->where('salemanId='.$admin_id.' '.$csql)->order('enTime desc')->limit($first,$pageNum)->getField('id,saleman,name,phone,address,goods,enTime,serviceName,serviceStatus,status,msg');
                
                $res = array('num'=>$count,'order'=>$order,'page'=>$page,'pageNum'=>$pageNum);
                //var_dump($res);
                $this->ajaxReturn($res);
            } else {
                $Model_data = M('maintain');
                //$saleman = $Model_data->where('1')->group('salemanId')->getField('salemanId,saleman,salemanPhone');
                $this->assign('saleman',$saleman);
                $this->display();
            }
        } else {
            $this->error("未登录或未授权",U("Login/index"),1);
        }
    }
    //指定维护人员
    public function salemanUpdate(){
        if (isset($_SESSION['admin_id']) && $_SESSION['group'] == 1) {
            if (isset($_REQUEST['id'])) {
                $id = intval($_REQUEST['id']);
                if (IS_AJAX) {
                    $admin_id = $_SESSION['admin_id'];
                    $serviceId = I('servicer');
                    $oldServicer = I('oldServicer');
                    $Model_data = M();
                    $status = $Model_data->table('saleman_maintain')->where('id='.$id)->getField('status');
                    if ($status == 1) {
                        $this->error('本维护订单已完成维护，不能再做修改');
                    }
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
                $pageNum = 12;
                $first=$pageNum*($page - 1);
                $Model_data = M();
                $count = $Model_data->table('saleman_maintain')->where('status=1 '.$csql)->count();
                $order = $Model_data->table('saleman_maintain')->where('status=1 '.$csql)->order('enTime desc')->limit($first,$pageNum)->getField('id,saleman,name,phone,address,goods,enTime,serviceName,serviceStatus,status,msg');
                
                $res = array('num'=>$count,'order'=>$order,'page'=>$page,'pageNum'=>$pageNum);
                //var_dump($res);
                $this->ajaxReturn($res);
            } else {
                $Model_data = M('maintain');
                $saleman = $Model_data->where('status=1')->group('salemanId')->getField('salemanId,saleman,salemanPhone');
                $this->assign('saleman',$saleman);
                $this->display();
            }
        }
    }

    public function download(){
        if (isset($_SESSION['admin_id']) && ($_SESSION['group'] == 99 || $_SESSION['group'] == 3)) {
            import("Org.Util.PHPExcel");
            import("Org.Util.PHPExcel.Writer.Excel5");
            import("Org.Util.PHPExcel.IOFactory.php");
            
            if (isset($_GET['id'])) {
                $csql = '1 ';
                $id = intval(I('id'));
                $csql .= ' and id='.$id;
            } else {
                $csql = 'status = 1 ';
                if(isset($_GET['saleman'])){
                    $saleman=intval($_GET['saleman']);
                    if($saleman){
                        $csql.="and salemanId='$saleman' ";
                    }
                }
                if(isset($_GET['firsttime'])){
                    $firsttime=$_GET['firsttime'];
                    if($firsttime){
                        $firsttime=str_replace(".", "-", $firsttime);
                        $csql.="and enTime>='$firsttime' ";
                    }
                }
                if(isset($_GET['lasttime'])){
                    $lastttime=$_GET['lasttime'];
                    if($lastttime){
                        $lastttime=str_replace(".", "-", $lastttime);
                        $lastttime=strtotime($lastttime)+86400;
                        $lastttime=date("Y-m-d",$lastttime);
                        $csql.="and enTime<='$lastttime' ";
                    }
                }
            }
            $Model_data = M('maintain');
            $info = $Model_data->where($csql)->order('enTime desc')->select();
            if (!empty($info)) {
                //var_dump($info);
                $date = date("Y_m_d",time());
                $fileName .= "_{$date}.xls";
                //创建PHPExcel对象，注意，不能少了\
                $objPHPExcel = new \PHPExcel();
                $objProps = $objPHPExcel->getProperties();
                $headArr = array('发布人','用户姓名','联系方式','详细地址','维护产品','维护信息','负责代理商','代理商电话','创建时间','维护人员','维护人员电话','维护状态','开始维护时间','完成维护时间','回访状态','回访人员','回访时间');
                //设置表头
                $key = ord("A");
                foreach($headArr as $v){
                    $colum = chr($key);
                    $objPHPExcel->setActiveSheetIndex(0) ->setCellValue($colum.'1', $v);
                    $key += 1;
                }
                $i = 2;
                //$objActSheet = $objPHPExcel->getActiveSheet();
                foreach($info as $key => $row){ //行写入
                    $objPHPExcel->getActiveSheet()->setCellValue('A'.$i,$row['username']);
                    $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,$row['name']);
                    $objPHPExcel->getActiveSheet()->setCellValue('C'.$i,$row['phone']);
                    $objPHPExcel->getActiveSheet()->setCellValue('D'.$i,$row['address']);
                    $objPHPExcel->getActiveSheet()->setCellValue('E'.$i,$row['goods']);
                    $objPHPExcel->getActiveSheet()->setCellValue('F'.$i,$row['msg']);
                    $objPHPExcel->getActiveSheet()->setCellValue('G'.$i,$row['saleman']);
                    $objPHPExcel->getActiveSheet()->setCellValue('H'.$i,$row['salemanphone']);
                    $objPHPExcel->getActiveSheet()->setCellValue('I'.$i,$row['entime']);
                    $objPHPExcel->getActiveSheet()->setCellValue('J'.$i,$row['servicename']);
                    $objPHPExcel->getActiveSheet()->setCellValue('K'.$i,$row['servicephone']);
                    if ($row['servicestatus'] == 0) {
                        $status = '未维护';
                    } elseif ($row['servicestatus'] == 1) {
                        $status = '维护中';
                    } elseif ($row['servicestatus'] == 2) {
                        $status = '已完成';
                    }
                    $objPHPExcel->getActiveSheet()->setCellValue('L'.$i,$status);
                    $objPHPExcel->getActiveSheet()->setCellValue('M'.$i,$row['serstarttime']);
                    $objPHPExcel->getActiveSheet()->setCellValue('N'.$i,$row['serendtime']);
                    if ($row['status'] == 0) {
                        $status = '未回访';
                    } elseif ($row['status'] == 1) {
                        $status = '已回访';
                    } elseif ($row['status'] == 2) {
                        $status = '服务异常';
                    }
                    $objPHPExcel->getActiveSheet()->setCellValue('O'.$i,$status);
                    $objPHPExcel->getActiveSheet()->setCellValue('P'.$i,$row['statususer']);
                    $objPHPExcel->getActiveSheet()->setCellValue('Q'.$i,$row['endtime']);
                    $i++;
                }
                //保存excel—2007格式
                $objWriter = new \PHPExcel_Writer_Excel2007($objPHPExcel);
                $filename="维护管理统计".date("Y-m-d").".xlsx";
                //或者$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); 非2007格式
                header("Pragma: public");
                header("Expires: 0");
                header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
                header("Content-Type:application/force-download");
                header("Content-Type:application/vnd.ms-execl");
                header("Content-Type:application/octet-stream");
                header("Content-Type:application/download");
                header('Content-Disposition:attachment;filename="'.$filename);
                header("Content-Transfer-Encoding:binary");
                $objWriter->save("php://output");
            } else {
                $this->error('查无数据');
            }
        } else {
            $this->error("未登录或未授权",U("Login/index"),1);
        }
    }
}