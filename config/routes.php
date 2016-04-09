<?php
	Route::post("subscribe","Rog=>subscribe",Validation::test(array(
			"email" => "email"
		)));


	// Shop

	Route::post("signup", "Rog=>shop_register",Validation::test(array(
			"name" => "required",
			"email" => "email",
			"mobile" => "minlength:10",
			"password" => "minlength:8",
			"s_name" => "required",
			"s_started" => "date",
			"s_city" => "required",
			"s_state" => "required",
			"b_name" => "required",
			"b_acc" => "minlength:10",
			"b_branch" => "required"
		)));
	Route::post("product","Shop=>create_product",Validation::test(array(
			"title" => "required",
			"type" => "in:1,2",
			"sub_type" => "in:1,2,3,4,5,6",
			"category" => "required",
			"gender" => "in:male,female,both",
			"custom_packing" => "boolean",
			"overview" => "required",
			"description" => "required",
			"tags" => "required",
			"days" => "int",
			"price" => "int"

		)));
	Route::get("product","Shop=>new_product:filter");


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