<?php
		
	class ShopController extends Controller{

		public function __filter_request(){
			if(Session::has('valid') && Session::has('id')){
				return true;
			}
			else return false;
		}
		
		public function new_product(){
			$this->catagery = Product::get_catagories("1");
			$this->render("product_form");
		}

		public function create_product(){
			if($this->is_valid_request()){
				$data = $this->getData();

				
				$media = "";
				$shop_id = Session::get('shop_id');
				$overview = $data['overview'];
				$days = $data['days'] + 2;
				$pro_id = Rog::generate_user_id($data['title'],"product");
				$data['product_id'] = $pro_id;

				$media = Uploads::multipleImage("photos","uploads/product/",function($d) use ($shop_id,$pro_id){
					$name = $shop_id."_".substr(hash("sha512",$d),-10)."_".$pro_id."_".time();
					return $name;
				});

				Product_queue::add(array(
						"title" => $data['title'],
						"product_type" => $data['type'],
						"product_sub_type" => $data['sub_type'],
						"product_category" => $data["category"],
						"gender" => $data["gender"],
						"custom_packing" => $data["custom_packing"],
						"desc_short" => $overview,
						"desc_long" => $data["description"],
						"media" => $media,
						"shop_id" => $shop_id,
						"delivery_days" => $days,
						"cost" => $data['price']
					));

			}else{
				$this->showErrors();
			}
		}
	}

?>