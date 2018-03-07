<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>订单查询</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" type="text/css" href="/luomansi/Application/Home/Public/css/query.css">
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
    <img src="/luomansi/Application/Home/Public/img/add-header.png" alt="" style="display:block;margin:0 auto 0;padding:20px 0;background-color:#fff;">
	<!-- 订单查询 -->
	<div class="query">
		<!-- 订单查询头部导航条 -->
		<ul class="query-nav">
			<li class="line3 query-nav-active" value="3">全部</li>
			<li class="line3" value="1">已受理</li>
			<li class="line3" value="0">待受理</li>
			<li value="2">未通过</li>
		</ul>
		<!-- 订单查询内容 -->
		<div class="query-content">
			<!-- 订单查询全部 -->
			<ul class="query-list-style query-all" style="display:block;">
				<?php if($hasInfo == 1): if(is_array($order)): foreach($order as $key=>$orderArr): ?><li>
					<div class="query-list-message">
						<h5>订单号：<?php echo ($orderArr["ordercode"]); ?></h5>
						<i><?php echo ($order["entime"]); ?></i>
						<h4>商品数量：<?php echo ($orderArr["shopNum"]); ?></h4>
						<div class="query-list-state">
						<?php switch($orderArr["status"]): case "1": ?><button class="query-state-btn query-state-1">已受理</button><?php break;?>
						<?php case "0": ?><button class="query-state-btn query-state-2">未受理</button><?php break;?>
						<?php case "2": ?><button class="query-state-btn query-state-3">未通过</button><?php break;?>
						<?php default: endswitch;?>
						</div>
						<a href="javascript:;" class="btn-seeData">查看详情</a>
					</div>
					<hr>
					<div class="query-product">
						<?php if(is_array($orderArr["detail"])): foreach($orderArr["detail"] as $key=>$value): ?><div class="product-item">
							<div class="product-img">
								<img src="/luomansi/Application/Upload/<?php echo ($value["goodsimg"]); ?>" alt="">
							</div>
							<div class="product-words">
								<span><?php echo ($value["goodsname"]); ?>-<?php echo ($value["goodscolor"]); echo ($value["goodsmodel"]); ?></span>
								<small>X<?php echo ($value["goodsnum"]); ?></small>
							</div>
						</div><?php endforeach; endif; ?>

						<a href="javascript:;" class="btn-stop">收起</a>

						<hr>
						<div class="remarks">
							备注：<?php if($orderArr["orderbak"] != ''): echo ($orderArr["orderbak"]); ?>
								  <?php else: ?>
								  无<?php endif; ?>
						</div>
					</div>
					<?php if($order["status"] == 2 and $order["msg"] != ''): ?><div class="remarks">
						<p>未通过原因：<?php echo ($orderArr["msg"]); ?></p>
					</div><?php endif; ?>
				</li><?php endforeach; endif; ?>
				<?php else: ?>

				<div class="no-information" style="display: block;">
					<img src="/luomansi/Application/Home/Public/img/no-information.png" alt="">
				</div><?php endif; ?>
			</ul>
			<!-- 订单查询已受理 -->
			<ul class="query-list-style query-already">
				<?php if($orderStatus[1] != 0): if(is_array($order)): foreach($order as $key=>$orderArr): if($orderArr['status'] == 1): ?><li>
					<div class="query-list-message">
						<h5>订单号：<?php echo ($orderArr["ordercode"]); ?></h5>
						<i><?php echo ($order["entime"]); ?></i>
						<h4>商品数量：<?php echo ($orderArr["shopNum"]); ?></h4>
						<div class="query-list-state">
						<?php switch($orderArr["status"]): case "1": ?><button class="query-state-btn query-state-1">已受理</button><?php break;?>
						<?php case "0": ?><button class="query-state-btn query-state-2">未受理</button><?php break;?>
						<?php case "2": ?><button class="query-state-btn query-state-3">未通过</button><?php break;?>
						<?php default: endswitch;?>
						</div>
						<a href="javascript:;" class="btn-seeData">查看详情</a>
					</div>
					<hr>
					<div class="query-product">
						<?php if(is_array($orderArr["detail"])): foreach($orderArr["detail"] as $key=>$value): ?><div class="product-item">
							<div class="product-img">
								<img src="/luomansi/Application/Upload/<?php echo ($value["goodsimg"]); ?>" alt="">
							</div>
							<div class="product-words">
								<span><?php echo ($value["goodsname"]); ?>-<?php echo ($value["goodscolor"]); echo ($value["goodsmodel"]); ?></span>
								<small>X<?php echo ($value["goodsnum"]); ?></small>
							</div>
						</div><?php endforeach; endif; ?>

						<a href="javascript:;" class="btn-stop">收起</a>

						<hr>
						<div class="remarks">
							备注：<?php if($orderArr["orderbak"] != ''): echo ($orderArr["orderbak"]); ?>
								  <?php else: ?>
								  无<?php endif; ?>
						</div>
					</div>
					
				</li><?php endif; endforeach; endif; ?>
				<?php else: ?>

				<div class="no-information" style="display: block;">
					<img src="/luomansi/Application/Home/Public/img/no-information.png" alt="">
				</div><?php endif; ?>
			</ul>
			<!-- 订单查询未受理 -->
			<ul class="query-list-style query-stay">
				<?php if($orderStatus[0] != 0): if(is_array($order)): foreach($order as $key=>$orderArr): if($orderArr['status'] == 0): ?><li>
					<div class="query-list-message">
						<h5>订单号：<?php echo ($orderArr["ordercode"]); ?></h5>
						<i><?php echo ($order["entime"]); ?></i>
						<h4>商品数量：<?php echo ($orderArr["shopNum"]); ?></h4>
						<div class="query-list-state">
						<?php switch($orderArr["status"]): case "1": ?><button class="query-state-btn query-state-1">已受理</button><?php break;?>
						<?php case "0": ?><button class="query-state-btn query-state-2">未受理</button><?php break;?>
						<?php case "2": ?><button class="query-state-btn query-state-3">未通过</button><?php break;?>
						<?php default: endswitch;?>
						</div>
						<a href="javascript:;" class="btn-seeData">查看详情</a>
					</div>
					<hr>
					<div class="query-product">
						<?php if(is_array($orderArr["detail"])): foreach($orderArr["detail"] as $key=>$value): ?><div class="product-item">
							<div class="product-img">
								<img src="/luomansi/Application/Upload/<?php echo ($value["goodsimg"]); ?>" alt="">
							</div>
							<div class="product-words">
								<span><?php echo ($value["goodsname"]); ?>-<?php echo ($value["goodscolor"]); echo ($value["goodsmodel"]); ?></span>
								<small>X<?php echo ($value["goodsnum"]); ?></small>
							</div>
						</div><?php endforeach; endif; ?>

						<a href="javascript:;" class="btn-stop">收起</a>

						<hr>
						<div class="remarks">
							备注：<?php if($orderArr["orderbak"] != ''): echo ($orderArr["orderbak"]); ?>
								  <?php else: ?>
								  无<?php endif; ?>
						</div>
					</div>
					
				</li><?php endif; endforeach; endif; ?>
				<?php else: ?>

				<div class="no-information" style="display: block;">
					<img src="/luomansi/Application/Home/Public/img/no-information.png" alt="">
				</div><?php endif; ?>				
			</ul>
			<!-- 订单查询未通过 -->
			<ul class="query-list-style query-not-through">
				<?php if($orderStatus[2] != 0): if(is_array($order)): foreach($order as $key=>$orderArr): if($orderArr['status'] == 2): ?><li>
					<div class="query-list-message">
						<h5>订单号：<?php echo ($orderArr["ordercode"]); ?></h5>
						<i><?php echo ($order["entime"]); ?></i>
						<h4>商品数量：<?php echo ($orderArr["shopNum"]); ?></h4>
						<div class="query-list-state">
						<?php switch($orderArr["status"]): case "1": ?><button class="query-state-btn query-state-1">已受理</button><?php break;?>
						<?php case "0": ?><button class="query-state-btn query-state-2">未受理</button><?php break;?>
						<?php case "2": ?><button class="query-state-btn query-state-3">未通过</button><?php break;?>
						<?php default: endswitch;?>
						</div>
						<a href="javascript:;" class="btn-seeData">查看详情</a>
					</div>
					<hr>
					<div class="query-product">
						<?php if(is_array($orderArr["detail"])): foreach($orderArr["detail"] as $key=>$value): ?><div class="product-item">
							<div class="product-img">
								<img src="/luomansi/Application/Upload/<?php echo ($value["goodsimg"]); ?>" alt="">
							</div>
							<div class="product-words">
								<span><?php echo ($value["goodsname"]); ?>-<?php echo ($value["goodscolor"]); echo ($value["goodsmodel"]); ?></span>
								<small>X<?php echo ($value["goodsnum"]); ?></small>
							</div>
						</div><?php endforeach; endif; ?>

						<a href="javascript:;" class="btn-stop">收起</a>

						<hr>
						<div class="remarks">
							备注：<?php if($orderArr["orderbak"] != ''): echo ($orderArr["orderbak"]); ?>
								  <?php else: ?>
								  无<?php endif; ?>
						</div>
					</div>
					<?php if($orderArr["status"] == 2 and $orderArr["msg"] != ''): ?><div class="remarks">
						<p>未通过原因：<?php echo ($orderArr["msg"]); ?></p>
					</div><?php endif; ?>
				</li><?php endif; endforeach; endif; ?>
				<?php else: ?>

				<div class="no-information" style="display: block;">
					<img src="/luomansi/Application/Home/Public/img/no-information.png" alt="">
				</div><?php endif; ?>
			</ul>
		</div>
		<!-- 未通过原因 -->
		<!-- <ul class="query-list-style query-not-through-reason">
			<li>
				<div class="query-list-img-bg">
					<img src="/luomansi/Application/Home/Public/img/product1.jpg" alt="">
				</div>
				<div class="query-list-message">
					<h5>DD1智能锁-真金假锁</h5>
					<i>2018-01-02  12:30 23 </i>
					<h4>数量：1</h4>
				</div>
				<div class="query-list-state">
					<button class="query-state-btn query-state-3">未通过</button>
				</div>
			</li>
			<li>
				<p>未通过原因：当前产品库存不足</p>
			</li>
		</ul> -->
	</div>
	<!-- 底部导航 -->
	<div class="footer-nav">
		<a href="<?php echo U('Shop/index');?>" class="footer-nav-item line2">
			<img src="/luomansi/Application/Home/Public/img/nav1.png" alt="" class="footer-nav-img">
			<img src="/luomansi/Application/Home/Public/img/nav1-active.png" alt="" class="footer-nav-imgActive">
		</a>
		<a href="<?php echo U('Order/index');?>" class="footer-nav-item footer-nav-itemActive">
			<img src="/luomansi/Application/Home/Public/img/nav2.png" alt="" class="footer-nav-img">
			<img src="/luomansi/Application/Home/Public/img/nav2-active.png" alt="" class="footer-nav-imgActive">
		</a>
		<a href="<?php echo U('Shopcar/index');?>" class="footer-nav-item line2">
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

		/*=====订单查询头部导航条====*/
		$('.query-nav li').click(function(){

			var _this = $(this).index();
			var status = $(this).attr('value');

			$('.query-nav li').removeClass('query-nav-active');
			$(this).addClass('query-nav-active');

			$('.query-content .query-list-style').hide();
			$('.query-content .query-list-style').eq(_this).show();

		});

		// 查看详情
		//$('.query-list-style li .query-list-message .btn-seeData').click(function(){
		$(document).on('click','.query-list-style li .query-list-message .btn-seeData',function(){
			$('.query-list-style li .query-product').slideUp();
			$(this).parent('.query-list-message').siblings('.query-product').slideDown();
			$('.query-list-style li .query-list-message .btn-seeData').show();
			$(this).hide();

		});

		// 收起
		//$('.query-list-style li .query-product .btn-stop').click(function(){
		$(document).on('click','.query-list-style li .query-product .btn-stop',function(){
			$(this).parent('.query-product').slideUp();
			$(this).parents('li').find('.btn-seeData').show();
		});

	})


</script>

</body>
</html>