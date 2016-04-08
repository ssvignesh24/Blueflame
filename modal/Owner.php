<?php

	class Owner extends Engine{
		public static function add($name, $email, $mobile, $picture){
			$owner_id = Rog::generate_user_id($email,"owner");
			$id = Owner::insert(array(
					"owner_id" => $owner_id,
					"name" => $name,
					"email" => $email,
					"mobile" => $mobile,
					"picture" => $picture
				));

			if($id > 0)
				return $owner_id;
			elseif($id == -1)
				return -1;
			else return false;
		}
	}
	
?>