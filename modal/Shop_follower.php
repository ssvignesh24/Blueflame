<?php
	class Shop_follower extends Engine{
		public static function add($shop,$customer_id){
			$result = Shop_follower::find(" shop_id = ? AND customer_id = ?",array($shop, $customer_id));
			if($result->is_empty()){
				Shop::find("shop_id = ?",array($shop))->increment("followers");
				Shop_follower::insert(array(
						"shop_id" => $shop,
						"customer_id" => $customer_id
					));
			}
		}

		public static function remove($shop,$customer_id){
			$result = Shop_follower::find(" shop_id = ? AND customer_id = ?",array($shop, $customer_id));
			if(!$result->is_empty()){
				Shop::find("shop_id = ?",array($shop))->decrement("followers");
				Shop_follower::delete(" shop_id = ? AND customer_id = ?",array($shop, $customer_id));
			}
		}
	}
?>