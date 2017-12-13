<?php
	function Connect_To_DB(){
		        $servername = "localhost";
				$username = "root";
				$password = "12345";
				$dbname = "project_rpg";

				$conn = new mysqli($servername, $username, $password, $dbname);
				if ($conn->connect_error)
					die("Connection failed: " . $conn->connect_error);
				return $conn;
	}
?>