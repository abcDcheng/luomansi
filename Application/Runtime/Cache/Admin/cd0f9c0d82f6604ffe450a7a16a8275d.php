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
        <div class="layui-tab-content">
            <div class="sc_title"></div>
            <div class="layui-tab-item layui-show">
                <menu class="sc_side_main">
                    <ul class="sc_side_menu">
                        <li class="layui-nav-item"><a data-title="系统首页" class="active">系统首页</a></li>
                    </ul>
                </menu>
            </div>
            <div class="layui-tab-item">
                <menu class="sc_side_main">
                    <ul class="sc_side_menu">
                        <li class="layui-nav-item"><a data-title="文章列表">文章列表</a></li>
                        <li class="layui-nav-item"><a data-title="文章子栏目">&nbsp;&nbsp;&nbsp;&nbsp;├ 文章子栏目</a></li>
                        <li class="layui-nav-item"><a data-title="文章分类">&nbsp;&nbsp;&nbsp;&nbsp;├ 文章分类</a></li>
                        <li class="layui-nav-item"><a data-title="单页编辑">单页编辑</a></li>
                        <li class="layui-nav-item"><a data-title="产品列表">产品列表</a></li>
                        <li class="layui-nav-item"><a data-title="链接列表">链接列表</a></li>
                        <li class="layui-nav-item"><a data-title="招聘列表">招聘列表</a></li>
                        <li class="layui-nav-item"><a data-title="下载列表">下载列表</a></li>
                    </ul>
                </menu>
            </div>
            <div class="layui-tab-item">
                <menu class="sc_side_main">
                    <ul class="sc_side_menu">
                        <li class="layui-nav-item"><a data-title="站点配置">站点配置</a></li>
                        <li class="layui-nav-item"><a data-title="导航管理">导航管理</a></li>
                        <li class="layui-nav-item"><a data-title="幻灯片管理">幻灯片管理</a></li>
                        <li class="layui-nav-item"><a data-title="留言管理">留言管理</a></li>
                        <li class="layui-nav-item"><a data-title="会员列表">会员列表</a></li>
                        <li class="layui-nav-item"><a data-title="订单管理">订单管理</a></li>
                    </ul>
                </menu>
            </div>
            <div class="layui-tab-item">
                <menu class="sc_side_main">
                    <ul class="sc_side_menu">
                        <li class="layui-nav-item"><a data-title="系统配置">系统配置</a></li>
                        <li class="layui-nav-item"><a data-title="模型管理">模型管理</a></li>
                        <li class="layui-nav-item"><a data-title="管理员列表">管理员列表</a></li>
                        <li class="layui-nav-item"><a data-title="节点管理">节点管理</a></li>
                    </ul>
                </menu>
            </div>
        </div>
    </div>
    <div class="layui-body" id="sc_body">
        <div class="sc_body">
            <form action="<?php echo U('Admin/update');?>" id="form" class="layui-form layui-form-pane">
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
                            <input name="id" value="<?php echo ($id); ?>" type="hidden"/>
                            <div class="layui-form-item">
                                <label class="layui-form-label label-required">用户名</label>
                                <div class="layui-input-block">
                                    <input type="text" name="username" class="layui-input" autocomplete="off" value="<?php echo ($info['username']); ?>" disabled='disabled'/>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">重置密码</label>
                                <div class="layui-input-block">
                                    <input name="repwd" type="checkbox" value="1">(不重置密码则不必勾选此项，若重置则默认密码为123456，再由改账户人员自行修改)
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label label-required">类别</label>
                                <div class="layui-input-block">
                                    <select id="group" name="group" class="layui-select">
                                        <option value="2">订单专员</option>
                                        <option value="3">客服专员</option>
                                    </select>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label label-required">状态</label>
                                <div class="layui-input-block">
                                    <?php if($info['is_status'] == 1): ?><input name="status" type="radio" value="1" title="使用中" checked="checked"/>
                                    <input name="status" type="radio" value="0" title="禁用"/>
                                    <?php else: ?>
                                    <input name="status" type="radio" value="1" title="使用中"/>
                                    <input name="status" type="radio" value="0" title="禁用" checked="checked"/><?php endif; ?>
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
        var group = parseInt(<?php echo ($info['group']); ?>);
        $('#group').val(group);
    });
    
</script>
</body>
</html>