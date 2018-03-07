<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>维护中心</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" type="text/css" href="/luomansi/Application/Home/Public/css/style1.css">
    <!-- JQ -->
    <script type="text/javascript" src="/luomansi/Application/Home/Public/js/jquery-1.11.0.min.js"></script>
    <!--移动端版本兼容 -->
    <script type="text/javascript" src='/luomansi/Application/Home/Public/js/mobile.js'></script>
    <script src="/luomansi/Application/Home/Public/js/iscroll-zoom.js"></script>
	<script src="/luomansi/Application/Home/Public/js/hammer.js"></script>
	<script src="/luomansi/Application/Home/Public/js/lrz.all.bundle.js"></script>
	<!-- <script src="/luomansi/Application/Home/Public/js/jquery.photoClip.min.js"></script> -->
    <script type="text/javascript" src='/luomansi/Application/Home/Public/js/main.js'></script>
    <!-- <script type="text/javascript" src='/luomansi/Application/Home/Public/js/maintain.js'></script> -->
	<!-- 自适应屏幕 -->
	<script type="text/javascript">
	    $(function(){
	        wHeight=$(window).height();
	        if(wHeight<975){
	            wHeight=975;
	            }
	        $('.page').height(wHeight).css('background-position','center '+(wHeight-1334)/2+'px');
	        $('.h832').css('padding-top',(wHeight-975)/2+'px');
	    })
	</script>

	
</head>
<body>

<div class="wrap">
    <div class="add-header" style="width:750px;margin:0 auto 0;box-sizing:border-box;padding:25px 40px;background-color:#fff;position:relative;">
        <img src="/luomansi/Application/Home/Public/img/header-logo.png" alt="">
        <p style="position: absolute;bottom:40px;right:40px;font-size:30px;color:#717f87;"><?php echo ($ad); ?></p>
    </div>
    <!-- 订单维护 -->
	<div class="maintain">
		
		<!-- 可执行订单 -->
		<ul class="maintain-executable maintain-style" style="display:block;">
			<?php if($hasInfo == 1): if(is_array($info)): foreach($info as $k=>$value): ?><li>
				<div class="query-list-img-bg">
					<img src="/luomansi/Application/Home/Public/img/product1.jpg" alt="">
				</div>
				<div class="query-list-message">
					<h5><?php echo ($value["goods"]); ?></h5>
					<p><?php echo ($value["name"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($value["phone"]); ?></p>
					<p><?php echo ($value["address"]); ?></p>
					<h3>维护内容：<?php echo ($value["msg"]); ?></h3>
				</div>
				<div class="query-list-state">
					<button class="query-state-btn maintain-executable-state-1" value="<?php echo ($k); ?>">执行维护</button>
				</div>
				<span class='lineColor'></span>
				<a href="javascript:;" class="maintain-data-btn" value="<?php echo ($k); ?>">查看详情>></a>
			</li><?php endforeach; endif; ?>
			<?php else: ?>
			<div class="no-information" style="display: block;">
				<img src="/luomansi/Application/Home/Public/img/no-information.png" alt="">
			</div><?php endif; ?>
		</ul>
		

		<!-- 可执行订单详情 -->
		<div class="maintain-executable-date-wrap maintain-date-wrap" >
			<div class="maintain-executable-date">
				<div class="maintain-executable-date-img">
					<img src="/luomansi/Application/Home/Public/img/product1.jpg" alt="">
				</div>
				

				<!-- 以前的 -->
				<!--
				<h5 id="goods"></h5> 
				<span id="namephone"></span>
				<p id="address"></p>
				<strong id="msg"></strong> -->
				<!-- 现在修改的 -->
				<p>订单要求：<con id="level"></con></p>
				<p>产品名称：<con id="goods"></con></p>
				<p>安装时间：<con id="installTime"></con></p>
				<p>产品问题：<i id="msg"></i></p>
				<p>客户名称：<con id="name"></con></p>
				<p>联系电话：<con id="phone"></con></p>
				<p>维护地址：<con id="address"></con></p>
				<p>客户说明：<con id="clientbak"></con></p>
			</div>
			<button id="service" class="maintain-executable-date-btn">执行维护</button>
			<button id="return" class="maintain-executable-date-btn">返回</button>
		</div>
	</div>


	<!-- 底部导航 -->
	<div class="footer-nav maintain-nav">
		<a href="<?php echo U('Maintain/index');?>" class="footer-nav-item footer-nav-itemActive">
			<img src="/luomansi/Application/Home/Public/img/maintain-nav1.png" alt="" class="footer-nav-img">
			<img src="/luomansi/Application/Home/Public/img/maintain-nav1-active.png" alt="" class="footer-nav-imgActive">
		</a>
		<a href="<?php echo U('Maintain/service');?>" class="footer-nav-item line2">
			<img src="/luomansi/Application/Home/Public/img/maintain-nav2.png" alt="" class="footer-nav-img">
			<img src="/luomansi/Application/Home/Public/img/maintain-nav2-active.png" alt="" class="footer-nav-imgActive">
		</a>
		<a href="<?php echo U('Maintain/complete');?>" class="footer-nav-item line2">
			<img src="/luomansi/Application/Home/Public/img/maintain-nav3.png" alt="" class="footer-nav-img">
			<img src="/luomansi/Application/Home/Public/img/maintain-nav3-active.png" alt="" class="footer-nav-imgActive">
		</a>
	</div>

</div>

<script type="text/javascript">
	
	$(function(){
		var info = <?php echo json_encode($info);?>;
		var orderId = 0;
		$('#service').click(function(){
			if (orderId) {
				if (confirm('确定开始执行该订单的维护吗')) {
					$(this).text('提交中...').attr('disabled',true);
					$.ajax({
						url : "<?php echo U('Maintain/startService');?>",
			            type : "post",
			            data : {orderId:orderId},
			            dataType : "json",
			            timeout : 5000,
			            success : function(data){
			            	$('#service').text('执行维护').removeAttr('disabled');
			            	if (data.code == 1) {
			            		window.location.href = "<?php echo U('Maintain/service');?>";
			            	} else {
			            		alert(data.msg);
			            	}
			            },
			            error : function(data){
			            	if (data.status == 'timeout') {
			            		alert('请求超时，请确认网络良好并重试');
			            	}
			            	$('#service').text('执行维护').removeAttr('disabled');
			            }
					});
				}
			} else {
				alert('请选择要维护的订单');
				return false;
			}
		});

		/*<!-- 可执行订单详情 -->*/
		$('.maintain-executable a,.query-state-btn').click(function(){
			var i = $(this).attr('value');
			orderId = info[i]['id'];
			$('#level').text(info[i]['orderLevel']);
			$('#goods').text(info[i]['goods']);
			$('#installTime').text(info[i]['installtime']);
			$('#name').html(info[i]['name']);
			$('#phone').html(info[i]['phone']);
			$('#address').text(info[i]['address']);
			$('#msg').text(info[i]['msg']);
			$('#clientbak').text(info[i]['clientbak']);
			$('.maintain-executable').hide();
			$('.maintain-executable-date-wrap').show();
		});
		$('#return').click(function(){
			$('.maintain-executable').show();
			$('.maintain-executable-date-wrap').hide();
		});
		/*<!-- 上传图片 -->*/
		// $('.maintain-ing a').click(function(){
		// 	$('.maintain-ing').hide();
		// 	$('.maintain-upload').show();
		// });

		// /*<!-- 订单已完成详情 -->*/
		// $('.maintain-complete a').click(function(){
		// 	$('.maintain-complete').hide();
		// 	$('.maintain-complete-date-wrap').show();
		// });

	})

</script>

</body>
</html>