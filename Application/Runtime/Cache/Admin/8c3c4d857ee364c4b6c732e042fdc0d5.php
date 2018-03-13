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

    <!-- 让IE8/9支持媒体查询 -->
	<!--[if lt IE 9]>
		<script src="./js/html5shiv.min.js"></script>
		<script src="./js/respond.min.js"></script>
	<![endif]-->
    <title>维护管理</title>
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
            <form action="<?php echo U('Maintain/salemanUpdate');?>" id="form" class="layui-form layui-form-pane">
                <div class="sc_title sc_body_title">
                    <h5>维护管理</h5>
                    <div class="sc_title_btn">
                    <?php if($info["status"] != 1): ?><button id="save" type="submit" class='layui-btn layui-btn-sm'><i class='layui-icon'>&#xe605;</i> 保存</button><?php endif; ?>
                        <a class='layui-btn layui-btn-sm layui-btn-primary' href="<?php echo U('Maintain/salemanIndex');?>"><i class="layui-icon">&#x1006;</i> 返回</a>
                    </div>
                </div>
                <div class="fadeInUp animated">
                    <section class="sc_layout_inner layui-clear">
                        <div class="sc_editor_content">
                            <input name="id" type="hidden" value="<?php echo ($info["id"]); ?>" />
                            <div class="layui-form-item">
                                <label class="layui-form-label">创建人员</label>
                                <div class="layui-input-block">
                                    <input type="text" name="username" class="layui-input" autocomplete="off" value="<?php echo ($info["username"]); ?>" disabled="disabled">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">客户姓名</label>
                                <div class="layui-input-block">
                                    <input type="text" name="name" class="layui-input" autocomplete="off" placeholder="客户姓名"  value="<?php echo ($info["name"]); ?>" disabled="disabled">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">联系方式</label>
                                <div class="layui-input-block">
                                    <input type="text" name="phone" class="layui-input" autocomplete="off" value="<?php echo ($info["phone"]); ?>" disabled="disabled">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">详细地址</label>
                                <div class="layui-input-block">
                                    <input type="text" name="address" class="layui-input" autocomplete="off" value="<?php echo ($info["address"]); ?>" disabled="disabled">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">产品名称</label>
                                <div class="layui-input-block">
                                    <input type="text" name="goods" class="layui-input" autocomplete="off" value="<?php echo ($info["goods"]); ?>" disabled="disabled">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">产品规格</label>
                                <div class="layui-input-block">
                                    <?php if($info["goodsmodel"] == ''): ?><input type="text" name="goodsModel" class="layui-input" autocomplete="off" value="未知" disabled="disabled">
                                    <?php else: ?>
                                    <input type="text" name="goodsModel" class="layui-input" autocomplete="off" value="<?php echo ($info["goodsmodel"]); ?>" disabled="disabled"><?php endif; ?>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">安装时间</label>
                                <div class="layui-input-block">
                                    <?php if($info["installtime"] == ''): ?><input type="text" name="installTime" value="未知" class="layui-input sc_form_date" readonly="">
                                    <?php else: ?>
                                    <input type="text" name="installTime" value="<?php echo ($info["installtime"]); ?>" class="layui-input sc_form_date" readonly=""><?php endif; ?>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">维护信息</label>
                                <div class="layui-input-block">
                                    <textarea id="msg" name="msg" class="layui-textarea"  placeholder="维护信息" disabled="disabled"><?php echo ($info["msg"]); ?></textarea>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">客户说明</label>
                                <div class="layui-input-block">
                                    <textarea id="clientBak" name="clientBak" class="layui-textarea" placeholder="无" disabled="disabled"><?php echo ($info["clientbak"]); ?></textarea>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">订单要求</label>
                                <div class="layui-input-block">
                                    <?php if($info["level"] == 1): ?><input type="text" name="level" class="layui-input" autocomplete="off" value="紧急服务" disabled="disabled"/>
                                    <?php else: ?>
                                    <input type="text" name="level" class="layui-input" autocomplete="off" value="预约服务" disabled="disabled"/><?php endif; ?>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">所属省市</label>
                                <div class="layui-input-block">
                                    <input type="text" name="province" class="layui-input" autocomplete="off" value="<?php echo ($info["province"]); echo ($info["city"]); ?>" disabled="disabled">
                                </div>
                            </div>
                            <div class="layui-form-item">
                            <?php if($info["status"] != 1): ?><label class="layui-form-label label-required">维护人员</label>
                                <div class="layui-input-block">
                                    <select id="servicer" name="servicer" class="layui-select">
                                        <option value="">选择维护人员</option>
                                        <?php if(is_array($servicer)): foreach($servicer as $key=>$value): ?><option value="<?php echo ($value["id"]); ?>"><?php echo ($value["name"]); ?>(<?php echo ($value["phone"]); ?>)</option><?php endforeach; endif; ?>
                                    </select>
                                </div>
                                <input name="oldServicer" type="hidden" value="<?php echo ($info["serviceid"]); ?>">
                            <?php else: ?>
                                <label class="layui-form-label">维护人员</label>
                                <div class="layui-input-block">
                                    <input type="text" name="servicerName" class="layui-input" autocomplete="off" value="<?php echo ($info["servicename"]); ?>(<?php echo ($info["servicephone"]); ?>)" readonly="">
                                </div>
                                <input name="servicer" type="hidden" value="<?php echo ($info["serviceid"]); ?>">
                                <input name="oldServicer" type="hidden" value="<?php echo ($info["serviceid"]); ?>"><?php endif; ?>
                            </div>
                            <?php if($info['serlog'] != ''): ?><div class="layui-form-item">
                                <label class="layui-form-label">维护追踪</label>
                                <div class="layui-input-block">
                                    <textarea name="serLog" class="layui-textarea" autocomplete="off" value="<?php echo ($info["serlog"]); ?>" disabled="disabled" style="height: 300px;" disabled="disabled"><?php echo ($info["serlog"]); ?></textarea>
                                </div>
                            </div><?php endif; ?>
                            <?php if($info['servicestatus'] != 0 and $info['comphoto'] != ''): ?><div class="layui-form-item from_item_image">
                                <div class="img_label">
                                    <label>门锁照片</label>
                                </div>
                                <div id="thumb_view" class="img_item transition">
                                    <img src="/luomansi/Application/Upload//<?php echo ($info['comimg']); ?>">
                                </div>
                            </div><?php endif; ?>
                            <?php if($info['servicestatus'] != 0 and $info['comimg'] != ''): ?><div class="layui-form-item from_item_image">
                                <div class="img_label">
                                    <label>识别码照片</label>
                                </div>
                                <div id="thumb_view" class="img_item transition">
                                    <img src="/luomansi/Application/Upload//<?php echo ($info['comimg']); ?>">
                                </div>
                            </div><?php endif; ?>
                            <div class="layui-form-item">
                                <label class="layui-form-label">受理人员</label>
                                <div class="layui-input-block">
                                    <input type="text" name="username" class="layui-input" autocomplete="off" placeholder="无" value="<?php echo ($info["statususer"]); ?>" disabled="disabled">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">回访状态</label>
                                <div class="layui-input-block">
                                <?php if($info["status"] == 2): ?><input type="text" name="status" class="layui-input" autocomplete="off" value="服务异常" disabled="disabled">
                                <?php elseif($info["status"] == 1): ?>
                                <input type="text" name="status" class="layui-input" autocomplete="off" value="已回访" disabled="disabled">
                                <?php else: ?>
                                <input type="text" name="status" class="layui-input" autocomplete="off" value="未回访" disabled="disabled"><?php endif; ?>
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
        $('#servicer').val(parseInt('<?php echo ($info["serviceid"]); ?>'));
        $('#msg').val('<?php echo ($info["msg"]); ?>');
        $('#save').click(function(){
            var servicer = $('#servicer').val();
            if (!servicer) {
                alert('请选择维护人员');
                return false;
            }
        });
    });
    


</script>
</body>
</html>