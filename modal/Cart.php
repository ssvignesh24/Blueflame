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
			if(Session::has("cart_id")){
				$cart_id = Session::get("cart_id");
				$customer_id = Session::get("id");
				$c = Cart::find("cart_id = ? AND customer_id = ?",array($cart_id,$customer_id));
				if($c){
					$cart = array();
					$c->each(function($item) use(&$cart){
						array_push($cart, $item->product_id);
					});
					return json_encode($cart,JSON_FORCE_OBJECT);
				}else
					return "''";
			}

			return "''";
		}
	}

?>