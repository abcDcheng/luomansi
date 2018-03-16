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
                $order = $Model_data->table('saleman_code')->where('goodsCode!="" '.$csql)->order('id desc')->limit($first,$pageNum)->getField('id,goods,goodsModel,goodsCode,install');
                
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
                $install = intval(I('install'));
                $Model_data = M('code');
                //判断产品码是否已录入
                $count = $Model_data->where("goodsCode='$goodsCode'")->count();
                if ($count > 0) {
                    $this->error('该识别码已存在',U('Code/add'));
                } else {
                    $insertData = array('goods'=>$goods,
                                        'goodsModel'=>$goodsModel,
                                        'goodsCode'=>$goodsCode,
                                        'install'=>$install,
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

    //修改识别码信息
    public function update(){
        if (isset($_SESSION['admin_id']) && $_SESSION['group'] == 99) {
            if (isset($_REQUEST['id'])) {
                $id = intval(I('id'));
                if (IS_AJAX) {
                    $goods = I('goods');
                    $goodsModel = I('goodsModel');
                    $goodsCode = I('goodsCode');
                    $oldCode = I('oldCode');
                    $install = intval(I('install'));
                    $Model_data = M('code');
                    if ($goodsCode != $oldCode) {
                        //判断产品码是否已注册
                        $count = $Model_data->where("goodsCode='$goodsCode'")->count();
                        if ($count > 0) {
                            $this->error('该识别码已存在',U('Code/index'));
                        }
                    }
                    $insertData = array('goods'=>$goods,
                                        'goodsModel'=>$goodsModel,
                                        'goodsCode'=>$goodsCode,
                                        'install'=>$install,
                                        'createTime'=>date('Y-m-d H:i:s'));
                    //var_dump($insertData);
                    $res = $Model_data->where('id='.$id)->save($insertData);
                    if ($res) {
                        $this->success('修改成功',U('Code/index'),'add');
                    } else {
                        $this->error('修改失败，请重试或联系技术人员解决');
                    }
                    
                } else {
                    //查询识别码信息
                    $Model_data = M('code');
                    $info = $Model_data->where('id='.$id)->find();
                    $this->assign('id',$id);
                    $this->assign('info',$info);
                    $this->display();
                }
                
            } else {
                $this->error("查无数据",U("Code/index"),3);
            }
        } else {
            $this->error("未授权",U("Login/index"),3);
        }
    }

    //数据删除
    public function del(){
        if (isset($_SESSION['admin_id']) && $_SESSION['group'] == 99) {
            if (isset($_POST['id'])) {
                $id = intval($_POST['id']);
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

    //使用exccel导入识别码
    public function export(){
        if (isset($_SESSION['admin_id']) && $_SESSION['group'] == 99) {
            $this->display();
        } else {
            $this->error("未授权",U("Login/index"),3);
        }
    }

    //获取上传的excel
    public function excelUpload(){
        if (isset($_SESSION['admin_id']) && $_SESSION['group'] == 99) {
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     10485760 ;// 设置附件上传大小
            $upload->exts      =     array('xls','xlsx');// 设置附件上传类型
            $upload->rootPath  =      './Application/Upload/excel/'; // 设置附件上传根目录
            $upload->savePath  =     ''; // 设置附件上传（子）目录
            $upload->autoSub   = false;
            // 上传单个文件 
            $info   =   $upload->uploadOne($_FILES['file']);
            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }else{// 上传成功 获取上传文件信息
                $exts   = $info['ext'];// 获取文件后缀
                $filename = $upload->rootPath.$info['savename']; // 生成文件路径名
                import("Org.Util.PHPExcel");
                $PHPExcel = new \PHPExcel();                                // 创建PHPExcel对象，注意，不能少了\
                if ($exts == 'xls') {
                    import("Org.Util.PHPExcel.Reader.Excel5");
                    $PHPReader = new \PHPExcel_Reader_Excel5();
                } elseif ($exts == 'xlsx') {
                    import("Org.Util.PHPExcel.Reader.Excel2007");
                    $PHPReader = new \PHPExcel_Reader_Excel2007();
                }
                //import("Org.Util.PHPExcel.IOFactory.php");

                $PHPExcel=$PHPReader->load($filename);
                $currentSheet = $PHPExcel->getSheet(0);                      // 获取表中的第一个工作表，如果要获取第二个，把0改为1，依次类推
                $allColumn = $currentSheet->getHighestColumn();              // 获取总列数
                $allRow = $currentSheet->getHighestRow();                    // 获取总行数
                $data_p = array();
                for ($i = 2,$j = 0; $i <= $allRow; $i++,$j++) {
                    $data_p[$j]['goods'] =$PHPExcel->getActiveSheet()->getCell("A" . $i)->getValue();
                    $data_p[$j]['goodsModel'] =$PHPExcel->getActiveSheet()->getCell("B" .$i)->getValue();
                    $data_p[$j]['goodsCode'] =$PHPExcel->getActiveSheet()->getCell("C" .$i)->getValue();
                    $data_p[$j]['goodsCode'] = str_replace(' ','',$data_p[$j]['goodsCode']);
                    $data_p[$j]['install'] =$PHPExcel->getActiveSheet()->getCell("D" .$i)->getValue();
                    $data_p[$j]['enTime'] = date('Y-m-d H:i:s');
                }
                $res['allRow'] = $allRow - 1;
                $res['code'] = 1;
                $res['info'] = $data_p;
                session('codeData',$data_p);
                unlink($filename);
                echo json_encode($res);
            }
        } else {
            $this->error("未授权",U("Login/index"),3);
        }
        
    }

    public function codeRecord(){
        if (isset($_SESSION['admin_id']) && $_SESSION['group'] == 99) {
            if (isset($_SESSION['codeData']) && !empty($_SESSION['codeData'])) {
                $code = $_SESSION['codeData'];
                $res = M('code')->addAll($code);
                if ($res) {
                    unset($_SESSION['codeData']);
                    $this->success('添加成功！',U('Code/index'));
                } else {
                    $this->error('添加失败，请检查文件是否错误');
                }
            } else {
                $this->error("未获取到数据，请上传正确的Excel文件");
            }
        } else {
            $this->error("未授权",U("Login/index"),3);
        }
    }
}