<?php
	class CartController extends Controller{

		public function __filter_request(){
			if(Session::has('valid') && Session::has('id') ){
				return true;
			}
			else return false;
		}
		public function add_item(){
			if($this->is_valid_request()){
				$data = $this->getData();

				$product = Product::find("product_id = ?",array($data['product_id']));
				if($product->is_empty()){
					// Not a valid product
				}else{
					if($product->active == 1){

						$product_id = $data['product_id'];
						$data = array(
								"product_id" => $product_id,
								"product_name" => $product->product_title,
								"image" => $product->media_cover,
								"cost" => $product->cost,
								"quantity" => 1
							);

						echo (Redis::add_to_bag($data))? $product_id : 0;
					}
					else{
						echo -1;
					}
				}
			}else{
				$this->showErrors();
			}
		}

		public function remove_item(){
			if($this->is_valid_request()){
				$data = $this->getData();
				$product = Product::find("product_id = ?",array($data['product_id']));
				if($product->is_empty()){
					// Not a valid product
				}else{
					if($product->active == 1){
						$product_id = $data['product_id'];
						echo (Redis::remove_from_bag($product_id))? $product_id : 0;
					}else
						echo -1;
				}
			}else{
				$this->showErrors();
			}
		}

		public function show_cart(){
			$bag_items = Redis::show_bag();
			if($bag_items){
				$this->bag = array();
				foreach ($bag_items as $key => $value) {
					$this->bag[$key] = json_decode($value);
				}
				$this->count = count($this->bag);
			}else{
				$this->bag = false;
				$this->count = 0;
			}

			$this->render("cart");
		
		}

		public function validate_coupon(){
			if($this->is_valid_request()){
				$coupon = $this->getData()['coupon'];
				$coupon_code = Coupon::find("coupon_code = ? ",$coupon);
				if($coupon_code->is_not_empty()){
					echo $coupon_code->discount_price;
					Redis::setcoupon($coupon_code->discount_price);
				}else echo -1;
			}else echo -1;
		}

		public function cart_products(){
			//$this->render("show_cart");
		}
	}
?>