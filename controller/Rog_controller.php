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
				$s_name = strtolower($data['name']);
				//Dulpicate shop name
				$s_id = Shop::find("name = ?",array($s_name));
				if(!$s_id->is_empty()){
					echo "Shop name taken";
					return;
				}
				// Is customer?
				$user = Customer::current();				
				if($user === false){
					echo "Not a user";
				}else{
					$user->update(array(
						"customer_type" => 2
						));
					Login::find("user_id = ?",array($user->customer_id))->update(array("user_type" => 2));
					$owner_id = $user->customer_id;
					$banner = Uploads::moveImage("s_banner","uploads/banner/",substr(hash("sha512", $owner_id.time()),-8)."_".time());
					$picture = Uploads::moveImage("picture","uploads/shop/",substr(hash("sha512", $owner_id.time()),-8)."_".time());
					$shop_id = Shop::add($s_name,$data['title'],$data['shop_type'], $owner_id, $banner, $data['s_city'], $data['s_state'], 'India', $user->email,$picture);
					if($shop_id && $shop_id > 0){
						header("Location:/product");
					}
					else echo "no";
				}
			}else{
				$this->showErrors();
			}
		}

		public function shop_name(){
			if($this->is_valid_request()){
				$name = $this->getData()['name'];
				$id = Shop::find("name = ?",array($name));
				if($id == false)
					echo 1;
				else echo 0;
			}else{
				$this->showErrors();
				return 0;
			}
		}

		// Customer register
		public function customer_register(){
			if($this->is_valid_request()){
				$data = $this->getData();
				$customer_id = Rog::generate_user_id($data['email'],"customer");
				$picture = Uploads::moveImage("picture","uploads/user_picture/",substr(hash("sha512", $customer_id.time()),-8)."_".time());
				$cus_id = Customer::add($customer_id,$data['name'],$data['email'],$data['mobile'],$data['password'], $picture);
				if($cus_id && $cus_id > 0)
					echo "ok";
				else echo "no";
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
					if($id['user_type'] == 2){
						$shop = Shop::find("owner_id = ?",array($id['id']));
						if($shop)
							$shop_id = $shop->shop_id;
						else{
							$this->logout();
							die("No shop found");
						}
						Session::set("shop_id",$shop_id);
					}
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