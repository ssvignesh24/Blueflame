<?php
		
	class ShopController extends Controller{

		public function __filter_request(){
			Session::print_all();
			if(Session::has('valid') && Session::has('id')){
				return true;
			}
			else return false;
		}
		
		public function new_product(){
			$this->render("product_form");
		}
	}

?>