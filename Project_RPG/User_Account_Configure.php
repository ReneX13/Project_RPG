<!DOCTYPE html>
<?php 
	include "Display_Functions.php";
	session_start();
	if(!isset($_SESSION['email']))
		header("Location:Project_RPG_User_Login.php");
	
	$Account_Information = Collect_Account_Information($_SESSION['email']);
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
				<nav id ="nav1">
					<fieldset id = "fieldset_Account_Info"><legend>Account Information: </legend>
						<?php echo $Account_Information[0]; ?>
					<form action = "Edit_Account.php" method = "post">
						<input type = "hidden" name = "acc_id" value = "<?php echo $Account_Information[1]; ?>"></input>
						<input type = "hidden" name = "edit" value = "name"></input>
						<input id = "button_spacer" type = "submit" value = "Edit Name"></input>
					</form>
					<form action = "Edit_Account.php" method = "post">
						<input type = "hidden" name = "acc_id" value = "<?php echo $Account_Information[1]; ?>"></input>
						<input type = "hidden" name = "edit" value = "password"></input>
						<input id = "button_spacer" type = "submit" value = "Edit Password"></input>
					</form>
					<form action = "Edit_Account.php" method = "post">
						<input type = "hidden" name = "acc_id" value = "<?php echo $Account_Information[1]; ?>"></input>
						<input type = "hidden" name = "edit" value = "email"></input>
						<input id = "button_spacer" type = "submit" value = "Edit Email"></input>
					</form>
					<form action = "Edit_Account.php" method = "post">
						<input type = "hidden" name = "acc_id" value = "<?php echo $Account_Information[1]; ?>"></input>
						<input type = "hidden" name = "edit" value = "billing"></input>
						<input id = "button_spacer" type = "submit" value = "Edit Billing Information"></input>
					</form>
					<form action = "Logout.php">
						<input id = "button_spacer" type = "submit" value = "Logout"></input>
					</form>
					</fieldset>
					<fieldset id = "fieldset_Character_List"><legend>Characters: </legend>
						<?php echo $Account_Information[2]; ?>
					</fieldset>
				</nav>
			</div>
		<footer class="site-footer">
			Project_RPG
		</footer>
	</body>
</html>