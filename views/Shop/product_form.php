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
			Type : <select name="type" class="prod_type">
				<option value="0">Select</option>
				<?php
					$keys = array_keys($this->p_c);
					foreach ($keys as $key) {
						echo '<option  value="'.$key.'">'.$key.'</option>';
					}
				?>
			</select><br/>
			Sub type : <select name="sub_type">
				<option value="1">Jewels</option>
				<option value="2">Dress &amp; Clothing</option>
				<option value="3">Bags &amp; Watches</option>
				<option value="4">Key chain &amp; Other accessories</option>
				<option value="5">Painting or Drawing</option>
				<option value="6">Statues</option>
			</select>	<br/>
			<?php 

			?>
			Category : <select class="category_select">
			<?php

				if($this->catagery)
				foreach ($this->catagery as $c) {
					$c = $c->category;
					echo "<option value='$c'>$c</option>";
				}
			?>
			<option value="_new">Add category</option>
			</select><br/>	
			<input type="text" name="category" value="<?php echo ($this->catagery)? $this->catagery[0]->category : ''; ?>" class="category_input" style="display:<?php ($this->catagery)? 'none' : 'block'; ?>"><br/>
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

			<label>Option Type 1</label>
			<select name="option_1" class="option_1">
				<option value="0">Select</option>
				<?php
					$keys = array_keys($this->p_option);
					foreach ($keys as $key) {
						echo "<option value='".$key."'>".$key."</option>";
					}
				?>
			</select><br/>

			<label>Option Type 2</label>
			<select name="option_1_value[]" class="option_1_value option_1_reaction" style="display : none">
				<option value="0">Select</option>
			</select><input name="option_2_price[]" class="option_1_reaction" placeholder="Price" style="display : none"/>

			<select name="option_2" class="option_2">
				<option value="0">Select</option>
				<?php
					$keys = array_keys($this->p_option);
					foreach ($keys as $key) {
						echo "<option value='".$key."'>".$key."</option>";
					}
				?>
			</select><br/>

			<select name="option_2_value[]" class="option_2_value option_2_reaction" style="display : none">
				<option value="0">Select</option>
			</select><input name="option_2_price[]" class="option_2_reaction" placeholder="Price" style="display : none"/><br/>

			<input type="file" name="photos[]" multiple="multiple"><br/>
			<input type="submit" value="Add product">
		</form>	
		<script type="text/javascript">


			$(".option_1").change(function(){
				p = <?php echo json_encode($this->p_option);?>;
				option = this.value;
				if(option == "Color"){
					d = p["Color"].split(",");
					$("select[name='option_1_value[]']").html("");
					for(v in d){
						f = (d[v].trim());
						$("select[name='option_1_value[]']").append("<option value="+f+">"+f+"</option>");
					}
					$(".option_1_reaction").show();
				}else if(option == "Make"){
					d = p["Make"].split(",");
					$("select[name='option_1_value']").html("");
					for(v in d){
						f = (d[v].trim());
						$("select[name='option_1_value[]']").append("<option value="+f+">"+f+"</option>");
					}
					$(".option_1_reaction").show();
				}
			});

			$(".option_2").change(function(){
				p = <?php echo json_encode($this->p_option);?>;
				option = this.value;
				if(option == "Color"){
					d = p["Color"].split(",");
					$("select[name='option_2_value[]']").html("");
					for(v in d){
						f = (d[v].trim());
						$("select[name='option_2_value[]']").append("<option value="+f+">"+f+"</option>");
					}
					$(".option_2_reaction").show();
				}else if(option == "Make"){
					d = p["Make"].split(",");
					$("select[name='option_2_value']").html("");
					for(v in d){
						f = (d[v].trim());
						$("select[name='option_2_value[]']").append("<option value="+f+">"+f+"</option>");
					}
					$(".option_1_reaction").show();
				}
			});
			$(".prod_type").change(function(){
				p = <?php echo json_encode($this->p_c);?>;
				val = this.value;
				d = p[val].split(",");
				$("select[name='sub_type']").html("");
				for(v in d){
					f = (d[v].trim());
					$("select[name='sub_type']").append("<option value="+f+">"+f+"</option>");
				}
			});
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