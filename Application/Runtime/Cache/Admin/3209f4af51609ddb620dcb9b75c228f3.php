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
    <link rel="stylesheet" href="/luomansi/Application/Admin/Public/css/jquery.autocompleter.css">
    <script src="/luomansi/Application/Admin/Public/plugs/layui/layui.js"></script>
    <script src="/luomansi/Application/Admin/Public/plugs/ueditor/ueditor.config.js"></script>
    <script src="/luomansi/Application/Admin/Public/plugs/ueditor/ueditor.all.js"></script>
    <script type="text/javascript">
        var getsaleman = <?php echo ($saleman); ?>;
    </script>
    <!-- <script src="/luomansi/Application/Admin/Public/plugs/static/base/js/jquery.cookie.js"></script> -->
    <script src="/luomansi/Application/Admin/Public/js/jquery.min.js"></script>
    <!-- <script src="/luomansi/Application/Admin/Public/plugs/uploadify/jquery.uploadify.min.js"></script> -->
    <script src="/luomansi/Application/Admin/Public/js/validform.js"></script>
    <script src="/luomansi/Application/Admin/Public/js/jquery.autocompleter.js" type="text/javascript"></script>
    <script src="/luomansi/Application/Admin/Public/js/sitecms.js"></script>
    <script src="/luomansi/Application/Admin/Public/js/main.js"></script>
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
				<dd><a href="<?php echo U('Saleman/installIndex');?>">保修登记</a></dd>
				<dd><a href="<?php echo U('Maintain/salemanIndex');?>">维护管理</a></dd>
				<?php } elseif ($group == 2) { ?>
				<dd><a href="<?php echo U('Order/index');?>">订单管理<span id="orderNum"></span></a></dd>
				<dd><a href="<?php echo U('Order/history');?>">历史订单</a></dd>
				<?php } elseif ($group == 3) { ?>
				<dd><a href="<?php echo U('Code/index');?>">识别码管理</a></dd>
				<dd><a href="<?php echo U('Install/index');?>">保修登记<span id="installNum"></span></a></dd>
				<dd><a href="<?php echo U('Install/history');?>">安装统计</a></dd>
				<dd><a href="<?php echo U('Maintain/index');?>">维护管理</a></dd>
				<dd><a href="<?php echo U('Maintain/history');?>">维护统计</a></dd>
				<?php } elseif ($group == 99) { ?>	
				<dd><a href="<?php echo U('Admin/ad');?>">广告宣传语</a></dd>
				<dd><a href="<?php echo U('Admin/index');?>">专员管理</a></dd>
				<dd><a href="<?php echo U('Saleman/index');?>">代理商管理</a></dd>
				<dd><a href="<?php echo U('Admin/servicer');?>">代理商人员</a></dd>
				<dd><a href="<?php echo U('Goods/index');?>">产品管理</a></dd>
				<dd><a href="<?php echo U('Code/index');?>">识别码管理</a></dd>
				<dd><a href="<?php echo U('Order/index');?>">订单管理<span id="orderNum"></span></a></dd>
				<dd><a href="<?php echo U('Order/history');?>">历史订单</a></dd>
				<dd><a href="<?php echo U('Install/index');?>">保修登记<span id="installNum"></span></a></dd>
				<dd><a href="<?php echo U('Install/history');?>">安装统计</a></dd>
				<dd><a href="<?php echo U('Maintain/index');?>">维护管理</a></dd>
				<dd><a href="<?php echo U('Maintain/history');?>">维护统计</a></dd>
				<dd><a href="<?php echo U('Admin/phone');?>">手机更换</a></dd>
				<?php } else if ($group == 4) { ?>	
					<dd><a href="<?php echo U('Code/index');?>">识别码管理</a></dd>
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
            <form action="<?php echo U('Maintain/update');?>" id="form" class="layui-form layui-form-pane">
                <div class="sc_title sc_body_title">
        <img id="logo" src="/luomansi/Application/Admin/Public/images/logo.png" style="width: 100px;height: 30px;margin-left: 5px;">
                    <h5>维护管理</h5>
                    <div class="sc_title_btn">
                    <?php if(($info["statususer"] == $user and $info["status"] != 1) or $group == 99): ?><button id="save" type="submit" class='layui-btn layui-btn-sm'><i class='layui-icon'>&#xe605;</i> 保存</button><?php endif; ?>
                        <a class='layui-btn layui-btn-sm layui-btn-primary' href="javascript:history.back();"><i class="layui-icon">&#x1006;</i> 返回</a>
                    </div>
                </div>
                <div class="fadeInUp animated">
                    <section class="sc_layout_inner layui-clear">
                        <div class="sc_editor_content">
                            <input name="id" type="hidden" value="<?php echo ($info["id"]); ?>" />
                            <input name="mod" type="hidden" value="<?php echo ($mod); ?>" />
                            <div class="layui-form-item">
                                <label class="layui-form-label">创建人员</label>
                                <div class="layui-input-block">
                                    <input type="text" name="username" class="layui-input" autocomplete="off" value="<?php echo ($info["username"]); ?>" readonly="">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label <?php echo ($require); ?>">客户姓名</label>
                                <div class="layui-input-block">
                                    <input type="text" name="name" class="layui-input" autocomplete="off" placeholder="客户姓名" datatype="*2-30" errormsg="客户姓名至少2个字符!" nullmsg="请输入客户姓名!"  value="<?php echo ($info["name"]); ?>" <?php echo ($disabled); ?>>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label <?php echo ($require); ?>">联系方式</label>
                                <div class="layui-input-block">
                                    <input type="text" name="phone" class="layui-input" autocomplete="off" datatype="*2-30" errormsg="请输入正确的联系方式" placeholder="联系方式" nullmsg="请输入联系方式!" value="<?php echo ($info["phone"]); ?>" <?php echo ($disabled); ?>>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label <?php echo ($require); ?>">详细地址</label>
                                <div class="layui-input-block">
                                    <input type="text" name="address" class="layui-input" autocomplete="off" datatype="*2-255" errormsg="请输入正确的详细地址" placeholder="详细地址" nullmsg="请输入详细地址!" value="<?php echo ($info["address"]); ?>" <?php echo ($disabled); ?>>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label <?php echo ($require); ?>">产品名称</label>
                                <div class="layui-input-block">
                                <?php if($disabled == ''): ?><select id="goods" name="goods" class="layui-select">
                                        <?php if(is_array($goods)): foreach($goods as $k=>$value): ?><option value="<?php echo ($k); ?>"><?php echo ($value); ?></option><?php endforeach; endif; ?>
                                    </select>
                                <?php else: ?>
                                    <input type="text" name="goodsName" class="layui-input" autocomplete="off" value="<?php echo ($info["goods"]); ?>" readonly="">
                                    <input name="goods" type="hidden" value="<?php echo ($info["goodsid"]); ?>"><?php endif; ?>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">产品规格</label>
                                <div class="layui-input-block">
                                    <input type="text" name="goodsModel" class="layui-input" autocomplete="off"  placeholder="未知" value="<?php echo ($info["goodsmodel"]); ?>" <?php echo ($disabled); ?>>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">安装时间</label>
                                <div class="layui-input-block">
                                    <input type="text" name="installTime" placeholder="未知" value="<?php echo ($info["installtime"]); ?>" class="layui-input sc_form_date" readonly="" <?php echo ($disabled); ?>>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label <?php echo ($require); ?>">维护信息</label>
                                <div class="layui-input-block">
                                    <textarea id="msg" name="msg" class="layui-textarea" datatype="*2-2000" nullmsg="请输入维护信息!" placeholder="维护信息" <?php echo ($disabled); ?>><?php echo ($info["msg"]); ?></textarea>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">客户说明</label>
                                <div class="layui-input-block">
                                    <textarea id="clientBak" name="clientBak" class="layui-textarea" placeholder="客户说明" <?php echo ($disabled); ?>><?php echo ($info["clientbak"]); ?></textarea>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label <?php echo ($require); ?>">订单要求</label>
                                <div class="layui-input-block">
                                <?php if($disabled == ''): ?><select id="level" name="level" class="layui-select">
                                        <option value="1">紧急服务</option>
                                        <option value="2">预约服务</option>
                                    </select>
                                <?php else: ?>
                                    <?php if($info["level"] == 1): ?><input type="hidden" name="level" class="layui-input" autocomplete="off" value="<?php echo ($info["level"]); ?>" readonly="">
                                    <input type="text" name="levelcon" class="layui-input" autocomplete="off" value="紧急服务" readonly="">
                                    <?php else: ?>
                                    <input type="hidden" name="level" class="layui-input" autocomplete="off" value="<?php echo ($info["level"]); ?>" readonly="">
                                    <input type="text" name="levelcon" class="layui-input" autocomplete="off" value="预约服务" readonly=""><?php endif; endif; ?>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">所属省市</label>
                                <div class="layui-input-block">
                                    <input type="text" name="province" class="layui-input" autocomplete="off" value="<?php echo ($info["province"]); echo ($info["city"]); ?>" readonly="" placeholder="未知">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                
                                <?php if($group == 1): ?><label class="layui-form-label">负责代理商</label>
                                <div class="layui-input-block">
                                    <input id="saleman" type="hidden" name="saleman">
                                    <input type="text" class="layui-input" autocomplete="off" value="<?php echo ($info["saleman"]); ?>" readonly="">
                                <?php else: ?>
                                <label class="layui-form-label">负责代理商</label>
                                <div class="layui-input-block">
                                <?php if($disabled == ''): ?><!-- <select id="saleman" name="saleman" class="layui-select" >
                                        <option value="">选择代理商</option>
                                        <?php if(is_array($saleman)): foreach($saleman as $key=>$value): ?><option value="<?php echo ($value["id"]); ?>"><?php echo ($value["name"]); ?>(<?php echo ($value["province"]); echo ($value["city"]); ?>)</option><?php endforeach; endif; ?>
                                    </select> -->
                                    <input id="salemancx" type="text" placeholder="选择代理商" class="layui-input" value="<?php echo ($info["saleman"]); ?>">
                                    <input id="saleman" type="hidden" name="saleman" value="<?php echo ($info["salemanid"]); ?>"/>
                                <?php else: ?>
                                    <input class="layui-input" type="text" value="<?php echo ($info["saleman"]); ?>" readonly="" placeholder="无">
                                    <input id="saleman" name="saleman" type="hidden" value="<?php echo ($info["salemanid"]); ?>"><?php endif; ?>
                                    <input name="oldSaleman" type="hidden" value="<?php echo ($info["salemanid"]); ?>"><?php endif; ?>
                                </div>
                            </div>
                            
                            <div class="layui-form-item">
                                
                                <?php if($group == 1): ?><label class="layui-form-label">维护人员</label>
                                <div class="layui-input-block">
                                    <select id="serviceName" name="servicer" class="layui-select">
                                        <option value="">选择维护人员</option>
                                        <?php if(is_array($servicer)): foreach($servicer as $key=>$value): ?><option value="<?php echo ($value["id"]); ?>"><?php echo ($value["name"]); ?>(<?php echo ($value["phone"]); ?>)</option><?php endforeach; endif; ?>
                                    </select>
                                    <input name="oldServicer" type="hidden" value="<?php echo ($info["serviceid"]); ?>">
                                <?php else: ?>
                                <label class="layui-form-label">维护人员</label>
                                <div class="layui-input-block">
                                    <?php if($info["servicename"] != ''): ?><input type="text" name="serviceName" class="layui-input" autocomplete="off" value="<?php echo ($info["servicename"]); ?>(<?php echo ($info["servicephone"]); ?>)" readonly="">
                                    <?php else: ?>
                                    <input type="text" name="serviceName" class="layui-input" autocomplete="off" value="" placeholder="无" readonly=""><?php endif; endif; ?>
                                </div>
                            </div>
                            <?php if($info["loc"] != ''): ?><div class="layui-form-item">
                                <label class="layui-form-label">维护定位</label>
                                <div class="layui-input-block">
                                    <input type="text" name="loc" class="layui-input" autocomplete="off" value="<?php echo ($info["loc"]); ?>" disabled="disabled">
                                </div>
                            </div><?php endif; ?>
                            <?php if($info['serlog'] != ''): ?><div class="layui-form-item">
                                <label class="layui-form-label">维护追踪</label>
                                <div class="layui-input-block">
                                    <textarea name="serLog" class="layui-textarea" autocomplete="off" value="<?php echo ($info["serlog"]); ?>" readonly="" style="height: 300px;"><?php echo ($info["serlog"]); ?></textarea>
                                </div>
                            </div><?php endif; ?>
                            <?php if($info['servicestatus'] != 0 and $info['comimg'] != ''): ?><div class="layui-form-item from_item_image">
                                <div class="img_label">
                                    <label>锁门照片</label>
                                </div>
                                <div id="thumb_view" class="img_item transition">
                                    <img src="/luomansi/Application/Upload//<?php echo ($info['comphoto']); ?>">
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
                                <?php if($group == 99): ?><select id="statusUser" name="statusUser" class="layui-select">
                                        <option value="">无</option>
                                    <?php if(is_array($statusUser)): foreach($statusUser as $key=>$value): ?><option value="<?php echo ($value["username"]); ?>"><?php echo ($value["username"]); ?></option><?php endforeach; endif; ?>
                                    </select>
                                <?php else: ?>
                                    <input type="text" name="username" class="layui-input" autocomplete="off" placeholder="无" value="<?php echo ($info["statususer"]); ?>" readonly=""><?php endif; ?>
                                </div>

                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label <?php echo ($require); ?>">回访状态</label>
                                <div class="layui-input-block">
                                <?php if(($info["statususer"] == $user and $info["status"] != 1) or $group == 99): ?><select id="status" name="status" class="layui-select" lay-filter="status">
                                        <option value="0">未回访</option>
                                        <option value="1">已回访</option>
                                        <option value="2">服务异常</option>
                                    </select>
                                <?php else: ?>
                                    <?php if($info['status'] == 0): ?><input type="text" name="statuscon" class="layui-input" autocomplete="off" value="未回访" readonly="">
                                    <?php elseif($info['status'] == 1): ?>
                                    <input type="text" name="statuscon" class="layui-input" autocomplete="off" value="已回访" readonly="">
                                    <?php else: ?>
                                    <input type="text" name="statuscon" class="layui-input" autocomplete="off" value="服务异常" readonly=""><?php endif; ?>
                                    <input id="status" name="status" type="hidden" value="<?php echo ($info["status"]); ?>"><?php endif; ?>
                                </div>
                            </div>
                            <?php if($info["statususer"] == $user or $group == 99): ?><div id="statusmsg" class="layui-form-item" 
                            <?php if($info['status'] != 2): ?>style="display: none"<?php endif; ?>
                            >
                                <label class="layui-form-label">回访信息</label>
                                <div class="layui-input-block">
                                    <textarea name="serMsg" class="layui-textarea"></textarea>
                                </div>
                            </div><?php endif; ?>
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
        $('#saleman').val(parseInt('<?php echo ($info["salemanid"]); ?>'));
        $('#serviceName').val(parseInt('<?php echo ($info["serviceid"]); ?>'));
        $('#status').val(parseInt('<?php echo ($info["status"]); ?>'));
        $('#msg').val('<?php echo ($info["msg"]); ?>');
        $('#clientBak').val('<?php echo ($info["clientbak"]); ?>');
        $('#level').val(parseInt('<?php echo ($info["level"]); ?>'));
        $('#goods').val(parseInt('<?php echo ($info["goodsid"]); ?>'));
        <?php if($group == 99): ?>$('#statusUser').val('<?php echo ($info["statususer"]); ?>');<?php endif; ?>
        $('#save').click(function(){
            var saleman = $('#saleman').val();
            if (!saleman) {
                if(!confirm('未选择负责代理商，确定修改吗？')){
                    return false;
                }
            }
            <?php if($group == 1): ?>var servicer = $('#serviceName').val();
            if (!servicer) {
                if(!confirm('未选择维护人员，确定修改吗？')){
                    return false;
                }
            }<?php endif; ?>
        });

        layui.use(['layer', 'form'], function(){
        var form = layui.form;
        form.on('select(status)', function(data){
            //alert($(data.elem).val());
            if (data.value != 0) {
                $('#statusmsg').show();
                $(window).scrollTop( $(".sc_editor_content").height());
            } else {
                $('#statusmsg').hide();
            }
          //console.log(data.elem); //得到select原始DOM对象
         // console.log(data.value); //得到被选中的值
          //console.log(data.othis); //得到美化后的DOM对象
        }); 
        }); 
    });
    


</script>
<script>
$(function(){
    lay('.sc_form_date').each(function(){
        layui.laydate.render({
            elem: this
            ,trigger: 'click'
            ,type: 'date'
        });
    });

});

</script>
</body>
</html>