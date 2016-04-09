<html>
	<head>
		<title> New Product </title>
		<script type="text/javascript" src="/assets/script/jq.js"></script>

		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" type="image/png" href="assets/icons/favicon.png">
	</head>
	<body>
		<h2>New Product</h2>
		<form action="/product" method="POST" enctype="multipart/form-data">
			<input type='text' placeholder="Title" name="title"/><br/>
			Type : <select name="type">
				<option value="1">Handmade</option>
				<option value="2">Vintage</option>
			</select><br/>
			Sub type : <select name="sub_type">
				<option value="1">Jewels</option>
				<option value="2">Dress &amp; Clothing</option>
				<option value="3">Bags &amp; Watches</option>
				<option value="4">Key chain &amp; Other accessories</option>
				<option value="5">Painting or Drawing</option>
				<option value="6">Statues</option>
			</select>	<br/>
			Category : <select class="category_select">
			<?php
				foreach ($this->catagery as $c) {
					$c = $c->category;
					echo "<option value='$c'>$c</option>";
				}
			?>
			<option value="_new">Add category</option>
			</select><br/>	
			<input type="test" name="category" value="<?php echo $this->catagery[0]->category; ?>" class="category_input" style="display:none">
			Target gender:
			<br/>	<input type="radio" name="gender" value="male">Male
			<input type="radio" name="gender" value="female">Female
			<input type="radio" name="gender" value="both">Both<br/>
			Custom packing? : <input type="checkbox" name="custom_packing"><br/>
			Delivery days : <input type="number" placeholder="Making + to reach us" name="days" ><br/>
			<input type='number' placeholder="Price" name="price"/><br/>
			Overview (Points): <textarea name="overview"></textarea><br/>
			Description : <textarea name="description"></textarea><br/>
			<input type='text' placeholder="Tags" name="tags"/><br/>
			<input type="file" name="photos[]" multiple="multiple"><br/>
			<input type="submit" value="Add product">
		</form>	
		<script type="text/javascript">
			$(".category_select").change(function(){
				value = $(this).val();
				if(value == "_new"){
					$(".category_input").val("").show();
				}else{
					$(".category_input").val(value).hide();
				}
			});
			$("textarea[name='overview'").keyup(function(e){
				if(e.which == 13){
					$(this).val($(this).val() + "*");
				}
					
			});
		</script>
	</body>
</html>