<?php
	class ProductController extends Controller{

		public function __filter_request(){
			if(Session::has('valid') && Session::has('id') ){
				return true;
			}
			else return false;
		}

		public function search(){
			if($this->is_valid_request()){
				$data = $this->getData();
				$key = $data['key'];
				Product::search($key);
			}else $this->showErrors();
		}
		
	}
?>