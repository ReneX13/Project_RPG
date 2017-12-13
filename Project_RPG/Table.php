 <!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Database Demo</title>
		<style>
			thead {color:rgb(0, 0, 0);
			background-color: rgba(225, 225, 225, 0.3);}
			tbody {color:rgba(225, 225, 225);}
			tfoot {color:red;}
			table, th, td {
				border: 1px solid black;
			}
			tr:nth-child(even) {
				background-color: rgba(100, 100, 100, 0.3);
			}
			header, footer{
				padding: 1em;
				color: white;
				
				clear: left;
				text-align: center;
			}
			#legend1 {
				color:rgb(225, 225, 225);
				font-style: normal;
				font-weight: bold;
				font-size: 20px;
			}
			#div1 {
				padding: 1% 0px;
				
			}
			#div2 {
				color:rgb(225, 225, 225);
				float: left;
				padding: 1% 0px;
			}
			#div3 {
				color:rgb(225, 225, 225);
				float: left;
				padding: 1% 2%;
			}
			#insert_button {
				margin: 5% 0%;
			}
			#fieldset1 {
				background: rgba(200, 150, 100, 0.5);
			}
			#fieldset2 {
				float:left;
				background: rgba(200, 150, 100, 0.3);
			}
			body {
				color:rgb(225, 225, 225);
				background-color: black;
				background-image: url("BG_3.jpg");

				background-size: 100%;
				background-repeat: no-repeat;
				background-attachment: fixed;
			}
		</style>
	</head>
	<body>
		<header>
				<h1>DATABASE PROJECT</h1>
		</header>
		<?php

		$servername = "localhost";
		$username = "root";
		$password = "12345";
		$dbname = "project_rpg";

		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error)
		    die("Connection failed: " . $conn->connect_error);

		$sql = "Describe ".$_GET['table'].";";
		$result = $conn->query($sql);
		
		
//THIS CODE #1
		$temp_array = $result->fetch_array(MYSQLI_ASSOC);
		$table_info_attr = array();
		foreach (array_keys($temp_array) as $key) {
			array_push($table_info_attr, $key);
		}
		
		$table_info = "<thead><tr>";
		foreach ($table_info_attr as $key) {
			$table_info .= "<th>".$key."</th>";
		}
		$table_info .= "</tr></thead>";
		
		$table_info .= "<tbody>";
		foreach ($result as $value) {
			$table_info .= "<tr>";
			foreach ($value as $v) {
				$table_info .= "<td>".$v."</td>";
			}
			$table_info .= "</tr>";
		}
		$table_info .= "</tbody>";
		echo "<div id=\"div1\"><fieldset id = 'fieldset1'><legend id = 'legend1'>Table Attributes: </legend><table  width=\"100%\">".$table_info."</table></fieldset></div>";
//THIS CODE #2		
		$sql = "SELECT * FROM ".$_GET['table'].";";
		$result = $conn->query($sql);
		
		$temp_array = $result->fetch_array(MYSQLI_ASSOC);
		$table_info_attr = array();
		
		if ($result->num_rows <= 0) {echo "Empty Table!";}
		
		else{
			foreach (array_keys($temp_array) as $key) {
				array_push($table_info_attr, $key);
			}
			
			$table_info = "<thead><tr>";
			foreach ($table_info_attr as $key) {
				$table_info .= "<th>".$key."</th>";
			}
			$table_info .= "</tr></thead>";
			
			$table_info .= "<tbody>";
			foreach ($result as $value) {
				$table_info .= "<tr>";
				foreach ($value as $v) {
					$table_info .= "<td>".$v."</td>";
				}
				$table_info .= "</tr>";
			}
			$table_info .= "</tbody>";
			echo "<div id=\"div1\"><fieldset id = 'fieldset1'><legend>Table Data: </legend><table  width=\"100%\">".$table_info."</table></fieldset></div>";
		}
		
		
		
		
		

		if ($result->num_rows > 0) {
	
		    while($row = $result->fetch_assoc()) {
		        echo 
				"id: " . $row["id"].
						" - Name: " . $row["name"]."<br>";
		    }
		} else {
		    echo " 0 results";
		}
		
		echo "<form action = \"Main.php\">
		<input type=\"submit\" value=\"Go Back\">
		</form>";
		
		/*?>
		
		
		
		<?php*/
		$sql = "Describe ".$_GET['table'].";";
		$result = $conn->query($sql);
		
		$temp_array = $result->fetch_array(MYSQLI_ASSOC);
		$table_info_attr = array();
		
		$Insert_Into_str = "<form method = 'post'><input type='hidden' name='table_name' value ='".$_GET['table']."'><div id ='div2'><fieldset><legend id ='legend1'>Insert Into Table</legend>";
		if ($result->num_rows <= 0) {echo "Empty Table!";}
		else{
			foreach ($result as $key) {
				//echo $key['Field']."<br>";
				$Insert_Into_str .= $key['Field'].":<br>"."<input type = 'text' name ='".$key['Field']."'></input><br>";
			}
			
		}
		$Insert_Into_str .= "</input><input id = 'insert_button' type=\"submit\" value=\"Enter\"></fieldset></div></form>
		";
		echo $Insert_Into_str;
		
		if(isset($_POST['table_name'])){
			$QUERY_VIEW = "Insert INTO ".$_POST['table_name']."(";
			$QUERY = "Insert INTO ".$_POST['table_name']."(";
			array_shift($_POST);
			
			$length = sizeof($_POST);
			foreach (array_keys($_POST) as $key) {
				$length --;
				if($length>0){
					$QUERY_VIEW .= $key.", ";
					$QUERY .= $key.", ";
				}
				else{
					$QUERY_VIEW .= $key.") <br>";
					$QUERY .= $key.") ";
				}
			}
			$QUERY_VIEW .= "VALUES (";
			$QUERY .= "VALUES (";
			$length = sizeof($_POST);
			foreach ($_POST as $key) {
				$length --;
				if($length>0){
					$QUERY_VIEW .= $key.", ";
					$QUERY .= $key.", ";
				}
				else{
					$QUERY_VIEW .= $key."); <br><br>";
					$QUERY .= $key."); ";
				}
			}
			
			echo "<div id ='div3'><fieldset id='fieldset2'><legend>RESULTS</legend>".$QUERY_VIEW."<br><br>";
			
			$result = $conn->query($QUERY);
						 
			if($result){
				echo "Successful! </fieldset></div>";
			}
			else{
				echo "Unsuccessful! </fieldset></div>";
			}
		
			unset($_POST,$QUERY, $QUERY_VIEW);
			header( "refresh:5;" );
		}
		
		?>
		
		
		<?php $conn->close(); ?>
		
	</body>
</html>