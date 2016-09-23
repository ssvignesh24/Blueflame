<?php
	include_once 'core/predis-1.0/autoload.php';

	
	class Redis{

		private $client;

		public function __construct(){
			$this->client = new Predis\Client();
		}
		
		public function set($name, $value){
			$this->client->set($name, $value);
		}

		public function get($name){
			$this->client->get($name);
		}

		public static function has($name){
			$client = new Predis\Client();
			return $client->exists($name);
		}

		public static function current_user(){
			$client = new Predis\Client();
			if(!isset($_COOKIE['rog_vik']))
				return false;
			$key = $_COOKIE['rog_vik'];
			$value = $client->get($key);
			if($value)
				return json_decode($value);
			else return false;
		}

		public static function is_logged_in(){
			if(Redis::current_uid() != false)
				return true;
			else return false;
		}

		public static function user($details){
			$key = uniqid(substr(hash('sha512',microtime()),40),false);
			$client = new Predis\Client();
			$client->set($key,json_encode($details,JSON_FORCE_OBJECT));
			return $key;
		}

		public static function current_uid(){
			$client = new Predis\Client();
			if(!isset($_COOKIE['rog_vik'])) return false;

			$key = $_COOKIE['rog_vik'];
			$value = $client->get($key);
			if($value){
				$user = json_decode($value);
				return $user->id;
			}else return false;
		}

		public static function is_owner(){
			$client = new Predis\Client();
			$key = $_COOKIE['rog_vik'];
			$value = $client->get($key);
			if($value){
				$user = json_decode($value);
				return ($user->user_type == 2);
			}else return false;
		}

		public static function current_shop(){
			$client = new Predis\Client();
			$key = $_COOKIE['rog_vik'];
			$value = $client->get($key);
			if($value){
				$user = json_decode($value);
				if($user->user_type == 2)
					return $user->shop_id;
				else return false;
			}else return false;
		}

		public static function get_bag_id(){
			if(Cookie::has("rog_c")){
				return Cookie::get("rog_c");
			}else{
				$key = uniqid(substr(hash('sha512',microtime()),40),false);
				Cookie::set("rog_c",$key);
				return $key;
			}
		}

		public static function add_to_bag($data){
			$bag_id = Redis::get_bag_id();
			$client = new Predis\Client();
			return $client->hset($bag_id,$data['product_id'],json_encode($data,JSON_FORCE_OBJECT));
		}

		public static function remove_from_bag($product_id){
			if(Cookie::has("rog_c"))
				$bag_id = Cookie::get("rog_c");
			else return false;
			$client = new Predis\Client();
			return $client->hdel($bag_id,$product_id);
		}

		public static function show_bag(){
			if(Cookie::has("rog_c"))
				$bag_id = Cookie::get("rog_c");
			else return false;
			$client = new Predis\Client();
			$bag = $client->hgetall($bag_id);
			return $bag;
		}

		public static function update_quantity($product_id,$quantity){
			if(Cookie::has("rog_c"))
				$bag_id = Cookie::get("rog_c");
			else return false;
			$client = new Predis\Client();
			$product = json_decode($client->hget($bag_id,$product_id));
			$product->quantity = $quantity;
			return $client->hset($bag_id,$product_id,$product);
		}

		public static function bag_products(){
			$bag_id = Cookie::get("rog_c");
			$client = new Predis\Client();
			$products = $client->hkeys($bag_id);
			return $products;
		}

		public static function setcoupon($discount_percent){
			if(Cookie::has("rog_c"))
				$bag_id = Cookie::get("rog_c");
			else return false;
			$client = new Predis\Client();
			$client->set($bag_id."_coupon",$discount_percent);
		}
	}
	
?>