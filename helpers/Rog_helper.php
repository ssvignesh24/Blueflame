<?php
	
	class Rog{
		const PRODUCT_CATGORY = array(
			"Jewels" => "Rings, Necklace, ear rings, ear studs, nose studs, bangles, anklets, Bracelets, brooches, Jewellery sets, Arm bands, Belly chains, Belly rings, Hair jewellery, Lip rings, Toe rings",
			"Painting & Art" => "Pencil sketch, Painting, Digital art, Glass art, Pen art, Sculpture, Ceramics arts, Glass art",
			"Printing" => "General printing, Greeting cards, Visiting cards",
			"Digital content" => "Photographs, Digital arts (soft), Clip arts",
			"Bags & Purses" => "Backpacks, handbags, travel bags, Men purse, women purse, market bags, Bottles, Sports bag, Food & Insulated bags",
			"Shoes" => "Boy’s Shoes, Girl’s , Insoles, Men’s shoe, women’s shoe",
			"Dress" => "Men, Women, Boys, Girls, Baby, House decoration",
			"Gifts" => "Albums, Photo frames",
			);

		const PRODUCT_OPTION = array(
				"Color" => "Red,Green,Blue,Black,White,Grey,Maroon,Purple,Sky blue,Brown,Pink,Maroon,Orange,Yellow",
				"Make" => "Gold,Silver,Copper,Iron,Steel,Glass,Wood,Plastic,Ceramic,Clay,Cloth",
				"Size" =>"",
				"Weight" =>"",
				"Height" =>"",
				"Width" =>"",
				"Length" =>"",
				"Diameter" =>""
			);

		public static function generate_user_id($data, $who){

			if($who == "customer")
				$id = "1";
			elseif($who == "shop")
				$id = "2";
			elseif($who == "payment")
				$id = "3";
			elseif($who == "product")
				$id = "4";
			elseif($who == "order")
				$id = "5";
			elseif($who == "message")
				$id = "6";
			elseif($who == "address")
				$id = "7";
			elseif($who == "account")
				$id = "8";
			elseif($who == "cart")
				$id = "8";
			elseif($who == "review")
				$id = "9";
			elseif($who == "option")
				$id = "0".$data."_";

			$sum = 0;
			
			for($i = 0; $i < strlen($data); $i++){
				$sum += ord($data[$i]);
			}
			$id .= mt_rand(1000,9999);
			$id .= substr(time(), strlen(time()) - 6);
			$id .= $sum.mt_rand(10000,99999);
			return $id;
		}

		public static function heads(){
			echo '<meta name="viewport" content="width=device-width, initial-scale=1">'.PHP_EOL;
			echo '<link rel="icon" type="image/png" href="assets/icons/favicon.png">'.PHP_EOL;
			echo '<script type="text/javascript" src="/bower_components/jquery/dist/jquery.min.js"></script>'.PHP_EOL;
			echo '<script type="text/javascript" src="/assets/script/K.js">'.PHP_EOL;
			echo '</script><link rel="stylesheet" type="text/css" href="/assets/style/fa.css">'.PHP_EOL;
			echo '<link type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">'.PHP_EOL;
			echo '<link rel="stylesheet" type="text/css" href="/assets/style/rog.css">'.PHP_EOL;
			echo '<link rel="stylesheet" type="text/css" href="/assets/style/shop.css">'.PHP_EOL;
		}

		public static function breadcrumbs(){
			include 'breadcrumbs.php';
		}

		public static function sliders(){
			echo "";
		}
	}

?>