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
    <title>订单管理</title>
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
            <form action="<?php echo U('Order/update');?>" id="form" class="layui-form layui-form-pane">
                <div class="sc_title sc_body_title">
                    <h5>订单管理</h5>
                    <div class="sc_title_btn">
                        <button id="save" type="submit" class='layui-btn layui-btn-sm'><i class='layui-icon'>&#xe605;</i> 保存</button>
                        <a class='layui-btn layui-btn-sm layui-btn-primary' href="javascript:history.back()"><i class="layui-icon">&#x1006;</i> 返回</a>
                    </div>
                </div>
                <div class="fadeInUp animated">
                    <section class="sc_layout_inner layui-clear">
                        <div class="sc_editor_content">
                            <input name="id" type="hidden" value="<?php echo ($info["id"]); ?>" />
                            <input name="mod" type="hidden" value="<?php echo ($mod); ?>" />
                            <div class="layui-form-item">
                                <label class="layui-form-label">订单号</label>
                                <div class="layui-input-block">
                                    <input type="text" name="orderCode" class="layui-input" autocomplete="off" value="<?php echo ($info["ordercode"]); ?>" disabled="disabled">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">代理商</label>
                                <div class="layui-input-block">
                                    <input type="text" name="saleman" class="layui-input" autocomplete="off" value="<?php echo ($info["saleman"]); ?>" disabled="disabled">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label label-required">联系方式</label>
                                <div class="layui-input-block">
                                    <input type="text" name="phone" class="layui-input" autocomplete="off" value="<?php echo ($info["phone"]); ?>">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label label-required">送货地址</label>
                                <div class="layui-input-block">
                                    <input type="text" name="address" class="layui-input" autocomplete="off" value="<?php echo ($info["address"]); ?>">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">订单详情</label>
                                <div class="layui-input-block">
                                <div style="
                                        line-height: 1.3;
                                        border-width: 1px;
                                        border-style: solid;
                                        background-color: #fff;
                                        border-color: #e6e6e6;
                                        border-radius: 2px;
                                        padding: 10px 0 10px 10px;" >
                                    <?php if(is_array($model)): foreach($model as $key=>$value): echo ($value["goodsname"]); ?>-<?php echo ($value["goodsmodel"]); ?>&nbsp;X&nbsp;<?php echo ($value["goodsnum"]); ?><br/><?php endforeach; endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label label-required">备注</label>
                                <div class="layui-input-block">
                                    <textarea id="orderbak" name="orderbak" class="layui-textarea" value="<?php echo ($info["orderbak"]); ?>"><?php echo ($info["orderbak"]); ?></textarea>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">下单时间</label>
                                <div class="layui-input-block">
                                    <input type="text" name="entime" class="layui-input" autocomplete="off" value="<?php echo ($info["entime"]); ?>" disabled="disabled">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label label-required">回访状态</label>
                                <div class="layui-input-block">
                                    <select id="status" name="status" class="layui-select">
                                        <option value="0">未受理</option>
                                        <option value="1">已受理</option>
                                        <option value="2">未通过</option>
                                    </select>
                                </div>
                            </div>
                            <div id="msg" class="layui-form-item" 
                            <?php if($info['status'] != 2): ?>style="display: none"<?php endif; ?>
                            >
                                <label class="layui-form-label">信息反馈</label>
                                <div class="layui-input-block">
                                    <textarea name="msg" class="layui-textarea"><?php echo ($info["msg"]); ?></textarea>
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
        //$('#saleman').val(parseInt('<?php echo ($info["salemanid"]); ?>'));
        $('#status').val(parseInt('<?php echo ($info["status"]); ?>'));
        $('#orderbak').val('<?php echo ($info["orderbak"]); ?>');
        $('#save').click(function(){
            
        });

        layui.use(['layer', 'form'], function(){
        var form = layui.form;
        form.on('select', function(data){
            //alert($(data.elem).val());
            if (data.value == 2) {
                $('#msg').show();
            } else {
                $('#msg').hide();
            }
          //console.log(data.elem); //得到select原始DOM对象
         // console.log(data.value); //得到被选中的值
          //console.log(data.othis); //得到美化后的DOM对象
        }); 
    });

        
    });
    


</script>
</body>
</html>