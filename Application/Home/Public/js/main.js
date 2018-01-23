
//随机数
function fnRand(min,max){
    return parseInt(Math.random()*(max-min)+min);
}



$(function(){
	
	// $('body').on('touchmove', function (event) {
	//     event.preventDefault();
	// });
  


  /*=====底部导航条====*/
  $('.footer-nav .footer-nav-item').click(function(){

    $('.footer-nav .footer-nav-item').removeClass('footer-nav-itemActive');
    $(this).addClass('footer-nav-itemActive');

  });


  /*=====订单查询头部导航条====*/
  $('.query-nav li').click(function(){

    var _this = $(this).index();

    $('.query-nav li').removeClass('query-nav-active');
    $(this).addClass('query-nav-active');

    $('.query-content .query-list-style').hide();
    $('.query-content .query-list-style').eq(_this).show();

  })
  

})