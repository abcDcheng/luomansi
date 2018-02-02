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
    <title>维护管理</title>
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
				<dd><a href="#">代理商人员</a></dd>
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
        <div class="sc_title sc_body_title">
            <h5>维护管理</h5>
            <!-- <div class="sc_title_btn">
                <a class="layui-btn layui-btn-sm" href="<?php echo U('Maintain/add');?>"><i class="layui-icon"></i> 新增</a>        </div> -->
        </div>
        <div class="fadeInUp animated">
            <form id="form-list" class="layui-form">
                <div class="layui-input-inline">
                    
                </div>
                <div class="layui-inline">
                    <div class="layui-input-inline">
                        <input type="text" name="start_time" placeholder="起始时间" value="{$start_time|default=''}" class="layui-input sc_form_date" readonly="">
                    </div>
                    -
                    <div class="layui-input-inline">
                        <input type="text" name="end_time" placeholder="结束时间" value="{$end_time|default=''}" class="layui-input sc_form_date" readonly="">
                    </div>
                </div>
                <button class="layui-btn layui-btn-danger sc_btn_search">搜索</button>
                <input type="hidden" name="nid" value="5">
                <table class="layui-table" lay-even="" lay-skin="nob">
                    <colgroup>
                        <col>
                        <col>
                        <col>
                        <col>
                        <col width="100">
                        <col width="120">
                        <col>
                        <col>
                        <col>
                        <col>
                        <col>
                    </colgroup>
                    <thead>
                        <tr>
                            <th>创建人员</th>
                            <th>客户姓名</th>
                            <th>联系方式</th>
                            <th>详细地址</th>
                            <th>产品名称</th>
                            <th>信息描述</th>
                            <th>创建时间</th>
                            <th>负责代理商</th>
                            <th>维护人员</th>
                            <th>维护状态</th>
                            <th>维护时间</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($info)): foreach($info as $key=>$value): ?><tr>
                            <td class="layui-elip"><?php echo ($value["username"]); ?></td>
                            <td class="layui-elip"><?php echo ($value["name"]); ?></td>
                            <td class="layui-elip"><?php echo ($value["phone"]); ?></td>
                            <td class="layui-elip"><?php echo ($value["address"]); ?></td>
                            <td class="layui-elip"><?php echo ($value["goods"]); ?></td>
                            <td class="layui-elip"><?php echo ($value["msg"]); ?></td>
                            <td class="layui-elip"><?php echo ($value["entime"]); ?></td>
                            <td class="layui-elip"><?php echo ($value["saleman"]); ?></td>
                            <td class="layui-elip"><?php echo ($value["servicename"]); ?></td>
                            <?php if($value["servicestatus"] == 0): ?><td class="layui-elip" style="color:red">未维护</td>
                            <?php elseif($value["servicestatus"] == 1): ?>
                                <td class="layui-elip" style="color:orange">维护中</td>
                            <?php else: ?>
                                <td class="layui-elip" style="color:green">已完成</td><?php endif; ?>
                            <td class="layui-elip"><?php echo ($value["serendtime"]); ?></td>
                            <td>
                                <a href="<?php echo U('Maintain/update?id='.$value['id']);?>" data-title="编辑">编辑</a>
                                <span class="sc_explode">
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

    });
    
    </script>
    </div>
    </div>
</div>
</body>

<script type="text/javascript">
    $(function(){
        $('.deleteId').click(function(){
            if (confirm('确定删除该数据吗？')) {
                var id = $(this).attr('value');
                //alert(id);
                $('.meng00').show();
                $.ajax({
                    url : "<?php echo U('Maintain/del');?>",
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