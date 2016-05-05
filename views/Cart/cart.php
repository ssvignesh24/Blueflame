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
					<span>Cart - <?php echo ($this->items->count() > 0)? count($this->items) : "No";?> item(s)</span>
				</div>
			</div>
		</div>
		<div class="content">
			<div class="cart-outer">
				<ul class="cart-items-list">
					<?php
						if($this->items)

							$this->items->each(function($p) use(&$total){


						?>
						<li class="cart_item">
							<div class="close">
								<div class="remove-item" data-product="<?php echo $p->product_id; ?>">
									<span>&times;</span>
								</div>
							</div>
							<div class="product-image">
								<div class="image">
									<img src="<?php echo $p->media_cover; ?>">
								</div>
							</div>
							<div class="product-info">
								<p class="product-title"><?php echo $p->title; ?></p>
								<div class="product-extra">Quantity - <div data-cost="<?php echo $p->cost; ?>" class="cart_quantity" maxlength="2" contenteditable="true">1</div> &emsp; <span class="label"> Color </span> : <span class="value">red</span></div>
							</div>
							<div class="product-price">
								<p class="price-one">&#8377;<?php echo $p->cost; ?> (each)</p>
								<p class="price-total">&#8377;<span class="actual-price"><?php echo $p->cost; ?></span> </p>
							</div>
						</li>

						<?php
						$total += $p->cost;
						});
					?>
				</ul>
				<div class="cart-total">
					Total :
					<span id="total-amount">&#8377;<?php echo $total; ?></span>
				</div>
				<div class="cart-footer">
					<div class="coupon-outer">
						<div class="coupon-input">
							<input placeholder="Coupon code" <?php if($this->items->count() == 0) echo "readonly"; ?> name="coupon">
						</div>
						<button class="coupon-apply">Apply</button>
					</div>

					<button class="checkout" <?php if($this->items->count() == 0) echo "disabled"; ?>>Checkout</button>
				</div>
			<div>
		</div>
		<script type="text/javascript">
			function calculate_total(){
				window.total = 0;
				$(".actual-price").each(function(e){
					if(this.innerHTML != "")
						window.total += parseInt(this.innerHTML);
				});
				$("#total-amount").html("&#8377;"+window.total);
			}
			$(".cart_quantity").keyup(function(){
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
			})
			
			calculate_total();
		</script>
	</body>
</html>