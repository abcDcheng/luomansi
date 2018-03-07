<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--
* @Author: defaultFish
* @Date:   2017-12-12 00:00:00
* +
* | siteCMS [ siteCMS网站内容管理系统 ]
* | Copyright (c) 2017 https://www.sitecms.cn All rights reserved.
* | Licensed ( https://www.sitecms.cn/licenses/ )
* | Author: defaultfish <defaultfish@qq.com>
* +
-->
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/luomansi/Application/Admin/Public/plugs/layui/css/layui.css">
    <link rel="stylesheet" href="/luomansi/Application/Admin/Public/css/font-awesome.min.css">
    <link rel="stylesheet" href="/luomansi/Application/Admin/Public/css/animate.css">
    <link rel="stylesheet" href="/luomansi/Application/Admin/Public/css/sitecms.css">
    <script src="/luomansi/Application/Admin/Public/plugs/layui/layui.js"></script>
    <script src="/luomansi/Application/Admin/Public/plugs/ueditor/ueditor.config.js"></script>
    <script src="/luomansi/Application/Admin/Public/plugs/ueditor/ueditor.all.js"></script>
    <!-- <script src="/luomansi/Application/Admin/Public/plugs/static/base/js/jquery.cookie.js"></script> -->
    <script src="/luomansi/Application/Admin/Public/js/jquery.min.js"></script>
    <!-- <script src="/luomansi/Application/Admin/Public/plugs/uploadify/jquery.uploadify.min.js"></script> -->
    <script src="/luomansi/Application/Admin/Public/js/validform.js"></script>
    <script src="/luomansi/Application/Admin/Public/js/sitecms.js"></script>
    <script src="/luomansi/Application/Admin/Public/plugs/layui/lay/modules/laydate.js"></script>
    <!-- <script src="/luomansi/Application/Admin/Public/js/jquery.photoClip.min.js"></script> -->
    <!-- 让IE8/9支持媒体查询 -->
	<!--[if lt IE 9]>
		<script src="./js/html5shiv.min.js"></script>
		<script src="./js/respond.min.js"></script>
	<![endif]-->
    <title>产品信息更新</title>
</head>
<body>

<div class="layui-layout-admin">
    <div class="layui-tab sc_side_tab" lay-filter="nav">
    
    <ul class="layui-tab-title">
        <li class="layui-this">
            <div class="sc_side_manage" style="background-image:url('/luomansi/Application/Admin/Public/images/male.png');"></div>
            
        </li>
        <style type="text/css">
			#orderNum,#installNum{
				color:red;
			}
        </style>
        <dl class="layui-nav layui-nav-tree sc_side_more">
            <dd class="layui-nav-item layui-nav-itemed">
                <dl class="layui-nav-child">

				<?php if (isset($_SESSION['group'])) { $group = $_SESSION['group']; if ($group == 1) { ?>
				<dd><a href="<?php echo U('Saleman/staff');?>">人员管理</a></dd>
				<!-- <dd><a href="#">历史订单</a></dd> -->
				<dd><a href="<?php echo U('Saleman/installIndex');?>">安装管理</a></dd>
				<dd><a href="<?php echo U('Maintain/salemanIndex');?>">维护管理</a></dd>
				<?php } elseif ($group == 2) { ?>
				<dd><a href="<?php echo U('Order/index');?>">订单管理<span id="orderNum"></span></a></dd>
				<dd><a href="<?php echo U('Order/history');?>">历史订单</a></dd>
				<?php } elseif ($group == 3) { ?>	
				<dd><a href="<?php echo U('Install/index');?>">安装管理<span id="installNum"></span></a></dd>
				<dd><a href="<?php echo U('Install/history');?>">安装统计</a></dd>
				<dd><a href="<?php echo U('Maintain/index');?>">维护管理</a></dd>
				<dd><a href="<?php echo U('Maintain/history');?>">维护统计</a></dd>
				<?php } elseif ($group == 99) { ?>	
				<dd><a href="<?php echo U('Admin/ad');?>">手机广告语</a></dd>
				<dd><a href="<?php echo U('Admin/index');?>">专员管理</a></dd>
				<dd><a href="<?php echo U('Saleman/index');?>">代理商管理</a></dd>
				<dd><a href="<?php echo U('Admin/servicer');?>">代理商人员</a></dd>
				<dd><a href="<?php echo U('Goods/index');?>">产品管理</a></dd>
				<dd><a href="<?php echo U('Code/index');?>">识别码管理</a></dd>
				<dd><a href="<?php echo U('Order/index');?>">订单管理<span id="orderNum"></span></a></dd>
				<dd><a href="<?php echo U('Order/history');?>">历史订单</a></dd>
				<dd><a href="<?php echo U('Install/index');?>">安装管理<span id="installNum"></span></a></dd>
				<dd><a href="<?php echo U('Install/history');?>">安装统计</a></dd>
				<dd><a href="<?php echo U('Maintain/index');?>">维护管理</a></dd>
				<dd><a href="<?php echo U('Maintain/history');?>">维护统计</a></dd>
				<?php } } ?>
				<dd><a href="<?php echo U('Index/pwd');?>">密码修改</a></dd>
				<dd><a id="loginout" href="<?php echo U('Index/loginout');?>">退出登录</a></dd>
                </dl> 
            </dd>
        </dl>
    </ul>


    <script type="text/javascript">
    	var getOrder = 0;
    	var getInstall = 0;
    	<?php if (isset($_SESSION['group'])) { $group = $_SESSION['group']; if ($group == 1) { ?>
				
		<?php } elseif ($group == 2) { ?>
				getOrder = 1;
				getNew();
				setInterval(getNew,10000);
		<?php } elseif ($group == 3) { ?>
				getInstall = 1;
				getNew();
				setInterval(getNew,10000);
		<?php } elseif ($group == 99) { ?>
				getOrder = 1;
				getInstall = 1;
				getNew();
				setInterval(getNew,10000);
		<?php } } ?>



		function getNew(){
			$.ajax({
				url : '<?php echo U("Index/getNew");?>',
				type : "post",
	            data : {getOrder:getOrder,getInstall:getInstall},
	            dataType : "json",
	            timeout : 5000,
	            success:function(data) {
	            	if (data.code == 1) {
	            		if (data.orderNum>0) {
	            			$('#orderNum').text('('+data.orderNum+')');
	            		} else {
	            			$('#orderNum').text('');
	            		}
	            		if (data.installNum>0) {
	            			$('#installNum').text('('+data.installNum+')');
	            		} else {
	            			$('#installNum').text('');
	            		}
	            	}
	            }
			});
		}
    </script>
    </div>
    <div class="layui-body" id="sc_body">
        <div class="sc_body">
            <form action="<?php echo U('Goods/goodsUpdate');?>" id="form" class="layui-form layui-form-pane" enctype="multipart/form-data">
                <div class="sc_title sc_body_title">
                    <h5>产品信息更新</h5>
                    <div class="sc_title_btn">
                        <button id="save" type="submit" class='layui-btn layui-btn-sm'><i class='layui-icon'>&#xe605;</i> 保存</button>
                        <a class='layui-btn layui-btn-sm layui-btn-primary' href="<?php echo U('Goods/index');?>"><i class="layui-icon">&#x1006;</i> 返回</a>
                    </div>
                </div>
                <div class="fadeInUp animated">
                    <section class="sc_layout_inner layui-clear">
                        <div class="sc_editor_content">
                        <input type="hidden" name="id" value="<?php echo ($goods["id"]); ?>">
                            <div class="layui-form-item">
                                <label class="layui-form-label label-required">产品名</label>
                                <div class="layui-input-block">
                                    <input type="text" name="goodsname" class="layui-input" autocomplete="off" placeholder="产品名" datatype="*1-30" errormsg="产品名至少1个字符!" nullmsg="请输入产品名!" value="<?php echo ($goods["goodsname"]); ?>">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label label-required">产品图片</label>
                                <div class="layui-input-block">
                                    <button type="button" class="layui-btn" id="test1">
                                      <i class="layui-icon">&#xe67c;</i>上传图片
                                    </button>
                                    <span id="phototext"></span>
                                    <input id="photo" type="hidden" name="photo" value="<?php echo ($goods["goodsimg"]); ?>"/><br/>
                                    <img id="img" style="width: 100px;height: 100px" src="/luomansi/Application/Upload//<?php echo ($goods["goodsimg"]); ?>"/>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label label-required">产品描述</label>
                                <div class="layui-input-block">
                                    <input type="text" name="goodsDes" class="layui-input" autocomplete="off" placeholder="产品描述" datatype="*1-30" errormsg="产品描述至少2个字符!" nullmsg="请输入产品描述!" value="<?php echo ($goods["goodsdes"]); ?>">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label label-required">下拉手</label>
                                <div class="layui-input-block">
                                    <?php if($goods["hashand"] == 1): ?><input name="hand" type="radio" value="1" title="有" checked="checked"/>
                                    <input name="hand" type="radio" value="0" title="无"/>
                                    <?php else: ?>
                                    <input name="hand" type="radio" value="1" title="有"/>
                                    <input name="hand" type="radio" value="0" title="无" checked="checked"/><?php endif; ?>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label label-required">假锁</label>
                                <div class="layui-input-block">
                                    <?php if($goods["haslock"] == 1): ?><input name="falseLock" type="radio" value="1" title="有" checked="checked"/>
                                    <input name="falseLock" type="radio" value="0" title="无"/>
                                    <?php else: ?>
                                    <input name="falseLock" type="radio" value="1" title="有"/>
                                    <input name="falseLock" type="radio" value="0" title="无" checked="checked"/><?php endif; ?>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <div class="layui-input-block">
                                    注：这里的下拉手和假锁选项表示产品是否具有该属性，若选择“无”则代理商下单时不会显示该属性。
                                </div>
                                
                            </div>
                        </div>
                    </section>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    UE.getEditor('content');
$(function(){
    //$('.colpick').css('z-index',9999);
    $('#save').click(function(){
        var photo = $('#photo').val();
        if (!photo) {
            alert('请上传图片');
            return false;
        }
    });
    layui.use('upload', function(){
      var upload = layui.upload;
       
      //执行实例
      var uploadInst = upload.render({
        elem: '#test1' //绑定元素
        ,url: '<?php echo U('Goods/photoUpload');?>' //上传接口
        ,before: function(res,index,upload){
          //上传完毕回调
          $('#phototext').text('文件上传中...').css('color','black');;
        }
        ,done: function(res,index,upload){
            //上传完毕回调
            if (res.code == 1) {
                $('#phototext').text('文件上传成功！').css('color','green');
                $('#photo').val("goods/"+res.savepath+res.savename);
                $('#img').attr('src','/luomansi/Application/Upload//'+"goods/"+res.savepath+res.savename).show();
            } else {
                $('#phototext').text('文件上传失败！').css('color','red');
            }
        }
        ,error: function(){
          //请求异常回调
        }
      });
    });
});
    
</script>
</body>
</html>