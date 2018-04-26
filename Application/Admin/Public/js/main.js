$(function(){
	 $('#salemancx').autocompleter({
        source: getsaleman,
        callback: function (value, index) {
           // alert( "Value "+value+" are selected (with index "+index+")." );
        }

    });
});