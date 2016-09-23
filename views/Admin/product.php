<html>
	<head>
		<title> Product name </title>
		<?php
			Rog::general_heads();
		?>
		<style type="text/css">
			*{font-family: arial,sans-serif}
			.approval_tools_holder{width: 100%;height: 70px;background-color: #333;position: fixed;bottom: 0px;left: 0px;padding: 5px}
			.approval_tools_holder .approval_items{width: 100px;height: 70px;float: left;text-align: center;color: #FFF}
			.approval_tools_holder .approval_items:hover{cursor: pointer;background-color: #000}
			.approval_tools_holder .approval_items .item_icon{font-size: 22pt;position: relative;top:8px;}
			.approval_tools_holder .approval_items .item_text{font-size: 13pt;margin-top: 10px}
			.approval_tools_holder .approve{float: right;}
			.approval_tools_holder .approve:hover{background-color: #3cba2b}
			.approval_tools_holder .cancel:hover{background-color: #ba2b2b}
			.approval_tools_holder .checklist_holder{width:600px;margin:auto;background-color: red}
			.approval_tools_holder .checklist_holder .checklist{margin: 0px 2.5px}
			.approval_tools_holder .checklist_holder .approved{background-color: #3cba2b}
			.approval_tools_holder .disable{opacity: 0.25}

		</style>
	</head>
	<body class="product_page">
		<?php
			include __DIR__."/../Product/_product_view.php";
		?>
		<div class="approval_tools_holder">
			<div class="approval_items cancel">
				<i class="fa fa-close item_icon"></i><br/>
				<p class="item_text">Cancel</p>
			</div>
			<div class="checklist_holder">
				<div class="approval_items checklist" data-check="">
					<i class="fa fa-question item_icon"></i><br/>
					<p class="item_text">Description</p>
				</div>
				<div class="approval_items checklist" data-check="">
					<i class="fa fa-question item_icon"></i><br/>
					<p class="item_text">Images</p>
				</div>
				<div class="approval_items checklist" data-check="">
					<i class="fa fa-question item_icon"></i><br/>
					<p class="item_text">Delivery</p>
				</div>
				<div class="approval_items checklist" data-check="">
					<i class="fa fa-question item_icon"></i><br/>
					<p class="item_text">Options</p>
				</div>
				<div class="approval_items checklist" data-check="">
					<i class="fa fa-question item_icon"></i><br/>
					<p class="item_text">Price</p>
				</div>
			</div>

			<div class="approval_items approve disable">
				<i class="fa fa-check item_icon"></i><br/>
				<p class="item_text">Approve</p>
			</div>
		</div>
		<script type="text/javascript">
			$(".checklist_holder .checklist").click(function(){
				if($(this).hasClass("approved")){
					$(this).removeClass("approved").children(".item_icon").removeClass("fa-check").addClass("fa-question");
				}else{
					$(this).addClass("approved").children(".item_icon").removeClass("fa-question").addClass("fa-check");
				}
				if($(".checklist_holder .approved").length == 5)
					$(".approval_tools_holder .approve").removeClass("disable");
				else{
					$(".approval_tools_holder .approve").removeClass("disable").addClass("disable");
				}

			});

		</script>
	</body>
</html>