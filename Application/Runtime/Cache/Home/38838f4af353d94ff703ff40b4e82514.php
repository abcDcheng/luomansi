<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>我要下单</title>
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
    
	<!-- 下订单 -->
	<div class="order">
		<!-- 下订单列表 -->
		<ul class="order-list">
		<?php if(is_array($goods)): foreach($goods as $key=>$value): ?><li>
				<a href="javascript:;" value="<?php echo ($key); ?>"><?php echo ($value); ?></a>
			</li><?php endforeach; endif; ?>
			<!-- <li>
				<a href="javascript:;">DD1智能锁</a>
			</li>
			<li>
				<a href="javascript:;">DD1智能锁</a>
			</li>
			<li>
				<a href="javascript:;">DD1智能锁</a>
			</li>
			<li>
				<a href="javascript:;">DD1智能锁</a>
			</li>
			<li>
				<a href="javascript:;">DD1智能锁</a>
			</li>
			<li>
				<a href="javascript:;">DD1智能锁</a>
			</li>
			<li>
				<a href="javascript:;">DD1智能锁</a>
			</li> -->
		</ul>
		<!-- 下订单详情 -->
		<div class="order-date-bg">
			<ul class="order-date">
				<li>
					<p class="icon03">
						<span>型<em></em><em></em>号：</span>
						<strong>DD1智能锁</strong>
					</p>
				</li>
				<li>
					<p>
						<span>车身颜色：</span>
						<strong class='carColor'>红古</strong>
					</p>
					<div class="chioceColor">
						<span class='active' value='红古'>
							<i style='background-color: #7f2d00;'></i>
							红<em></em>古
						</span>
						<span value='青古'>
							<i style='background-color: #cce198;'></i>
							青<em></em>古
						</span>
						<span value='白金'>
							<i style='background-color: #d1c0a5;'></i>
							白<em></em>金
						</span>
						<span value='黑宝石'>
							<i style='background-color: #211916;'></i>
							宝石黑
						</span>
						<span style='font-size:25px;padding:17.5px 13px;' value='奥斯卡金'>
							<i style='background-color: #fff100;'></i>
							奥斯卡金
						</span>
						<span value='红古铜'>
							<i style='background-color: #7d0000;'></i>
							红古铜
						</span>
						<span value='珍珠铬'>
							<i style='background-color: #eeeeee;'></i>
							珍珠铬
						</span>
					</div>
				</li>
				<li>
					<p class="icon03">
						<span>拉<em></em><em></em>手：</span>
						<strong>1</strong>
					</p>
				</li>
				<li id="hand">
					<p>
						<span>方<em></em><em></em>向：</span>
						<strong class='hand'>带下拉手</strong>
					</p>
					<label class="handChoice">
						<small class='active' value='带下拉手'>带下拉手</small>
						<small value='不带下拉手'>不带下拉手</small>
					</label>
				</li>
				<li id="falseLock">
					<p>
						<span>方<em></em><em></em>向：</span>
						<strong class='lock'>带假锁</strong>
					</p>
					<label class="lockChoice">
						<small class='active' value='带假锁'>带假锁</small>
						<small value='不带假锁'>不带假锁</small>
					</label>
				</li>
				<li>
					<p>
						<span>数<em></em><em></em>量：</span>
						<input type="number" value="10">
					</p>
				</li>
			</ul>
			<button class="order-date-btn">确认订单</button>
		</div>
	</div>


	<!-- 底部导航 -->
	<div class="footer-nav">
		<a href="order.html" class="footer-nav-item footer-nav-itemActive">
			<img src="/luomansi/Application/Home/Public/img/nav1.png" alt="" class="footer-nav-img">
			<img src="/luomansi/Application/Home/Public/img/nav1-active.png" alt="" class="footer-nav-imgActive">
		</a>
		<a href="query.html" class="footer-nav-item line2">
			<img src="/luomansi/Application/Home/Public/img/nav2.png" alt="" class="footer-nav-img">
			<img src="/luomansi/Application/Home/Public/img/nav2-active.png" alt="" class="footer-nav-imgActive">
		</a>
		<a href="shopping-cart.html" class="footer-nav-item line2">
			<img src="/luomansi/Application/Home/Public/img/nav3.png" alt="" class="footer-nav-img">
			<img src="/luomansi/Application/Home/Public/img/nav3-active.png" alt="" class="footer-nav-imgActive">
		</a>
		<a href="<?php echo U('Person/index');?>" class="footer-nav-item line2">
			<img src="/luomansi/Application/Home/Public/img/nav4.png" alt="" class="footer-nav-img">
			<img src="/luomansi/Application/Home/Public/img/nav4-active.png" alt="" class="footer-nav-imgActive">
		</a>
	</div>
</div>
<style type="text/css">
    .meng00{display:none;z-index:9999;width: 100%;height: 100%;position: fixed;left: 0;top:0;background:url('/luomansi/Application/Home/Public/img/15.gif') center center no-repeat rgba(0,0,0,0.8);}
</style>
<div class="meng00"></div>


</body>

<script type="text/javascript">
	
$(function(){

	/*打开订单详情*/
	$('.order-list li a').click(function(){
		var goodsId = parseInt($(this).attr("value"));
		$('.chioceColor,.handChoice,.lockChoice').empty();
		$('.meng00').show();
		$.ajax({
			url : "<?php echo U('Shop/goodsInfo');?>",
            type : "post",
            data : {goodsId:goodsId},
            dataType : "json",
            timeout : 5000,
            success : function(data){
            	if (data.code == 's') {

					$('.order-list').hide();
					$('.order-date-bg').show();
            	} else {
            		alert(data.msg);
            	}
            	$('.meng00').hide();
            }
		});
		
	});

	/*选择颜色*/
	$('.chioceColor span').click(function(){

		$('.chioceColor span').removeClass('active');
		$(this).addClass('active');

		var thisValue = $(this).attr('value');
		$('.carColor').text(thisValue);
	});

	/*是否带下拉手*/
	$('.handChoice small').click(function(){
		$('.handChoice small').removeClass('active');
		$(this).addClass('active');

		var thisValue = $(this).attr('value');
		$('.hand').text(thisValue);
	});

	/*是否带加锁*/
	$('.lockChoice small').click(function(){
		$('.lockChoice small').removeClass('active');
		$(this).addClass('active');

		var thisValue = $(this).attr('value');
		$('.lock').text(thisValue);
	});
})

</script>
</html>