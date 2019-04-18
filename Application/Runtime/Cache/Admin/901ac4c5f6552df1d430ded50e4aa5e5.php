<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--
* @Author: defaultFish
* @Date:   2017-12-12 00:00:00
* +
* | siteCMS [ siteCMS网站内容管理系统 ]
* | Copyright (c) 2017 https://www.sitecms.cn All rights reserved.
* | Licensed ( https://www.sitecms.cn/licenses/ )
* | Author: defaultfish <defaultfish@qq.com>
* +
-->
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/luomansi/Application/Admin/Public/plugs/layui/css/layui.css">
    <link rel="stylesheet" href="/luomansi/Application/Admin/Public/css/font-awesome.min.css">
    <link rel="stylesheet" href="/luomansi/Application/Admin/Public/css/animate.css">
    <link rel="stylesheet" href="/luomansi/Application/Admin/Public/css/sitecms.css">
    <link rel="stylesheet" href="/luomansi/Application/Admin/Public/css/jquery.autocompleter.css">
    <script src="/luomansi/Application/Admin/Public/plugs/layui/layui.js"></script>
    <script src="/luomansi/Application/Admin/Public/plugs/ueditor/ueditor.config.js"></script>
    <script src="/luomansi/Application/Admin/Public/plugs/ueditor/ueditor.all.js"></script>
    <script type="text/javascript">
        var getsaleman = <?php echo ($saleman); ?>;
    </script>
    
    <!-- <script src="/luomansi/Application/Admin/Public/plugs/static/base/js/jquery.cookie.js"></script> -->
    <script src="/luomansi/Application/Admin/Public/js/jquery.min.js"></script>
    <!-- <script src="/luomansi/Application/Admin/Public/plugs/uploadify/jquery.uploadify.min.js"></script> -->
    <script src="/luomansi/Application/Admin/Public/js/validform.js"></script>
    <script src="/luomansi/Application/Admin/Public/js/jquery.autocompleter.js" type="text/javascript"></script>
    <script src="/luomansi/Application/Admin/Public/js/sitecms.js"></script>
    <script src="/luomansi/Application/Admin/Public/js/main.js"></script>
    <script src="/luomansi/Application/Admin/Public/plugs/layui/lay/modules/laydate.js"></script>
    
    <!-- <link id="layuicss-layer" rel="stylesheet" href="http://admin.sitecms.cn/Public/plugs/layui/css/modules/layer/default/layer.css?v=3.1.0" media="all">
    <link id="layuicss-laydate" rel="stylesheet" href="http://admin.sitecms.cn/Public/plugs/layui/css/modules/laydate/default/laydate.css?v=5.0.9" media="all"> -->
    <!-- 让IE8/9支持媒体查询 -->
    <!--[if lt IE 9]>
        <script src="./js/html5shiv.min.js"></script>
        <script src="./js/respond.min.js"></script>
    <![endif]-->
    <title>维护统计</title>
</head>
<body>

<div class="layui-layout-admin">
    <div class="layui-tab sc_side_tab" lay-filter="nav">
    <style type="text/css">
	.layui-nav-tree .layui-nav-child a{
		height: 35px;
	}
	.layui-nav-child dd{
		font-size: 20px;
	}
</style>
	
    <ul class="layui-tab-title">
        <li class="layui-this">
            <div class="sc_side_manage" style="background:url('/luomansi/Application/Admin/Public/images/logo.png') no-repeat;"></div>
            
        </li>
        <style type="text/css">
			#orderNum,#installNum{
				color:red;
			}
        </style>
        <dl class="layui-nav layui-nav-tree sc_side_more">
            <dd class="layui-nav-item layui-nav-itemed">
                <dl class="layui-nav-child">

				<?php if (isset($_SESSION['group'])) { $group = $_SESSION['group']; if ($group == 1) { ?>
				<dd><a href="<?php echo U('Saleman/staff');?>">人员管理</a></dd>
				<!-- <dd><a href="#">历史订单</a></dd> -->
				<dd><a href="<?php echo U('Saleman/installIndex');?>">保修登记</a></dd>
				<dd><a href="<?php echo U('Maintain/salemanIndex');?>">维护管理</a></dd>
				<?php } elseif ($group == 2) { ?>
				<dd><a href="<?php echo U('Order/index');?>">订单管理<span id="orderNum"></span></a></dd>
				<dd><a href="<?php echo U('Order/history');?>">历史订单</a></dd>
				<?php } elseif ($group == 3) { ?>
				<dd><a href="<?php echo U('Code/index');?>">识别码管理</a></dd>
				<dd><a href="<?php echo U('Install/index');?>">保修登记<span id="installNum"></span></a></dd>
				<dd><a href="<?php echo U('Install/history');?>">安装统计</a></dd>
				<dd><a href="<?php echo U('Maintain/index');?>">维护管理</a></dd>
				<dd><a href="<?php echo U('Maintain/history');?>">维护统计</a></dd>
				<?php } elseif ($group == 99) { ?>	
				<dd><a href="<?php echo U('Admin/ad');?>">广告宣传语</a></dd>
				<dd><a href="<?php echo U('Admin/index');?>">专员管理</a></dd>
				<dd><a href="<?php echo U('Saleman/index');?>">代理商管理</a></dd>
				<dd><a href="<?php echo U('Admin/servicer');?>">代理商人员</a></dd>
				<dd><a href="<?php echo U('Goods/index');?>">产品管理</a></dd>
				<dd><a href="<?php echo U('Code/index');?>">识别码管理</a></dd>
				<dd><a href="<?php echo U('Order/index');?>">订单管理<span id="orderNum"></span></a></dd>
				<dd><a href="<?php echo U('Order/history');?>">历史订单</a></dd>
				<dd><a href="<?php echo U('Install/index');?>">保修登记<span id="installNum"></span></a></dd>
				<dd><a href="<?php echo U('Install/history');?>">安装统计</a></dd>
				<dd><a href="<?php echo U('Maintain/index');?>">维护管理</a></dd>
				<dd><a href="<?php echo U('Maintain/history');?>">维护统计</a></dd>
				<dd><a href="<?php echo U('Admin/phone');?>">手机更换</a></dd>
				<?php } else if ($group == 4) { ?>	
					<dd><a href="<?php echo U('Code/index');?>">识别码管理</a></dd>
				<?php } } ?>
				<dd><a href="<?php echo U('Index/pwd');?>">密码修改</a></dd>
				<dd><a id="loginout" href="<?php echo U('Index/loginout');?>">退出登录</a></dd>
                </dl> 
            </dd>
        </dl>
    </ul>


    <script type="text/javascript">
    	var getOrder = 0;
    	var getInstall = 0;
    	<?php if (isset($_SESSION['group'])) { $group = $_SESSION['group']; if ($group == 1) { ?>
				
		<?php } elseif ($group == 2) { ?>
				getOrder = 1;
				getNew();
				setInterval(getNew,10000);
		<?php } elseif ($group == 3) { ?>
				getInstall = 1;
				getNew();
				setInterval(getNew,10000);
		<?php } elseif ($group == 99) { ?>
				getOrder = 1;
				getInstall = 1;
				getNew();
				setInterval(getNew,10000);
		<?php } } ?>



		function getNew(){
			$.ajax({
				url : '<?php echo U("Index/getNew");?>',
				type : "post",
	            data : {getOrder:getOrder,getInstall:getInstall},
	            dataType : "json",
	            timeout : 5000,
	            success:function(data) {
	            	if (data.code == 1) {
	            		if (data.orderNum>0) {
	            			$('#orderNum').text('('+data.orderNum+')');
	            		} else {
	            			$('#orderNum').text('');
	            		}
	            		if (data.installNum>0) {
	            			$('#installNum').text('('+data.installNum+')');
	            		} else {
	            			$('#installNum').text('');
	            		}
	            	}
	            }
			});
		}
    </script>
    </div>
    <div class="layui-body" id="sc_body">
        <div class="sc_body">
        <div class="sc_title sc_body_title">
        <img id="logo" src="/luomansi/Application/Admin/Public/images/logo.png" style="width: 100px;height: 30px;margin-left: 5px;">
            <h5>维护统计</h5>
            <!-- <div class="sc_title_btn">
                <a class="layui-btn layui-btn-sm" href="<?php echo U('Maintain/add');?>"><i class="layui-icon"></i> 新增</a>        </div> -->
        </div>
        <div class="fadeInUp animated">
            <div id="form-list" class="layui-form">
                <div class="layui-input-inline">
                    
                </div>
                <div class="layui-inline">
                   <div class="layui-input-inline">
                       <!-- <select name="saleman" id="saleman">
                            <option value="">选择代理商</option>
                            <?php if(is_array($saleman)): foreach($saleman as $key=>$value): ?><option value="<?php echo ($value["id"]); ?>"><?php echo ($value["name"]); ?>(<?php echo ($value["province"]); echo ($value["city"]); ?>)</option><?php endforeach; endif; ?>
                        </select> -->
                        <input id="salemancx" type="text" placeholder="搜索代理商" class="layui-input" style="width: 250px">
                        <input id="saleman" type="hidden" name="saleman" value=""/>
                    </div>
                    <div class="layui-input-inline">
                        <input id="firsttime" type="text" name="start_time" placeholder="起始时间" value="" class="layui-input sc_form_date" readonly="">
                    </div>
                    -
                    <div class="layui-input-inline">
                        <input id="lasttime" type="text" name="end_time" placeholder="结束时间" value="" class="layui-input sc_form_date" readonly="">
                    </div>
                </div>
                <button id="cx" class="layui-btn layui-btn-danger sc_btn_search">搜索</button>
                <button id="dl" class="layui-btn layui-btn-danger sc_btn_search">下载</button>
                <input type="hidden" name="nid" value="5">
                <table style="table-layout: fixed;" class="layui-table" lay-even="" lay-skin="nob">
                    <colgroup>
                        <col width="80">
                        <col width="120">
                        <col width="150">
                        <col width="100">
                        <col>
                        <col width="150">
                        <col width="100">
                        <col width="100">
                        <col width="100">
                        <col width="100">
                        <col width="80">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>客户姓名</th>
                            <th>联系方式</th>
                            <th>详细地址</th>
                            <th>维护产品</th>
                            <th>维护信息</th>
                            <th>创建时间</th>
                            <th>负责代理商</th>
                            <th>维护人员</th>
                            <th>维护状态</th>
                            <th>受理人员</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody id="body">
                    
                    </tbody>
                </table>
            </div>
            <div class="layui-clear">
                <div class="fr">
                    <div class="sc_pages">
                        <ul class="pagination">  
                        <li><a id="first" class="fenye">首页</a></li>
                        <li><a id="prev" class="fenye">上一页</a></li>
                        <li><a id="next" class="fenye">下一页</a></li>
                        <li><a id="last" class="fenye">末页</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    $(function(){
        lay('.sc_form_date').each(function(){
            layui.laydate.render({
                elem: this
                ,trigger: 'click'
                ,type: 'date'
            });
        });

    });
    
    </script>
    </div>
    </div>
</div>
</body>

<script type="text/javascript">
    $(function(){
        var firsttime='';
        var lasttime='';
        var str='';
        var page = 1;
        var saleman = '';
        $('#cx').click(function(){
            //re= /,|\(|\)|#|'|"|=|;|>|<|%|\\/i;
            saleman = $('#saleman').val();
            if($('#firsttime').val()&&$('#lasttime').val()&&$('#firsttime').val()>$('#lasttime').val()){
                alert("第一个日期比第二个日期大");
                return false;
            }else{
                firsttime=$('#firsttime').val();
                lasttime=$('#lasttime').val();
            }             
            str='';
            fenye(1);
    });
    $('.fenye').click(function(){

        var f=$(this).attr("value");
        if(f==0)return false;
        else fenye(f);
    });

    $('#clear').click(function(){
        $('#firsttime').val('');
        $('#lasttime').val('');
        firsttime='';
        lasttime='';
        str='';
        fenye(1);
    });

    
    function fenye(page){
      $.ajax({
        //contentType:false,
        type: "post",
        timeout:5000,//设置超时时间为5秒
        url: "<?php echo U('Maintain/history');?>",
        data: {saleman:saleman,firsttime:firsttime,lasttime:lasttime,page:page},
        dataType: "json",
        success:function(data){
            $('#an').text(data[0]);
            $('#body').empty();
            if(data['num']!=0){   
                var page=Math.ceil(data['num']/data['pageNum']);         
                // for(var i=1;i<data.length-1;i++){
                //     $('#body').append(data[i]);
                // }
            var tableHtml2 = '';
            var order = data['order'];
            var edit = '查看详情';
            for(key in order){
                var tableHtml = '';
                tableHtml += '<tr><td class="layui-elip">'+order[key]['name']+'</td><td class="layui-elip">'+order[key]['phone']+'</td><td class="layui-elip" title="'+order[key]['address']+'">'+order[key]['address']+'</td><td class="layui-elip">'+order[key]['goods']+'</td><td class="layui-elip" title="'+order[key]['msg']+'">'+order[key]['msg']+'</td><td class="layui-elip">'+order[key]['entime']+'</td><td class="layui-elip">'+order[key]['saleman']+'</td><td class="layui-elip">'+order[key]['servicename']+'</td>';
                
                if (parseInt(order[key]['servicestatus']) == 2) {
                    tableHtml += '<td class="layui-elip"><span style="color:green">已维护</span></td>';
                } else if (parseInt(order[key]['servicestatus']) == 1) {
                    tableHtml += '<td class="layui-elip"><span style="color:orange">维护中</span></td>';
                } else {
                    tableHtml += '<td class="layui-elip"><span style="color:red">未维护</span></td>';
                }
                // if (parseInt(order[key]['status']) == 2) {
                //     tableHtml += '<td class="layui-elip"><span style="color:red">服务异常</span></td>';
                // } else if (parseInt(order[key]['status']) == 1) {
                //     tableHtml += '<td class="layui-elip"><span style="color:green">已完成</span></td>';
                // } else {
                //     tableHtml += '<td class="layui-elip"><span style="color:red">未回访</span></td>';
                // }
                tableHtml += '<td class="layui-elip">'+order[key]['statususer']+'</td>';
                tableHtml+='<td><a class="maintainUpdate" href="javascript:;" value="'+key+'" data-title="'+edit+'">'+edit+'</a><a id="dl" href="/luomansi/index.php/Admin/Maintain/download/id/'+key+'" value="'+key+'" data-title="下载">下载</a></td></tr>';
                tableHtml2 = tableHtml+tableHtml2;
            }
            $('#body').append(tableHtml2);
            var val=parseInt(data['page']);
            //alert(val);
            switch(val){
            case 1:$('#allnum').text(data[0]);
                 $('#pth').text(val);
                 $("#p").text(page);
                 $('#first').attr("value",0);
                 $('#first').css("color","grey");
                 $('#prev').attr("value",0);
                 $('#prev').css("color","grey");
                 if(page==1){
                    $('#next').attr("value",0);
                    $('#next').css("color","grey");
                    $('#last').attr("value",0);
                    $('#last').css("color","grey");
                    }
                 else{
                    $('#next').attr("value",2);
                    $('#next').css("color","black");
                    $('#last').attr("value",page);
                    $('#last').css("color","black");
                    }
                 break;
            case page:
                  $('#pth').text(val);
                  $('#allnum').text(data[0]);
                    $('#p').text(page);
                  $('#first').attr("value",1);
                  $('#first').css("color","black");
                    $('#prev').attr("value",--val);
                    $('#prev').css("color","black");
                    $('#next').attr("value",0);
                    $('#next').css("color","grey");
                    $('#last').attr("value",0);
                    $('#last').css("color","grey");
                      break;
            default:
              //alert(val);
              $('#pth').text(val);
                $('#allnum').text(data[0]);
                  $('#p').text(page);
                $('#first').attr("value",1);
                    $('#prev').attr("value",--val);
                    val++;
                    $('#next').attr("value",++val);
                    $('#last').attr("value",page);
                    $('#first').css("color","black");
                  $('#prev').css("color","black");
                  $('#next').css("color","black");
                  $('#last').css("color","black");
                      break;
            }
            $('tbody tr:even').addClass("alt-row");
            }else{
              alert("没有找到数据");
              $('#allnum').text("0");
                $('#p').text("0");
                $('#pth').val("0");
                $('#first').attr("value",0);
              $('#first').css("color","grey");
                $('#prev').attr("value",0);
                $('#prev').css("color","grey");
                $('#next').attr("value",0);
                $('#next').css("color","grey");
                $('#last').attr("value",0);
                $('#last').css("color","grey");
              return false;
              }
           },
           error:function(XMLHttpRequest, Status){//ajax请求结束
             if(Status=='timeout'){//请求超时
               alert('请求超时,请重试');
               return false;
             }
           }
      });
      
    }
    //fenye(1);
    $('#cx').click();

    $('#body').on('click','.maintainUpdate',function(){
        var id = $(this).attr('value');
        window.location.href="/luomansi/index.php/Admin/Maintain/update/mod/history/id/"+id;
    });

    $('#body').on('click','maintaindel',function(){
        if (confirm('确定删除该数据吗？')) {
            var id = $(this).attr('value');
            //alert(id);
            $('.meng00').show();
            $.ajax({
                url : "<?php echo U('Maintain/del');?>",
                type : "post",
                data : {id:id},
                dataType : "json",
                timeout : 10000,
                success : function(x,data){
                    $('.meng00').hide();
                    if (data.code == 1) {
                        alert('删除成功');
                        window.location.reload();
                    } else {
                        alert(data.msg);
                    }
                },
                error : function(data){
                    $('.meng00').hide();
                    if (data.status == 'timeout') {
                        alert('连接超时，请重试');
                    }
                }
            });
        }
    });
    //导出excel
    $('#dl').click(function(e){
        e.preventDefault();
        str = "";
        str += '&&saleman=' + saleman;
        str += '&&firsttime=' + firsttime;
        str += '&&lasttime=' + lasttime;
        window.location.href="/luomansi/index.php/Admin/Maintain/download?mod=history"+str;
        }); 
    });
</script>
</html>