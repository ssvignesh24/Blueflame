<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/assets/style/bs.css">
		<style type="text/css">
			body{margin: 0px;font-family: arial,sans-serif;}
			*{box-sizing : box-border;}
			a{text-decoration: none;color: inherit;}
			a:hover{color: inherit;}
			.left-panel{width: 25%;height: 100%;float: left;min-width: 300px;background-color: #333;color: #FFF}
			.left-panel ul,li{padding: 0px;list-style: none;margin: 0px}
			.left-panel li{width: 100%;height: 60px;}
			.left-panel li:hover{cursor: pointer;background-color: #222}
			.left-panel li span{position: relative;top:17px;font-size: 14pt;left:10px;}
			.right-panel{width: 75%;height: 100%;float: left;min-width: 700px;padding: 10px;height: 100%;overflow:auto;}
			.right-panel .form-outer{width: 70%;margin: auto auto;}
			.list-inline{margin-bottom: 20px;height: 45px}
			.list-inline li{float: right;margin-right: 20px}
			.list-inline li h2{margin: 0}
			.list-inline li.left{float: left;}
			.table tr td:last-child a{float: left;}
		</style>
	</head>
	<body>
		<div class="left-panel">
			<ul>
				<?php
					foreach (Database::$schema as $table => $structure) {
						echo "<a href='/admin/$table'><li><span>".str_replace("_"," ",ucfirst($table))."</span></li></a>";
					}

				?>
			</ul>
		</div>
		<div class="right-panel">
			<?php
				include 'views/Admin/'.$this->partial.".php";
			?>
		</div>
	</body>
</html> 