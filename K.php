<?php
	
	date_default_timezone_set("Asia/Kolkata");

	include 'core/load.php';
	
	$session = new Session();
	if(explode("/", $_GET['route'])[0] == "admin"){
		include 'core/auth.php';
		$a = new Admin();
		$a->handle($_GET['route']);

	}else{

		if(count(explode(".", $_SERVER['HTTP_HOST'])) >= 3)
			$action = Route::route_of("*.".$_GET['route'], $_SERVER['REQUEST_METHOD']);
		else
			$action = Route::route_of($_GET['route'], $_SERVER['REQUEST_METHOD']);
		// Initiate controller pbject
		$controller = new $action['controller'];
		
		// Check for filter
		if($action['filter'] == true){
			if(!$controller->__filter_request())
				$controller->filter_failed();
		}

		// Check for input errors
		if(isset($action['error'])){
			$controller->setErrors($action['error']);
			$controller->setErrorsFields($action['error_fields']);
		}
		elseif(isset($action['data'])) $controller->setData($action['data']);

		// Check if action exists
		if(method_exists($controller, $action['action'])){
			$controller->$action['action']();
			if(!$controller->getRenderState()){
				if(file_exists("views/".substr($action['controller'], 0,-10)."/".$action['action'].".php"))
					include "views/".substr($action['controller'], 0,-10)."/".$action['action'].".php";
			}
		}
		else
			throw new Exception("Action not found : ".$action['action']);
		
	}

	

?> 