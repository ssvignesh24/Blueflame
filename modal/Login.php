<?php
	
	class Login extends Engine{
		
		public static function verify($username,$password){
			$username = hash("sha512", $username);
			$record = Login::find("email = ? OR mobile = ?",  array($username, $username));
			if($record){
				if(password_verify($password,$record->password)){
					Session::set("id", $record->user_id);
					Session::set("user_type", $record->user_type);
					Session::set("valid",true);
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
				Session::set("id", $user_id);
				Session::set("user_type", 1);
				Session::set("valid",true);
			}
			return $id;
		}

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
				Session::set("id", $ruser_id);
				Session::set("user_type", 2);
				Session::set("valid",true);
			}
			return $id;
		}

	}

?>