<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>归属地查询</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" type="text/css" href="/luomansi/Application/Home/Public/css/code.css">
    <!-- JQ -->
    <script type="text/javascript" src="/luomansi/Application/Home/Public/js/jquery-1.11.0.min.js"></script>
    <!--移动端版本兼容 -->
    <script type="text/javascript" src='/luomansi/Application/Home/Public/js/resize.js'></script>
    <!-- mian -->
    <script type="text/javascript" src='/luomansi/Application/Home/Public/js/code.js'></script>
</head>
<body>

<div class="wrap">

    <div class="banner">
        
        <img src="/luomansi/Application/Home/Public/img/add-logo.png" alt="" class="add-logo">
        <img src="/luomansi/Application/Home/Public/img/title.png" alt="" class="title">

    </div>

    <div class="content">
        <p class="words" style="font-size: 0.3rem">欢迎您使用智能锁著名品牌罗曼斯<br/>我们将竭诚为您服务！</p>
        
        <div class="entry" style="margin: 0.35rem auto 0;">
            <p>
                <input id="code" style="width: 100%" type="text" placeholder='请输入产品识别码（不区分大小写）'>
                <label class="tips" style="display: none">请输入正确的识别码</label>
            </p>

            <img id="scan" src="/luomansi/Application/Home/Public/img/scanning.png" alt="" class="scanning">
        </div>
        <p style="font-size:0.25rem;margin:0.3rem auto 0;text-align: center;">识别码查询请在智能锁输入12#或400#，或见外包装</p>
        <button class="lookup" style="margin:0.35rem auto ">归属地查询</button>

    </div>
    <p class="footer-w" style="margin: 0.35rem auto 0;"><a style="color: #fff;text-decoration: none;" href="tel://4008637100">400-863-7100</a><br/><?php echo ($ad); ?></p>

    <div class="footer-bg">
        
    </div>

</div>

<div class="mask">

    <div class="frame">
        <img src="/luomansi/Application/Home/Public/img/add-logo2.png" alt="" class="add-logo2">
        <hr/>
        <ul>
            <li>
                <span class='w1'>识别码：</span>
                <i id="goodsCode"></i>
            </li>
            <li>
                <span class='w2'>产   品：</span>
                <i id="goods"></i>
            </li>
            <li>
                <span class='w2'>颜   色：</span>
                <i id="goodsmodel"></i>
            </li>
            <li>
                <span class='w1'>归属地：</span>
                <i id="loc"></i>
            </li>
        </ul>

        <button class="btn-return">返  回</button>
    </div>
</div>
<style type="text/css">
    .meng00{display:none;z-index:9999;width: 100%;height: 100%;position: fixed;left: 0;top:0;background:url('/luomansi/Application/Home/Public/img/15.gif') center center no-repeat rgba(0,0,0,0.8);}
</style>
<div class="meng00"></div>
<script type="text/javascript">
    $(function(){
    $('.lookup').click(function(){
        var code = $('#code').val();
        if (!code) {
            $('.tips').show();
            setTimeout(function(){
                $('.tips').hide();
            },1500);
            return false;
        }
        $('.meng00').show();
        $.ajax({
            url : "<?php echo U('Code/codesearch');?>",
            type : "post",
            data : {code:code},
            dataType : "json",
            timeout : 5000,
            success : function(data){
                $('.meng00').hide();
                if (data.code == 1) {
                    $('#goodsCode').text(data.goods.goodscode);
                    $('#goods').text(data.goods.goods);
                    $('#goodsmodel').text(data.goods.goodsmodel);
                    $('#loc').text(data.goods.area);
                    $('.mask').show();
                } else {
                    alert(data.msg);
                }
            },
            error : function(x,status){
                $('.meng00').hide();
                if (status == 'timeout') {
                    alert("连接超时，请重试");
                } else {
                    alert("连接超时，请保持网络良好重试");
                }
            }
        });
    });
    });
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
    var open = parseInt('<?php echo ($open); ?>');
    if (!open) {
        alert('此功能暂未开放');
        return false;
    }
    wx.scanQRCode({
        needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
        scanType: ["qrCode","barCode"], // 可以指定扫二维码还是一维码，默认二者都有
        success: function (res) {
            var serialNumber = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
            //alert(serialNumber);
            var serial = serialNumber.split(",");
            serialNumber = serial[serial.length-1];
            $('#code').val(serialNumber);
        }
    });
}
</script>


</body>

</html>