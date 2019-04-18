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
<div class="layui-layout-admin sc_login">

    <div class="sc_login_inner">
    
        <div class="sc_login_content">
<img style="width:330px;height:110px;margin:0 0 25px 75px;" src="/luomansi/Application/Admin/Public/images/logo_big.png"/>
            <div class="sc_login_right">
                <form method="post" id="form" class="layui-form">
                    <dl>
                        <dt>罗曼斯代理商后台管理系统</dt>
                        <dd>
                            <label for="username">
                                <span class="icon"><i class="fa fa-user"></i></span>
                                <div class="layui-input-inline">
                                    <input type="text" name="username" autocomplete="off" placeholder="用户名" datatype="s1-16" errormsg="用户名至少1个字符!" nullmsg="请输入用户名!" class="layui-input" value="<?php echo ($username); ?>"/>
                                </div>
                            </label>
                        </dd>
                        <dd>
                            <label for="password">
                                <span class="icon"><i class="fa fa-key"></i></span>
                                <div class="layui-input-inline">
                                    <input type="password" name="password" autocomplete="off" placeholder="密码" datatype="*6-18" errormsg="密码范围在6~18位之间!" nullmsg="请输入密码!" class="layui-input" />
                                </div>
                            </label>
                        </dd>
                        <dd>
                            
                            <p>
                            <?php if($cookie == 1): ?><input name="cookie" lay-skin="primary" type="checkbox" value="1" title="记住账号" checked="checked">
                            <?php else: ?>
                                <input name="cookie" lay-skin="primary" type="checkbox" value="1" title="记住账号"><?php endif; ?>
                                <button class="layui-btn">登 录</button>
                            </p>
                        </dd>
                    </dl>
                </form>
            </div>
            <div style="width:100%;float: left;font-size: 20px;margin: 20px 0;text-align: center;color: #eee"><p><?php echo ($ad['ad']); ?></p></div>
            <div class="sc_login_left"></div>
        </div>
    </div>
</div>
</body>
</html>