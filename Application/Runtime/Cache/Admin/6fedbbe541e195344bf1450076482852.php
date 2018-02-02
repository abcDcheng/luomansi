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
    <script src="/luomansi/Application/Admin/Public/js/jquery.min.js"></script>
    <script src="/luomansi/Application/Admin/Public/js/validform.js"></script>
    <script src="/luomansi/Application/Admin/Public/js/sitecms.js"></script>

    <!-- 让IE8/9支持媒体查询 -->
	<!--[if lt IE 9]>
		<script src="./js/html5shiv.min.js"></script>
		<script src="./js/respond.min.js"></script>
	<![endif]-->
    <title>罗曼斯代理商后台管理系统</title>
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
				<dd><a href="<?php echo U('Admin/servicer');?>">代理商人员</a></dd>
				<dd><a href="<?php echo U('Goods/index');?>">产品管理</a></dd>
				<dd><a href="<?php echo U('Order/index');?>">订单管理</a></dd>
				<dd><a href="<?php echo U('Order/history');?>">历史订单</a></dd>
				<dd><a href="#">安装管理</a></dd>
				<dd><a href="#">安装统计</a></dd>
				<dd><a href="<?php echo U('Maintain/index');?>">维护管理</a></dd>
				<dd><a href="<?php echo U('Maintain/history');?>">维护统计</a></dd>
				<?php } } ?>
				<dd><a href="<?php echo U('Index/pwd');?>">密码修改</a></dd>
				<dd><a id="loginout" href="<?php echo U('Index/loginout');?>">退出登录</a></dd>
                </dl> 
            </dd>
        </dl>
    </ul>
    </div>
    <div class="layui-body" id="sc_body">
        <div class="sc_body">
            <div class="sc_title sc_body_title">
                <h5>系统首页</h5>
            </div>
            <div class="fadeInUp animated">
                <fieldset class="layui-elem-field">
                    <legend>登录信息</legend>
                    <div class="layui-field-box">
                        <ul class="sc_list_info">
                            <li>欢迎您：admin。</li>
                            <!-- <li>登录时间 : 2017年12月01日 00:00:00</li> -->
                        </ul>
                    </div>
                </fieldset>
                <!-- <div class="layui-row layui-col-space15">
                    <div class="layui-col-md6">
                        <blockquote class="layui-elem-quote layui-quote-nm">
                            <ul class="sc_list_info">
                                <li><span>程序版本 :</span>V3.2</li>
                                <li><span>ThinkPHP版本 :</span>3.2.3</li>
                                <li><span>服务器操作系统 :</span>Darwin</li>
                                <li><span>WEB运行环境 :</span>apache2handler</li>
                                <li><span>PHP版本 :</span>5.6.32</li>
                                <li><span>Mysql版本 :</span>10.1.28-MariaDB</li>
                                <li><span>上传大小限制 :</span>128M</li>
                            </ul>
                        </blockquote>
                    </div>
                    <div class="layui-col-md6">
                        <blockquote class="layui-elem-quote layui-quote-nm">
                            <ul class="sc_list_info">
                                <li><span>版权所有 :</span><a href="https://sitecms.cn" target="_blank">SiteCMS</a></li>
                                <li><span>基于程序 :</span><a href="http://www.thinkphp.cn" target="_blank">ThinkPHP</a></li>
                                <li><span>前端框架 :</span><a href="http://www.layui.com" target="_blank">Layui</a></li>
                                <li><span>开发团队 :</span><a href="https://defaultfish.com" target="_blank">DefaultFish</a></li>
                                <li><span>联系邮箱 :</span><a href="mailto:defaultfish@qq.com">defaultfish@qq.com</a></li>
                                <li><span>项目地址 :</span><a href="https://gitee.com/defaultfish/sitecms">https://gitee.com/defaultfish/sitecms</a></li>
                                <li><span>BUG反馈 :</span><a href="https://gitee.com/defaultfish/sitecms/issues">https://gitee.com/defaultfish/sitecms/issues</a></li>
                            </ul>
                        </blockquote>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>
</body>
</html>