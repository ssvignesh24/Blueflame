<ul class="list-inline">
	<li class="left">
		<h2><?php echo str_replace("_", " ", ucfirst($this->table_name)); ?></h2>
	</li>
	<a href="<?php echo $this->table_name; ?>/truncate">
		<li>
			<button class="btn btn-primary">Truncate</button>
		</li>
	</a>
	<a href="<?php echo $this->table_name; ?>/new">
		<li>
			<button class="btn btn-primary">New</button>
		</li>
	</a>
	
</ul>
<div class="table-outer table-responsive ">

	<table class="table table-striped table-bordered">
		<thead>
			<th>Sn.no</th>
			<?php
				$fields = array_keys(Database::$schema[$this->table_name]);
				$c = array();
				foreach ($fields as $field) {
					echo "<th>".ucfirst($field)."</th>";
					array_push($c, $field);
				}
			?>
			<th></th>
		</thead>
		<?php
			if($this->content)
				foreach ($this->content as $row) {
					echo "<tr data-id=".$row->id.">";
					echo "<td>".$row->id."</td>";
					foreach ($c as $f)
						echo "<td>".$row->$f."</td>";
					echo "<td><a href='$this->table_name/edit?rid=".$row->id."'><button class='btn btn-primary'>Edit</button></a>&emsp;<a href='$this->table_name/delete?rid=".$row->id."'><button class='btn btn-danger'>Delete</button></a></td>";
					echo "</tr>";
				}
		?>
	</table>
</div>