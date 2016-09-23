<?php
	
	class Login extends Engine{
		
		public static function verify($username,$password){
			$username = hash("sha512", $username);
			$record = Login::find("email = ? OR mobile = ?",  array($username, $username));
			if(!$record->is_empty()){
				if(password_verify($password,$record->password)){

					$data = array(
							"id" => $record->user_id,
							"user_type" => $record->user_type,
							"valid" => true
						);
					
					if($record->user_type == 2){
						$shop = Shop::find("owner_id = ? AND default_shop = 1",array($record->user_id));
						if(!$shop->is_empty()){
							$data["shop_id"] = $shop->shop_id;
						}
					}
					$key = Redis::user($data);
					Cookie::set("rog_vik",$key);
					return array(
						"id" => $record->user_id,
						"user_type" => $record->user_type
						);
				}else{
					return -1;
				}
			}else{
				return 0;
			}
		}

		public static function add_customer($email, $mobile, $password, $user_id){
			$options = [
			    'cost' => 13,
			    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
			];
			$pass = password_hash($password, PASSWORD_BCRYPT, $options);
			$mobile = hash("sha512", $mobile);
			$email = hash("sha512", $email);

			$id = Login::insert(array(
					"email" => $email,
					"mobile" => $mobile,
					"user_id" => $user_id,
					"password" => $pass,
					"user_type"	=> 1
				));
			if($id > 0){
				$data = array(
							"id" => $user_id,
							"user_type" => 1,
							"valid" => true
						);
				$key = Redis::user($data);
			}
			return $id;
		}

		/**** Expired   *****/
		public static function add_shop($email, $mobile, $password, $user_id){
			$options = [
			    'cost' => 13,
			    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
			];
			$pass = password_hash($password, PASSWORD_BCRYPT, $options);
			$mobile = hash("sha512", $mobile);
			$email = hash("sha512", $email);

			$id = Login::insert(array(
					"email" => $email,
					"mobile" => $mobile,
					"user_id" => $user_id,
					"password" => $pass,
					"user_type"	=> 2
				));
			if($id > 0){
				$data = array(
							"id" => $user_id,
							"user_type" => 2,
							"valid" => true
						);
				$key = Redis::user($data);
				
			}
			return $id;
		}

	}

?>