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
            
        </li>
        <dl class="layui-nav layui-nav-tree sc_side_more">
            <dd class="layui-nav-item layui-nav-itemed">
                <dl class="layui-nav-child">

				<?php if (isset($_SESSION['group'])) { $group = $_SESSION['group']; if ($group == 1) { ?>
				<dd><a href="<?php echo U('Saleman/staff');?>">人员管理</a></dd>
				<!-- <dd><a href="#">历史订单</a></dd> -->
				<dd><a href="<?php echo U('Saleman/installIndex');?>">安装管理</a></dd>
				<dd><a href="<?php echo U('Maintain/salemanIndex');?>">维护管理</a></dd>
				<?php } elseif ($group == 2) { ?>
				<dd><a href="<?php echo U('Order/index');?>">订单管理</a></dd>
				<dd><a href="<?php echo U('Order/history');?>">历史订单</a></dd>
				<?php } elseif ($group == 3) { ?>	
				<dd><a href="<?php echo U('Install/index');?>">安装管理</a></dd>
				<dd><a href="<?php echo U('Install/history');?>">安装统计</a></dd>
				<dd><a href="<?php echo U('Maintain/index');?>">维护管理</a></dd>
				<dd><a href="<?php echo U('Maintain/history');?>">维护统计</a></dd>
				<?php } elseif ($group == 99) { ?>	
				<dd><a href="<?php echo U('Admin/index');?>">专员管理</a></dd>
				<dd><a href="<?php echo U('Saleman/index');?>">代理商管理</a></dd>
				<dd><a href="<?php echo U('Admin/servicer');?>">代理商人员</a></dd>
				<dd><a href="<?php echo U('Goods/index');?>">产品管理</a></dd>
				<dd><a href="<?php echo U('Order/index');?>">订单管理</a></dd>
				<dd><a href="<?php echo U('Order/history');?>">历史订单</a></dd>
				<dd><a href="<?php echo U('Install/index');?>">安装管理</a></dd>
				<dd><a href="<?php echo U('Install/history');?>">安装统计</a></dd>
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
            <form action="<?php echo U('Maintain/salemanUpdate');?>" id="form" class="layui-form layui-form-pane">
                <div class="sc_title sc_body_title">
                    <h5>详情页</h5>
                    <div class="sc_title_btn">
                        <button id="save" type="submit" class='layui-btn layui-btn-sm'><i class='layui-icon'>&#xe605;</i> 保存</button>
                        <a class='layui-btn layui-btn-sm layui-btn-primary' href="<?php echo U('Maintain/salemanIndex');?>"><i class="layui-icon">&#x1006;</i> 返回</a>
                    </div>
                </div>
                <div class="fadeInUp animated">
                    <section class="sc_layout_inner layui-clear">
                        <div class="sc_editor_content">
                            <input name="id" type="hidden" value="<?php echo ($info["id"]); ?>" />
                            <div class="layui-form-item">
                                <label class="layui-form-label">创建人员</label>
                                <div class="layui-input-block">
                                    <input type="text" name="username" class="layui-input" autocomplete="off" value="<?php echo ($info["username"]); ?>" disabled="disabled">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">客户姓名</label>
                                <div class="layui-input-block">
                                    <input type="text" name="name" class="layui-input" autocomplete="off" placeholder="客户姓名"  value="<?php echo ($info["name"]); ?>" disabled="disabled">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">联系方式</label>
                                <div class="layui-input-block">
                                    <input type="text" name="phone" class="layui-input" autocomplete="off" value="<?php echo ($info["phone"]); ?>" disabled="disabled">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">详细地址</label>
                                <div class="layui-input-block">
                                    <input type="text" name="address" class="layui-input" autocomplete="off" value="<?php echo ($info["address"]); ?>" disabled="disabled">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">维护信息</label>
                                <div class="layui-input-block">
                                    <textarea id="msg" name="msg" class="layui-textarea"  placeholder="维护信息" disabled="disabled"><?php echo ($info["msg"]); ?></textarea>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label label-required">维护人员</label>
                                <div class="layui-input-block">
                                    <select id="servicer" name="servicer" class="layui-select">
                                        <option value="">选择维护人员</option>
                                        <?php if(is_array($servicer)): foreach($servicer as $key=>$value): ?><option value="<?php echo ($value["id"]); ?>"><?php echo ($value["name"]); ?>(<?php echo ($value["phone"]); ?>)</option><?php endforeach; endif; ?>
                                    </select>
                                </div>
                                <input name="oldServicer" type="hidden" value="<?php echo ($info["serviceid"]); ?>">
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label label-required">回访状态</label>
                                <div class="layui-input-block">
                                <?php if($info["status"] == 2): ?><input type="text" name="status" class="layui-input" autocomplete="off" value="服务异常" disabled="disabled">
                                <{else if condition="$info.status eq 1"}>
                                <input type="text" name="status" class="layui-input" autocomplete="off" value="已回访" disabled="disabled">
                                <?php else: ?>
                                <input type="text" name="status" class="layui-input" autocomplete="off" value="已回访" disabled="disabled"><?php endif; ?>
                                </div>
                            </div>
                            <?php if($info['servicestatus'] == 2 and $info['comimg'] != ''): ?><div class="layui-form-item from_item_image">
                                <div class="img_label">
                                    <label>现场照片</label>
                                </div>
                                <div id="thumb_view" class="img_item transition">
                                    <img src="/luomansi/Application/Upload//<?php echo ($info['comimg']); ?>">
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
        $('#servicer').val(parseInt('<?php echo ($info["serviceid"]); ?>'));
        $('#msg').val('<?php echo ($info["msg"]); ?>');
        $('#save').click(function(){
            var servicer = $('#servicer').val();
            if (!servicer) {
                alert('请选择维护人员');
                return false;
            }
        });
    });
    


</script>
</body>
</html>