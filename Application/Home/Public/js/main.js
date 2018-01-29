
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


  

})