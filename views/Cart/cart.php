<html>
	<head>
		<?php  Rog::heads(); $total = 0; ?>
		<title>Cart | Rog</title>
		<style type="text/css">
		</style>
	</head>
	<body class="cart-body">
		<?php Rog::breadcrumbs(); ?>
		<div class="rog-head">
			<div class="content">
				<div class="page-title">
					<span>Cart - <?php echo ($this->count > 0)? $this->count : "No";?> item(s)</span>
				</div>
			</div>
		</div>
		<?php
			if($this->count != 0){
		?>
		<div class="content">
			<div class="cart-outer">
				<ul class="cart-items-list">
					<?php
						if($this->bag){
							foreach ($this->bag as $product_id => $details) {
					?>
								<li class="cart_item">
									<div class="close">
										<div class="remove-item" data-product="<?php echo $product_id; ?>">
											<span>&times;</span>
										</div>
									</div>
									<div class="product-image">
										<div class="image">
											<img src="<?php echo $details->image; ?>">
										</div>
									</div>
									<div class="product-info">
										<p class="product-title"><?php echo $details->product_name; ?></p>
										<div class="product-extra">Quantity <button class="quantity-sub quantity-action"><span>-</span></button><div data-cost="<?php echo $details->cost; ?>" class="cart_quantity"><?php echo $details->quantity; ?></div> <button class="quantity-add quantity-action"><span>+</span></button> &emsp; <span class="label"> Color </span> : <span class="value">red</span></div>
									</div>
									<div class="product-price">
										<p class="price-one">&#8377;<?php echo $details->cost; ?> (each)</p>
										<p class="price-total">&#8377;<span class="actual-price"><?php echo $details->cost; ?></span> </p>
									</div>
								</li>
						<?php
								$total += $details->cost;
							}
						}
					?>
				</ul>
				
				<div class="cart-total">
					Total :
					<span id="total-amount">&#8377;<?php echo $total; ?></span>
				</div>
				<div class="coupon-discount">
					Coupon discount (<span class="discount_percent">25%</span>):
					<span class="discount_amount">-&#8377;45</span>
					<br/>
					<br/>
					<span class="grand-total-label">Grand total:</span>
					<span class="grand-total">&#8377;32000</span>

				</div>
				<div class="cart-footer">
					<div class="coupon-outer">
						<div class="coupon-input">
							<input placeholder="Coupon code" <?php if($this->count == 0) echo "readonly"; ?> name="coupon">
						</div>
						<button class="coupon-apply">Apply</button>
					</div>

					<button class="checkout" <?php if($this->count == 0) echo "disabled"; ?>>Checkout</button>
				</div>
			</div>
		</div>
		<?php
			}
		?>
		<script type="text/javascript">
			window.coupon_error_flag = false;
			$(".coupon-apply").click(function(){
				coupon = $("input[name='coupon']").val().toUpperCase();
				if(coupon.length >= 5){
					window.coupon_code = coupon;
					$.get("/coupon",{coupon : coupon},function(res){
						if(res != -1){
							res = parseInt(res);
							$(".coupon-discount").show();
							$(".discount_percent").html(res+"% for "+window.coupon_code);
							$(".cart-total span").css("font-weight","normal");
							sub = window.total * (res/100);
							grand_total =  Math.floor(window.total - sub);
							$("span.discount_amount").html("-&#8377;"+sub);
							$(".grand-total").html("&#8377;"+window.grand_total);
						}else{
							window.coupon_error_flag = true;
							$(".coupon-apply").html("Invalid");
						}
					});
				}else{
					window.coupon_error_flag = true;
					$(".coupon-apply").html("Invalid");
				}

			});

			$("input[name='coupon']").keyup(function(e){
				if(e.which == 13){
					$(".coupon-apply").click();
				}else{
					if(window.coupon_error_flag){
						$(".coupon-apply").html("Apply");
						window.coupon_error_flag = false;
					}
				}
			});

			function calculate_total(){
				window.total = 0;
				$(".actual-price").each(function(e){
					if(this.innerHTML != "")
						window.total += parseInt(this.innerHTML);
				});
				$("#total-amount").html("&#8377;"+window.total);
			}

			$(".quantity-sub").click(function(){
				quantity_place = $(this.parentNode).children(".cart_quantity")
				quantity = parseInt(quantity_place.html());
				if(quantity > 1)
					quantity_place.html(quantity - 1);
				quantity_place.change();
			});

			$(".quantity-add").click(function(){
				quantity_place = $(this.parentNode).children(".cart_quantity")
				quantity = parseInt(quantity_place.html());
				quantity_place.html(quantity + 1);
				quantity_place.change();
			});

			$(".cart_quantity").change(function(){
				quantity = parseInt(this.innerHTML);
				cost = parseInt($(this).attr("data-cost"));
				if(this.innerHTML != "")
					$(this.parentNode.parentNode.parentNode).children(".product-price").children(".price-total").children(".actual-price").html(quantity * cost);
				else
					$(this.parentNode.parentNode.parentNode).children(".product-price").children(".price-total").children(".actual-price").html("0");
				calculate_total();
			});

			$(".remove-item").click(function(){
				product_id = $(this).attr("data-product");
				$.post("/removeitem",{ product_id : product_id},function(response){
					if(response > 0){
						console.log($(".remove-item[data-product="+response+"]").html());
						$(".remove-item[data-product="+response+"]").parent().parent().remove();
						calculate_total();
					}
				});
			});
			calculate_total();
		</script>
	</body>
</html>