<?php
	include "Connection.php";
	if(!isset($_POST['email']))
		header("Location:Project_RPG_User_Login.php");
	
	$conn = Connect_To_DB();
	$sql = "Select * From ACCOUNT Where Email = '".$_POST['email']."';";
		
	$result = $conn->query($sql);

	if ($result->num_rows <= 0) {header("Location:Project_RPG_User_Login.php?TRIED=1");}
	else{
		
		foreach ($result as $value) {
			if($value['Password'] != $_POST['password'])
				header("Location:Project_RPG_User_Login.php?TRIED=2");
			
			else{
				if(isset($_SESSION['email']))
					Destroy_Session();
				
				session_start();
				$_SESSION['email']=$_POST['email'];
				$_SESSION['password']=$_POST['password'];
				unset($_POST['email']);
				unset($_POST['password']);
				header("Location:User_Account_Configure.php");
			}
		}
	}
?>