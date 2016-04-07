<?php
	
	class Route{

		private static $_ROUTE,$_VALIDATION;

		public static function get($pattern, $handle, $validation = false){
			if(!isset(Route::$_ROUTE['get']))
				$_ROUTE['get'] = array();
			Route::$_ROUTE['get'][$pattern] = $handle;
			if($validation) Route::$_VALIDATION['get'][$pattern] = $validation;

		}

		public static function post($pattern, $handle, $validation = false){
			if(!isset(Route::$_ROUTE['post']))
				$_ROUTE['post'] = array();

			Route::$_ROUTE['post'][$pattern] = $handle;
			if($validation) Route::$_VALIDATION['post'][$pattern] = $validation;
		}

		public static function url($pattern, $handle, $validation = false){
			if(!isset(Route::$_ROUTE['url']))
				$_ROUTE['url'] = array();

			Route::$_ROUTE['url'][$pattern] = $handle;
			if($validation) Route::$_VALIDATION['url'][$pattern] = $validation;
		}

		public static function route_of($url,$method){
			$r = array();
			$frags = false;
			$val = false;
			if(isset(Route::$_ROUTE['url'][$url])){
				$frags = explode("=>", Route::$_ROUTE['url'][$url]);
				if(isset(Route::$_VALIDATION['url'][$url]))
					$val = Route::$_VALIDATION['url'][$url];
			}elseif($method == "GET" && isset(Route::$_ROUTE['get'][$url])){
				$frags = explode("=>", Route::$_ROUTE['get'][$url]);
				if(isset(Route::$_VALIDATION['get'][$url]))
					$val = Route::$_VALIDATION['get'][$url];
			}elseif($method == "GET" && !isset(Route::$_ROUTE['get'][$url]) && isset(Route::$_ROUTE['get']["_default"])){
				$frags = explode("=>", Route::$_ROUTE['get']["_default"]);
			}
			elseif($method == "POST" && isset(Route::$_ROUTE['post'][$url])){
				$frags = explode("=>", Route::$_ROUTE['post'][$url]);
				if(isset(Route::$_VALIDATION['post'][$url]))
					$val = Route::$_VALIDATION['post'][$url];
			}

			try{
				if($frags){
					$r["controller"] = $frags[0]."Controller";
					$filter = explode(":", $frags[1]);
					$r["action"] = $filter[0];
					$r['filter'] = isset($filter[1]);

					if($val){
						if($val->validate($method))
							$r['data'] = $val->getData();
						else{
							$r['error'] = $val->getErrors();
							$r['error_fields'] = $val->getErrorFields();
						}
					}else{
						$r['data'] = Validation::getRequestData($method);
					}
					return $r;
				}else throw new Exception("Something went wrong");
			}catch(Exception $e){
				echo $e->getMessage();
				return false;
			}
		}
	}

?>
