<?php
	session_start();
	if(!isset($_SESSION['email']))
		header("Location:Project_RPG_User_Login.php");
	
	unset($_SESSION['email']);
	unset($_SESSION['password']);
	session_destroy();
	header("Location:Project_RPG_User_Login.php");
?>