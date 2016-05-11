<html>
	<head>
		<?php  Rog::heads(); ?>
		<title><?php echo $this->key; ?> - Search | Rog</title>
		<link rel="stylesheet" type="text/css" href="/bower_components/seiyria-bootstrap-slider/dependencies/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="/bower_components/seiyria-bootstrap-slider/dist/css/bootstrap-slider.min.css">
		<script type="text/javascript" src="/bower_components/seiyria-bootstrap-slider/dependencies/js/modernizr.js"></script>
		<script type="text/javascript" src="/bower_components/seiyria-bootstrap-slider/dist/bootstrap-slider.min.js"></script>
		<style type="text/css">
		</style>
	</head>
	<body class="cart-body">
		<?php Rog::breadcrumbs(); ?>
		<div class="rog-head">
			<div class="content">
				<div class="page-title search-head">
					<div class="clear-search">
						<span>&times;</span>
					</div>
					<input class="search-key" value="<?php echo $this->key; ?>"placeholder="Search" type="text" ></div>
				</div>
			</div>
		</div>
		<div class="search-filter-outer">
			<div class="search-filter" data-status="close">
				<div class="filter-icon-outer"><i class="filter-icon fa fa-filter"></i></div>
				<p class="filter-text"> No filter</p>
				<div class="filter-options">
					<div class="filter-left">
						<div class="filter-select">
							<span>Show only new items (3 months)</span>
						</div>
						<div class="gender-filter">
							<span class='gender-label'>Search for : </span>
							<div class="filter-select gender-select filter-select-active">
								<span>Male</span>
							</div>
							<div class="filter-select gender-select filter-select-active">
								<span>Female</span>
							</div>
						</div>
						<div class="price-filter">
							<span class='price-label'>Price range : </span>
							<input type="text" class="price-selector">
						</div>
					</div>
					<div class="filter-right">
						<div class="select-segment">
							<div class="filter-days">
								<span>Delivery within : </span>
							</div>
							<div class="filter-days filter-days-select filter-selectric" data-status="close">
								<span>5 days</span>
								<div class="select-option-outer">
									<ul>
										<li class="select-option"><span>4 days</span></li>
										<li class="select-option"><span>1 week</span></li>
										<li class="select-option"><span>less than 2 weeks</span></li>
										<li class="select-option"><span>less than 3 weeks</span></li>
										<li class="select-option"><span>less than 1 month</span></li>
									</ul>
								</div>
							</div>

						</div>
						<div class="select-segment">
							<div class="filter-days">
								<span>Category : </span>
							</div>
							<div class="filter-days filter-days-select filter-selectric" data-status="close">
								<span>All</span>
								
							</div>
						</div>
						<div class="select-segment">
							<div class="filter-days">
								<span>Sub-category : </span>
							</div>
							<div class="filter-days filter-days-select filter-selectric" data-status="close">
								<span>All</span>
							</div>
						</div>
					</div>
					<div class="search-outer">
						<button>Apply</button>
					</div>
				</div>
				
			</div>
		</div>
		<div class="content">

			<div class="search-result-outer">
				<ul class="search-result">
				
				</ul>
			</div>
			
		</div>
		<div class="footer">

		</div>
		<script type="text/javascript" src="/shop_script"></script>
		<script type="text/javascript">
			
			var product_list = <?php echo ($this->product_list)? $this->product_list : "null"; ?>;
			var cart_items = <?php echo ($this->cart_items)? $this->cart_items : "null"; ?>;
			$(".search-filter-outer ").click(function(){
				this_ = $(this).children(".search-filter");
				state = $(this_).attr("data-status");
				if(state == "close"){
					$(this_).attr("data-status","open");
					$(".filter-options").css("height","275px").css("padding","10px");;
					$(this_).children(".filter-text").hide();
					$(this_).children(".filter-icon-outer").children(".filter-icon").removeClass("fa-filter").addClass("fa-times");
				}
			});
			$(".filter-icon-outer").click(function(e){

				if($(this).children("i").hasClass("fa-times")){
					this_ = $(".search-filter");
					$(this_).attr("data-status","close");
					$(".filter-options").css("height","0px");

					setTimeout(function(){
						$(this_).children(".filter-text").show();
						$(".filter-options").css("padding","0");
					},400);
					$(this_).children(".filter-icon-outer").children(".filter-icon").addClass("fa-filter").removeClass("fa-times");
					e.stopPropagation();
				}
			})
			$(".filter-days-select ").click(function(e){
				state = $(this).attr("data-status");
				if(state == "close"){
					$(this).attr("data-status","open").children(".select-option-outer").css("height","auto");
				}else{
					$(this).attr("data-status","close").children(".select-option-outer").css("height","0px");
				}
				e.stopPropagation();
			});

			$("body,html").click(function(){
				$(".select-option-outer").css("height","0");
				$(".filter-days-select ").attr("data-status","close");
			});

			$(".select-option-outer .select-option").click(function(e){
				$(".select-option-outer").css("height","0");
				value = $(this).children("span").html();
				$(this.parentNode.parentNode.parentNode).children("span").html(value);
				$(".filter-days-select ").attr("data-status","close");
				e.stopPropagation();
			});	
			$(".price-selector").slider({
				min : 100,
				max : 50000,
				step : 100,
				range : true,
				tooltip_position : 'bottom',
				tooltip_split : true,
				tooltip : 'always',
				formatter : function(e){
					return "₹"+e;
				}

			});
			$(".clear-search").click(function(){
				$(".search-key").val("").focus();
				
			});
			$(".search-key").keyup(function(e){
				if(e.which == 13){
					$.post("/search",{key : this.value},function(data){
						if(data != 0){
							data = $.parseJSON(data);
							$("ul.search-result").html("");
							populate(data);
						}
					});
				}
			});

			function bind(){
				$(".add_to_bag button").click(function(e){
					action = $(this).attr("data-action");
					product_id = $(this).attr("data-product-id");

					if(action == "add"){
						$.post("/additem",{ product_id : product_id},function(response){
							if(response > 0){

								$(".add_to_bag button[data-product-id='"+response.trim()+"']").attr("data-action","remove").html("<span>Remove</span>").parent().css("bottom","0px");
							}
						});
					}else if(action == "remove"){
						$.post("/removeitem",{ product_id : product_id},function(response){
							if(response > 0){
								$(".add_to_bag button[data-product-id='"+response.trim()+"']").attr("data-action","add").html("<span>Add to bag</span>").parent().css("bottom","-50px");;
							}
						});
					}
				});
			}

			function populate(data){
				for(d in data){
					if(!cart_items || cart_items.indexOf(data[d].product_id  + "") < 0)
						element = '<li class="search-item" data-shop="'+data[d].shop_id+'" data-item="'+data[d].product_id+'"><div class="image"><div class="item_action"></div><img src="'+data[d].media_cover+'"><div class="add_to_bag"><button data-product-id="'+data[d].product_id+'" data-action="add">Add to bag</button></div></div><div class="info-outer">	<p class="item-title">'+data[d].title+'</p><div class="extra-info"><span class="cost">&#8377;'+data[d].cost+'</span><i class="fa fa-star rating-icon"></i><b class="rating">3.5</b></div></div></li>';
					else
						element = '<li class="search-item" data-shop="'+data[d].shop_id+'" data-item="'+data[d].product_id+'"><div class="image"><div class="item_action"></div><img src="'+data[d].media_cover+'"><div class="add_to_bag" style="bottom:0px"><button data-product-id="'+data[d].product_id+'" data-action="remove">Remove</button></div></div><div class="info-outer">	<p class="item-title">'+data[d].title+'</p><div class="extra-info"><span class="cost">&#8377;'+data[d].cost+'</span><i class="fa fa-star rating-icon"></i><b class="rating">3.5</b></div></div></li>';
					$("ul.search-result").append(element);
				}
				bind();
			}


			populate(product_list);
		</script>
	</body>
</html>






