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
    <title>代理商账号管理</title>
</head>
<body>

<div class="layui-layout-admin">
    <div class="layui-tab sc_side_tab" lay-filter="nav">
    
    <ul class="layui-tab-title">
        <li class="layui-this">
            <div class="sc_side_manage" style="background-image:url('/luomansi/Application/Admin/Public/images/male.png');"></div>
            
        </li>
        <style type="text/css">
			#orderNum,#installNum{
				color:red;
			}
        </style>
        <dl class="layui-nav layui-nav-tree sc_side_more">
            <dd class="layui-nav-item layui-nav-itemed">
                <dl class="layui-nav-child">

				<?php if (isset($_SESSION['group'])) { $group = $_SESSION['group']; if ($group == 1) { ?>
				<dd><a href="<?php echo U('Saleman/staff');?>">人员管理</a></dd>
				<!-- <dd><a href="#">历史订单</a></dd> -->
				<dd><a href="<?php echo U('Saleman/installIndex');?>">安装管理</a></dd>
				<dd><a href="<?php echo U('Maintain/salemanIndex');?>">维护管理</a></dd>
				<?php } elseif ($group == 2) { ?>
				<dd><a href="<?php echo U('Order/index');?>">订单管理<span id="orderNum"></span></a></dd>
				<dd><a href="<?php echo U('Order/history');?>">历史订单</a></dd>
				<?php } elseif ($group == 3) { ?>	
				<dd><a href="<?php echo U('Install/index');?>">安装管理<span id="installNum"></span></a></dd>
				<dd><a href="<?php echo U('Install/history');?>">安装统计</a></dd>
				<dd><a href="<?php echo U('Maintain/index');?>">维护管理</a></dd>
				<dd><a href="<?php echo U('Maintain/history');?>">维护统计</a></dd>
				<?php } elseif ($group == 99) { ?>	
				<dd><a href="<?php echo U('Admin/ad');?>">手机广告语</a></dd>
				<dd><a href="<?php echo U('Admin/index');?>">专员管理</a></dd>
				<dd><a href="<?php echo U('Saleman/index');?>">代理商管理</a></dd>
				<dd><a href="<?php echo U('Admin/servicer');?>">代理商人员</a></dd>
				<dd><a href="<?php echo U('Goods/index');?>">产品管理</a></dd>
				<dd><a href="<?php echo U('Code/index');?>">识别码管理</a></dd>
				<dd><a href="<?php echo U('Order/index');?>">订单管理<span id="orderNum"></span></a></dd>
				<dd><a href="<?php echo U('Order/history');?>">历史订单</a></dd>
				<dd><a href="<?php echo U('Install/index');?>">安装管理<span id="installNum"></span></a></dd>
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


    <script type="text/javascript">
    	var getOrder = 0;
    	var getInstall = 0;
    	<?php if (isset($_SESSION['group'])) { $group = $_SESSION['group']; if ($group == 1) { ?>
				
		<?php } elseif ($group == 2) { ?>
				getOrder = 1;
				getNew();
				setInterval(getNew,10000);
		<?php } elseif ($group == 3) { ?>
				getInstall = 1;
				getNew();
				setInterval(getNew,10000);
		<?php } elseif ($group == 99) { ?>
				getOrder = 1;
				getInstall = 1;
				getNew();
				setInterval(getNew,10000);
		<?php } } ?>



		function getNew(){
			$.ajax({
				url : '<?php echo U("Index/getNew");?>',
				type : "post",
	            data : {getOrder:getOrder,getInstall:getInstall},
	            dataType : "json",
	            timeout : 5000,
	            success:function(data) {
	            	if (data.code == 1) {
	            		if (data.orderNum>0) {
	            			$('#orderNum').text('('+data.orderNum+')');
	            		} else {
	            			$('#orderNum').text('');
	            		}
	            		if (data.installNum>0) {
	            			$('#installNum').text('('+data.installNum+')');
	            		} else {
	            			$('#installNum').text('');
	            		}
	            	}
	            }
			});
		}
    </script>
    </div>
    <div class="layui-body" id="sc_body">
        <div class="sc_body">
        <div class="sc_title sc_body_title">
            <h5>代理商账号管理</h5>
            <div class="sc_title_btn">
                <a class="layui-btn layui-btn-sm" href="<?php echo U('Saleman/add');?>"><i class="layui-icon"></i> 新增</a>        </div>
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
                        <col width="120">
                        <col>
                        <col>
                        <col>
                    </colgroup>
                    <thead>
                        <tr>
                            <!-- <th><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose" class="list-check-box"><div class="layui-unselect layui-form-checkbox" lay-skin="primary"><i class="layui-icon"></i></div></th> -->
                            <th>账号</th>
                            <th>姓名</th>
                            <th>联系方式</th>
                            <th>省份</th>
                            <th>城市</th>
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
                            <td class="layui-elip"><?php echo ($value["province"]); ?></td>
                            <td class="layui-elip"><?php echo ($value["city"]); ?></td>
                            <?php if($value["is_status"] == 1): ?><td class="layui-elip" style="color:green">使用中</td>
                            <?php else: ?>
                                <td class="layui-elip" style="color:red">禁用</td><?php endif; ?>
                            <td><?php echo ($value["createtime"]); ?></td>
                            <td>
                                <a href="<?php echo U('Saleman/update?id='.$value['id']);?>" data-title="编辑">编辑</a>
                                <span class="sc_explode">|</span>
                                <a class="deleteId" data-confirm="#" value="<?php echo ($value["id"]); ?>">删除</a>
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
        $('.deleteId').click(function(){
            if (confirm('确定删除该账户吗？')) {
                var id = $(this).attr('value');
                //alert(id);
                $('.meng00').show();
                $.ajax({
                    url : "<?php echo U('Saleman/del');?>",
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