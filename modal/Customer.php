<?php
	
	class Customer extends Engine{

		public static function add($name, $email, $mobile, $password, $picture){
			$customer_id = Rog::generate_user_id($email,"customer");

			$id = Customer::insert(array(
					"customer_id" => $customer_id,
					"name" => $name,
					"email" => $email,
					"mobile" => $mobile,
					"picture" => $picture,
				));
			if($id > 0){
				$login_id = Login::add_customer($email, $mobile, $password, $customer_id);
				if($login_id > 0)
					return $customer_id;
				else return false;
			}else return $id;

		}
	}

?>