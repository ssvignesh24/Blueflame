<?php

	Route::post("subscribe","Rog=>subscribe",Validation::test(array(
			"email" => "email"
		)));


	// Shop
	Route::post("signup", "Rog=>shop_register",Validation::test(array(
			"name" => "required",
			"title" => "required",
			"shop_type" => "in:1,2",
			"s_started" => "date",
			"s_city" => "required",
			"s_state" => "required",
			"b_name" => "required",
			"b_acc" => "minlength:10",
			"b_branch" => "required"
		)));
	Route::post("product","Shop=>create_product:filter",Validation::test(array(
			"type" => "in:Jewels,Painting & Art,Printing,Digital content,Bags & Purses,Shoes,Gifts",
			"sub_type" => "required",
			"category" => "required",
			"gender" => "in:male,female,both",
			"custom_packing" => "boolean",
			"overview" => "required",
			"description" => "required",
			"tags" => "required",
			"days" => "int",
			"price" => "int",
			"title" => "required"
		)));
	Route::get("product","Shop=>new_product:filter");
	Route::get("search","Product=>search", Validation::test(array(
			"key" => "required"
		)));

	Route::get("select/:shop","Shop=>change_shop:filter");
	Route::get("shops","Shop=>list_shops:filter");
	Route::get("shop_script","Shop=>script:filter");
	Route::get(":shop","Shop=>home");
	Route::get(":shop/followers","Shop=>list_followers");

	// Cart
	Route::post("additem","Cart=>add_item:filter",Validation::test(array(
			"product_id" => "required"
		)));
	Route::post("removeitem","Cart=>remove_item:filter",Validation::test(array(
			"product_id" => "required"
		)));
	Route::get("cart","Cart=>show_cart");
	Route::post("cart","Cart=>cart_products");

	// Customer
	Route::post("register","Rog=>customer_register",Validation::test(array(
			"name" => "required",
			"email" => "email",
			"mobile" => "minlength:10",
			"password" => "minlength:8"
 		)));

	// Login
	Route::post("login","Rog=>login",Validation::test(array(
			"username" => "required",
			"password" => "minlength:8"
		)));
	
?>