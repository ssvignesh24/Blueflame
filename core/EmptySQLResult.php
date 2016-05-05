<?php

	class EmptySQLResult{
		public function each($args = false){
			return false;
		}

		public function is_empty(){
			return true;
		}
	}
?>