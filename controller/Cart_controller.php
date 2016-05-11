<?php
	class CartController extends Controller{

		public function __filter_request(){
			if(Session::has('valid') && Session::has('id') ){
				return true;
			}
			else return false;
		}
		public function add_item(){
			if($this->is_valid_request()){
				$data = $this->getData();
				$id = Product::find("product_id = ?",array($data['product_id']));
				if($id == false){
					// Not a valid product
				}else{
					if($id->active == 1){
						if(!Session::has('cart_id')){
							$u_id = Session::get("id");
							$cart_id = Rog::generate_user_id($u_id,"cart");
							Session::set("cart_id",$cart_id);
						}
						else
							$cart_id = Session::get("cart_id");
						$product_id = $data['product_id'];
						$customer_id = Session::get("id");
						$id = Cart::insert(array(
							"cart_id" => $cart_id,
							"product_id" => $product_id,
							"customer_id" => $customer_id
						));

						if($id > 0)
							echo $product_id;
						else echo 0;
					}
					else{
						echo -1;
					}
				}
			}else{
				$this->showErrors();
			}
		}

		public function remove_item(){
			if($this->is_valid_request()){
				$data = $this->getData();
				$id = Product::find("product_id = ?",array($data['product_id']));
				if($id == false){
					// Not a valid product
				}else{
					if($id->active == 1 && Session::has("cart_id")){
						$cart_id = Session::get("cart_id");
						$product_id = $data['product_id'];
						$customer_id = Session::get("id");
						Cart::delete("cart_id = ? AND product_id = ? AND customer_id = ?",array($cart_id,$product_id,$customer_id));
						echo $product_id;
					}else
						echo -1;
				}
			}else{
				$this->showErrors();
			}
		}

		public function show_cart(){
			if(Session::has("cart_id"))
				$this->items = Cart::join(array("product"))->where("cart_id = ?",array(Session::get("cart_id")));
			else
				$this->items = new EmptySQLResult();
			$this->render("cart");
		
		}

		public function cart_products(){
			//$this->render("show_cart");
		}
	}
?>