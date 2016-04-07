<div class="form-outer">	
	<form method="POST" action="/admin/<?php echo $this->table_name; ?>/update">
		<input type="hidden" name="_rid" value="<?php echo $this->content->id; ?>">
		<?php
			$fields = (Database::$schema[$this->table_name]);
			foreach ($fields as $field => $type) {
				if(!is_array($type)){

					$type = explode(",", $type);
					echo "<div class='form-group'>";
					echo "<label>".ucfirst($field)."</label>";
					
					switch ($type[0]) {
						case 'int':
							echo "<input type='number' name='$field' class='form-control' value='".$this->content->$field."'/>";
							break;

						case 'varchar':
							echo "<input type='text' name='$field' class='form-control' max-length=$type[1] value='".$this->content->$field."'/>";
							break;

						case 'date':
							echo "<input type='date' name='$field' class='form-control' value='".$this->content->$field."'/>";
							break;

						case 'datetime':
							echo "<input type='datetime-local' name='$field' class='form-control' value='".$this->content->$field."'/>";
							break;
					
						case 'file':
							echo "<input type='file' name='$field' class='form-control' />";
							break;
						case "boolen":
							echo "<input type='checkbox' name='$field' class='form-control' "; 
							echo ($this->content->$field)? "checked" : "";
							echo "/>";
							break;
						
					}
					echo "</div>";
				}else{
					if($type[0] == "set"){
						echo "<div class='form-group'><label>".ucfirst($field)."</label>";
						echo "<select name='$field' class='form-control'>";
						if(is_array($type[1]))
							foreach ($type[1] as $value => $option) 
								echo "<option value='$value'>$option</option>";
						else{
							$options = explode(",", $type[1]);
							foreach ($options as $option) 
								echo "<option value='$option'>$option</option>";
						}

						echo "</select></div>";
					}elseif($type[0] == "auto" && is_callable($type[1])){

					}
					
				}
			}

		?>
		<input type="submit" class="btn btn-primary" value="Update"/>
	</form>
</div>  