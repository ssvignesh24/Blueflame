<?php

	class EmptySQLResult{
		public function each($args = false){
			return false;
		}

		public function is_empty(){
			return true;
		}

		public function count(){
			return 0;
		}
	}
?>