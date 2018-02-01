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
	<script src="/luomansi/Application/Home/Public/js/jquery.photoClip.min.js"></script>
    <script type="text/javascript" src='/luomansi/Application/Home/Public/js/main.js'></script>
    <script type="text/javascript" src='/luomansi/Application/Home/Public/js/maintain.js'></script>
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
		
		<!-- 可执行订单 -->
		<ul class="maintain-executable maintain-style" style="display:block;">
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
					<button class="query-state-btn maintain-executable-state-1">执行维护</button>
				</div>
				<span class='lineColor'></span>
				<a href="javascript:;" class="maintain-data-btn" value="<?php echo ($k); ?>">查看详情>></a>
			</li><?php endforeach; endif; ?>
			
		</ul>
		<!-- 可执行订单详情 -->
		<div class="maintain-executable-date-wrap maintain-date-wrap" >
			<div class="maintain-executable-date">
				<div class="maintain-executable-date-img">
					<img src="/luomansi/Application/Home/Public/img/product1.jpg" alt="">
				</div>
				<h5>DD1智能锁-真金假锁</h5>
				<span>张先生   12345566677</span>
				<p>广东省广州市天河区天河北路...</p>
				<strong>维护内容：锁芯坏了，换锁芯...</strong>
			</div>
			<button class="maintain-executable-date-btn">执行维护</button>
		</div>
	</div>


	<!-- 底部导航 -->
	<div class="footer-nav maintain-nav">
		<a href="javascript:;" class="footer-nav-item footer-nav-itemActive">
			<img src="/luomansi/Application/Home/Public/img/maintain-nav1.png" alt="" class="footer-nav-img">
			<img src="/luomansi/Application/Home/Public/img/maintain-nav1-active.png" alt="" class="footer-nav-imgActive">
		</a>
		<a href="javascript:;" class="footer-nav-item line2">
			<img src="/luomansi/Application/Home/Public/img/maintain-nav2.png" alt="" class="footer-nav-img">
			<img src="/luomansi/Application/Home/Public/img/maintain-nav2-active.png" alt="" class="footer-nav-imgActive">
		</a>
		<a href="javascript:;" class="footer-nav-item line2">
			<img src="/luomansi/Application/Home/Public/img/maintain-nav3.png" alt="" class="footer-nav-img">
			<img src="/luomansi/Application/Home/Public/img/maintain-nav3-active.png" alt="" class="footer-nav-imgActive">
		</a>
	</div>

</div>

<script type="text/javascript">
	
	$(function(){
		var info = <?php echo json_encode($info);?>;
		$('.maintain-nav .footer-nav-item').click(function(){

			var _this = $(this).index();

			$('.maintain .maintain-style').hide();
			$('.maintain .maintain-style').eq(_this).show();

		});

		/*<!-- 可执行订单详情 -->*/
		$('.maintain-executable a').click(function(){
			$('.maintain-executable').hide();
			$('.maintain-executable-date-wrap').show();
		});

		/*<!-- 上传图片 -->*/
		$('.maintain-ing a').click(function(){
			$('.maintain-ing').hide();
			$('.maintain-upload').show();
		});

		/*<!-- 订单已完成详情 -->*/
		$('.maintain-complete a').click(function(){
			$('.maintain-complete').hide();
			$('.maintain-complete-date-wrap').show();
		});

	})

</script>

</body>
</html>