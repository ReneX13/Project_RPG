<!DOCTYPE html>
<?php
	include "Display_Functions.php";
	session_start();
	if(!isset($_SESSION['email']))
		header("Location:Project_RPG_User_Login.php");
	
	$Display = Display_Edit_Account($_POST['edit'], $_POST['acc_id']);
?>
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
			<fieldset id = "fieldset_Login">
				<legend><?php echo $Display[0];	?></legend>
				<form action= "Change_Information.php" method = "post">
					<?php echo $Display[1]; ?>
				</form>
					<?php 
						if(isset($Display[2]))
							echo $Display[2];	
					?>
				<form action = "User_Account_Configure.php">
						<input id = "button_spacer2" type="submit" value="Go Back"></input>
				</form>
			</fieldset>
		</div>
		<footer class="site-footer">
			Project_RPG
		</footer>
	</body>
</html>