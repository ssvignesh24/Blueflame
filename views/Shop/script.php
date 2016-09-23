(function(d,w){
	cart_items = <?php  echo (Cart::getItems()); ?>;

	$(".category_list li").click(function(){
		category = $(this).children("span").html();
		if(category != "All"){
			K.l(category);
			$(".product_listing .product").hide();
			$(".product_listing .product[data-category='"+category+"']").show();
		}else
			$(".product_listing .product").show();
		$(".category_list .active").removeClass("active");
		$(this).addClass("active");
	});

	$(".filter-select").click(function(){
		if($(this).hasClass("filter-select-active")){
			$(this).removeClass("filter-select-active");
		}else{
			$(this).addClass("filter-select-active");
		}
	})
	/* $(".add_cart").click(function(){
		action = $(this).attr("data-action");
		product_id = $(this).attr("data-product-id");

		if(action == "add"){
			$.post("/additem",{ product_id : product_id},function(response){
				if(response > 0){
					$("button.add_cart[data-product-id='"+response.trim()+"']").attr("data-action","remove").html("<span>Remove</span>");
				}
			});
		}else if(action == "remove"){
			$.post("/removeitem",{ product_id : product_id},function(response){
				if(response > 0){
					$("button.add_cart[data-product-id='"+response.trim()+"']").attr("data-action","add").html("<span>Add to bag</span>");
				}
			});
		}
	}); */

	$(".start-follow").click(function(){
		shop = $(this).attr("data-shop");
		if(!$(this).hasClass("unfollow")){
			$.post("/follow_shop",{shop : shop}, function(d){
				if(d == 1){
					$(".start-follow").addClass("unfollow").html("-unfollow");

				}
			});

		}else{
			$.post("/unfollow_shop",{shop : shop}, function(d){
				if(d == 1)
					$(".start-follow").removeClass("unfollow").html("+Follow");;	
			});
		}
	})

})(document,window);