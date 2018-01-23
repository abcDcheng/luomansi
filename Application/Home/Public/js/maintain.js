$(function(){

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
		},
		clipFinish: function(dataURL) {
			// console.log(dataURL);
			$('.uploadImg').attr('src',dataURL);
		}
	});

	$('#file').click(function(){
		$(this).hide();
		$('.uploadImg').attr('src','');
	});
	$('.upload-btn').click(function(){
		$('#file').show();
	})


})






























