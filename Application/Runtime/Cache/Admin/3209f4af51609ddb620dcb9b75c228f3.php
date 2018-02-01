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
            <form action="<?php echo U('Maintain/update');?>" id="form" class="layui-form layui-form-pane">
                <div class="sc_title sc_body_title">
                    <h5>详情页</h5>
                    <div class="sc_title_btn">
                        <button id="save" type="submit" class='layui-btn layui-btn-sm'><i class='layui-icon'>&#xe605;</i> 保存</button>
                        <a class='layui-btn layui-btn-sm layui-btn-primary' href="<?php echo U('Maintain/index');?>"><i class="layui-icon">&#x1006;</i> 返回</a>
                    </div>
                </div>
                <div class="fadeInUp animated">
                    <section class="sc_layout_inner layui-clear">
                        <div class="sc_editor_content">
                            <input name="id" type="hidden" value="<?php echo ($info["id"]); ?>" />
                            <div class="layui-form-item">
                                <label class="layui-form-label label-required">创建人员</label>
                                <div class="layui-input-block">
                                    <input type="text" name="username" class="layui-input" autocomplete="off" value="<?php echo ($info["username"]); ?>" disabled="disabled">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label label-required">客户姓名</label>
                                <div class="layui-input-block">
                                    <input type="text" name="name" class="layui-input" autocomplete="off" placeholder="客户姓名" datatype="s2-16" errormsg="客户姓名至少2个字符!" nullmsg="请输入客户姓名!"  value="<?php echo ($info["name"]); ?>">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label label-required">联系方式</label>
                                <div class="layui-input-block">
                                    <input type="text" name="phone" class="layui-input" autocomplete="off" datatype="s2-30" errormsg="请输入正确的联系方式" placeholder="联系方式" nullmsg="请输入联系方式!" value="<?php echo ($info["phone"]); ?>">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label label-required">详细地址</label>
                                <div class="layui-input-block">
                                    <input type="text" name="address" class="layui-input" autocomplete="off" datatype="s2-255" errormsg="请输入正确的详细地址" placeholder="详细地址" nullmsg="请输入详细地址!" value="<?php echo ($info["address"]); ?>">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label label-required">维护信息</label>
                                <div class="layui-input-block">
                                    <textarea id="msg" name="msg" class="layui-textarea"  placeholder="维护信息"><?php echo ($info["msg"]); ?></textarea>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label label-required">负责代理商</label>
                                <div class="layui-input-block">
                                    <select id="saleman" name="saleman" class="layui-select">
                                        <option value="">选择代理商</option>
                                        <?php if(is_array($saleman)): foreach($saleman as $key=>$value): ?><option value="<?php echo ($value["id"]); ?>"><?php echo ($value["name"]); ?>(<?php echo ($value["phone"]); ?>)</option><?php endforeach; endif; ?>
                                    </select>
                                </div>
                            </div>
                            <input name="oldSaleman" type="hidden" value="<?php echo ($info["salemanid"]); ?>">
                            <div class="layui-form-item">
                                <label class="layui-form-label">维护人员</label>
                                <div class="layui-input-block">
                                    <input type="text" name="serviceName" class="layui-input" autocomplete="off" value="<?php echo ($info["serviceName"]); echo ($info["servicePhone"]); ?>" disabled="disabled">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label label-required">回访状态</label>
                                <div class="layui-input-block">
                                    <select id="status" name="status" class="layui-select">
                                        <option value="0">未回访</option>
                                        <option value="1">已回访</option>
                                        <option value="2">服务异常</option>
                                    </select>
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
        $('#saleman').val(parseInt('<?php echo ($info["salemanid"]); ?>'));
        $('#status').val(parseInt('<?php echo ($info["status"]); ?>'));
        $('#msg').val('<?php echo ($info["msg"]); ?>');
        $('#save').click(function(){
            var saleman = $('#saleman').val();
            if (!saleman) {
                alert('请选择代理商');
                return false;
            }
        });
    });
    


</script>
</body>
</html>