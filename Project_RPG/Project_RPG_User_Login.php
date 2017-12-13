<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Database Project</title>
		<link rel="stylesheet" href="user_account_style.css">
	</head>
	<body>
		<header>
				Project_RPG
		</header>
			<div class="page-wrap">
				<form action= "Check_Login_Info.php" method = "post">
				  <fieldset id = "fieldset_Login">
					<legend>Login:</legend>
					Email:<br>
					<input type="text" name="email">
					<br>
					Password:<br>
					<input type="text" name="password">
					<br><br>
					<input type="submit" value="Submit">
					<?php
						if(isset($_GET['TRIED'])){
							echo "Email or Password Incorrect!";
						}	
					?>
				  </fieldset>
				</form>
			</div>
		<footer class="site-footer">
			Project_RPG
		</footer>
	</body>
</html>