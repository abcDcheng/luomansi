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
		<!-- 可执行订单详情 -->
		<div class="maintain-executable-date-wrap maintain-date-wrap" >
			<div class="maintain-executable-date">
				<div class="maintain-executable-date-img">
					<img src="/luomansi/Application/Home/Public/img/product1.jpg" alt="">
				</div>
				<h5 id="goods"></h5>
				<span id="namephone"></span>
				<p id="address"></p>
				<strong id="msg"></strong>
			</div>
			<button id="return" class="maintain-executable-date-btn">返回</button>
		</div>
		<!-- 订单执行中 -->
		<ul class="maintain-ing maintain-style" style="display:block;">
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
					<button class="query-state-btn maintain-executable-state-2" value="<?php echo ($value["id"]); ?>">点击完成</button>
				</div>
				<span class='lineColor'></span>
				<a href="javascript:;" class="maintain-data-btn" value="<?php echo ($k); ?>">查看详情>></a>
			</li><?php endforeach; endif; ?>
		</ul>
		<!-- 上传图片 -->
		<div class="maintain-upload" >
			<div class="maintain-upload-content">
				<div class="maintain-upload-img">
					
					<div id="clipArea"></div>
					<img src="" alt="" class="uploadImg">
					<input type="file" id="file">
				</div>

				<button class="upload-btn" id="clipBtn">确认上传</button>
				<button class="upload-btn" id="complete">确认提交</button>
			</div>
		</div>
		

	</div>


	<!-- 底部导航 -->
	<div class="footer-nav maintain-nav">
		<a href="<?php echo U('Maintain/index');?>" class="footer-nav-item line2">
			<img src="/luomansi/Application/Home/Public/img/maintain-nav1.png" alt="" class="footer-nav-img">
			<img src="/luomansi/Application/Home/Public/img/maintain-nav1-active.png" alt="" class="footer-nav-imgActive">
		</a>
		<a href="<?php echo U('Maintain/service');?>" class="footer-nav-item footer-nav-itemActive">
			<img src="/luomansi/Application/Home/Public/img/maintain-nav2.png" alt="" class="footer-nav-img">
			<img src="/luomansi/Application/Home/Public/img/maintain-nav2-active.png" alt="" class="footer-nav-imgActive">
		</a>
		<a href="<?php echo U('Maintain/complete');?>" class="footer-nav-item line2">
			<img src="/luomansi/Application/Home/Public/img/maintain-nav3.png" alt="" class="footer-nav-img">
			<img src="/luomansi/Application/Home/Public/img/maintain-nav3-active.png" alt="" class="footer-nav-imgActive">
		</a>
	</div>

</div>
<style type="text/css">
    .meng00{display:none;z-index:9999;width: 100%;height: 100%;position: fixed;left: 0;top:0;background:url('/luomansi/Application/Home/Public/img/15.gif') center center no-repeat rgba(0,0,0,0.8);}
</style>
<div class="meng00"></div>
<script type="text/javascript">
	
	$(function(){
		var info = <?php echo json_encode($info);?>;
		var orderId = 0;
		var imgUrl = '';
		/*<!-- 可执行订单详情 -->*/
		$('.maintain-data-btn').click(function(){
			var i = $(this).attr('value');
			orderId = info[i]['id'];
			$('#goods').text(info[i]['goods']);
			$('#namephone').html(info[i]['name']+"&nbsp;&nbsp;&nbsp;&nbsp;"+info[i]['phone']);
			$('#address').text(info[i]['address']);
			$('#msg').text('维护内容：'+info[i]['msg']);
			$('.maintain-ing').hide();
			$('.maintain-executable-date-wrap').show();
		});

		$('#return').click(function(){
			$('.maintain-ing').show();
			$('.maintain-executable-date-wrap').hide();
		});

		$('.query-state-btn').click(function(){
			orderId = $(this).attr('value');
			$('.maintain-ing').hide();
			$('.maintain-upload').show();
		});

		/*<!-- 上传图片 -->*/
		// $('.maintain-ing a').click(function(){
			
		// });

		/*<!-- 订单已完成详情 -->*/
		$('.maintain-complete a').click(function(){
			$('.maintain-complete').hide();
			$('.maintain-complete-date-wrap').show();
		});

	var clipArea = new bjj.PhotoClip("#clipArea", {
		size: [600, 380],
		outputSize: [600, 380],
		file: "#file",
		view: "#view",
		ok: "#clipBtn",
		loadStart: function() {
			console.log("照片读取中");
		},
		loadComplete: function() {
			console.log("照片读取完成");
		},
		clipFinish: function(dataURL) {
			// console.log(dataURL);
			imgUrl = dataURL;
			$('.uploadImg').attr('src',dataURL);
		}
	});

	$('#file').click(function(){
		$(this).hide();
		$('.uploadImg').attr('src','');
	});
	$('.upload-btn').click(function(){
		$('#file').show();
	})

	$('#complete').click(function(){
		if (!imgUrl) {
			alert('请上传现场图片 ');
			return false;
		}
		if (confirm('确定提交吗？')) {
			$('.meng00').show();
			$.ajax({
				url : "<?php echo U('Maintain/completeService');?>",
	            type : "post",
	            data : {orderId:orderId,imgUrl:imgUrl},
	            dataType : "json",
	            timeout : 15000,
	            success : function(data) {
	            	$('.meng00').hide();
	            	if (data.code == 1) {
	            		alert(data.msg);
	            		window.location.href = "<?php echo U('Maintain/complete');?>";
	            	} else {
	            		alert(data.msg);
	            	}
	            }
			});
		}
	});



	})

</script>

</body>
</html>