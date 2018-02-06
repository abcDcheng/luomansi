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
	    			$res = $Model_data->where(array('serviceId'=>$serviceId,'id'=>$orderId))->data(array('serviceStatus'=>2,'comImg'=>$dir."/".$output_file,'serEndTime'=>date('Y-m-d H:i:s')))->save();
	    			if ($res) {
	    				$this->success('数据提交成功，请让客户等候客服回访');
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
            $this->assign('hasInfo',$hasInfo);
            $this->assign('info',$info);
            $this->display();
        } else {
            redirect(U("Login/maintainLogin"));
        }
    }
}