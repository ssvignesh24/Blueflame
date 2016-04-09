<?php
	
	class Product extends Engine{
		public static function get_catagories($shop_id){
			$s = Engine::execute("SELECT DISTINCT product_category as category FROM product WHERE shop_id = ? ",array($shop_id));
			return $s;
		}
	}
?>