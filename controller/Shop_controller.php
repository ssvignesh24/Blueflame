<?php
		
	class ShopController extends Controller{

		public function __filter_request(){
			if(Session::has('valid') && Session::has('id')){
				return true;
			}
			else return false;
		}
		
		public function new_product(){
			$this->render("product_form");
		}

		public function home(){
			
		}

		public function list_followers(){
			echo "Follow";
			$this->p($this->getdata());
		}

		public function setting(){
			echo "hi";
			$this->p($this->getdata());

		}
	}

?>