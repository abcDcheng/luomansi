<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>购物车</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
	<link rel="stylesheet" type="text/css" href="/luomansi/Application/Home/Public/css/style.css">
    <!-- JQ -->
    <script type="text/javascript" src="/luomansi/Application/Home/Public/js/jquery-1.11.0.min.js"></script>
    <!--移动端版本兼容 -->
    <script type="text/javascript" src='/luomansi/Application/Home/Public/js/mobile.js'></script>
    <script type="text/javascript" src='/luomansi/Application/Home/Public/js/main.js'></script>
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
	<!-- 购物车 -->
	<div class="shopping-cart">
		<div class="shopping-title">
			<span>订单详情：</span>
			<button class="addBtn">+ 加 单</button>
		</div>
		<!-- 购物车内容 -->
		<div class="query-content">
			<ul class="query-list-style" style="display:block;">
				<li>
					<div class="query-list-img-bg">
						<img src="img/product1.jpg" alt="">
					</div>
					<div class="query-list-message">
						<h5>DD1智能锁-真金假锁</h5>
						<i>2018-01-02  12:30 23 </i>
						<h4>数量：1</h4>
						<a href="javascript:;" class="edit">编辑</a>
					</div>
					<div class="query-list-state">
						<a href="javascript:;" class="deteleBtn">删除</a>
					</div>
				</li>
				<li>
					<div class="query-list-img-bg">
						<img src="img/product2.jpg" alt="">
					</div>
					<div class="query-list-message">
						<h5>DD1智能锁-真金假锁</h5>
						<i>2018-01-02  12:30 23 </i>
						<h4>数量：1</h4>
						<a href="javascript:;" class="edit">编辑</a>
					</div>
					<div class="query-list-state">
						<a href="javascript:;" class="deteleBtn">删除</a>
					</div>
				</li>
				<li>
					<div class="query-list-img-bg">
						<img src="img/product3.jpg" alt="">
					</div>
					<div class="query-list-message">
						<h5>DD1智能锁-真金假锁</h5>
						<i>2018-01-02  12:30 23 </i>
						<h4>数量：1</h4>
						<a href="javascript:;" class="edit">编辑</a>
					</div>
					<div class="query-list-state">
						<a href="javascript:;" class="deteleBtn">删除</a>
					</div>
				</li>
				<li>
					<textarea placeholder='备注:'></textarea>
				</li>
				<div class="no-information">
					<img src="img/no-information.png" alt="">
				</div>
			</ul>

			<button class="shopping-cart-btn">确认提交</button>
		</div>
	</div>

	<!-- 提交成功 -->
	<div class="successBg">
		<img src="img/icon13.png" alt="" class="icon13">
	</div>


	<!-- 底部导航 -->
	<div class="footer-nav">
		<a href="<?php echo U('Shop/index');?>" class="footer-nav-item">
			<img src="/luomansi/Application/Home/Public/img/nav1.png" alt="" class="footer-nav-img">
			<img src="/luomansi/Application/Home/Public/img/nav1-active.png" alt="" class="footer-nav-imgActive">
		</a>
		<a href="<?php echo U('Order/index');?>" class="footer-nav-item line2">
			<img src="/luomansi/Application/Home/Public/img/nav2.png" alt="" class="footer-nav-img">
			<img src="/luomansi/Application/Home/Public/img/nav2-active.png" alt="" class="footer-nav-imgActive">
		</a>
		<a href="<?php echo U('Shopcar/index');?>" class="footer-nav-item line2  footer-nav-itemActive">
			<img src="/luomansi/Application/Home/Public/img/nav3.png" alt="" class="footer-nav-img">
			<img src="/luomansi/Application/Home/Public/img/nav3-active.png" alt="" class="footer-nav-imgActive">
		</a>
		<a href="<?php echo U('Person/index');?>" class="footer-nav-item line2">
			<img src="/luomansi/Application/Home/Public/img/nav4.png" alt="" class="footer-nav-img">
			<img src="/luomansi/Application/Home/Public/img/nav4-active.png" alt="" class="footer-nav-imgActive">
		</a>
	</div>
</div>


<script type="text/javascript">
	$(function(){

		$('.shopping-cart-btn').click(function(){

			$('.shopping-cart').hide();
			$('.successBg').show();
		});
	})
</script>

</body>
</html>