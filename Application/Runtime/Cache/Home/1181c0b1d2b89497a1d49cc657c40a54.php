<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>购物车</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
	<link rel="stylesheet" type="text/css" href="/luomansi/Application/Home/Public/css/style1.css">
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
			<?php if($hasShop == 1): if(is_array($shopcar)): foreach($shopcar as $key=>$value): ?><li>
					<div class="query-list-img-bg">
						<img src="/luomansi/Application/Upload/<?php echo ($value["goodsimg"]); ?>" alt="">
					</div>
					<div class="query-list-message">
						<h5><?php echo ($value["goodsname"]); ?>-<?php echo ($value["goodsmodel"]); ?></h5>
						<i><?php echo ($value["entime"]); ?></i>
						<h4>数量：<?php echo ($value["goodsnum"]); ?></h4>
						
					</div>
					<div class="query-list-state">
						<a href="<?php echo U('Shop/update?id='.$value['id']);?>" class="deteleBtn">编辑</a><br/>
						<a href="<?php echo U('shopcar/goodsDel?delId='.$value['id']);?>" class="deteleBtn">删除</a>
					</div>
				</li><?php endforeach; endif; ?>
				<li>
					<textarea id="bak" placeholder='备注:'></textarea>
				</li>
				<button class="shopping-cart-btn">确认提交</button>
			<?php else: ?>
				<div class="no-information" style="display: block;">
					<img src="/luomansi/Application/Home/Public/img/no-information.png" alt="">
				</div><?php endif; ?>
			</ul>

			
		</div>
	</div>

	<!-- 提交成功 -->
	<div class="successBg">
		<img src="/luomansi/Application/Home/Public/img/icon13.png" alt="" class="icon13">
	</div>


	<!-- 底部导航 -->
	<div class="footer-nav">
		<a href="<?php echo U('Shop/index');?>" class="footer-nav-item">
			<img src="/luomansi/Application/Home/Public/img/nav1.png" alt="" class="footer-nav-img">
			<img src="/luomansi/Application/Home/Public/img/nav1-active.png" alt="" class="footer-nav-imgActive">
		</a>
		<a href="<?php echo U('Shopcar/index');?>" class="footer-nav-item line2  footer-nav-itemActive">
			<img src="/luomansi/Application/Home/Public/img/nav3.png" alt="" class="footer-nav-img">
			<img src="/luomansi/Application/Home/Public/img/nav3-active.png" alt="" class="footer-nav-imgActive">
		</a>
		<a href="<?php echo U('Order/index');?>" class="footer-nav-item line2">
			<img src="/luomansi/Application/Home/Public/img/nav2.png" alt="" class="footer-nav-img">
			<img src="/luomansi/Application/Home/Public/img/nav2-active.png" alt="" class="footer-nav-imgActive">
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
<script type="text/javascript">
	$(function(){

		$('.shopping-cart-btn').click(function(){
			if (confirm('确定提交本订单吗？')) {
				var bak = $('#bak').val();
				// alert(bak);
				// return false;
				$('.meng00').show();
				$.ajax({
					url : "<?php echo U('Shopcar/orderRecord');?>",
		            type : "post",
		            data : {bak:bak},
		            dataType : "json",
		            timeout : 5000,
		            success : function(data) {
		            	if (data.code == 1) {
		            		$('.shopping-cart').hide();
							$('.successBg').show();
							setTimeout(function(){
								window.location.href = "<?php echo U('Order/index');?>";
							},2000);
		            	} else {
		            		alert(data.msg);
		            	}
		            	$('.meng00').hide();
		            },
		            error:function(data){
		            	if (data.status == 'timeout') {
		            		alert('连接超时，请重试');
		            	}
		            	$('.meng00').hide();
		            }
				});
				
			}



		});


		$('.addBtn').click(function(){
			window.location.href = "<?php echo U('Shop/index');?>";
		});

		$('.query-list-state a').click(function(){
			if (!confirm('确定删除该产品吗？')) {
				return false;
			}
		});
	})
</script>

</body>
</html>