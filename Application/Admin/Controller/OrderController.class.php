<?php
namespace Admin\Controller;
use Think\Controller;
class OrderController extends Controller {
    //获取订单数据
    public function index(){
    	if (isset($_SESSION['admin_id']) && ($_SESSION['group'] == 99 || $_SESSION['group'] == 2)) {
            if (IS_AJAX) {
                $csql='';
                $ra=array();
                $page=1;
                //按订单号查询
                if(isset($_POST['orderCode'])){
                    $orderCode=trim($_POST['orderCode']);
                    if($orderCode){
                        $csql.="and orderCode like '%$orderCode%' ";
                    }
                }
                //是否按代理商查询
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
                $pageNum = 8;   //分页每页数目
                $first=$pageNum*($page - 1);
                $Model_data = M();
                $count = $Model_data->table('saleman_order')->where('status!=1 '.$csql)->count();
                $order = $Model_data->table('saleman_order')->where('status!=1 '.$csql)->order('enTime desc')->limit($first,$pageNum)->getField('id,salemanId,saleman,orderCode,phone,address,orderBak,enTime,status,msg,statusTime');
                //echo $Model_data->getLastSql();
                //var_dump($order);
                if (!empty($order)) {
                    //获取订单ID，用来查询订单产品信息
                    $ids = array();
                    foreach($order as $key=>$value){
                        $ids[] = $key;
                        $order[$key]['detail'] = array();
                    }
                    $ids = implode(',', $ids);
                    //查询出订单产品信息，并对应入订单
                    $shop = $Model_data->table('saleman_shopcar')->where("orderId in ($ids)")->select();
                    for($j = 0;$j < count($shop);$j++){
                        $order[$shop[$j]['orderid']]['detail'][] = $shop[$j];
                    }
                }
                $res = array('num'=>$count,'order'=>$order,'page'=>$page,'pageNum'=>$pageNum);
                //var_dump($res);
                $this->ajaxReturn($res);
            } else {
                $Model_data = M('order');
                $Model_data->where('isNew=0')->data(array('isNew'=>1))->save();
                $Model_data = M('SysAdmin');
                $saleman = $Model_data->where('`group`=1')->order('province asc,city asc')->field('id,name,province,city')->select();
                $this->assign('saleman',$saleman);
                $this->display();
            }
    		
    	} else {
    		$this->error("未登录或未授权",U("Login/index"),1);
    	}
    }
    //更新订单状态
    public function update(){
        if (isset($_SESSION['admin_id']) && ($_SESSION['group'] == 99 || $_SESSION['group'] == 2)) {
            //判断来自哪个页面的请求，用于链接返回
            if (isset($_REQUEST['mod'])) {
                $mod = $_REQUEST['mod'];
            } else {
                $mod = 'index';
            }
            if (IS_AJAX) {
                $id = I('id');
                $phone = I('phone');
                $address = I('address');
                $orderBak = I('orderbak');
                $status = intval(I('status'));
                //若订单未通过，记录订单反馈信息
                if ($status == 2) {
                    $msg = I('msg');
                } else {
                    $msg = '';
                }
                $data = array('phone'=>$phone,
                              'address'=>$address,
                              'orderBak'=>$orderBak,
                              'status'=>$status,
                              'msg'=>$msg
                            );
                //订单审核，记录订单时间和操作人员账户
                if ($status) {
                    $data['statusTime'] = date('Y-m-d H:i:s');
                }
                $data['statusUser'] = isset($_SESSION['username'])?$_SESSION['username']:'';
                $Model_data = M('order');
                $res = $Model_data->where('id='.$id)->data($data)->save();
                if ($res === false) {
                    $this->error('更新失败');
                } elseif ($res === 0) {
                    $this->success('数据无变化',U("Order/".$mod));
                } else {
                    $this->success('数据更新成功',U("Order/".$mod));
                }
            } else {
                if (isset($_GET['id'])) {
                    $id = intval($_GET['id']);
                    if ($id) {
                        //查询订单所有信息
                        $Model_data = M();
                        $order = $Model_data->table('saleman_order')->where('id='.$id)->find();
                        if (!empty($order)) {
                            $model = $Model_data->table('saleman_shopcar')->where('orderId='.$id)->select();
                            $this->assign('mod',$mod);
                            $this->assign('info',$order);
                            $this->assign('model',$model);
                            $this->display();
                        } else {
                            $this->error("查无该订单数据",U("Order/".$mod),1);
                        }
                    } else {
                        $this->error("查无该订单数据",U("Order/".$mod),1);
                    }
                } else {
                    $this->error("查无订单数据",U("Order/".$mod),1);
                }
                
            }
        } else {
            $this->error("未登录或未授权",U("Login/index"),1);
        }
    }
    //历史订单页面
    public function history(){
        if (isset($_SESSION['admin_id']) && ($_SESSION['group'] == 99 || $_SESSION['group'] == 2)) {
            if (IS_AJAX) {
                $csql='';
                $ra=array();
                $page=1;
                //按订单号查询
                if(isset($_POST['orderCode'])){
                    $orderCode=trim($_POST['orderCode']);
                    if($orderCode){
                        $csql.="and orderCode like '%$orderCode%' ";
                    }
                }
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
                $pageNum = 8;
                $first=$pageNum*($page - 1);
                $Model_data = M();
                $count = $Model_data->table('saleman_order')->where('status=1 '.$csql)->count();
                $order = $Model_data->table('saleman_order')->where('status=1 '.$csql)->order('enTime desc')->limit($first,$pageNum)->getField('id,salemanId,saleman,orderCode,phone,address,orderBak,enTime,status,msg,statusTime');;
                //var_dump($res);
                if (!empty($order)) {
                    $ids = array();
                    foreach($order as $key=>$value){
                        $ids[] = $key;
                        $order[$key]['detail'] = array();
                    }
                    $ids = implode(',', $ids);
                    $shop = $Model_data->table('saleman_shopcar')->where("orderId in ($ids)")->select();
                    for($j = 0;$j < count($shop);$j++){
                        $order[$shop[$j]['orderid']]['detail'][] = $shop[$j];
                    }
                }
                $res = array('num'=>$count,'order'=>$order,'page'=>$page,'pageNum'=>$pageNum);
                //var_dump($res);
                $this->ajaxReturn($res);
            } else {
                $Model_data = M('SysAdmin');
                $saleman = $Model_data->where('`group`=1')->order('province asc,city asc')->field('id,name,province,city')->select();
                $this->assign('saleman',$saleman);
                $this->display();
            }
            
        } else {
            $this->error("未登录或未授权",U("Login/index"),1);
        }        
    }

    //导出
    public function download(){
        if (isset($_SESSION['admin_id']) && ($_SESSION['group'] == 99 || $_SESSION['group'] == 2)) {
            import("Org.Util.PHPExcel");
            import("Org.Util.PHPExcel.Writer.Excel5");
            import("Org.Util.PHPExcel.IOFactory.php");
            
            if (isset($_GET['id'])) {
                $csql = '1 ';
                $id = intval(I('id'));
                $csql .= ' and id='.$id;
            } else {
                $csql = 'status = 1 ';
                //按订单号查询
                if(isset($_POST['orderCode'])){
                    $orderCode=trim($_POST['orderCode']);
                    if($orderCode){
                        $csql.="and orderCode like '%$orderCode%' ";
                    }
                }
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
            $Model_data = M('order');
            $info = $Model_data->where($csql)->order('enTime desc')->getField('id,salemanId,saleman,orderCode,phone,address,orderBak,enTime,status,msg,statusTime');
            if (!empty($info)) {
                $ids = array();
                foreach($info as $key=>$value){
                    $ids[] = $key;
                    $info[$key]['detail'] = array();
                }
                $ids = implode(',', $ids);
                $Model_data = M();
                $shop = $Model_data->table('saleman_shopcar')->where("orderId in ($ids)")->select();
                for($j = 0;$j < count($shop);$j++){
                    $info[$shop[$j]['orderid']]['detail'][] = $shop[$j];
                }
                //var_dump($info);
                //创建PHPExcel对象，注意，不能少了\
                $objPHPExcel = new \PHPExcel();
                $objProps = $objPHPExcel->getProperties();
                $headArr = array('订单号','代理商','联系方式','送货地址','订单详情','订单备注','下单时间','受理状态','受理时间','信息反馈','回访人员');
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
                    $objPHPExcel->getActiveSheet()->setCellValue('A'.$i,$row['ordercode']);
                    $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,$row['saleman']);
                    $objPHPExcel->getActiveSheet()->setCellValue('C'.$i,$row['phone']);
                    $objPHPExcel->getActiveSheet()->setCellValue('D'.$i,$row['address']);
                    $detail = array();
                    for($j=0;$j<count($row['detail']);$j++){
                        $model = $row['detail'][$j]['goodsname']."-".$row['detail'][$j]['goodsmodel']." ×".$row['detail'][$j]['goodsnum'];
                        $detail[] = $model;
                    } 
                    $detailStr = implode("\n",$detail);
                    $objPHPExcel->getActiveSheet()->setCellValue('E'.$i,$detailStr);
                    $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getAlignment()->setWrapText(true);
                    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(40);
                    $objPHPExcel->getActiveSheet()->setCellValue('F'.$i,$row['orderbak']);
                    $objPHPExcel->getActiveSheet()->setCellValue('G'.$i,$row['entime']);
                    if ($row['status'] == 2) {
                        $status = '未通过';
                    } elseif ($row['status'] == 1) {
                        $status = '已受理';
                    } else {
                        $status = '未受理';
                    }
                    $objPHPExcel->getActiveSheet()->setCellValue('H'.$i,$status);
                    $objPHPExcel->getActiveSheet()->setCellValue('I'.$i,$row['statustime']);
                    $objPHPExcel->getActiveSheet()->setCellValue('J'.$i,$row['msg']);
                    $objPHPExcel->getActiveSheet()->setCellValue('K'.$i,$row['statususer']);
                    
                    $i++;
                }
                //保存excel—2007格式
                $objWriter = new \PHPExcel_Writer_Excel2007($objPHPExcel);
                $filename="代理商订单统计".date("Y-m-d").".xlsx";
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