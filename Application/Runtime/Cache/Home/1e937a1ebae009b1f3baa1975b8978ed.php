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
    <script src="/luomansi/Application/Home/Public/js/iscroll-zoom.js"></script>
    <script src="/luomansi/Application/Home/Public/js/hammer.js"></script>
    <script src="/luomansi/Application/Home/Public/js/lrz.all.bundle.js"></script>
    <script src="/luomansi/Application/Home/Public/js/jquery.photoClip.min.js"></script>
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
    <div class="add-header" style="width:750px;margin:0 auto 0;box-sizing:border-box;padding:25px 40px;background-color:#fff;position:relative;">
        <img src="/luomansi/Application/Home/Public/img/header-logo.png" alt="">
        <p style="position: absolute;bottom:40px;right:40px;font-size:30px;color:#717f87;"><?php echo ($ad); ?></p>
    </div>
    <h3 style="font-size:36px;text-align: center;padding:40px 0;background-color:#0a4268;color:#ffffff;">产品安装登记</h3>
    
    <!-- 用户登记资料 -->
    <ul class="registration">
        <li>
            <div style="width:100%;">
                <div class="maintain-upload-content">
                    <div class="maintain-upload-img">
                        
                        <div id="clipArea"></div>
                        <img src="" alt="" class="uploadImg">
                        <input type="file" id="file">
                    </div>

                    <button class="upload-btn" id="clipBtn">确认上传</button>
                <!-- <p style="font-size:30px;">上传设备显示识别码照片：</p>
                <div style="width:288px;height:288px;background: url(/luomansi/Application/Home/Public/img/add-upload.png) center center no-repeat;margin:20px auto 0;" id="clipArea">
                    <input type="file" id="file" style="z-index: 2">
                </div> -->
            </div>
        </li>
        <li>
            <div class="name-item">
                <span>识别码：</span>
            </div>
            <div class="push-item">
                <textarea id="goodsCode" placeholder='请扫描或填写安装码' style="box-sizing:border-box;padding-right:37px;height:70px"></textarea>
                <img id="scan" src="/luomansi/Application/Home/Public/img/sao_icon.png" alt="" class="sao_icon">
            </div>
        </li>
    	<li>
    		<div class="name-item">
    			<span>姓<em></em>名：</span>
    		</div>
    		<div class="push-item">
    			<input id="name" type="text" placeholder='请填写客户姓名'>
    		</div>
    	</li>
    	<li>
    		<div class="name-item">
    			<span>手机号：</span>
    		</div>
    		<div class="push-item">
    			<input id="phone" type="tel" placeholder='请填写客户手机'>
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
    			<textarea id="address" placeholder='请填写安装详细地址'></textarea>
    		</div>
    	</li>
    </ul>

    <button class="btn-registration" style="margin-bottom:80px;">确认提交</button>

    <small style='display:block;font-size:28px;color:#717f87;text-align: center;margin-top:25px;'>&nbsp;&nbsp;&nbsp;</small>

     <!--<img src="/luomansi/Application/Home/Public/img/add_logo.png" alt="" style="display:block;margin:50px auto 0;"> -->
	
</div>

<!-- 成功安装 -->
<div class="success-bg" style="position: fixed;width: 100%;height: 100%;top:0;left: 0;z-index: 3;display:none;">
    <div class="success-bg-c" style="position: absolute;width: 100%;height: 100%;top:0;left: 0;background-color: rgba(233,233,233,0.8);display:-webkit-box;-webkit-box-orient: vertical;-webkit-box-pack: center;-webkit-box-align: center;text-align: center;font-size: 29px;">
        <img src="/luomansi/Application/Home/Public/img/icon16.png" alt="">
        <p style="margin-top:15px;">已完成安装</p>
        <p style="margin-top:15px;font-weight: 700;">产品安装完成，进入保修状态</p>

        <button id="comfirm" style="display:none;width:450px;height:80px;font-size:32px;background-color:#0b4268;border-radius: 10px;color:#ffffff;margin:30px auto 0;">客户确认完成</button>
    </div>
</div>
<style type="text/css">
    .meng00{display:none;z-index:9999;width: 100%;height: 100%;position: fixed;left: 0;top:0;background:url('/luomansi/Application/Home/Public/img/15.gif') center center no-repeat rgba(0,0,0,0.8);}
</style>
<div class="meng00"></div>

<script type="text/javascript">
    $(function(){
        new ZArea('#area');
        var canClick = 0;
        var imgUrl = '';
        $('#comfirm').click(function(){
            if (canClick) {
                window.location.href = "<?php echo U('Login/installLogin');?>";
            }
            
        });
        $('.btn-registration').click(function(){
            if (!imgUrl) {
                alert('请上传识别码照片！');
                return false;
            }
            var name = $.trim($('#name').val());
            var phone = $.trim($('#phone').val());
            var address = $.trim($('#address').val());
            var area = $('#area').val();
            var goodsCode = $('#goodsCode').val();
            if (!goodsCode) {
                alert('请扫描或输入安装码');
                return false;
            }
            if (!name || !phone || !address || !area) {
                alert('信息填写不完整');
                return false;
            }
            //判断手机格式
            if(!(/^1[0-9]\d{9,9}$/.test(phone))){ 
                alert('手机号格式不对');
                return false;
            }
            $('.meng00').show();
            $(this).html("提交中...").attr('disabled',true);
            $.ajax({
                url : "<?php echo U('Install/record');?>",
                type : "post",
                data : {imgUrl:imgUrl,goodsCode:goodsCode,name:name,phone : phone,address:address,area:area},
                dataType : "json",
                timeout : 20000,
                success : function(data){
                    $('.meng00').hide();
                    if (data.code == 1) {
                        $('.success-bg').show();
                        $('.wrap').hide();
                        $('.btn-registration').html("提交完成");
                        setTimeout(function(){
                            $('#comfirm').show();
                            canClick = 1;
                        },2000);
                    } else {
                        alert(data.msg);
                        $('.btn-registration').html("确认提交").removeAttr('disabled');
                    }
                },
                error : function(data){
                    $('.meng00').hide();
                    if (data.status == 'timeout') {
                        alert("连接超时，请重试");
                    } else {
                        alert("连接超时，请保持网络良好重试");
                    }
                    $('.btn-registration').html("确认提交").removeAttr('disabled');
                }
            });
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
                $('#file').hide();
            },
            clipFinish: function(dataURL) {
                // console.log(dataURL);
                imgUrl = dataURL;
                $('.uploadImg').attr('src',dataURL);
            }
        });

        $('#file').click(function(){
            // $(this).hide();
            $('.uploadImg').attr('src','');
        });
        $('.upload-btn').click(function(){
            $('#file').show();
        })
    })
</script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
  /*
   * 注意：
   * 1. 所有的JS接口只能在公众号绑定的域名下调用，公众号开发者需要先登录微信公众平台进入“公众号设置”的“功能设置”里填写“JS接口安全域名”。
   * 2. 如果发现在 Android 不能分享自定义内容，请到官网下载最新的包覆盖安装，Android 自定义分享接口需升级至 6.0.2.58 版本及以上。
   * 3. 常见问题及完整 JS-SDK 文档地址：http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html
   *
   * 开发中遇到问题详见文档“附录5-常见错误及解决办法”解决，如仍未能解决可通过以下渠道反馈：
   * 邮箱地址：weixin-open@qq.com
   * 邮件主题：【微信JS-SDK反馈】具体问题
   * 邮件内容说明：用简明的语言描述问题所在，并交代清楚遇到该问题的场景，可附上截屏图片，微信团队会尽快处理你的反馈。
   */
  wx.config({
    //debug: true,
    appId: '<?php echo ($jssdk["appId"]); ?>',
    timestamp: <?php echo ($jssdk["timestamp"]); ?>,
    nonceStr: '<?php echo ($jssdk["nonceStr"]); ?>',
    signature: '<?php echo ($jssdk["signature"]); ?>',
    jsApiList: [
      // 所有要调用的 API 都要加到这个列表中
                'checkJsApi',
                'onMenuShareTimeline',
                'onMenuShareAppMessage',
                'onMenuShareQQ',
                'onMenuShareWeibo',
                'hideMenuItems',
                'showMenuItems',
                'hideAllNonBaseMenuItem',
                'showAllNonBaseMenuItem',
                'translateVoice',
                'startRecord',
                'stopRecord',
                'onRecordEnd',
                'playVoice',
                'pauseVoice',
                'stopVoice',
                'uploadVoice',
                'downloadVoice',
                'chooseImage',
                'previewImage',
                'uploadImage',
                'downloadImage',
                'getNetworkType',
                'openLocation',
                'getLocation',
                'hideOptionMenu',
                'showOptionMenu',
                'closeWindow',
                'scanQRCode',
                'chooseWXPay',
                'openProductSpecificView',
                'addCard',
                'chooseCard',
                'openCard' 
    ]
  });
    wx.ready(function () {
        $('#scan').click(function(){
            goodsScan();
        });
    });
function goodsScan(){
    //alert(1);
    wx.scanQRCode({
        needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
        scanType: ["qrCode","barCode"], // 可以指定扫二维码还是一维码，默认二者都有
        success: function (res) {
            var serialNumber = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
            //alert(serialNumber);
            var serial = serialNumber.split(",");
            serialNumber = serial[serial.length-1];
            $('#goodsCode').val(serialNumber);
        }
    });
}
</script>
</body>
</html>