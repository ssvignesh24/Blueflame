<?php
	
	include_once 'helpers/Redis_helper.php';

	function grant(){
		$token = filter_input(INPUT_GET,"token")."_24";
		$auth = filter_input(INPUT_GET,"auth")."_13";
		if(Redis::has($token) && Redis::has($auth)){
			return true;
		}else{
			return false;
		}
	}
	
		
?>