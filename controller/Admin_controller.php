<?php
	
	class AdminController extends Controller{

		public function __filter_request(){

	      return true;
	    }
		

		// GET Handlers
		public function home(){

		}

		public function coupons(){
			$coupons = Coupon::all();
			$this->init = false;
			if($coupons->is_not_empty()){
				$this->init = $coupons->to_json();
			}
			$this->page = "Coupons";
			$this->options = array("Search");
			$this->allow_new = array(
					"coupon_code" => array(
							"label" => "Coupon code",
							"type" => "text"
						),
					"discount_price" => array(
							"label" => "Discount in %",
							"type" => "number"
						),
					"coupon_expires" => array(
							"label" => "Expires",
							"type" => "date"
						)
				);
			$this->req_fields = array(
				"coupon_code" => "Coupon code",
				"discount_price" => "Discount percentage",
				"created_at" => "Added on",
				"coupon_used" => "Coupon used",
				"coupon_expires" => "Expires on",
				);
			$this->input = array(
					array(
							"placeholder" => "Coupon code",
							"path" => "/admin/product_by_title"
						),
				);
			$this->render("page");
		}

		public function products(){
			$this->page = "Products";
			$this->options = array("Search","Status");
			$this->allow_new = array(
				"product_type" => "Type",
				"product_sub_type" => "Sub-type",
				"product_category" => "Shop category",
				"product_title" => "Product title",
				"shop_title" => "Shop title",
				"shop_name" => "Shop name",
				"custom_packing" => "Custom packing",
				"gender" => "Gender",
				"desc_long" => "Description",
				"review_count" => "Review count",
				"delivery_days" => "Devilery",
				"cost" => "Cost",
				"active" => "Active"
				);
			$this->req_fields = array(
				"product_type" => "Type",
				"product_sub_type" => "Sub-type",
				"product_category" => "Shop category",
				"product_title" => "Product title",
				"shop_title" => "Shop title",
				"shop_name" => "Shop name",
				"custom_packing" => "Custom packing",
				"gender" => "Gender",
				"desc_long" => "Description",
				"review_count" => "Review count",
				"delivery_days" => "Devilery",
				"cost" => "Cost",
				"active" => "Active"
				);
			$this->input = array(
					array(
							"placeholder" => "Title",
							"path" => "/admin/product_by_title"
						),
					array(
							"placeholder" => "Product id",
							"path" => "/admin/product_by_id"
						),
					array(
							"placeholder" => "Shop name",
							"path" => "/admin/product_by_shop"
						),
				);
			$this->render("page");
		}

		public function approvals(){
			$product = Product_queue::find("status = ?",1);
			$this->init = false;
			if($product->is_not_empty()){
				$this->init = $product->to_json(function($pro){
					$pro->visit = "<a target='_blank' href=/admin/product?proid=".$pro->product_id."><button class='btn btn-primary'>Show</button></a>";
				});
			}
			$this->page = "Approvals";
			$this->options = array("Pending","Cancelled");
			$this->allow_new = false;
			$this->req_fields = array(
				"product_type" => "Type",
				"product_sub_type" => "Sub-type",
				"product_title" => "Product title",
				"shop_title" => "Shop title",
				"shop_name" => "Shop name",
				"custom_packing" => "Custom packing",
				"gender" => "Gender",
				"desc_long" => "Description",
				"delivery_days" => "Devilery",
				"cost" => "Cost",
				"p_created_at" => "Added on",
				"visit" => "Action"
				);
			$this->input = array(
					array(
							"placeholder" => "Title",
							"path" => "/admin/approval_by_title"
						),
					array(
							"placeholder" => "Shop name",
							"path" => "/admin/approval_by_shop"
						),
				);
			$this->render("page");
		}

		public function customers(){
			$this->page = "Customers";
			$this->options = array("Search");
			$this->allow_new = true;
			$this->req_fields = array(
				"customer_name" => "Name",
				"email" => "E-mail",
				"mobile" => "Mobile",
				"picture" => "Picture",
				"customer_type" => "Shop owner?",
				"created_at" => "Since"
				);
			$this->input = array(
					array(
							"placeholder" => "Name",
							"path" => "/admin/customer_by_name"
						),
					array(
							"placeholder" => "Email or mobile",
							"path" => "/admin/customer_by_mobile"
						),
				);
			$this->render("page");

		}

		public function shops(){
			$this->page = "Shops";
			$this->options = array("Search");
			$this->allow_new = true;
			$this->req_fields = array(
				"title" => "Shop title",
				"shop_name" => "Shop name",
				"shop_title" => "Shop title",
				"customer_name" => "Owner name",
				"email" => "Owner email",
				"mobile" => "Owner mobile",
				"shop_address" => "Shop address"
				);
			$this->input = array(
					array(
							"placeholder" => "Shop name",
							"path" => "/admin/shop_by_title"
						),
					array(
							"placeholder" => "Shop username",
							"path" => "/admin/shop_by_username"
						),
					array(
							"placeholder" => "Ower mobile or email",
							"path" => "/admin/shop_by_owner"
						),
				);
			$this->render("page");

		}

		public function dash(){

		}

		public function sales(){

		}

		public function shipping(){

		}

		public function payments(){

		}

		public function requests(){

		}

		public function rog(){

		}

		public function view_product(){
			if($this->is_valid_request()){
				$this->render("product");	
			}
			
		}

		// Creations

		public function create_coupons(){
			if($this->is_valid_request()){
				$data = $this->getData();
				$data['coupon_id'] = Rog::generate_user_id($data['coupon_code'],'coupon');
				$id = Coupon::insert($data);
				if($id > 0)
					header("Location:/admin/coupons");
			}else echo 0;
		}

		// POST handlers


		/***  Products  ***/
		public function product_by_shop(){
			if($this->is_valid_request()){
				$query = $this->getData()['q'];
				$shop_id = Shop::find("shop_name = ?",$query);
				if(!$shop_id->is_empty()){
					$products = Product::join('shop')->where("product.shop_id = ?",$shop_id->shop_id);
					echo $products->to_json();
				}else echo 0;
				
			}
		}

		public function product_by_id(){
			if($this->is_valid_request()){
				$query = $this->getData()['q'];
				$products = Product::join("shop")->where("product.product_id = ?",$query);
				echo $products->to_json();
			}

		}

		public function product_by_title(){
			if($this->is_valid_request()){
				$query = $this->getData()['q'];
				$products = Product::join("shop")->where("product.product_title like ?","%".$query."%");
				echo $products->to_json();
			}
		}


		/***  Approvals  ***/
		public function approval_by_title(){
			if($this->is_valid_request()){
				$query = $this->getData()['q'];
				$products = Product_queue::join("shop")->where("product_queue.status = 1 AND Product_queue.product_title like ? ","%".$query."%");
				echo $products->to_json();
			}else echo 0;
		}

		public function approval_by_shop(){
			if($this->is_valid_request()){
				$query = $this->getData()['q'];
				$shop_id = Shop::find("shop_name = ?",$query);
				if(!$shop_id->is_empty()){
					$products = Product_queue::join('shop')->where("product_queue.status = 1 AND Product_queue.shop_id = ?",$shop_id->shop_id);
					echo $products->to_json();
				}else echo 0;
			}
		}

		/*** Customer ***/

		public function customer_by_name(){
			if($this->is_valid_request()){
				$query = $this->getData()['q'];
				$customers = Customer::find("customer_name like ?","%".$query."%");
				echo $customers->to_json(function($customer){
					if($customer->customer_type == 2)
						$customer->customer_type = "Yes";
					elseif($customer->customer_type == 1)
						$customer->customer_type = "No";
					$customer->picture = "<img class='thumb' src='/".$customer->picture."'/>";
				});
			}
		}

		public function customer_by_mobile(){
			if($this->is_valid_request()){
				$query = $this->getData()['q'];
				$customers = Customer::find("mobile = ? OR email = ?",array($query,$query));
				echo $customers->to_json(function($customer){
					if($customer->customer_type == 2)
						$customer->customer_type = "Yes";
					elseif($customer->customer_type == 1)
						$customer->customer_type = "No";
					$customer->picture = "<img class='thumb' src='/".$customer->picture."'/>";
				});
			}
		}

		public function shop_by_owner(){
			if($this->is_valid_request()){
				$query = $this->getData()['q'];
				$owner = Customer::find(" ( mobile = ? OR email = ? ) AND customer_type = 2",array($query,$query ));
				if($owner->is_not_empty()){
					$shop = Shop::join("customer:owner_id")->where("shop.owner_id = ? ",$owner->customer_id);
					echo $shop->to_json(function($shop){
						$shop->shop_address = $shop->city.", ".$shop->state.", India";
					});
				}
			}
		}

		public function shop_by_title(){
			if($this->is_valid_request()){
				$query = $this->getData()['q'];
				$shops = Shop::join("customer:owner_id")->where("shop.shop_title like ?","%".$query."%");
				echo $shops->to_json(function($shop){
						$shop->shop_address = $shop->city.", ".$shop->state.", India";
					});
			}
		}

		public function shop_by_username(){
			if($this->is_valid_request()){
				$query = $this->getData()['q'];
				$shops = Shop::join("customer:owner_id")->where("shop.shop_name = ?",$query);
				echo $shops->to_json(function($shop){
						$shop->shop_address = $shop->city.", ".$shop->state.", India";
					});
			}
		}

	}

?>