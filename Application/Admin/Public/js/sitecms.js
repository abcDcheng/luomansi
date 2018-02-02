$(function(){
    $("#loginout").click(function(e){
    
    if (!confirm("确定退出吗？")) {
        return false;
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


