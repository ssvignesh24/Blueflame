<?php
		
	class ShopController extends Controller{

		public function __filter_request(){
			Session::print_all();
			if(Session::has('valid') && Session::has('id') && Session::has("shop_id")){
				return true;
			}
			else return false;
		}
		
		public function new_product(){
			$this->p_c = Rog::PRODUCT_CATGORY;
			$this->p_option = Rog::PRODUCT_OPTION;
			$this->catagery = Product::get_catagories(Session::get("shop_id"));
			$this->render("product_form");
		}

		public function list_shops(){
			$this->user = Customer::current()->name;
			$this->shops = Shop::list_shop();
			$this->render("list_shop");
		}

		public function test(){
			echo "HELLO ADMIN";
		}

		public function change_shop(){
			$data = $this->getData();
			$this->shop = Shop::find("name = ? AND owner_id = ?",array(strtolower($data['shop']), Session::get("id")));
			if($this->shop->is_empty()){
				header("Location:/");
				die();
			}else{
				$shop_id = $this->shop->shop_id;
				Session::set("shop_id",$shop_id);
				header("Location:/".$this->shop->name);
			}
		}

		public function home(){
			$data = $this->getData();
			$this->shop = Shop::find("name = ?",array(strtolower($data['shop'])));
			if($this->shop->is_empty()){
				header("Location:/");
				die();
			}else{
				$this->owner = Customer::find("customer_id = ?",array($this->shop->owner_id));
				$shop_id = $this->shop->shop_id;
				$this->categories = Product::get_catagories($shop_id);
				$this->products = Product::find("shop_id = ?",array($shop_id));
				$follow = Shop_follower::find(" shop_id = ? AND customer_id = ?",array($shop_id, Session::get("id")));
				$this->following = $follow->is_empty();
				if(Session::has("cart_id")){
					$cart_id = Session::get("cart_id");
					$this->cart_items = Cart::get_cart_items($cart_id);
					
				}else
					$this->cart_items = array();
				$this->render("home");
			}
		}

		public function script(){
			$this->render("script");
		}

		public function list_followers(){
			echo "Follow";
			$this->p($this->getdata());
		}

		public function setting(){
			echo "hi";
			$this->p($this->getdata());
		}

		public function moveProduct(){

		}

		public function follow_shop(){
			if($this->is_valid_request()){
				$data = $this->getData();
				$shop = $data['shop'];
				Shop_follower::add($shop,Session::get("id"));
				echo 1;
			}
		}

		public function unfollow_shop(){
			if($this->is_valid_request()){
				$data = $this->getData();
				$shop = $data['shop'];
				Shop_follower::remove($shop,Session::get("id"));
				echo 1;
			}
		}

		public function create_product(){
			if($this->is_valid_request()){
				$data = $this->getData();
				$media = "";
				$shop_id = Session::get('shop_id');
				$overview = $data['overview'];
				$days = $data['days'] + 2;
				$prod_id = Rog::generate_user_id($data['title'],"product");
				$data['product_id'] = $prod_id;

				$media = Uploads::multipleImage("photos","uploads/product/",function($d) use ($shop_id,$prod_id){
					$name = $shop_id."_".substr(hash("sha512",$d),-10)."_".$prod_id."_".time();
					return $name;
				});

				Product_queue::add(array(
						"title" => $data['title'],
						"product_id" => $prod_id,
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