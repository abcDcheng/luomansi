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
    <title>siteCMS站点管理框架</title>
</head>
<body>

<div class="layui-layout-admin">
    <div class="layui-tab sc_side_tab" lay-filter="nav">
        <ul class="layui-tab-title">
            <li class="layui-this">
                <div class="sc_side_manage" style="background-image:url('/luomansi/Application/Admin/Public/images/male.png');"></div>
                admin
            </li>
            <li><span><i class="fa fa-desktop"></i></span>内容管理</li>
            <li><span><i class="fa fa-cog"></i></span>站点设置</li>
            <li><span><i class="fa fa-cogs"></i></span>系统设置</li>
            <dl class="layui-nav layui-nav-tree sc_side_more">
                <dd class="layui-nav-item layui-nav-itemed">
                    <a></a>
                    <dl class="layui-nav-child">
                        <dd><a data-title="修改密码">修改密码</a></dd>
                        <dd><a data-title="修改资料">修改资料</a></dd>
                        <dd><a data-title="清除缓存">清除缓存</a></dd>
                        <dd><a href="login.html">退出登录</a></dd>
                    </dl>
                </dd>
            </dl>
        </ul>
        
    </div>
    <div class="layui-body" id="sc_body">
        <div class="sc_body">
            <form action="<?php echo U('Goods/goodsAdd');?>" id="form" class="layui-form layui-form-pane">
                <div class="sc_title sc_body_title">
                    <h5>详情页</h5>
                    <div class="sc_title_btn">
                        <button id="save" type="submit" class='layui-btn layui-btn-sm'><i class='layui-icon'>&#xe605;</i> 保存</button>
                        <a class='layui-btn layui-btn-sm layui-btn-primary' href="<?php echo U('Admin/index');?>"><i class="layui-icon">&#x1006;</i> 返回</a>
                    </div>
                </div>
                <div class="fadeInUp animated">
                    <section class="sc_layout_inner layui-clear">
                        <div class="sc_editor_content">
                        <input type="hidden" name="id" value="<?php echo ($goods["id"]); ?>">
                            <div class="layui-form-item">
                                <label class="layui-form-label label-required">产品名</label>
                                <div class="layui-input-block">
                                    <input type="text" name="goodsname" class="layui-input" autocomplete="off" placeholder="产品名" datatype="s1-16" errormsg="用户名至少1个字符!" nullmsg="请输入产品名!">
                                </div>
                            </div>
                            <div class="layui-form-item from_item_image">
                                <div class="img_label">
                                    <label>产品图</label>
                                    <a id="btn_upload_thumb"></a>
                                    <span><i class="layui-icon" data-tips-text="推荐尺寸 720x720">&#xe6b2;</i></span>
                                </div>
                                <div id="thumb_view" class="img_item transition">
                                    <img>
                                    <input type="hidden" name="thumb" value="{$view.thumb|default=''}">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label label-required">下拉手</label>
                                <div class="layui-input-block">
                                    <input name="hand" type="radio" value="1" title="有" checked="checked"/>
                                    <input name="hand" type="radio" value="0" title="无"/>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label label-required">假锁</label>
                                <div class="layui-input-block">
                                    <input name="falseLock" type="radio" value="1" title="有" checked="checked"/>
                                    <input name="falseLock" type="radio" value="0" title="无"/>
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
    $('.colpick').css('z-index',9999);
    $('#save').click(function(){
        var pwd = $('#pwd').val();
        var repwd = $('#repwd').val();
        if (pwd != repwd) {
            alert('两次输入的密码不一致');
            return false;
        }
    });
});
    
</script>
</body>
</html>