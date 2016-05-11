<?php
	class ProductController extends Controller{

		public function __filter_request(){
			if(Session::has('valid') && Session::has('id') ){
				return true;
			}
			else return false;
		}

		public function product(){
			$data = $this->getData();
			echo $data['product_id'];
		}

		public function search(){
			if($this->is_valid_request()){
				$data = $this->getData();
				$this->key = $data['key'];
				$this->product_list = Product::search($this->key);
				if($this->product_list)
					$this->product_list = json_encode($this->product_list,JSON_FORCE_OBJECT);
				if(Session::has("cart_id")){
					$cart_id = Session::get("cart_id");
					$this->cart_items = Cart::get_cart_items($cart_id);
					if(count($this->cart_items) > 0)
						$this->cart_items = json_encode($this->cart_items);
					else
						$this->cart_items = false;
				}else
					$this->cart_items = array();

				$this->render("search");
			}else $this->showErrors();
		}

		public function search_json(){
			if($this->is_valid_request()){
				$data = $this->getData();
				$this->key = $data['key'];
				$this->product_list = Product::search($this->key);
				if($this->product_list){
					echo json_encode($this->product_list,JSON_FORCE_OBJECT);

				}else echo 0;
			}else $this->showErrors();
		}
		
	}
?>