<?php
	
	class Product extends Engine{
		public static function get_catagories($shop_id){
			$s = Engine::execute("SELECT DISTINCT product_category as category FROM product WHERE shop_id = ? ",array($shop_id));
			if(count($s) == 0)
				return false;
			else return $s;
		}

		public static  function search($key,$cat = false,$shop = false,$pricemax = 100000,$pricemin = 0){
			$values = array();
			$key = "%".str_replace(" ", "%", $key)."%";			
			$q = "SELECT * FROM `product` WHERE `title` like ? ";
			array_push($values, $key);
			if($cat){
				$q .= " AND `product_type` like ? ";
				array_push($values, $cat['type']);
				if(isset($cat['sub'])){
					$q .= " AND `product_sub_type` like ? ";
					array_push($values, $cat['sub']);
				}
			}
			if($shop){
				$q .= " AND `shop_id` like ?";
				array_push($values, $shop);
			}
			$q .= " AND cost <= ? AND cost >= ? AND active = 1 ORDER BY `updated_at`";
			array_push($values, $pricemax);
			array_push($values, $pricemin);
			$result = Product::execute($q,$values);

			$values = array();
			$key = "%".str_replace(" ", "%", $key)."%";			
			$q = "SELECT * FROM `product` WHERE `desc_long` like ? ";
			array_push($values, $key);
			if($cat){
				$q .= " AND `product_type` like ? ";
				array_push($values, $cat['type']);
				if(isset($cat['sub'])){
					$q .= " AND `product_sub_type` like ? ";
					array_push($values, $cat['sub']);
				}
			}
			if($shop){
				$q .= " AND `shop_id` like ?";
				array_push($values, $shop);
			}
			$q .= " AND cost <= ? AND cost >= ? AND active = 1 ORDER BY `updated_at`";
			array_push($values, $pricemax);
			array_push($values, $pricemin);
			$result_desc = Product::execute($q,$values);
			$res = array_merge($result,$result_desc);
			//var_dump($res);
		}
	}
?>