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
				<a href="javascript:;" value="<?php echo ($value["id"]); ?>" hand="<?php echo ($value["hashand"]); ?>" falseLock="<?php echo ($value["haslock"]); ?>"><?php echo ($value["goodsname"]); ?></a>
			</li><?php endforeach; endif; ?>
		</ul>
		<!-- 下订单详情 -->
		<div class="order-date-bg">
			<ul class="order-date">
				<li id="goodsReturn">
					<p class="icon03">
						<span>型<em></em><em></em>号：</span>
						<strong id="goods">DD1智能锁</strong>
					</p>
				</li>
				<li>
					<p>
						<span>颜<em></em><em></em>色：</span>
						<strong class='carColor'></strong>
					</p>
					<div class="chioceColor">
						<!-- <span class='active' value='红古'>
							<i style='background-color: #7f2d00;'></i>
							红<em></em>古
						</span> -->
					</div>
				</li>
				<!-- <li>
					<p class="icon03">
						<span>拉<em></em><em></em>手：</span>
						<strong>1</strong>
					</p>
				</li> -->
				<li id="hand">
					<p>
						<span>拉<em></em><em></em>手：</span>
						<strong class='hand'></strong>
					</p>
					<label class="handChoice">
					</label>
				</li>
				<li id="falseLock">
					<p>
						<span>假<em></em><em></em>锁：</span>
						<strong class='lock'></strong>
					</p>
					<label class="lockChoice">
					</label>
				</li>
				<li>
					<p>
						<span>数<em></em><em></em>量：</span>
						<input id="goodsNum" type="number" value="10">
					</p>
				</li>
			</ul>
			<button class="order-date-btn">确认订单</button>
		</div>
	</div>


	<!-- 底部导航 -->
	<div class="footer-nav">
		<a href="<?php echo U('Shop/index');?>" class="footer-nav-item footer-nav-itemActive">
			<img src="/luomansi/Application/Home/Public/img/nav1.png" alt="" class="footer-nav-img">
			<img src="/luomansi/Application/Home/Public/img/nav1-active.png" alt="" class="footer-nav-imgActive">
		</a>
		<a href="<?php echo U('Order/index');?>" class="footer-nav-item line2">
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
<style type="text/css">
    .meng00{display:none;z-index:9999;width: 100%;height: 100%;position: fixed;left: 0;top:0;background:url('/luomansi/Application/Home/Public/img/15.gif') center center no-repeat rgba(0,0,0,0.8);}
</style>
<div class="meng00"></div>


</body>

<script type="text/javascript">
	
$(function(){
	//var model = <?php echo json_encode($model);?>;
	//console.log(model);
	var info = [];
	var colorArr = [];
	var hasHandCode = 0;
	var hasHand = 0;
	var hasLockCode = 0;
	var hasLock = 0;
	var goodsId = 0;
	var hand = ['带下拉手','不带下拉手'];
	var falseLock = ['带假锁','不带假锁'];
	/*打开订单详情*/
	$('.order-list li a').click(function(){
		goodsId = parseInt($(this).attr("value"));
		hasHandCode = parseInt($(this).attr("hand"));
		hasLockCode = parseInt($(this).attr("falseLock"));
		colorArr = [];
		var goodsName = $(this).text();
		$('.chioceColor,.handChoice,.lockChoice').empty();
		$('.meng00').show();
		$.ajax({
			url : "<?php echo U('Shop/goodsInfo');?>",
            type : "post",
            data : {goodsId:goodsId},
            dataType : "json",
            timeout : 5000,
            success : function(data){
            	if (data.code == 1) {
            		info = data.info;
            		//加载颜色
            		for (var i = 0;i < info.length;i++) {
            			if ($.inArray(info[i]['goodscolor'],colorArr) != -1) {
            				//console.log(info[i]['goodscolor']+"--"+colorArr);
            				continue;
            			} else {
            				$('.chioceColor').append("<span class='active' value='"+info[i]['goodscolor']+"'><i style='background-color: "+info[i]['colorcode']+";'></i>"+info[i]['goodscolor']+"</span>");
            				colorArr.push(info[i]['goodscolor']);
            			}
            		}
            		if (hasHandCode) {
            			$('#hand').show();
            		} else {
            			$('#hand').hide();
            			hasHand = 0;
            		}
            		if (hasLockCode) {
            			$('#falseLock').show();
            		} else {
            			$('#falseLock').hide();
            			hasLock = 0;
            		}
            		$('.chioceColor span:first').click();
            		$('#goods').text(goodsName);
					$('.order-list').hide();
					$('.order-date-bg').show();
            	} else {
            		alert(data.msg);
            	}
            	$('.meng00').hide();
            }
		});
		
	});

	//返回选择产品型号
	$('#goodsReturn').click(function(){
		$('.order-list').show();
		$('.order-date-bg').hide();
	});

	/*选择颜色*/
	$('.chioceColor').on('click','span',function(){
	//$('.chioceColor span').click(function(){

		$('.chioceColor span').removeClass('active');
		$(this).addClass('active');

		var thisValue = $(this).attr('value');
		$('.carColor').text(thisValue);
		var handsArr = [];
		var lockArr = [];
		for (var i = 0;i < info.length;i++) {
			if (info[i]['goodscolor'] == thisValue) {
				if (hasHandCode && $.inArray(info[i]['hand'],handsArr) == -1) {
					handsArr.push(info[i]['hand']);
				}
				if (hasLockCode && $.inArray(info[i]['falselock'],handsArr) == -1) {
					lockArr.push(info[i]['falselock']);
				}
			}
		}
		//alert(thisValue);
		//console.log(info);
		//alert(hasHandCode+"  "+hasLockCode);
		//alert(handsArr);
		//alert(lockArr);
		if (hasHandCode) {
			$('.handChoice').empty();
			handsArr.sort();
			for (var j = 0;j < handsArr.length;j++) {
				if (handsArr[j] == 1) {
					$('.handChoice').append("<small value='1'>带下拉手</small>");
				} else {
					$('.handChoice').append("<small value='0'>不带下拉手</small>");
				}
			}
			$('.handChoice small:first').click();
		}

		if (hasLockCode) {
			$('.lockChoice').empty();
			lockArr.sort();
			for (var j = 0;j < lockArr.length;j++) {
				if (lockArr[j] == 1) {
					$('.lockChoice').append("<small value='1'>带假锁</small>");
				} else {
					$('.lockChoice').append("<small value='0'>不带假锁</small>");
				}
			}
			$('.lockChoice small:first').click();
		}
	});

	/*是否带下拉手*/
	$('.handChoice').on('click','small',function(){
	//$('.handChoice small').click(function(){
		$('.handChoice small').removeClass('active');
		$(this).addClass('active');

		var thisValue = $(this).html();
		$('.hand').text(thisValue);
	});

	/*是否带加锁*/
	$('.lockChoice').on('click','small',function(){
	//$('.lockChoice small').click(function(){
		$('.lockChoice small').removeClass('active');
		$(this).addClass('active');

		var thisValue = $(this).html();
		$('.lock').text(thisValue);
	});

	//确认订单
	$('.order-date-btn').click(function(){
		if (!goodsId) {
			alert('请选择产品');
			return false;
		}
		var goodsNum = $('#goodsNum').val();
		if (isNaN(goodsNum) && goodsNum <=0) {
			alert('订购的数量必须为整数且大于0');
			return false;
		}
		var Ccolor = $(".chioceColor").find('.active').attr('value');
		if (hasHandCode) {
			var Chand = $('.handChoice').find('.active').attr('value');
		} else {
			var Chand = 0;
		}
		if (hasLockCode) {
			var Clock = $('.lockChoice').find('.active').attr('value');
		} else {
			var Clock = 0;
		}
		console.log(Ccolor+''+Chand+Clock);
		//return false;
		$('.meng00').show();
		$.ajax({
			url : "<?php echo U('Shop/goodsRecord');?>",
            type : "post",
            data : {goodsId:goodsId,goodsColor:Ccolor,hasHand:hasHandCode,hand:Chand,hasLock:hasLockCode,falseLock:Clock,goodsNum:goodsNum},
            dataType : "json",
            timeout : 5000,
            success : function(data){
            	if (data.code == 1) {
            		alert(data.msg);
            		//window.location.href="<?php echo U('Shopcar/index');?>";
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
	});
})

</script>
</html>