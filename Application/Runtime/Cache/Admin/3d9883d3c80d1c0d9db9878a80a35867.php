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
    
    <!-- <link id="layuicss-layer" rel="stylesheet" href="http://admin.sitecms.cn/Public/plugs/layui/css/modules/layer/default/layer.css?v=3.1.0" media="all">
    <link id="layuicss-laydate" rel="stylesheet" href="http://admin.sitecms.cn/Public/plugs/layui/css/modules/laydate/default/laydate.css?v=5.0.9" media="all"> -->
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
                        <dd><a id="loginout">退出登录</a></dd>
                    </dl>
                </dd>
            </dl>
        </ul>
<!--         <div class="layui-tab-content">
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
</div> -->
    </div>
    <div class="layui-body" id="sc_body">
        <div class="sc_body">
        <div class="sc_title sc_body_title">
            <h5>代理商账号管理</h5>
            <div class="sc_title_btn">
                <button class="layui-btn layui-btn-sm" data-url="#"><i class="layui-icon"></i> 新增</button>        </div>
        </div>
<!--         <div class="sc_search layui-clear">
    <form method="get" action="/page/index.html?spm=m-1-5" class="layui-form sc_search_form">
        <div class="layui-input-inline">
            <input type="text" name="keyword" placeholder="请输入标题名称" value="" class="layui-input">
        </div>
        <div class="layui-inline">
            <div class="layui-input-inline">
                <input type="text" name="start_time" placeholder="起始时间" value="" class="layui-input sc_form_date" readonly="" lay-key="1">
            </div>
            -
            <div class="layui-input-inline">
                <input type="text" name="end_time" placeholder="结束时间" value="" class="layui-input sc_form_date" readonly="" lay-key="2">
            </div>
        </div>
        <button class="layui-btn layui-btn-danger sc_btn_search">搜索</button>
    </form>
</div> -->
        <div class="fadeInUp animated">
            <form id="form-list" class="layui-form">
                <input type="hidden" name="nid" value="5">
                <table class="layui-table" lay-even="" lay-skin="nob">
                    <colgroup>
                        <col>
                        <col>
                        <col>
                        <col>
                        <col width="160">
                        <col width="150">
                    </colgroup>
                    <thead>
                        <tr>
                            <!-- <th><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose" class="list-check-box"><div class="layui-unselect layui-form-checkbox" lay-skin="primary"><i class="layui-icon"></i></div></th> -->
                            <th>账号</th>
                            <th>姓名</th>
                            <th>联系方式</th>
                            <th>状态</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($info)): foreach($info as $key=>$value): ?><tr>
                            <!-- <td>
                                <input type="checkbox" name="id[]" value="<?php echo ($value["id"]); ?>" lay-skin="primary" class="list-check-box">
                                <div class="layui-unselect layui-form-checkbox" lay-skin="primary"><i class="layui-icon"></i></div>
                            </td> -->
                            <td class="layui-elip"><?php echo ($value["username"]); ?></td>
                            <td class="layui-elip"><?php echo ($value["name"]); ?></td>
                            <td class="layui-elip"><?php echo ($value["phone"]); ?></td>
                            <?php if($value["is_status"] == 1): ?><td class="layui-elip" style="color:green">使用中</td>
                            <?php else: ?>
                                <td class="layui-elip" style="color:red">禁用</td><?php endif; ?>
                            <td><?php echo ($value["createtime"]); ?></td>
                            <td>
                                <a href="<?php echo U('Saleman/update?id='.$value['id']);?>" data-title="编辑">编辑</a>
                                <span class="sc_explode">|</span>
                                <a data-confirm="#">删除</a>
                            </td>
                        </tr><?php endforeach; endif; ?>
                    </tbody>
                </table>
            </form>
            <div class="layui-clear">
                <div class="fr">
                    <div class="sc_pages">
                        <?php echo ($page); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    $(function(){
        lay('.sc_form_date').each(function(){
            layui.laydate.render({
                elem: this
                ,trigger: 'click'
                ,type: 'datetime'
            });
        });
        // layui.form.on('checkbox(allChoose)', function(data){
        //     var child = $(data.elem).parents('table').find('input[type="checkbox"]');
        //     child.each(function(index, item){
        //         item.checked = data.elem.checked;
        //     });
        //     if ($('.layui-table').find('.list-check-box').is(':checked')) {
        //         $('.sc_search').hide(300,function(){$('.sc_mobile').show(300);});
        //     } else {
        //         $('.sc_mobile').hide(300,function(){$('.sc_search').show(300);});
        //     };
        //     layui.form.render('checkbox');
        // });
        // $('.sc_mobile').hide();
        // layui.form.on('checkbox', function(data){
        //     if ($('.layui-table').find('.list-check-box').is(':checked')) {
        //         $('.sc_search').hide(300,function(){$('.sc_mobile').show(300);});
        //     } else {
        //         $('.sc_mobile').hide(300,function(){$('.sc_search').show(300);});
        //     };
        // });
    });
    
    </script>
    </div>
    </div>
</div>
</body>
</html>