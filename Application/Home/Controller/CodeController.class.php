<?php
namespace Home\Controller;
use Think\Controller;
class CodeController extends Controller {
    public function index(){
    	$ad = A('Login');
        $ad = $ad->getAD();
        $jssdk = A('jssdk');
        $signPackage = $jssdk->GetSignPackage();
    	$model_data = M();
    	$open = $model_data->table('saleman_client')->where('id=1')->find();
    	if (!empty($open)) {
    		$open = $open['scanopen'];
    	}
        $this->assign('jssdk',$signPackage);
    	$this->assign('ad',$ad);
    	$this->assign('open',$open);
        $this->display();
    }

    public function codesearch(){
    	if (IS_AJAX) {
    		$code = str_replace(' ','',I('code'));
	    	$code = str_replace('%','',$code);
	    	if (!$code) {
	    		$this->error('请输入识别码');
	    	}
            if (strlen($code)<10) {
                $this->error('产品码长度必须大于10');
            }
	    	$model_data = M();
	    	
            $info = $model_data->table('saleman_code')->where(array('goodsCode'=>array('like','%'.$code.'%')))->find();
            if (!empty($info)) {
                $arr = array('code'=>1);
                $arr['goods'] = $info;
                $this->ajaxReturn($arr);
	    		
	    	} else {
                $this->error('查找不到该识别码');
            }
            
    	} else {
			$this->error('未知操作');
    	}
    	
    }
}