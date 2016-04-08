<?php
	class RogController extends Controller{

		

		public function subscribe(){
			if($this->is_valid_request()){
				$data = $this->getData();
				$id_ = Subscribe::insert(array(
						"email" => $data['email']
					));
				if($id_ == -1) echo -1;
				elseif($id_ == false) echo 0;
				else echo 1;
			}else{
				$this->showErrors();
			}
		}

		// Shop register
		public function shop_register(){
			if($this->is_valid_request()){
				$data = $this->getData();
				$dup = Customer::find("email = ? || mobile = ?",array($data['email'], $data['mobile']));
				if($dup){
					echo "Aldready customer";
				}else{
					$picture = Uploads::moveImage("picture","uploads/owner/", substr(hash("sha512", $data['email'].time()), -8)."_".time());
					$owner_id = Owner::add($data['name'],$data['email'],$data['mobile'],$picture);
					$banner = Uploads::moveImage("s_banner","uploads/banner/",substr(hash("sha512", $owner_id.time()),-8)."_".time());
					if($owner_id > 0){
						$shop_id = Shop::add($data['s_name'],$owner_id, $banner, $data['s_city'], $data['s_state'], 'India', $data['email']);
						if($shop_id && $shop_id > 0){
							$l_id = Login::add_shop($data['email'],$data['mobile'],$data['password'],$owner_id);
							if($l_id && $l_id > 0)
								echo "yes";
							else echo "no2";
						}
						else echo "no";
					}elseif($owner_id == -1){
						echo "Dup shop";
					}
					else echo "no";
				}
			}else{
				$this->showErrors();
			}
		}

		// Customer register
		public function customer_register(){
			if($this->is_valid_request()){
				$data = $this->getData();
				$dup = Owner::find("email = ? || mobile = ?",array($data['email'], $data['mobile']));
				if($dup){
					echo "Aldready owner";
				}else{
					$cus_id = Customer::add($data['name'],$data['email'],$data['mobile'],$data['password'], $data['picture']);

					if($cus_id && $cus_id > 0)
						echo "ok";
					else echo "no";
				}
			}else{
				$this->showErrors();
			}
		}


		public function login(){
			if($this->is_valid_request()){
				$data = $this->getData();
				$id = Login::verify($data['username'], $data['password']);
				if(is_array($id)){
					//header("Location:/product");
					Session::print_all();
				}elseif($id == 0){
					echo "No user";
				}elseif($id == -1){
					echo "Not a valid password";
				}
			}else{
				$this->showErrors();
			}
		}
	}
?>