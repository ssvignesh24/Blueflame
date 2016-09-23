<?php

	class Cart extends Engine{

		static public function get_cart_items($cart_id){
			$cart = array();
			$customer_id = Session::get("id");
			$c = Cart::find("cart_id = ? AND customer_id = ?",array($cart_id,$customer_id));
			$c->each(function($item) use(&$cart){
				array_push($cart, $item->product_id);
			});
			return $cart;
		}

		public static function getItems(){
			if(Cookie::has("rog_c")){
				return json_encode(Redis::bag_products());
			}
			return "''";
		}
	}

?>

