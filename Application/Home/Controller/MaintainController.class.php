<?php
namespace Home\Controller;
use Think\Controller;
class MaintainController extends Controller {
    //未维护页面
    public function index(){
        //查询自己的为维护订单
        if (isset($_SESSION['service_id'])) {
        	$admin_id = intval($_SESSION['service_id']);
        	$Model_data = M('maintain');
        	$info = $Model_data->where("serviceStatus=0 and serviceId=".$admin_id)->order('id desc')->select();
        	//var_dump($info);
            if (empty($info)) {
                $hasInfo = 0;
            } else {
                $hasInfo = 1;
            }
            foreach ($info as $key => $value) {
                if ($value['level'] == 1) {
                    $info[$key]['orderLevel'] = '紧急服务';
                } else {
                    $info[$key]['orderLevel'] = '预约服务';
                }
            }
            $ad = A('Login');
            $ad = $ad->getAD();
            $this->assign('ad',$ad);
            $this->assign('hasInfo',$hasInfo);
        	$this->assign('info',$info);
        	$this->display();
        } else {
            redirect(U("Login/maintainLogin"));
        }
    }

    //开始执行维护
    public function startService(){
    	if (isset($_SESSION['service_id'])) {
    		if (isset($_POST['orderId'])) {
    			$serviceId = intval($_SESSION['service_id']);
    			$orderId = intval($_POST['orderId']);
    			$Model_data = M('maintain');
    			$res = $Model_data->where(array('serviceId'=>$serviceId,'id'=>$orderId))->data(array('serviceStatus'=>1,'serStartTime'=>date('Y-m-d H:i:s')))->save();
    			if ($res) {
    				$this->success('数据提交成功，请前往执行中订单查看');
    			} elseif ($res === 0) {
    				$this->error('该订单可能已开始执行，请前往执行中订单查看');
    			} else {
    				$this->error('数据更新失败，请重试');
    			}
    		} else {
    			$this->error('未接收到数据，请重试');
    		}
    	} else {
            $this->error('未检测到登录状态，请重新登录');
        }
    }

    //维护中页面
    public function service(){
        if (isset($_SESSION['service_id'])) {
        	$admin_id = intval($_SESSION['service_id']);
        	$Model_data = M('maintain');
        	$info = $Model_data->where("serviceStatus=1 and serviceId=".$admin_id)->order('id desc')->select();
        	//var_dump($info);
            if (empty($info)) {
                $hasInfo = 0;
            } else {
                $hasInfo = 1;
            }
            foreach ($info as $key => $value) {
                if ($value['level'] == 1) {
                    $info[$key]['orderLevel'] = '紧急服务';
                } else {
                    $info[$key]['orderLevel'] = '预约服务';
                }
            }
            $jssdk = A('jssdk');
            $signPackage = $jssdk->GetSignPackage();
            $this->assign('jssdk',$signPackage);
            $ad = A('Login');
            $ad = $ad->getAD();
            $this->assign('ad',$ad);
            $this->assign('hasInfo',$hasInfo);
        	$this->assign('info',$info);
        	$this->display();
        } else {
            redirect(U("Login/maintainLogin"));
        }
    }

    //完成维护
    public function completeService(){
    	if (isset($_SESSION['service_id'])) {
    		if (isset($_POST['orderId']) && isset($_POST['imgUrl'])) {
    			$base_img = str_replace('data:image/jpeg;base64,', '', $_POST['imgUrl']);
    			//$base_img = $_POST['imgUrl'];
    			$path = "./Application/Upload/";
    			$dir = "maintain";
				$prefix='lms_';
				$output_file = $prefix.time().rand(100,999).'.jpg';
				$img = $path.$dir."/".$output_file;
				if(file_put_contents($img, base64_decode($base_img))){
					$serviceId = intval($_SESSION['service_id']);
	    			$orderId = intval($_POST['orderId']);
	    			$Model_data = M('maintain');
                    $serLog = $Model_data->where(array('serviceId'=>$serviceId,'id'=>$orderId))->getField('serLog');
                    $goodsCode = I('goodsCode');
                    $serDate = I('serDate');
                    $serStartTime = I('serStartTime');
                    $serEndTime = I('serEndTime');
                    $serStatus = I('serStatus');
                    $serBak = I('serBak');
                    $logtmp = '数据记录时间：'.date('Y-m-d H:i:s')."\n";
                    $logtmp .= "服务时间：$serDate $serStartTime"."至$serEndTime"."\n";
                    $logtmp .= "产品码：$goodsCode"."\n";
                    if ($serStatus) {
                        $serviceStatus = 2;
                        $logtmp .= "维护结果：已完成"."\n";
                    } else {
                        $serviceStatus = 1;
                        $logtmp .= "维护结果：未完成"."\n";
                        $logtmp .= "未完成原因：$serBak"."\n";
                    }
                    $logtmp .= "\n";
                    $serLog .= $logtmp;
                    $data = array(
                        'serviceStatus'     =>$serviceStatus,
                        'comImg'            =>$dir."/".$output_file,
                        'serLog'            =>$serLog
                        );
	    			$res = $Model_data->where(array('serviceId'=>$serviceId,'id'=>$orderId))->data($data)->save();
	    			if ($res) {
                        if ($serStatus) {
                            $this->success('数据提交成功，请让客户等候客服回访');
                        } else {
                            $this->success('已更新维护信息');
                        }
	    				
	    			} elseif ($res === 0) {
	    				$this->error('该订单可能已执行完成，请前往已完成订单确认');
	    			} else {
	    				$this->error('数据更新失败，请重试');
	    			}
				} else {
					$this->error('图片保存失败');
				}
    			
    		} else {
    			$this->error('未接收到数据，请重试');
    		}
    	} else {
            $this->error('未检测到登录状态，请重新登录');
        }
    }

    //维护订单完成页面
    public function complete(){
        if (isset($_SESSION['service_id'])) {
            $admin_id = intval($_SESSION['service_id']);
            $Model_data = M('maintain');
            $info = $Model_data->where("serviceStatus=2 and serviceId=".$admin_id)->order('id desc')->select();
            //var_dump($info);
            if (empty($info)) {
                $hasInfo = 0;
            } else {
                $hasInfo = 1;
            }
            foreach ($info as $key => $value) {
                if ($value['level'] == 1) {
                    $info[$key]['orderLevel'] = '紧急服务';
                } else {
                    $info[$key]['orderLevel'] = '预约服务';
                }
            }
            $ad = A('Login');
            $ad = $ad->getAD();
            $this->assign('ad',$ad);
            $this->assign('hasInfo',$hasInfo);
            $this->assign('info',$info);
            $ad = A('Login');
            $ad = $ad->getAD();
            $this->assign('ad',$ad);
            $this->display();
        } else {
            redirect(U("Login/maintainLogin"));
        }
    }
}