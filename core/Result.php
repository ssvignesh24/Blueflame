<?php
	
	class SQLResult extends Engine{

		private $result, $table;
		public function __construct($result, $table){
			$this->result = $result;
			$this->table = $table;
		}

		public function __get($name){
			if(isset($this->result->$name))
				return $this->result->$name;
			else
				throw new Exception();
		}

		public function showError(){
			throw new Exception();
		}

		public function update($array){
			$q = "UPDATE `".$this->table."` SET ";
			foreach ($array as $key => $value) $q .= " ".$key." = ?,";
			$q[strlen($q) - 1 ] = " ";
			$q .= "WHERE `id` in (";

			if(is_array($this->result)){
				$ar = array();
				foreach ($this->result as $value) array_push($ar, $value->id);
				$q .= implode(",", $ar);
			}else
				$q .= $this->result->id;
			$q .= ")";
			Engine::prepare_and_execute($q,array_values($array));

		}

		public function each($func){
			if(is_array($this->result)){
				foreach ($this->result as $value) {
					$func($value);
				}
			}else
				$func($this->result);
		}
	}
	
?>