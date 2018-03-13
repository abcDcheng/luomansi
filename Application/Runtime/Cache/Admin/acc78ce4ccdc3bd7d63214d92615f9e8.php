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
    <script src="/luomansi/Application/Admin/Public/js/colpick.js" type="text/javascript"></script>
    <link rel="stylesheet" href="/luomansi/Application/Admin/Public/css/colpick.css" type="text/css"/>
    <!-- 让IE8/9支持媒体查询 -->
	<!--[if lt IE 9]>
		<script src="./js/html5shiv.min.js"></script>
		<script src="./js/respond.min.js"></script>
	<![endif]-->
    <title><?php echo ($goods["goodsname"]); ?>规格添加</title>
</head>
<body>

<div class="layui-layout-admin">
    <div class="layui-tab sc_side_tab" lay-filter="nav">
        <style type="text/css">
	.layui-nav-tree .layui-nav-child a{
		height: 35px;
	}
	.layui-nav-child dd{
		font-size: 20px;
	}
</style>
	
    <ul class="layui-tab-title">
        <li class="layui-this">
            <div class="sc_side_manage" style="background:url('/luomansi/Application/Admin/Public/images/logo.png') no-repeat;"></div>
            
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
            <form action="<?php echo U('Goods/modelUpdate');?>" id="form" class="layui-form layui-form-pane">
                <div class="sc_title sc_body_title">
                <img id="logo" src="/luomansi/Application/Admin/Public/images/logo.png" style="width: 100px;height: 30px;margin-left: 5px;">
                    <h5><?php echo ($goods["goodsname"]); ?>规格添加</h5>
                    <div class="sc_title_btn">
                        <button id="save" type="submit" class='layui-btn layui-btn-sm'><i class='layui-icon'>&#xe605;</i> 保存</button>
                        <a class='layui-btn layui-btn-sm layui-btn-primary' href="<?php echo U('Goods/goodsModel?id='.$goods['id']);?>"><i class="layui-icon">&#x1006;</i> 返回</a>
                    </div>
                </div>
                <div class="fadeInUp animated">
                    <section class="sc_layout_inner layui-clear">
                        <div class="sc_editor_content">
                            <input type="hidden" name="id" value="<?php echo ($model["id"]); ?>">
                            <input type="hidden" name="goodsId" value="<?php echo ($goods["id"]); ?>">
                            <div class="layui-form-item">
                                <label class="layui-form-label label-required">产品名</label>
                                <div class="layui-input-block">
                                    <input type="text" name="goodsname" class="layui-input" autocomplete="off" value="<?php echo ($goods["goodsname"]); ?>" disabled="disabled">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label label-required">颜色</label>
                                <div class="layui-input-block">
                                    <input type="text" name="color" class="layui-input" autocomplete="off" placeholder="颜色" datatype="*1-30" errormsg="颜色名至少1个字符!" nullmsg="请输入颜色名!" value="<?php echo ($model["goodscolor"]); ?>">
                              </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label label-required">颜色代码</label>
                                <div class="layui-input-block">
                                    <input id="colorCode" type="text" name="colorCode" class="layui-input" autocomplete="off" placeholder="颜色代码" value="<?php echo ($model["colorcode"]); ?>">
                                    <input id="picker" type="button" name="colpick" value="选取颜色"/>
                              </div>
                            </div>
                            <?php if($goods["hashand"] == 1): ?><div class="layui-form-item">
                                <label class="layui-form-label label-required">下拉手</label>
                                <div class="layui-input-block">
                                    <?php if($model["hand"] == 1): ?><input name="hand" type="radio" value="1" title="有" checked="checked"/>
                                    <input name="hand" type="radio" value="0" title="无"/>
                                    <?php else: ?>
                                    <input name="hand" type="radio" value="1" title="有"/>
                                    <input name="hand" type="radio" value="0" title="无" checked="checked"/><?php endif; ?>
                                </div>
                            </div>
                            <?php else: ?>
                            <input type="hidden" name="hand" value="0"><?php endif; ?>
                            <?php if($goods["haslock"] == 1): ?><div class="layui-form-item">
                                <label class="layui-form-label label-required">假锁</label>
                                <div class="layui-input-block">
                                    <?php if($model["falselock"] == 1): ?><input name="falseLock" type="radio" value="1" title="有" checked="checked"/>
                                    <input name="falseLock" type="radio" value="0" title="无"/>
                                    <?php else: ?>
                                    <input name="falseLock" type="radio" value="1" title="有"/>
                                    <input name="falseLock" type="radio" value="0" title="无" checked="checked"/><?php endif; ?>
                                </div>
                            </div>
                            <?php else: ?>
                            <input type="hidden" name="falseLock" value="0"><?php endif; ?>
                            <div class="layui-form-item">
                                <label class="layui-form-label label-required">状态</label>
                                <div class="layui-input-block">
                                    <?php if($model['status'] == 1): ?><input name="status" type="radio" value="1" title="上架中" checked="checked"/>
                                    <input name="status" type="radio" value="0" title="已下架"/>
                                    <?php else: ?>
                                    <input name="status" type="radio" value="1" title="上架中"/>
                                    <input name="status" type="radio" value="0" title="已下架" checked="checked"/><?php endif; ?>
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
    $('#picker').colpick({
        onSubmit:function(hsb,hex,rgb,el){
            $('#colorCode').val('#'+hex);
        }
    });
    $('.colpick').css('z-index',9999);
    $('#save').click(function(){
        var colorCode = $('#colorCode').val();
        if (!colorCode) {
            alert('请选择颜色编码');
            return false;
        }
    });
    $('.gBtn').click(function(){

        var text = $(this).val();
        if (text == '展开') {
            $(this).val('收起');
            $('.salemanBlock').slideDown(100);
        } else {
            $(this).val('展开');
            $('.salemanBlock').slideUp(100);
        }
        
    });


});
    
</script>
</body>
</html>