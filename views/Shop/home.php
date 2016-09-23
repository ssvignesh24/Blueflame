<html>
	<head>
		<title> <?php  echo $this->shop->shop_title; ?> | Rog </title>
		<?php  Rog::heads(); ?>
	</head>
	<body>
		<?php Rog::breadcrumbs(); ?>
		<div class="banner_outer">
			<?php
			?>

			<div class="banner" <?php echo ($this->shop->banner != "")? "style='background-image:url(".$this->shop->banner.")'" : ""; ?>></div>
			<div class="overlay"></div>
			<div class="shop_details">
				<div class="owner" <?php echo ($this->shop->banner != "")? "style='background-image:url(".$this->shop->picture.")'" : ""; ?>>

				</div>
				<p class="shop_name"><?php  echo $this->shop->shop_title; ?></p>
				<p class="shop_location"><?php echo $this->shop->city.", ".$this->shop->state.", India";?></p>
				<div class="shop_info">
					<p> <?php echo $this->shop->followers; ?> Followers | 34 Reviews | 4.5 <span class="fa fa-star"> </span> <?php if($this->is_logged_in){ ?> | <span data-shop="<?php echo $this->shop->shop_id; ?>" class="start-follow <?php  echo ($this->following)?  '"> +Follow' : 'unfollow"> -unfollow '; ?></span></p> <?php } ?>
					
				</div>
			</div>
		</div>
		<div class="content">
			<div class="category_outer">
				<ul class="category_list">	
					<li class="active"><span>All</span></li>
					<?php
						if($this->categories)
							foreach ($this->categories as $category) {
								echo "<li><span>$category->category</span></li>";
							}
					?>
				</ul>
			</div>
			<div class="product_listing">
				<ul>
					<?php

						if($this->products){
							$this->products->each(function($product){
									$in_cart = (array_search($product->product_id, $this->cart_items) !== false);
								?>

									<li class="product" data-category = "<?php echo $product->product_category; ?>">
										<div class="product_image">
											<img src="<?php echo $product->media_cover; ?>">
											<div class="quick_look_outer">
												<button class="quick_look"  data-product-id = "<?php echo $product->product_id; ?>">
													<span>Quick look</span>
												</button>
											</div>
										</div>
										<div class="product_info">
											<p class="product_name"><?php echo $product->product_title ?></p>
											<div class="product_extra">
												<span class="product_price">&#8377;<?php echo $product->cost; ?></span>
												<span class="product_rating">3.5&ensp;<span class="fa fa-star"></span></span>
											</div>
										</div>
									</li>
								<?
							});
						}

					?>
				</ul>
			</div>
		</div>
		<script type="text/javascript" src="/shop_script"></script>
	</body>
</html>