(function(d){
	window.K = function(){};
	K.imageLoader = function(src, handler){
		r = new Image();
		r.src = src;
		r.onload = handler;
	};

	K.uploadProgress = function(file, target, $progress_bar, handler){
		window.fd = new FormData();
		fd.file_upload_name = [];
		for(d in file){
			window.fd.append(d,file[d]);
			fd.file_upload_name.push(file[d]);
		}
		$.ajax({
		  xhr: function() {
		    var xhr = new window.XMLHttpRequest();
		    xhr.upload.uploadHandler_bar = $progress_bar;
		    $progress_bar.fadeIn();
		    xhr.upload.addEventListener("progress", function(evt) {
		      if (evt.lengthComputable) {
		        var percentComplete = evt.loaded / evt.total;
		        percentComplete = parseInt(percentComplete * 100);
		         $progress_bar.children(".progress").css("width",percentComplete + "%");
		         if(percentComplete == 100){
		 			this.uploadHandler_bar.fadeOut();
		         }
		      }
		    }, false);
		    return xhr;
		  },
		  url: target,
		  type: "POST",
		  data : window.fd,
		  contentType: false,
          processData: false,
		  success: handler
		});
	};

	K.rand = function(min,max){
		max = max || 99999999;
		min = min || 0;
  		return Math.floor(Math.random() * (max - min) + min);
	};

	K.l = function(msg){
		console.log(msg);
	}
})(document);
