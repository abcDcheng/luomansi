<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>用户登记资料</title>
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
    <script type="text/javascript" src="/luomansi/Application/Home/Public/js/jQuery.cityselect.full.min.js"></script>
    <script type="text/javascript" src='/luomansi/Application/Home/Public/js/ZArea.min.js'></script>
    <!-- <script type="text/javascript" src='http://assets.yangyue.com.cn/js/ZArea.min.js'></script> -->
    
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
    
    <!-- 用户登记资料 -->
    <ul class="registration">
    	<li>
    		<div class="name-item">
    			<span>姓<em></em>名：</span>
    		</div>
    		<div class="push-item">
    			<input id="name" type="text" placeholder='请填写你的姓名'>
    		</div>
    	</li>
    	<li>
    		<div class="name-item">
    			<span>手机号：</span>
    		</div>
    		<div class="push-item">
    			<input id="phone" type="text" placeholder='请填写你的手机号'>
    		</div>
    	</li>
    	<li>
    		<div class="name-item">
    			<span>地<em></em>址：</span>
    		</div>
    		<div class="push-item">
                <input id="area" type="text" placeholder="请选择地区" onfocus="this.blur();"></input>
    		</div>
    	</li>
    	<li>
    		<div class="name-item">
    			<textarea id="address" placeholder='请填写你的详细地址'></textarea>
    		</div>
    	</li>
    </ul>

    <button class="btn-registration">确认提交</button>
	
</div>

<script type="text/javascript">
    $(function(){

        new ZArea('#area');
        $('.btn-registration').click(function(){
            var name = $.trim($('#name').val());
            var phone = $.trim($('#phone').val());
            var address = $.trim($('#address').val());
            var area = $('#area').val();
            if (!name || !phone || !address || !area) {
                alert('信息填写不完整');
                return false;
            }
            //判断手机格式
            if(!(/^1[0-9]\d{9,9}$/.test(phone))){ 
                alert('手机号格式不对');
                return false;
             }
            $(this).html("提交中...").attr('disabled',true);
            $.ajax({
                url : "<?php echo U('Install/record');?>",
                type : "post",
                data : {name:name,phone : phone,address:address,area:area},
                dataType : "json",
                timeout : 5000,
                success : function(data){
                    if (data.code == 1) {
                        alert(data.msg);
                        $('.btn-registration').html("提交完成");
                    } else {
                        alert(data.msg);
                        $('.btn-registration').html("确认提交").removeAttr('disable');
                    }
                },
                error : function(data){
                    if (data.status == 'timeout') {
                        alert("连接超时，请重试");
                    }
                    $('.btn-registration').html("确认提交").removeAttr('disabled');
                }
            });
        });
    })

</script>

</body>
</html>