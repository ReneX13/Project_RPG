<!DOCTYPE html>
<html>
	<script>
		var Number_of_Attribute = 0;
		var Attribute_Type_List = {};
			Attribute_Type_List['SMALLINT'] = 0;
			Attribute_Type_List['BIGINT'] = 0;
			Attribute_Type_List['DOUBLE PRECISION'] = 0;
			Attribute_Type_List['DATE'] = 0;
			Attribute_Type_List['TIME'] = 0;
			Attribute_Type_List['CHARACTER']=1;
			Attribute_Type_List['VARCHAR']=1;
			Attribute_Type_List['BINARY']=1;
			Attribute_Type_List['VARBINARY']=1;
			Attribute_Type_List['INTEGER']=1;
			Attribute_Type_List['FLOAT']=1;
			Attribute_Type_List['DECIMAL']=2;
			Attribute_Type_List['NUMERIC']=2;
		
		function Add_Attribute(){
			//id='"+ATI+"' onchange='"+AT_Change+"'
			var newdiv = document.createElement('div');
			Number_of_Attribute ++; 
			var ATI = "attribute_type_"+Number_of_Attribute;
			var AT_Change = "onAttributeTypeChange("+Number_of_Attribute+")";
			
			var tmp_str = "";
			for (key in Attribute_Type_List){
				tmp_str += "<option value='"+key+"'>"+key+"</option>";		
			}
			newdiv.innerHTML = "Name <input type='text' name='Att_Name"+Number_of_Attribute+"'>"+
			"</input> Type <select name='Att_Type_"+Number_of_Attribute+"' id = '"+ATI+"' onchange = '"+AT_Change+"'>"+
			"<option value=''>-- SELECT TYPE --</option>"+tmp_str+
			"</select><span id='ASO_"+Number_of_Attribute+"'></span>"+
			"NN<input type='checkbox' name='NN_"+Number_of_Attribute+"' value='NOT NULL'>"+
			"UN<input type='checkbox' name='UN_"+Number_of_Attribute+"' value='UNIQUE'>"+
			"PK<input type='checkbox' name='PK_"+Number_of_Attribute+"' value='PRIMARY KEY'>"+
			"<input type='hidden' name='"+Number_of_Attribute+"_Z' value='#'>";
			
			document.getElementById("Create_Table_Form").appendChild(newdiv);
		}
		function Display_Query(){
			
		}
		function Remove_Attribute(){
			document.getElementById("Create_Table_Form").removeChild(document.getElementById("Create_Table_Form").lastChild);
		}
		function onAttributeTypeChange(x){
			var att = document.getElementById("ASO_"+x);
			var att_type_List = document.getElementById("attribute_type_"+x);

			var att_Size_Option = Attribute_Type_List[att_type_List.options[att_type_List.selectedIndex].value];
			
			if(att_Size_Option == 0){
				document.getElementById("ASO_"+x).innerHTML = "";
				}
			else if(att_Size_Option == 1){
				document.getElementById("ASO_"+x).innerHTML = "<br><input type='hidden'name='"+x+"_OP' value='('>"+
				"N <input id='num' type=\"number\" name='n_"+x+"'>"+
				"<input type='hidden' name='"+x+"_CP'value=')'>";
			}
			else if(att_Size_Option == 2){
				document.getElementById("ASO_"+x).innerHTML =  "<br><input type='hidden'name='"+x+"_OP' value='('>"+
				"P <input id='num' type=\"number\" name='p_"+x+"'>" + "<input type='hidden' name='"+x+"_C'value=','>"+
				"S <input id='num' type=\"number\" name='s_"+x+"'>"+
				"<input type='hidden' name='"+x+"_CP'value=')'>";
			}
		}
	</script>
	<?php
		
	?>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Database Project</title>
		<style>
			* {
				box-sizing: border-box;
			}

			header{
				font-style: oblique;
				padding: 1em;
				color: white;
				clear: left;
				text-align: center;
			}

			#nav1 {
				width: 50%;
				float: left;
				padding: 5px 5%;
			} 
			
			#nav2 {
				
				color:rgb(0, 225, 0);
				font-variant: small-caps;
				font-style: oblique;
				width: 50%;
				float: left;
				padding: 5px 5%;
			}
			#fieldset1 {
				background: rgba(0, 0, 0, 0.6);				
			}
			#legend1 {
				color:rgb(0, 225, 0);
				font-style: normal;
				font-weight: bold;
				font-size: 20px;
			}
			div{
				border: 4px dotted grey;
				margin: 5px;
				padding: 3px 2px;
			}
			#num{
				width: 10%
			}
			select{
				width: 25%
			}
			
			
			thead {color:green;}
			tbody {color:blue;}
			tfoot {color:red;}
			table{
				border: 10px ridge white;
			}
			th{
				border: 7px groove white;
			}
			
			td {
				border: 4px inset white;
			}
			
			tr:nth-child(even) {
				background-color: #dddddd;
			}
			
			tr:nth-child(odd) {
				background-color: #eeddd0;
			}
			#example1 {
				
				width: 50%;
				float: left;
				padding: 15px;
			}
			body {
				background-color: black;
				background-image: url("BG_2.jpg");

				background-size: 100%;
				background-repeat: no-repeat;
				background-attachment: fixed;
			}
		</style>
	</head>
		<body>
			<?php//Variables
				$ATTRIBUTE_ARRAY = {""}
				$T_Name = '';
			?>
			
			<?php
			error_reporting(E_ERROR | E_PARSE);
			$servername = "localhost";
			$username = "root";
			$password = "12345";
			$dbname = "project_rpg";

			$conn = new mysqli($servername, $username, $password, "project_rpg");
			if ($conn->connect_error)
				die("Connection failed: " . $conn->connect_error);
			?>
			
			<header>
				<h1>DATABASE PROJECT</h1>
			</header>
			
			<?php
				$sql = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA LIKE 'project_rpg';";
				$result = $conn->query($sql);
				
				$str = "";
				while ($row = $result->fetch_assoc()) {
					$str .= "<tr><td><a href=\"Table.php?table=".$row["TABLE_NAME"]."\"    style=\"color: #CC0000\">".$row["TABLE_NAME"]."</a></td></tr>";
				}
				
				echo "<nav id = 'nav1'>
				<table  width=\"50%\">
					<thead>
					<tr>
						<th>TABLES</th>
					</tr>
					</thead>
					<tbody>".$str.	
					"</tbody>
				</table>
				</nav>";
				
				
			?>
			
			<nav id = 'nav2'><fieldset id='fieldset1'><legend id = 'legend1'>CREATE TABLE</legend> 
				<?php 
					
					
					if(isset($_POST['set_attributes'])){
						
						$CreateTableQuery_View ="Create Table ".$_POST['table_name']."(";
						$CreateTableQuery ="Create Table ".$_POST['table_name']."(";
						array_shift($_POST);
						$length = sizeof($_POST);
						foreach ($_POST as $value) {
							$length --;
							if($value == "#" ){
								if($length >0){
									$CreateTableQuery_View .= ", <br>";
									$CreateTableQuery .= ", ";
								}
								else{
									$CreateTableQuery_View .= "); ";
									$CreateTableQuery .= "); ";
								}
							}
							else{
								$CreateTableQuery_View .= $value." "; 
								$CreateTableQuery .= $value." "; 
							}
						}
						echo $CreateTableQuery_View;
						$result = $conn->query($CreateTableQuery);
						 
						if($result){
							echo "Successful! </fieldset></div>";
							//header( "refresh:1;" );
							echo "<br><br> <form action ='Main.php' method ='post'>Successful! <input type=\"submit\" value=\"Continue\"> </form>";
						}
						else{
							echo "Unsuccessful! </fieldset></div>";
							//header( "refresh:1;" );
							echo "<br><br> <form action ='Main.php' method ='post'>Unsuccessful! <input type=\"submit\" value=\"Continue\"> </form>";
						}
						unset($_POST, $CreateTableQuery, $CreateTableQuery_View);
					}
					else if(isset($_POST['table_name'])){					
						echo "<form id = 'Create_Table_Form' method ='post'>
								<input type = 'hidden' name = 'table_name' value ='".$_POST['table_name']."'>
								<input type = 'hidden' name = 'set_attributes' value =''>
							<input type='submit' value='Create'> 
							</form>
							<form action = 'Main.php' method = 'post'><input type='submit' value='Cancel'></form>
							<button onclick='Add_Attribute()'>add</button>
							<button onclick='Remove_Attribute()'>remove</button>";
					}
					else{
						echo "<form method=\"post\">
							Table Name:<br>
								<input type=\"text\" name=\"table_name\"><br>
								
						<input type=\"submit\" value=\"Continue\">
						</form>";
					}
					
				?>
			</fieldset></nav>
			
			<?php $conn->close(); ?>
		</body>
</html>