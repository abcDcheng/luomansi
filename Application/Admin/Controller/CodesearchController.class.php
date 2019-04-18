<?php
namespace Admin\Controller;
use Think\Controller;
class CodesearchController extends Controller {
	public function index(){
        if (isset($_SESSION['admin_id']) && ($_SESSION['group'] == 99 || $_SESSION['group'] == 3 || $_SESSION['group'] == 4)) {
            $group = intval($_SESSION['group']);
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
                $count = $Model_data->table('saleman_searchcode')->where('goodsCode!="" '.$csql)->count();
                //查询数据
                $order = $Model_data->table('saleman_searchcode')->where('goodsCode!="" '.$csql)->order('id desc')->limit($first,$pageNum)->getField('id,goods,goodsModel,goodsCode,install,area,saleman,bak');
                // foreach ($order as $key => $value) {
                //     if ($value['install']) {
                //         $address = M('install')->field('loc')->where(array('goodsCode'=>array('like','%'.$value['goodscode'].'%')))->find();
                //         if (!empty($address)) {
                //             $order[$key]['installAddr'] = $address['loc'];
                //         } else {
                //             $order[$key]['installAddr'] = '';
                //         }
                //     } else {
                //         $order[$key]['installAddr'] = '';
                //     }
                // }
                $res = array('num'=>$count,'order'=>$order,'page'=>$page,'pageNum'=>$pageNum);
                //var_dump($res);
                $this->ajaxReturn($res);
            } else {
                $Model_data = M('client');
                $open = $Model_data->where('id=1')->find();
                if (!empty($open)) {
                    $open = $open['scanopen'];
                } else {
                    $open = 0;
                }
                $this->assign('open',$open);
                $this->assign('group',$group);
                $this->display();
            }
    		
    	} else {
    		$this->error("未登录或未授权",U("Login/index"),1);
    	}
	}





    public function scanopen(){
        if (isset($_SESSION['admin_id']) && ($_SESSION['group'] == 99)) {
            if (IS_AJAX) {
                $open = intval(I('open'));
                $Model_data = M('client');
                $res = $Model_data->where('id=1')->save(array('scanopen'=>$open,'enTime'=>date('Y-m-d H:i:s')));
                if ($res) {
                    $this->success('操作成功');
                } else {
                    $this->error('操作失败');
                }
            } else {
                $this->error('未知操作');
            }
            
        }
    }
}