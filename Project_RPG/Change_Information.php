<?php 
	include "Connection.php";
	
	session_start();
	if(!isset($_SESSION['email']))
		header("Location:Project_RPG_User_Login.php");
	
	if(!isset($_POST['edit']))
		header("Location:User_Account_Configure.php");
	
	$conn = Connect_To_DB();
	
	if($_POST['edit'] == "name"){
		$sql = "UPDATE Account SET First_Name = '".$_POST['First_Name']."', Last_Name = '".$_POST['Last_Name']."' WHERE Account_ID = ".$_POST['acc_id'];
		
		if ($conn->query($sql) === TRUE) {
		echo "Record updated successfully! <br>";
		} else {
			echo "Error updating record: <br>" . $conn->error."<br>";
		}
		unset($_POST['First_Name']);
		unset($_POST['Last_Name']);
	}
	
	else if($_POST['edit'] == "password"){
		$sql = "UPDATE Account SET Password = '".$_POST['new']."' WHERE Account_ID = ".$_POST['acc_id'];
		if($_POST['new'] === $_POST['confirm'] && $_POST['current'] === $_SESSION['password']){
			if ($conn->query($sql) === TRUE) 
			{
				echo "Record updated successfully! <br>";
				$_SESSION['password'] = $_POST['new'];
			} 
			else {
				echo "Error updating record: <br>" . $conn->error."<br>";
			}
		}
		else{
			if($_POST['current'] !== $_SESSION['password']){
				echo "Incorrect current password! <br>";
			}
			else{
				echo "New password doesn't match Confirm password! <br>";
			}
		}
		unset($_POST['new']);
		unset($_POST['confirm']);
		unset($_POST['current']);
	}
	
	else if($_POST['edit'] == "email"){
		$sql = "UPDATE Account SET Email = '".$_POST['new']."' WHERE Account_ID = ".$_POST['acc_id'];
		if($_POST['new'] === $_POST['confirm'])
		{
			if ($conn->query($sql) === TRUE) 
			{
				echo "Record updated successfully! <br>";
				$_SESSION['email'] = $_POST['new'];
			} 
			else {
				echo "Error updating record: <br>" . $conn->error."<br>";
			}
		}
		else{
			echo "New email doesn't match Confirm email! <br>";
		}
		unset($_POST['new']);
		unset($_POST['confirm']);
	}
	
	else if($_POST['edit'] == "billing"){
		foreach($_POST['card'] as $card_info){
			$Card_Info_Array = explode(",", $card_info);
			$sql = "DELETE FROM ACCOUNT_BILLING WHERE ".
				   "Card_Number = ".$Card_Info_Array[0].
				   " AND ".
				   "Security_Code = ".$Card_Info_Array[1].
				   " AND ".
				   "Expiration_Month = ".$Card_Info_Array[2].
				   " AND ".
				   "Expiration_Year = ".$Card_Info_Array[3].";";
				   
			if ($conn->query($sql) === TRUE) 
			{
				echo "Record updated successfully! <br>";
			} 
			else {
				echo "Error updating record: <br>" . $conn->error."<br>";
			}
		}
	}
	
	else if($_POST['edit'] == "billing_Add"){
		$sql = "INSERT INTO ACCOUNT_BILLING(Account_ID, Card_Number, Security_Code, Expiration_Month, Expiration_Year)
				VALUES(".$_POST['acc_id'].", "
				.$_POST['Number'].", "
				.$_POST['Code'].", "
				.$_POST['Month'].", "
				.$_POST['Year'].");";
		echo $sql;
		if ($conn->query($sql) === TRUE) 
		{
			echo "Record updated successfully! <br>";
		} 
		else {
			echo "Error updating record: <br>" . $conn->error."<br>";
		}
		
		unset($_POST['Number']);
		unset($_POST['Code']);
		unset($_POST['Year']);
		unset($_POST['Month']);
	}
	
	unset($_POST['edit']);
	header("Location:USer_Account_Configure.php");
?>