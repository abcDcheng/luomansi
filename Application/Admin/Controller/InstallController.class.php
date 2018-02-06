<?php
namespace Admin\Controller;
use Think\Controller;
class InstallController extends Controller {
    //安装管理页
    public function index(){
    	if (isset($_SESSION['admin_id']) && ($_SESSION['group'] == 99 || $_SESSION['group'] == 3)) {
            if (IS_AJAX) {
                $csql='';
                $ra=array();
                $page=1;
                //按代理商查询
                if(isset($_POST['saleman'])){
                    $saleman=intval($_POST['saleman']);
                    if($saleman){
                        $csql.="and salemanId='$saleman' ";
                    }
                }
                //按时间查询
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
                $pageNum = 12;//分页每页数量
                $first=$pageNum*($page - 1);
                $Model_data = M();
                //查询数据总数
                $count = $Model_data->table('saleman_install')->where('status!=1 '.$csql)->count();
                //查询数据
                $order = $Model_data->table('saleman_install')->where('status!=1 '.$csql)->order('enTime desc')->limit($first,$pageNum)->getField('id,saleman,serName,serPhone,name,phone,area,address,enTime,status,msg,statusTime');
                
                $res = array('num'=>$count,'order'=>$order,'page'=>$page,'pageNum'=>$pageNum);
                //var_dump($res);
                $this->ajaxReturn($res);
            } else {
                $Model_data = M('install');
                $Model_data->where('isNew=0')->data(array('isNew'=>1))->save();
                $saleman = $Model_data->where('status!=1')->group('salemanId')->getField('salemanId,saleman,salemanPhone');
                $this->assign('saleman',$saleman);
                $this->display();
            }
    		
    	} else {
    		$this->error("未登录或未授权",U("Login/index"),1);
    	}
    }

    //安装回访更新
    public function update(){
        if (isset($_SESSION['admin_id']) && ($_SESSION['group'] == 99 || $_SESSION['group'] == 3)) {
            //判断是从订单管理页还是历史订单页访问
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
                if ($status) {  //若有回访，记录回访时间及回访人员账号
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
                if (isset($_GET['id'])) {   //获取订单数据
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

    //安装统计
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
                $count = $Model_data->table('saleman_install')->where('status=1 '.$csql)->count();
                $order = $Model_data->table('saleman_install')->where('status=1 '.$csql)->order('enTime desc')->limit($first,$pageNum)->getField('id,saleman,serName,serPhone,name,phone,area,address,enTime,status,msg,statusTime');
                
                $res = array('num'=>$count,'order'=>$order,'page'=>$page,'pageNum'=>$pageNum);
                //var_dump($res);
                $this->ajaxReturn($res);
            } else {
                $Model_data = M('install');
                $saleman = $Model_data->where('status=1')->group('salemanId')->getField('salemanId,saleman,salemanPhone');
                $this->assign('saleman',$saleman);
                $this->display();
            }
            
        } else {
            $this->error("未登录或未授权",U("Login/index"),1);
        }     
    }

    //导出
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
            $Model_data = M('install');
            $info = $Model_data->where($csql)->order('enTime desc')->select();
            if (!empty($info)) {
                //var_dump($info);
                $date = date("Y_m_d",time());
                $fileName .= "_{$date}.xls";
                //创建PHPExcel对象，注意，不能少了\
                $objPHPExcel = new \PHPExcel();
                $objProps = $objPHPExcel->getProperties();
                $headArr = array('安装人员','手机','归属代理商','新用户姓名','联系方式','地区','详细地址','完成时间','回访状态','信息反馈','回访人员','回访时间');
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
                    $objPHPExcel->getActiveSheet()->setCellValue('A'.$i,$row['sername']);
                    $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,$row['serphone']);
                    $objPHPExcel->getActiveSheet()->setCellValue('C'.$i,$row['saleman']);
                    $objPHPExcel->getActiveSheet()->setCellValue('D'.$i,$row['name']);
                    $objPHPExcel->getActiveSheet()->setCellValue('E'.$i,$row['phone']);
                    $objPHPExcel->getActiveSheet()->setCellValue('F'.$i,$row['area']);
                    $objPHPExcel->getActiveSheet()->setCellValue('G'.$i,$row['address']);
                    $objPHPExcel->getActiveSheet()->setCellValue('H'.$i,$row['entime']);
                    if ($row['status']) {
                        $status = '已回访';
                    } else {
                        $status = '未回访';
                    }
                    $objPHPExcel->getActiveSheet()->setCellValue('I'.$i,$status);
                    $objPHPExcel->getActiveSheet()->setCellValue('J'.$i,$row['msg']);
                    $objPHPExcel->getActiveSheet()->setCellValue('K'.$i,$row['statususer']);
                    $objPHPExcel->getActiveSheet()->setCellValue('L'.$i,$row['statustime']);
                    $i++;
                }
                //保存excel—2007格式
                $objWriter = new \PHPExcel_Writer_Excel2007($objPHPExcel);
                $filename="安装管理统计".date("Y-m-d").".xlsx";
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