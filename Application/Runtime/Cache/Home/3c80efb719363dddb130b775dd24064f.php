<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>个人中心</title>
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
    <script type="text/javascript" src='/luomansi/Application/Home/Public/js/md5.js'></script>
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
	<!-- 个人中心 -->
	<div class="personal-center">
		
		<!-- 个人中心顶部banner -->
		<div class="personal-center-banner">
			<div class="personal-center-header">
				<img src="/luomansi/Application/Home/Public/img/headerImg.png" alt="">
				<p><?php echo ($info["name"]); ?>&nbsp;hi</p>
				<small style='text-align: center;font-size: 25px;color: #ffffff;margin-top: 10px;display:block;'><?php echo ($info["province"]); echo ($info["city"]); ?></small>
			</div>
			<img src="/luomansi/Application/Home/Public/img/icon04.png" alt="" class="icon04 modifyBtn">
		</div>
		<!-- 个人中心信息 -->
		<ul class="personal-center-message">
			<li>
				<div class="personal-center-flex-1">
					<img src="/luomansi/Application/Home/Public/img/icon05.png" alt="">
				</div>
				<div class="personal-center-flex-1">
					<span>账<em></em><em></em>号：</span>
				</div>
				<div class="personal-center-flex-3">
					<span><?php echo ($info["username"]); ?></span>
				</div>
			</li>
			<li>
				<div class="personal-center-flex-1">
					<img src="/luomansi/Application/Home/Public/img/icon06.png" alt="">
				</div>
				<div class="personal-center-flex-1">
					<span>姓<em></em><em></em>名：</span>
				</div>
				<div class="personal-center-flex-3">
					<span><?php echo ($info["name"]); ?></span>
				</div>
			</li>
			<li>
				<div class="personal-center-flex-1">
					<img src="/luomansi/Application/Home/Public/img/icon07.png" alt="">
				</div>
				<div class="personal-center-flex-1">
					<span>手<em></em><em></em>机：</span>
				</div>
				<div class="personal-center-flex-3">
					<span><?php echo ($info["phone"]); ?></span>
				</div>
			</li>
			<li>
				<div class="personal-center-flex-1">
					<img src="/luomansi/Application/Home/Public/img/icon08.png" alt="">
				</div>
				<div class="personal-center-flex-1">
					<span>收货地址：</span>
				</div>
				<div class="personal-center-flex-3">
					<span><?php echo ($info["address"]); ?></span>
				</div>
			</li>
		</ul>

	</div>
	<!-- 修改密码 -->
	<div class="personal-modify-bg">
		<ul class="personal-modify">
			<li>
				<span>请输入旧密码:</span>
				<input id="oldpwd" type="password"/>
			</li>
			<li>
				<span>请输入新密码:</span>
				<input id="newpwd" type="password"/>
			</li>
			<li>
				<span>请再输入一遍:</span>
				<input id="repwd" type="password"/>
			</li>
			<li style="position: relative;">
				<span>请输入手机验证码</span>
				<input id="yzm" type="tel" style="width:200px;">
				<button id="getyzm" style="position: absolute;font-size:30px;background-color:#0b4268;border-radius: 8px;color:#ffffff;padding:8px 15px;width:150px;outline: none;border:0;right:15px;">获取</button>
				<small id="tip" style='position: absolute;width:100%;color:red;font-size:20px;left:120px;bottom:5px;display: none;'>提示：验证码已发送至<con id="codePhone"></con></small>
			</li>
		</ul>

		<button class="personal-modify-btn">确认修改</button>
	</div>

	<!-- 修改成功 -->
	<div class="modify-success">
		<h4>提  醒</h4>
		<p>您已修改成功，自动为您跳转到登录页</p>
		<hr>
		<button class="modify-success-btn">知道了</button>
	</div>
	


	<!-- 底部导航 -->
	<div class="footer-nav">
		<a href="<?php echo U('Shop/index');?>" class="footer-nav-item">
			<img src="/luomansi/Application/Home/Public/img/nav1.png" alt="" class="footer-nav-img">
			<img src="/luomansi/Application/Home/Public/img/nav1-active.png" alt="" class="footer-nav-imgActive">
		</a>
		<a href="<?php echo U('Shopcar/index');?>" class="footer-nav-item line2">
			<img src="/luomansi/Application/Home/Public/img/nav3.png" alt="" class="footer-nav-img">
			<img src="/luomansi/Application/Home/Public/img/nav3-active.png" alt="" class="footer-nav-imgActive">
		</a>
		<a href="<?php echo U('Order/index');?>" class="footer-nav-item line2">
			<img src="/luomansi/Application/Home/Public/img/nav2.png" alt="" class="footer-nav-img">
			<img src="/luomansi/Application/Home/Public/img/nav2-active.png" alt="" class="footer-nav-imgActive">
		</a>
		<a href="<?php echo U('Person/index');?>" class="footer-nav-item line2 footer-nav-itemActive">
			<img src="/luomansi/Application/Home/Public/img/nav4.png" alt="" class="footer-nav-img">
			<img src="/luomansi/Application/Home/Public/img/nav4-active.png" alt="" class="footer-nav-imgActive">
		</a>
	</div>
</div>

<script type="text/javascript">
	
	$(function(){

		/*修改密码*/
		$('.modifyBtn').click(function(){

			$('.personal-center').hide();
			$('.personal-modify-bg').show();
		});

		$('#getyzm').click(function(){
			$(this).attr("disabled",true).text("获取中...");
			$.ajax({
				type: "post",
    			timeout:5000,//设置超时时间为5秒
    	        url: "<?php echo U('Person/getYZM');?>",
    	        data: {telCode:1},
    	        dataType: "json",
    	        cache:false,
    	        success:function(data){        	        
					if(data.code==1){
						$('#codePhone').text(data.tel);
						$("#tip").show();
						$("#getyzm").text("60s");
						$("#getyzm").css("backgroundColor","grey");
						var second=60;
						telTimer=setInterval(function(){	//30秒倒计时重新获取验证码
							if(second<=1){
								clearInterval(telTimer);
								$("#getyzm").removeAttr("disabled",true).text("获取").css("backgroundColor","#0b4268");
								$('#tip').hide();
							}else{										
								second--;
								$("#getyzm").text(second+"s");
							}
						},1000);
					}else{
						alert(data.msg);
						$("#getyzm").removeAttr("disabled").text("获取").css("backgroundColor","#0b4268");
						
						return false;
					}
        	    },
        	    error:function(x,status){
					if(status=='timeout'){
						alert("请求超时，请重试");
						$("#getyzm").removeAttr("disabled").text("获取").css("backgroundColor","#0b4268");
						return false;
					}
	        	}
			});
		});

		/*确认修改*/
		$('.personal-modify-btn').click(function(){
			var newpwd = $('#newpwd').val();
			var repwd = $('#repwd').val();
			var yzm = $('#yzm').val();
			if (!yzm) {
				alert("请输入手机验证码");
				return false;
			}
			if (newpwd == repwd) {
				var tmp = /^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,18}$/;
				if (!tmp.test(newpwd)) {
					alert("新密码长度不得小于6位，由字母数字组成");
					return false;
				}
				var oldpwd = hex_md5($('#oldpwd').val());
				newpwd = hex_md5(newpwd);
				$(this).val("修改中...").attr('disable',true);
				$.ajax({
					url : "<?php echo U('Person/changePwd');?>",
		            type : "post",
		            data : {oldpwd:oldpwd,newpwd : newpwd,yzm:yzm},
		            dataType : "json",
		            timeout : 5000,
		            success : function(data){
		            	if (data.code == 1) {
		            		$('.personal-modify-bg').hide();
							$('.modify-success').show();
		            	} else {
		            		alert(data.msg);
		            		$('.personal-modify-btn').val("确认修改").removeAttr('disable');
		            	}
		            },
		            error : function(x,data){
		            	if (data == 'timeout') {
		            		alert("连接超时，请重试");
		            	}
		            	$('.personal-modify-btn').val("确认修改").removeAttr('disable');
		            }
				});
			} else {
				alert("新密码与确认密码不一致，请重新填写");
			}
			
		});

		$('.modify-success-btn').click(function(){
			window.location.href = "<?php echo U('Login/login');?>";
		});
	})

</script>


    

</script>

</body>
</html>