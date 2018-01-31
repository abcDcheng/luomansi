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
    <title>后台专员管理</title>
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
        <div class="sc_title sc_body_title">
            <h5>产品管理</h5>
            <div class="sc_title_btn">
                <a class="layui-btn layui-btn-sm" href="<?php echo U('Goods/add');?>"><i class="layui-icon"></i> 新增</a>        </div>
        </div>
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
                            <th>产品图</th>
                            <th>产品名</th>
                            <th>状态</th>
                            <th>规格</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($info)): foreach($info as $key=>$value): ?><tr>
                            <td class="layui-elip"><img height="70" src="/luomansi/Application/Upload/<?php echo ($value["goodsimg"]); ?>"></td>
                            <td class="layui-elip"><?php echo ($value["goodsname"]); ?></td>
                            <?php if($value["status"] == 1): ?><td class="layui-elip" style="color:green">上架中</td>
                            <?php else: ?>
                                <td class="layui-elip" style="color:red">已下架</td><?php endif; ?>
                            <td><a href="<?php echo U('Goods/goodsModel?id='.$value['id']);?>">查看规格</a></td>
                            <td>
                                <a href="<?php echo U('Goods/update?id='.$value['id']);?>" data-title="编辑">编辑</a>
                                <span class="sc_explode">|</span>
                                <a class="deleteId" data-confirm="#" value="<?php echo ($value["id"]); ?>">删除</a>
                            </td>
                        </tr><?php endforeach; endif; ?>
                    </tbody>
                </table>
            </form>
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

    });
    
    </script>
    </div>
    </div>
</div>
</body>

<script type="text/javascript">
    $(function(){
        $('.deleteId').click(function(){
            if (confirm('确定删除该产品吗？')) {
                var id = $(this).attr('value');
                //alert(id);
                $('.meng00').show();
                $.ajax({
                    url : "<?php echo U('Goods/del');?>",
                    type : "post",
                    data : {id:id},
                    dataType : "json",
                    timeout : 10000,
                    success : function(data){
                        $('.meng00').hide();
                        if (data.code == 1) {
                            alert('删除成功');
                            window.location.reload();
                        } else {
                            alert(data.msg);
                        }
                    },
                    error : function(data){
                        $('.meng00').hide();
                        if (data.status == 'timeout') {
                            alert('连接超时，请重试');
                        }
                    }
                });
            }
        });
    });
</script>
</html>