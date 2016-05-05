(function(d,w){
	cart_items = <?php  echo (Cart::getItems()); ?>;
	src = "/uploads/banner/a9412584_1460119207.jpg";
	owner = "/uploads/owner/2f8ff4c1_1460119207.jpg";
	K.imageLoader(src,function(){
		$(".banner").css("background-image","url("+src+")");
	});
	K.imageLoader(owner,function(){
		$(".owner").css("background-image","url("+owner+")");
	});

	$(".category_list li").click(function(){
		category = $(this).children("span").html();
		if(category != "All"){
			K.l(category);
			$(".product_listing .product").hide();
			$(".product_listing .product[data-category='"+category+"']").show();
		}
		$(".category_list .active").removeClass("active");
		$(this).addClass("active");
	});


	$(".add_cart").click(function(){
		action = $(this).attr("data-action");
		product_id = $(this).attr("data-product-id");

		K.l(action);
		if(action == "add"){
			$.post("/additem",{ product_id : product_id},function(response){
				if(response > 0){
					$("button.add_cart[data-product-id='"+response.trim()+"']").attr("data-action","remove").html("<span>Remove</span>");
				}
			});
		}else if(action == "remove"){
			$.post("/removeitem",{ product_id : product_id},function(response){
				if(response > 0){
					$("button.add_cart[data-product-id='"+response.trim()+"']").attr("data-action","add").html("<span>Add to cart</span>");
				}
			});
		}
	});
})(document,window);