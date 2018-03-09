<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>维护中心</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" type="text/css" href="/luomansi/Application/Home/Public/css/shijian.css"/>
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
    <script type="text/javascript" src='/luomansi/Application/Home/Public/js/jquer_shijian.js' charset="utf-8"></script>
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
    <!-- 订单维护 -->
	<div class="maintain">
		<!-- 可执行订单详情 -->
		<div class="maintain-executable-date-wrap maintain-date-wrap" >
			<div class="maintain-executable-date">
				<div class="maintain-executable-date-img" style="width: 268px;height: 268px;">
					<img id="goodsImg" src="" alt="">
				</div>
				<h5 id="goods"></h5>
				<!-- 现在修改的 -->
				<p style="margin-top:50px;">订单要求：<con id="level" style="color:red"></con></p>
				<p>产品名称：<con id="goodsName"></con></p>
				<p>安装时间：<con id="installTime"></con></p>
				<p>产品问题：<i id="msg"></i></p>
				<p>客户名称：<con id="name"></con></p>
				<p>联系电话：<con id="phone"></con></p>
				<p>维护地址：<con id="address"></con></p>
				<p>客户说明：<con id="clientbak"></con></p>
			</div>
			<button id="return" class="maintain-executable-date-btn">返回</button>
		</div>
		<!-- 订单执行中 -->
		<ul class="maintain-ing maintain-style" style="display:block;">
			<?php if($hasInfo == 1): if(is_array($info)): foreach($info as $k=>$value): ?><li>
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
			<?php else: ?>
			<div class="no-information" style="display: block;">
				<img src="/luomansi/Application/Home/Public/img/no-information.png" alt="">
			</div><?php endif; ?>
		</ul>
		<!-- 上传图片 -->
		<div class="maintain-upload" >
			<div class="maintain-upload-content">
				<div class="maintain-upload-img">
                    <div id="clipArea1"></div>
                    <img src="" alt="" class="uploadImg uploadImg1">
                    <input type="file" id="file1">
                </div>

                <button class="upload-btn" id="clipBtn1">确认上传</button>
				<div class="maintain-upload-img">
                        
                    <div id="clipArea2"></div>
                    <img src="" alt="" class="uploadImg uploadImg2">
                    <input type="file" id="file2">
                </div>

                <button class="upload-btn" id="clipBtn2">确认上传</button>
				
				<div class="maintain-add">
					<p>
						<span>识别码：</span>
						<textarea id="goodsCode" placeholder='请输入识别码' style="height:70px;width: 360px;padding-right: 50px;"></textarea>
						<img id="scan" src="/luomansi/Application/Home/Public/img/sao_icon.png" alt="" class="sao_icon">
					</p>
					<p>
						<i>服务日期：</i><input type="text" placeholder='请选择服务日期' id="input3">
					</p>
					<p>
						<i>服务时间：</i><input type="text" value='00:00' id="input4" style="width:177px;text-align: center;"><i style="float: left;">至</i><input type="text" value='00:00' id="input5" style="width:177px;text-align: center;">
					</p>
					<p>
						<i>维护结果：</i>
						<select id="serStatus">
							<option value="1">已完成</option>
							<option value="0">未完成</option>
						</select>
					</p>
					<p id="bakBoard" style="display: none;">
						<i>维护备注：</i><textarea id="serBak" style="width: 390px;height: 70px;" placeholder='请填写未完成原因'></textarea>
					</p>
				</div>

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
		var imgSrc = '/luomansi/Application/Upload'+'/';
		/*<!-- 可执行订单详情 -->*/
		$('.maintain-data-btn').click(function(){
			var i = $(this).attr('value');
			orderId = info[i]['id'];
			$('#level').text(info[i]['orderLevel']);
			if (info[i]['goodsmodel']) {
				$('#goods').text(info[i]['goods']+'-'+info[i]['goodsmodel']);
			} else {
				$('#goods').text(info[i]['goods']);
			}
			$('#goodsName').text(info[i]['goods']);
			$('#goodsImg').attr('src',imgSrc+info[i]['goodsimg']);
			if (info[i]['installtime']) {
				$('#installTime').text(info[i]['installtime']);
			} else {
				$('#installTime').text('未知');
			}
			$('#name').html(info[i]['name']);
			$('#phone').html(info[i]['phone']);
			$('#address').text(info[i]['address']);
			$('#msg').text(info[i]['msg']);
			if (info[i]['clientbak']) {
				$('#clientbak').text(info[i]['clientbak']);
			} else {
				$('#clientbak').text('无');
			}
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

		var clipArea1 = new bjj.PhotoClip("#clipArea1", {
            size: [600, 380],
            outputSize: [600, 380],
            file: "#file1",
            view: "#view1",
            ok: "#clipBtn1",
            loadStart: function() {
                console.log("照片读取中");
            },
            loadComplete: function() {
                console.log("照片读取完成");
                $('#file1').hide();
            },
            clipFinish: function(dataURL) {
                // console.log(dataURL);
                imgUrl1 = dataURL;
                $('.uploadImg1').attr('src',dataURL);
            }
        });

        $('#file1').click(function(){
            // $(this).hide();
            $('.uploadImg1').attr('src','');
        });
        $('#clipBtn1').click(function(){
            $('#file1').show();
        })



        var clipArea2 = new bjj.PhotoClip("#clipArea2", {
            size: [600, 380],
            outputSize: [600, 380],
            file: "#file2",
            view: "#view2",
            ok: "#clipBtn2",
            loadStart: function() {
                console.log("照片读取中");
            },
            loadComplete: function() {
                console.log("照片读取完成");
                $('#file2').hide();
            },
            clipFinish: function(dataURL) {
                // console.log(dataURL);
                imgUrl2 = dataURL;
                $('.uploadImg2').attr('src',dataURL);
            }
        });

        $('#file2').click(function(){
            // $(this).hide();
            $('.uploadImg2').attr('src','');
        });
        $('#clipBtn2').click(function(){
            $('#file2').show();
        })

		$('#serStatus').change(function(){
			var status = parseInt($(this).val());
			if (status) {
				$('#serBak').empty().val('');
				$('#bakBoard').hide();
			} else {
				$('#bakBoard').show();
			}
		});

		$('#complete').click(function(){
			if (!imgUrl1 || !imgUrl2) {
				alert('请上传门锁照片和识别码照片！');
				return false;
			}
			var goodsCode = $('#goodsCode').val();
			var serDate = $('#input3').val();
			var serStartTime = $('#input4').val();
			var serEndTime = $('#input5').val();
			var serStatus = parseInt($('#serStatus').val());
			if (!goodsCode) {
				alert('请扫描或输入产品码');
				return false;
			}
			if (!serDate) {
				alert('请选择服务日期');
				return false;
			}
			if (!serStatus) {
				var serBak = $('#serBak').val();
				if (!serBak) {
					alert('请填写未完成原因');
					return false;
				}
			} else {
				var serBak = '';
			}
			if (confirm('确定提交吗？')) {
				$('.meng00').show();
				$.ajax({
					url : "<?php echo U('Maintain/completeService');?>",
		            type : "post",
		            data : {orderId:orderId,imgUrl1:imgUrl1,imgUrl2:imgUrl2,goodsCode:goodsCode,serDate:serDate,serStartTime:serStartTime,serEndTime:serEndTime,serStatus:serStatus,serBak:serBak},
		            dataType : "json",
		            timeout : 30000,
		            success : function(data) {
		            	$('.meng00').hide();
		            	if (data.code == 1) {
		            		alert(data.msg);
		            		if (serStatus) {
		            			window.location.href = "<?php echo U('Maintain/complete');?>";
		            		} else {
		            			window.location.reload();
		            		}
		            		
		            	} else {
		            		alert(data.msg);
		            	}
		            }
				});
			}
		});

		//选择需要显示的
		$("#input3").shijian({
			y:-10,//当前年份+10
			Hour:false,//是否显示小时
			Minute:false,//是否显分钟
			 width: 200,
			 height:60,
			 showNowTime: true //是否默认显示当前时间
		});

		$("#input4").shijian({
				width: 177,
				height:60,
				Year: false,
				Month: false,
				Day: false,
				Hour: true,
				Minute: true
		});

		$("#input5").shijian({
				width: 177,
				height:60,
				Year: false,
				Month: false,
				Day: false,
				Hour: true,
				Minute: true
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