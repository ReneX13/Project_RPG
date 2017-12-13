<!DOCTYPE html>
<?php
	include "Display_Functions.php";
	
	session_start();
	if(!isset($_SESSION['email']))
		header("Location:Project_RPG_User_Login.php");

	$Character_Information = Collect_Character_Information($_POST['char_name']);
	$Character_Equipment_Information = Collect_Equipment_Information($_POST['char_name']);
	$Character_Abilities_Information = Abilities_Display($_POST['char_name']);	
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
				<form action = "User_Account_Configure.php">
					<input id = "button_spacer3" type="submit" value="Go Back"></input>
				</form>
				<fieldset><legend>Character Information: </legend>
					<?php echo $Character_Information[0]
							  ."<br> STATS: "
							  .Calculating_Complete_Stats($Character_Information[1], 
														  $Character_Information[2], 
														  $Character_Equipment_Information[1], 
														  $Character_Equipment_Information[2],
														  $Character_Information[3]);
					?>
				</fieldset>
				<fieldset><legend>Equipment: </legend>
					<?php echo $Character_Equipment_Information[0];?>
				</fieldset>
				<fieldset><legend>Abilities: </legend>
					<?php echo $Character_Abilities_Information;?>
				</fieldset>
			</div>
		<footer class="site-footer">
			Project_RPG
		</footer>
	</body>
</html>


