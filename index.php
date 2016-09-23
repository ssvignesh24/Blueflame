<?php
	include 'lib/front.php';

	if(grant()){
		include 'lib/home.php';
	}else{
?>

<html>
	<head>
		<title> Rog </title>
		<script type="text/javascript" src="/assets/script/jq.js"></script>
		<link rel="stylesheet" type="text/css" href="/assets/style/splash.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" type="image/png" href="assets/icons/favicon.png">
		<script src="https://api.trello.com/1/client.js?key=d08d7a047db1608a232d6eb783924287"></script>
	</head>
	<body>
		<div class="splash_content">
	      <div class="logo"></div>
	      <p class="info">One day we will have a website,<br/>
and that day is coming soon. <span class="redit">Stay in touch.</span></p>
	      <div class="subscribe_outer">
	          <div class="thank display"> <span>Thanks you!</span></div>
	          <div class="queue display"> <span>Your are already in the list, thank you for your interest</span></div>
	          <div class="error display"> <span>Sorry something went wrong, try again after sometime.</span></div>
	          <input type="text" placeholder="Your email" id="email">
	          <button id="subscribe" data-send="false"><img src="/assets/icons/send2.png"></button>
	      </div>
	    </div>
	    <script type="text/javascript" src="/assets/script/splash.js"></script>
	    <script type="text/javascript" src="/assets/script/ga.js"></script>
	    <script type="text/javascript">
	    	var authenticationSuccess = function() { console.log("Successful authentication"); }
			var authenticationFailure = function() { console.log("Failed authentication"); }
			Trello.authorize({
			  type: "popup",
			  name: "Getting Started Application",
			  scope: {
			    read: true,
			    write: true },
			  expiration: "never",
			  success: authenticationSuccess,
			  error: authenticationFailure
			});
	    </script>
	</body>
</html>
<?php
	}
?>