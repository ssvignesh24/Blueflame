<?php
	
	class Customer extends Engine{

		public static function add($customer_id,$name, $email, $mobile, $password, $picture){
			

			$id = Customer::insert(array(
					"customer_id" => $customer_id,
					"customer_name" => $name,
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

		public static function current(){
			$ret = array();
			$id = Session::get("id");

			$details = Customer::find("customer_id = ?",array($id));
			if($details){
				return $details;
			}else return false;
		}
	}

?>