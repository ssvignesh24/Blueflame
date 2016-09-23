<?php

	class Product_queue extends Engine{
		public static function add($d){
			$id = Product_queue::insert($d);
			if($id > 0)
				return $id;
			else return false;
		}
	}

?>