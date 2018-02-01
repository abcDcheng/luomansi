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
    
    <!-- 订单维护 -->
	<div class="maintain">
		

		<!-- 订单已完成 -->
		<ul class="maintain-complete maintain-style" style="display: block">
			<?php if(is_array($info)): foreach($info as $k=>$value): ?><li>
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
					<button class="query-state-btn maintain-executable-state-2">已完成</button>
				</div>
				<span class='lineColor'></span>
				<a href="javascript:;" class="maintain-data-btn" value="<?php echo ($k); ?>">查看详情>></a>
			</li><?php endforeach; endif; ?>
		</ul>
		<!-- 订单已完成详情 -->
		<div class="maintain-complete-date-wrap maintain-date-wrap">
			<div class="maintain-executable-date">
				<div class="maintain-executable-date-img">
					<img src="/luomansi/Application/Home/Public/img/product1.jpg" alt="">
				</div>
				<h5 id="goods"></h5>
				<span id="namephone"></span>
				<p id="address"></p>
				<strong id="msg"></strong>

				<div class="maintain-complete-imgbg">
					<img id="img" src="/luomansi/Application/Home/Public/img/complete-img.jpg" alt="" class="complete-img">
					<img src="/luomansi/Application/Home/Public/img/icon12.png" alt="" class="icon12">
				</div>
				<button id="return" class="maintain-executable-date-btn">返回</button>
			</div>

		</div>
		

	</div>


	<!-- 底部导航 -->
	<div class="footer-nav maintain-nav">
		<a href="<?php echo U('Maintain/index');?>" class="footer-nav-item line2">
			<img src="/luomansi/Application/Home/Public/img/maintain-nav1.png" alt="" class="footer-nav-img">
			<img src="/luomansi/Application/Home/Public/img/maintain-nav1-active.png" alt="" class="footer-nav-imgActive">
		</a>
		<a href="<?php echo U('Maintain/service');?>" class="footer-nav-item line2">
			<img src="/luomansi/Application/Home/Public/img/maintain-nav2.png" alt="" class="footer-nav-img">
			<img src="/luomansi/Application/Home/Public/img/maintain-nav2-active.png" alt="" class="footer-nav-imgActive">
		</a>
		<a href="<?php echo U('Maintain/complete');?>" class="footer-nav-item footer-nav-itemActive">
			<img src="/luomansi/Application/Home/Public/img/maintain-nav3.png" alt="" class="footer-nav-img">
			<img src="/luomansi/Application/Home/Public/img/maintain-nav3-active.png" alt="" class="footer-nav-imgActive">
		</a>
	</div>

</div>

<script type="text/javascript">
	
	$(function(){

		var info = <?php echo json_encode($info);?>;
		var imgSrc = '/luomansi/Application/Upload'+'/';
		/*<!-- 订单已完成详情 -->*/
		$('.maintain-complete a').click(function(){
			var i = $(this).attr('value');
			$('#goods').text(info[i]['goods']);
			$('#namephone').html(info[i]['name']+"&nbsp;&nbsp;&nbsp;&nbsp;"+info[i]['phone']);
			$('#address').text(info[i]['address']);
			$('#img').attr('src',imgSrc+info[i]['comimg']);
			$('#msg').text('维护内容：'+info[i]['msg']);
			$('.maintain-complete').hide();
			$('.maintain-complete-date-wrap').show();
		});

		$('#return').click(function(){
			$('.maintain-complete').show();
			$('.maintain-complete-date-wrap').hide();
		});

	})

</script>

</body>
</html>