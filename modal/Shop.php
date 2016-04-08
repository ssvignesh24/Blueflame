<?php
	
	class Shop extends Engine{

		static public function add($name, $owner_id, $banner, $city, $state, $country, $email){
			$shop_id = Rog::generate_user_id($email,"shop");

			$id = Shop::insert(array(
					"shop_id" => $shop_id,
					"name" => $name,
					"owner_id" => $owner_id,
					"banner" => $banner,
					"city" => $city,
					"state" => $state,
					"contact_email" => $email
				));

			if($id > 0)
				return $shop_id;
			else return false;
		}
	}
?>