<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>安装管理登录</title>
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
    <script type="text/javascript" src='/luomansi/Application/Home/Public/js/utils.js'></script>
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
<body style="background-color: #435a79">

<div class="wrap sign-in-wrap">
	<!-- 登陆页面 -->
	<div class="sign-in">
		
		<img src="/luomansi/Application/Home/Public/img/soin-in-logo.png" alt="" class="soin-in-logo">

		<!-- <p class="add-title" style="font-size:36px;text-align: center;margin:30px auto 0;">全 自 动 智 能 锁</p> -->

		<div class="sign-in-mask">
			
			<div class="sign-in-content">
				
				<h2 class="add-words" style="font-size: 37px;width:550px;margin:-30px auto 0;font-weight: 300;">安装管理</h2>

				<p>
					<span>
						<img src="/luomansi/Application/Home/Public/img/icon01.png" alt="">
					</span>
					<input id="account" type="text" placeholder='请输入账号' class="pushName">
					<small class='tips_name'>请输入正确账号</small>
				</p>
				<p>
					<span>
						<img src="/luomansi/Application/Home/Public/img/icon02.png" alt="">
					</span>
					<input id="pwd" type="password" placeholder='请输入密码' class="pushPassword">
					<small class='tips_password'>请输入正确密码</small>
				</p>
				<input type="button" value="登录" class="sign-in-btn">

			</div>

			<small class='add-tips' style='display:block;text-align: center;font-size:38px;color:#ffffff;margin:50px auto 0;'><?php echo ($ad); ?></small>

		</div>
	</div>
</div> 

<script type="text/javascript">
	$(function(){
		// 判断手机号码是否正确
		// $('.pushPassword').blur(function(){
		// 	var inputVal = $(this).val();
		// 	if (validatePhone(inputVal) == false) {
		// 		$(this).val('');
		// 		$('.tips_password').fadeIn(500);
		// 		setTimeout(function(){
		// 			$('.tips_password').fadeOut(500);
		// 		},2000);
		// 	}
		// });

		//var tmp = 1;	//避免用户重复提交
		$('.sign-in-btn').click(function(){
			// 判断账号是否为空
			var username = $.trim($('.pushName').val());
			if (username == '') {
				$('.tips_name').fadeIn(500);
				setTimeout(function(){
					$('.tips_name').fadeOut(500);
				},2000);

				return false;
			}

			// 判断密码是否为空
			var password = $('.pushPassword').val();
			if (password == '') {
				$('.tips_password').fadeIn(500);
				setTimeout(function(){
					$('.tips_password').fadeOut(500);
				},2000);

				return false;
			}
			$(this).val("登录中...").attr('disabled',true);
			$.ajax({
				url : "<?php echo U('Login/serviceAdmin');?>",
	            type : "post",
	            data : {username:username,password : password},
	            dataType : "json",
	            timeout : 5000,
	            success : function(data){
	            	if (data.code == 1) {
	            		window.location.href = '<?php echo U('Install/index');?>';
	            	} else {
	            		alert(data.msg);
	            		$('.sign-in-btn').val("登录").removeAttr('disabled');
	            	}
	            },
	            error : function(data){
	            	if (data.status == 'timeout') {
	            		alert("连接超时，请重试");
	            	}
	            	$('.sign-in-btn').val("登录").removeAttr('disabled');
	            }
			});
			

		});

	})

</script>

</body>
</html>