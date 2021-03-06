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
    <script src="/luomansi/Application/Admin/Public/js/select.js"></script>
    <script src="/luomansi/Application/Admin/Public/plugs/layui/lay/modules/laydate.js"></script>

    <!-- 让IE8/9支持媒体查询 -->
	<!--[if lt IE 9]>
		<script src="./js/html5shiv.min.js"></script>
		<script src="./js/respond.min.js"></script>
	<![endif]-->
    <title>新增代理商</title>
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
            <form action="<?php echo U('Saleman/add');?>" id="form" class="layui-form layui-form-pane">
                <div class="sc_title sc_body_title">
        <img id="logo" src="/luomansi/Application/Admin/Public/images/logo.png" style="width: 100px;height: 30px;margin-left: 5px;">
                    <h5>新增代理商</h5>
                    <div class="sc_title_btn">
                        <button id="save" type="submit" class='layui-btn layui-btn-sm'><i class='layui-icon'>&#xe605;</i> 保存</button>
                        <a class='layui-btn layui-btn-sm layui-btn-primary' href="<?php echo U('Saleman/index');?>"><i class="layui-icon">&#x1006;</i> 返回</a>
                    </div>
                </div>
                <div class="fadeInUp animated">
                    <section class="sc_layout_inner layui-clear">
                        <div class="sc_editor_content">
                            <div class="layui-form-item">
                              <label class="layui-form-label label-required">账户名</label>
                              <div class="layui-input-block">
                                  <input type="text" name="username" class="layui-input" autocomplete="off" placeholder="账户名" datatype="*1-16" errormsg="账户名至少1个字符!" nullmsg="请输入账户名!">
                              </div>
                          </div>
                          <div class="layui-form-item">
                              <label class="layui-form-label label-required">密码</label>
                              <div class="layui-input-block">
                                  <input id="pwd" type="password" name="pwd" placeholder="密码" class="layui-input" autocomplete="off" datatype="*6-18" errormsg="密码范围在6~18位之间!" nullmsg="请输入密码!" value="a123456">
                              </div>
                          </div>
                          <div class="layui-form-item">
                              <label class="layui-form-label label-required">确认密码</label>
                              <div class="layui-input-block">
                                  <input id="repwd" type="password" name="repwd" placeholder="确认密码" class="layui-input" autocomplete="off" datatype="*6-18" errormsg="密码范围在6~18位之间!" nullmsg="请输入密码!" value="a123456">
                              </div>
                          </div>
                          <div class="layui-form-item">
                              <label class="layui-form-label label-required">姓名</label>
                              <div class="layui-input-block">
                                  <input type="text" name="name" class="layui-input" autocomplete="off" placeholder="姓名" datatype="*2-16" errormsg="姓名至少2个字符!" nullmsg="请输入姓名!">
                              </div>
                          </div>
                          <div class="layui-form-item">
                              <label class="layui-form-label label-required">联系方式</label>
                              <div class="layui-input-block">
                                  <input type="text" name="phone" class="layui-input" autocomplete="off" placeholder="联系方式" datatype="n11-11" errormsg="联系方式必须为手机号!" nullmsg="请输入联系方式!">
                              </div>
                          </div>
                          <div class="layui-form-item">
                                <label class="layui-form-label label-required">省份</label>
                                <div class="layui-input-block">
                                    <select id="province" name="province" class="layui-select" lay-filter="province">
                                    </select>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label label-required">城市</label>
                                <div class="layui-input-block">
                                    <select id="city" name="city" class="layui-select">
                                        
                                    </select>
                                </div>
                            </div>
                          <div class="layui-form-item">
                              <label class="layui-form-label label-required">送货地址</label>
                              <div class="layui-input-block">
                                  <input type="text" name="address" class="layui-input" autocomplete="off" placeholder="送货地址" datatype="*4-255" errormsg="送货地址至少4个字符!" nullmsg="请输入送货地址!">
                              </div>
                          </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">可下单产品</label>
                                <?php if(is_array($goods)): foreach($goods as $key=>$value): ?><div class="layui-input-block">
                                      <input lay-filter="allChoose" name="goods" type="checkbox" checked="checked" class="list-check-box" value="<?php echo ($value["id"]); ?>" level="1"/>
                                      <span style="font-weight: bold;"><?php echo ($value["goodsname"]); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;
                                      <input class="gBtn" type="button" value="展开" code="<?php echo ($value["id"]); ?>">
                                    </div>
                                    <div class="layui-input-block goodsInfo<?php echo ($value["id"]); ?>" style="display: none;margin-left: 150px;">
                                        <?php if(is_array($value["model"])): foreach($value["model"] as $key=>$info): ?><input name="goodsInfo[]" type="checkbox" checked="checked" value="<?php echo ($info[0]); ?>" class="list-check-box model<?php echo ($value["id"]); ?>" level="2"/><?php echo ($info[1]); ?><br/><?php endforeach; endif; ?>
                                    </div><?php endforeach; endif; ?>
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
    $('#save').click(function(){
        var info = $('input[name="goodsInfo[]"]:checked').val();
        //alert(info);
        //return false;
        var pwd = $('#pwd').val();
        var repwd = $('#repwd').val();
        var reg = /^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,18}$/;
        if (!reg.test(pwd)) {
            alert('密码必须为字母数字组合');
            return false;
        }
        if (pwd != repwd) {
            alert('两次输入的密码不一致');
            return false;
        }
    });

    $('.gBtn').click(function(){

        var code = $(this).attr('code');
        var text = $(this).val();
        if (text == '展开') {
            $(this).val('收起');
            $('.goodsInfo'+code).slideDown();
        } else {
            $(this).val('展开');
            $('.goodsInfo'+code).slideUp();
        }
        
    });



    layui.use(['layer', 'form'], function(){
        var form = layui.form;
        form.on('checkbox', function(data){
            if ($(data.elem).attr('level') == 1) {
                var id = $(data.elem).val();
                var child = $(data.elem).parents().siblings('.goodsInfo'+id).find('input[type="checkbox"]');
                child.each(function(index, item){
                    item.checked = data.elem.checked;
                });
            } else if ($(data.elem).attr('level') == 2) {
                var parent = $(data.elem).parent().prev().find('input[type="checkbox"]');
                if (data.elem.checked) {
                    parent.each(function(index, item){
                        item.checked = data.elem.checked;
                    });
                } else {
                    var tmp = 0;
                    $(data.elem).siblings('input[type="checkbox"]').each(function(index, item){
                        console.log(item.checked);
                        if (item.checked) {
                            tmp = 1;
                        }
                    });
                    if (!tmp) {
                        parent.each(function(index, item){
                            item.checked = data.elem.checked;
                        });
                    }
                }
            }
            
            
            layui.form.render('checkbox');
        });
        var oProvince=document.getElementById("province");
        var oCity=document.getElementById("city");
        for(var i in json){
            var option=document.createElement("option");
            option.innerHTML=i;
            option.value=i;
            oProvince.appendChild(option);
        }
        for(var i in json[oProvince.value]){
            var option=document.createElement("option");
            option.innerHTML=json[oProvince.value][i];
            option.value=json[oProvince.value][i];
            oCity.appendChild(option);
        }
        layui.form.render('select');
        form.on('select(province)', function(data){
            oCity.innerHTML="";
            for(var i in json[oProvince.value]){
                    var option=document.createElement("option");
                    option.innerHTML=json[oProvince.value][i];
                    option.value=json[oProvince.value][i];
                    oCity.appendChild(option);
                }
            
            layui.form.render('select');
        });
    });

    


});
    
</script>
</body>
</html>