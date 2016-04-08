<?php
	
	class Rog{
		public static function generate_user_id($data, $who){
			if($who == "customer")
				$id = "1";
			elseif($who == "shop")
				$id = "2";
			elseif($who == "payment")
				$id = "3";
			elseif($who == "product")
				$id = "4";
			elseif($who == "order")
				$id = "5";
			elseif($who == "message")
				$id = "6";
			elseif($who == "address")
				$id = "7";
			elseif($who == "owner")
				$id = "8";
			elseif($who == "cart")
				$id = "8";
			elseif($who == "review")
				$id = "9";
			$sum = 0;
			
			for($i = 0; $i < strlen($data); $i++){
				$sum += ord($data[$i]);
			}
			$id .= mt_rand(1000,9999);
			$id .= substr(time(), strlen(time()) - 6);
			$id .= $sum.mt_rand(10000,99999);
			return $id;
		}
	}

?>