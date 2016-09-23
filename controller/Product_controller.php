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
			$this->render("product");
		}

		public function search(){
			if($this->is_valid_request()){
				$data = $this->getData();
				$this->key = $data['key'];
				$this->product_list = Product::search($this->key);
				if($this->product_list)
					$this->product_list = json_encode($this->product_list,JSON_FORCE_OBJECT);
				if(Cookie::has("rog_c")){

					$this->bag = Redis::bag_products();

					//$this->bag = Cart::get_cart_items($cart_id);
					if(count($this->bag) > 0)
						$this->bag = json_encode($this->bag);
					else
						$this->bag = false;
				}else
					$this->bag = array();

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