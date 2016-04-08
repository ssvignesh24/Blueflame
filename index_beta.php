<html>
	<head>
		<title>Shop signup</title>
		<link rel="stylesheet" type="text/css" href="/assets/style/beta.css">
	</head>
	<body>
		<form method="POST" action="/signup" enctype="multipart/form-data">
			<input placeholder="name" name="name" type="text"><br/>
			<input placeholder="enail" name="email" type="text"><br/>
			<input placeholder="mobile" name="mobile" type="number"><br/>
			<input placeholder="password" name="password" type="password"><br/>
			<input placeholder="image" name="picture" type="file"><br/>

			<input placeholder="Shop name" name="s_name" type="text"><br/>
			
			<input placeholder="Started" name="s_started" type="date"><br/>
			<input placeholder="City" name="s_city" type="text"><br/>
			<input placeholder="State" name="s_state" type="text"><br/>
			<input placeholder="banner" name="s_banner" type="file"><br/>
<br/>
			<input placeholder="Bank name" name="b_name" type="text"><br/>
			<input placeholder="Account number" name="b_acc" type="text"><br/>
			<input placeholder="Branch" name="b_branch" type="text"><br/>

			<input type="submit" value="Signup">
		</form>
<br/>
		<form action="/register" method="POST" enctype="multipart/form-data">
			<input name="name" placeholder="Name" type="text"><br/>
			<input name="email" placeholder="Email" type="text"><br/>
			<input name="mobile" placeholder="mobile" type="text"><br/>
			<input name="picture" placeholder="picture" type="file"><br/>
			<input name="password" placeholder="Password" type="password"><br/>
			<input type="submit" value="Signup">
		</form>

		<form action="/login" method="POST" >
			<input name="username" placeholder="email or mobile" type="text"><br/>
			<input name="password" placeholder="Password" type="password"><br/>
			<input type="submit" value="Login">
		</form>
	</body>
</html>