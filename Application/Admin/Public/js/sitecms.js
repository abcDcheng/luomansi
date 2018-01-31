$(function(){
    $("#loginout").click(function(e){
    e.preventDefault();
    if (confirm("确定退出吗？")) {
        $.ajax({
            url : "loginout",
            type : "post",
            data : {loginout : 1},
            dataType : "json",
            timeout : 5000,
            success : function(data){
                alert('成功退出');
                window.location.href="../Login/index";
            }
        });
    }
});
});
layui.use(['element','layer','form','laydate'], function(){
    var element = layui.element,
        layer = layui.layer,
        laydate = layui.laydate,
        form = layui.form;
    //表单验证
    $(".layui-form").Validform({
        tiptype:3,
        ajaxPost:true,
        callback:function(data){
            if (data.code == 1) {
                alert(data.msg);
                //console.log(data.url);
                window.location.href = data.url;
            } else {
                alert(data.msg);
            }
        }
    });
    form.on('checkbox(allChoose)', function(data){
        var child = $(data.elem).parents('table').find('tbody input[type="checkbox"]');
        child.each(function(index, item){
            item.checked = data.elem.checked;
        });
        form.render('checkbox');
    });
});


