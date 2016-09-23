<?php
	$menu = ["Dash","Approvals","Shipping","Customers","Shops","Products","Sales","Payments","Requests","Coupons","Rog"];
?>
<html>
	<head>
		<title>Products | Admin</title>
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="/assets/style/table-sort.css">
		<script   src="https://code.jquery.com/jquery-1.12.3.min.js" integrity="sha256-aaODHAgvwQW1bFOGXMeX+pC4PZIPsvn2h1sArYOhgXQ=" crossorigin="anonymous"></script>
		<script   src="/assets/script/table-sort.js" ></script>
		<style type="text/css">
		a,a:hover{text-decoration: none;}
		*{box-sizing : border-box;font-family:helvetica;}
		.side-menu{width: 400px;height: 100%;position: fixed;left:0px;top:0px;background-color: #333;z-index: 20;}
		.viewport{width: 100%;height: 100%;overflow: hidden;padding-left: 400px;z-index: 10;}
		.side-menu .admin-head{width: 100%;height: 50px;background-image: url(/assets/images/rog_admin2.png);background-repeat: no-repeat;background-size: 60%;background-position: 20px 10px}
		.side-menu .admin-actions-list{width: 100%;padding: 0px;list-style: none;margin: 20px 0px 0px;}
		.side-menu .admin-actions-list .admin-action{width: 100%;height: 60px;color: #BBB;font-size: 16pt;}
		.side-menu .admin-actions-list .active{background-color: #282828;box-shadow: 0px 0px 25px rgba(0,0,0,0.1) inset;border-top:1px solid #383838;border-bottom: 1px solid #383838;color: #FFF}
		.side-menu .admin-actions-list .admin-action:hover{background-color: #222;cursor: pointer;}
		.side-menu .admin-actions-list .admin-action span{position: relative;top: 18px;left: 20px;}
		.viewport .action-bar{width: 98%;height: 45px;margin: 10px auto;border-bottom: 3px solid #999;}
		.viewport .action-bar ul{padding: 0;margin: 0;list-style: none;}
		.viewport .action-bar ul li{float: left;width: 175px;height: 100%;text-align: center;position: relative;}
		.viewport .action-bar ul li:hover{cursor: pointer;background-color: rgba(0,0,0,0.06)}
		.viewport .action-bar ul li.active:after{position: absolute;content: '';border-right:3px solid #999;border-bottom: 3px solid #999;left : 86px;bottom : -6px;width: 3px;height: 3px;transform:rotate(45deg);}
		.viewport .action-bar ul li.new{float: right;background-color: #27a757;color: #FFF;width: 120px;}
		.viewport .action-bar ul li.new:hover{background-color: #1bcd5e;cursor: pointer;}
		.viewport .action-bar ul li span{position: relative;top:13px;font-size: 12pt;}
		.viewport .content{width: 100%;min-height: 200px;padding: 5px 10px;position: relative;}
		.viewport .content .segment{padding: 5px;min-height: 60px}
		.viewport .content .product-segment{margin-top: 20px;}
		.viewport .content .admin-input{width: 300px;height: 45px;margin-right: 30px;float: left;position: relative;}
		.viewport .content .admin-input:after{position: absolute;content: 'or';width: 20px;height: 20px;right: -27px;top:10px;}
		.viewport .content .admin-input:last-child:after{content: '';}
		.viewport .content .admin-input .input{width: 250px;height: 100%;background-color: #EEE;float: left;border:0px;padding: 5px 5px 5px 10px;font-size: 13pt;}
		.viewport .content .admin-input .go{width: 49px;height: 45px;color: #FFF;background-color:#287fb1;float: left;border:0;border-left:1px solid #FFF;font-size: 14pt;}
		.viewport .content .admin-input .go:hover{cursor: pointer;background-color: #1b8ccd}
		.viewport .content .admin-input .go:focus,.viewport .content .admin-input .input:focus{outline: none;}
		.viewport .content .pageview{margin-top: 30px;height:100%;width:100%;overflow: scroll;}
		.viewport .content .pageview .outtable td img.thumb{width: 120px;height: 120px;}
		.viewport .content .creation{width: 100%;height: 100%;position: absolute;top:0px;right: 0px;background: #FFF;display: none;}
		.viewport .content .creation .creation_form_holder{width: 600px;margin: auto;}
		</style>
	</head>
	<body>
		<div class="side-menu">
			<div class="admin-head"></div>
			<ul class="admin-actions-list">
				<?php
					foreach($menu as $m){
						if($m == $this->page)
							echo '<li class="admin-action active"><span>'.$m.'</span></li>';
						else
							echo '<a href="/admin/'.strtolower($m).'"><li class="admin-action"><span>'.$m.'</span></li></a>';
					}

				?>
			</ul>
		</div>
		<div class="viewport">
			<div class="action-bar">
				<ul>
					<?php
						foreach($this->options as $option){
							echo '<li><span>'.$option.'</span></li>';
						}

						if($this->allow_new)
							echo '<li class="new"><span> New </span></li>';
					?>
				</ul>
			</div>
			<div class="content">
				<div class="segment product-segment">

					<?php
						foreach($this->input as $input){
					?>
					<div class="admin-input">
						<input type="text" placeholder="<?php echo $input['placeholder']; ?>" class="input">
						<button class="go" data-path="<?php echo $input['path']; ?>"><i class="fa fa-search"></i></button>
					</div> 
					<?php
						}
					?>
					
				</div>
				<div class="pageview">
					<table class="table sortable table-bordered table-striped table-hover outtable">
					    
					 </table>
				</div>
				<div class="creation">
					<div class="creation_form_holder">
						<?php

							if($this->allow_new != false){
								echo "<form class='creation_form' method='POST' action='/admin/create_".strtolower($this->page)."'>";
								foreach ($this->allow_new as $field => $value) {
									echo "<div class='form-group'>";
									echo " <label>".$value['label']."</label>";
									if($value['type'] == "text" || $value['type'] == "number" || $value['type'] == "date"){
										echo "<input name='".$field."' type='".$value['type']."' class='form-control' placeholder='".$value['label']."'>";
									}
									echo "</div>";
								}
								echo "<input type='submit' class='btn btn-primary' value='Create'>";
								echo "</form>";
							}

							?>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">

			var ini_data = <?php if($this->init) echo $this->init; else echo "false"; ?>;
			var req_fields = <?php echo json_encode($this->req_fields); ?>;
			$(document).ready(function(){
				if(ini_data){
					populate_table(ini_data);
				}
			});

			function populate_table(response){
				$keys = Array();
				$keys.push("Sn.");
				table = "<tbody>";
				if(response.length != undefined){
					for(i_ in response){
						item = response[i_];
						table += "<tr>";
						table += "<td>"+ (parseInt(i_) + 1) +"</td>";

						for(f_ in item){
							if( req_fields[f_] == undefined)
								continue;
							if(i_ == 0){
								$keys.push(req_fields[f_]);
							}
							table += "<td>"+item[f_]+"</td>";
						}
						table += "</tr>";
					}
					table += "</tbody>";
					
				}else{
					table += "<tr>";
					table += "<td>1</td>";
					for(f_ in response){
						if(req_fields[f_] == undefined)
							continue;
						$keys.push(req_fields[f_]);
						table += "<td>"+response[f_]+"</td>";
					}
				}
				head = "<thead><th>"+$keys.join("</th><th>")+"</th></thead><tbody>";
				table = head+table;
				$(".outtable").html(" ").append(table);
				$.bootstrapSortable(1);
			}
			$(".creation_form").submit(function(){
				$flag = true;
				data = $( this ).serializeArray();
				for(f in data){
					if(data[f]['value'] == ""){
						$flag = false;
						$(".creation_form input[name="+data[f]['name']+"]").parent().addClass("has-error");
					}else
						$(".creation_form input[name="+data[f]['name']+"]").parent().removeClass("has-error");
				}
				return $flag;
			});
			$(".action-bar .new").click(function(){
				$(".content .creation").toggle();
				if ($('.content .creation').css('display') == 'block') {
					$(".action-bar .new span").html("Close");
				}else $(".action-bar .new span").html("New");
			});	
			$(".admin-input .input").keydown(function(e){
				if(e.which == 13)
					$(this.parentNode).children(".go").click();
			});
			$(".go").click(function(e){
				path = $(this).attr("data-path");
				value = $(this.parentNode).children(".input").val();
				
				$.post(path,{ q : value }, function(response){
					if(response == 0){
						$(".outtable").html(" ").append("<tr><td>No result</td></tr>");
						return;
					}
					response = $.parseJSON(response);
					populate_table(response);
				});
			});
		</script>
	</body>
</html>