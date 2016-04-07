<?php
	Route::post("subscribe","Rog=>subscribe",Validation::test(array(
			"email" => "email"
		)));
?>