(function(d,w){
	src = "/uploads/banner/a9412584_1460119207.jpg";
	owner = "/uploads/owner/2f8ff4c1_1460119207.jpg";
	K.imageLoader(src,function(){
		$(".banner").css("background-image","url("+src+")");
	});
	K.imageLoader(owner,function(){
		$(".owner").css("background-image","url("+owner+")");
	});
})(document,window);