<html>
	<head>
		<title><?php echo $this->user."'s shops"; ?></title>
		<?php  Rog::heads(); ?>
	</head>
	<head>
		<ul>
			<?php
				$this->shops->each(function($shop){
					echo "<li><a href='select/".$shop->name."'>".$shop->name."</li>";
				});
			?>
		</ul>
	</head>
</html>