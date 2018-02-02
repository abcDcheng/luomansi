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
    <title>新增代理商</title>
</head>
<body>

<div class="layui-layout-admin">
    <div class="layui-tab sc_side_tab" lay-filter="nav">
    
    <ul class="layui-tab-title">
        <li class="layui-this">
            <div class="sc_side_manage" style="background-image:url('/luomansi/Application/Admin/Public/images/male.png');"></div>
            
        </li>
        <dl class="layui-nav layui-nav-tree sc_side_more">
            <dd class="layui-nav-item layui-nav-itemed">
                <dl class="layui-nav-child">

				<?php if (isset($_SESSION['group'])) { $group = $_SESSION['group']; if ($group == 1) { ?>
				<dd><a href="#">人员管理</a></dd>
				<!-- <dd><a href="#">历史订单</a></dd> -->
				<dd><a href="#">安装管理</a></dd>
				<dd><a href="<?php echo U('Maintain/salemanIndex');?>">维护管理</a></dd>
				<dd><a href="#">维护统计</a></dd>
				<?php } elseif ($group == 2) { ?>
				<dd><a href="<?php echo U('Order/index');?>">订单管理</a></dd>
				<dd><a href="<?php echo U('Order/history');?>">历史订单</a></dd>
				<?php } elseif ($group == 3) { ?>	
				<dd><a href="#">安装管理</a></dd>
				<dd><a href="#">安装统计</a></dd>
				<dd><a href="<?php echo U('Maintain/index');?>">维护管理</a></dd>
				<dd><a href="<?php echo U('Maintain/history');?>">维护统计</a></dd>
				<?php } elseif ($group == 99) { ?>	
				<dd><a href="<?php echo U('Admin/index');?>">专员管理</a></dd>
				<dd><a href="<?php echo U('Saleman/index');?>">代理商管理</a></dd>
				<dd><a href="<?php echo U('Saleman/service');?>">代理商人员</a></dd>
				<dd><a href="<?php echo U('Goods/index');?>">产品管理</a></dd>
				<dd><a href="<?php echo U('Order/index');?>">订单管理</a></dd>
				<dd><a href="<?php echo U('Order/history');?>">历史订单</a></dd>
				<dd><a href="#">安装管理</a></dd>
				<dd><a href="#">安装统计</a></dd>
				<dd><a href="<?php echo U('Maintain/index');?>">维护管理</a></dd>
				<dd><a href="<?php echo U('Maintain/history');?>">维护统计</a></dd>
				<?php } } ?>
				<dd><a href="#">密码修改</a></dd>
				<dd><a id="loginout" href="<?php echo U('Index/loginout');?>">退出登录</a></dd>
                </dl> 
            </dd>
        </dl>
    </ul>
    </div>
    <div class="layui-body" id="sc_body">
        <div class="sc_body">
            <form action="<?php echo U('Saleman/add');?>" id="form" class="layui-form layui-form-pane">
                <div class="sc_title sc_body_title">
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
                              <label class="layui-form-label label-required">用户名</label>
                              <div class="layui-input-block">
                                  <input type="text" name="username" class="layui-input" autocomplete="off" placeholder="用户名" datatype="s4-16" errormsg="用户名至少4个字符!" nullmsg="请输入用户名!">
                              </div>
                          </div>
                          <div class="layui-form-item">
                              <label class="layui-form-label label-required">密码</label>
                              <div class="layui-input-block">
                                  <input id="pwd" type="password" name="pwd" placeholder="密码" class="layui-input" autocomplete="off" datatype="*6-18" errormsg="密码范围在6~18位之间!" nullmsg="请输入密码!">
                              </div>
                          </div>
                          <div class="layui-form-item">
                              <label class="layui-form-label label-required">确认密码</label>
                              <div class="layui-input-block">
                                  <input id="repwd" type="password" name="repwd" placeholder="确认密码" class="layui-input" autocomplete="off" datatype="*6-18" errormsg="密码范围在6~18位之间!" nullmsg="请输入密码!">
                              </div>
                          </div>
                          <div class="layui-form-item">
                              <label class="layui-form-label label-required">姓名</label>
                              <div class="layui-input-block">
                                  <input type="text" name="username" class="layui-input" autocomplete="off" placeholder="姓名" datatype="s2-16" errormsg="姓名至少2个字符!" nullmsg="请输入姓名!">
                              </div>
                          </div>
                          <div class="layui-form-item">
                              <label class="layui-form-label label-required">联系方式</label>
                              <div class="layui-input-block">
                                  <input type="text" name="username" class="layui-input" autocomplete="off" placeholder="联系方式" datatype="s4-30" errormsg="联系方式至少4个字符!" nullmsg="请输入联系方式!">
                              </div>
                          </div>
                          <div class="layui-form-item">
                              <label class="layui-form-label label-required">送货地址</label>
                              <div class="layui-input-block">
                                  <input type="text" name="username" class="layui-input" autocomplete="off" placeholder="送货地址" datatype="s4-16" errormsg="送货地址至少4个字符!" nullmsg="请输入送货地址!">
                              </div>
                          </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">可下单产品</label>
                                <?php if(is_array($goods)): foreach($goods as $key=>$value): ?><div class="layui-input-block">
                                    <input lay-filter="allChoose" name="goods" type="checkbox" checked="checked" class="list-check-box" value="<?php echo ($value["id"]); ?>" level="1"/><span style="font-weight: bold;"><?php echo ($value["goodsname"]); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;<input class="gBtn" type="button" value="展开" code="<?php echo ($value["id"]); ?>"></div>
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
    });

    


});
    
</script>
</body>
</html>