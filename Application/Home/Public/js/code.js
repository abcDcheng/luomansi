$(function(){

    $('.mask').on('touchmove', function (event) {
        event.preventDefault();
    });
    // 点击缩放
    function zoomFn(obj){
        $(obj).on('touchstart',function(e){
            $(this).css('-webkit-transform','scale3d(0.8,0.8,0.8)');
        })

        $(obj).on('touchend',function(e){
            $(this).css('-webkit-transform','scale3d(1,1,1)');
        })
    }

    zoomFn('.clickBtn');



    // $('.lookup').click(function(){

    //     $('.mask').show();
    // });

    $('.btn-return').click(function(){
        $('.mask').hide();
    })

    
  
	
})

//随机数
function fnRand(min,max){
    return parseInt(Math.random()*(max-min)+min);
}


