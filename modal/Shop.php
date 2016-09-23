<?php
	
	class Shop extends Engine{

		static public function add($name, $title, $type, $owner_id, $banner, $city, $state, $country, $email,$picture){
			$shop_id = Rog::generate_user_id($email,"shop");
			$type = (int)$type;
			$id = Shop::insert(array(
					"shop_id" => $shop_id,
					"shop_name" => $name,
					"owner_id" => $owner_id,
					"shop_type" => $type,
					"shop_title" => $title,
					"picture" => $picture,
					"banner" => $banner,
					"city" => $city,
					"state" => $state,
					"contact_email" => $email
				));

			if($id > 0){
				return $shop_id;
				Session::set("current_shop",$shop_id);
			}
			else return false;
		}

		static public function list_shop(){
			$user_id = (Session::get("id"));
			$shops = Shop::find("owner_id = ?",array($user_id));
			if($shops->is_empty())
				return false;
			else return $shops;
		}
	}
?>