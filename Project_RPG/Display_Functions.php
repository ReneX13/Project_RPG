<?php
	include "Connection.php";
	include "Calculation_Functions.php";
	
/*Project_RPG.php Functions*/
	function Display_Content_Table(){
		$str = "";
		$Selection = array("Classes","Races","Elements","Items", "Weapons", "Armor", "Abilities", "Enemy", "NPC", "Towns", "Regions");
		foreach($Selection as $S) {
			if($S == "Elements")
				$str .="<tr><td><a href=\"Project_RPG_SelectionDisplay.php?List=".$S."&Search=NONE\" style=\"color: Lime\">".$S."</a></tr></td>";
			else 
				$str .= "<tr><td><a href=\"Project_RPG_SelectionList.php?List=".$S."\"    style=\"color: springgreen\">".$S."</a></td></tr>";
		}
		
		return "<nav id = 'nav1'>
		<table  width=\"50%\">
			<thead>
			<tr>
				<th><h1>CONTENTS</h1></th>
			</tr>
			</thead>
			<tbody>".$str."</tbody>
		</table>
		</nav>";
	}
/******************************************************************************************************************************************/

/*Project_RPG_SelectionList.php Functions*/
	function Display_Table_For_List($List){
		$Title = strtoupper($List);
		
		return "<table  width=\"50%\">
			<thead>
			<tr>
				<th><h1>".$Title."</h1></th>
			</tr>
			</thead>
			<tbody>".Display_List($List)."</tbody>
		</table>";
	}
	
	function Display_List($List){
		$conn = Connect_To_DB();
		$sql = Select_Query_For_List($List);
		$result = $conn->query($sql);
		
		if ($result->num_rows <= 0) {echo "Empty Table!";}
		else{
			$conn->close(); 
			return Create_Table_For_List($List, $result);
		}
		$conn->close();
	}
	
	function Create_Table_For_List($List, $result){
		$str = "";
		if($List == "Items"){
			foreach ($result as $value) {
				$str .= "<tr><td><a href=\"Project_RPG_SelectionDisplay.php?List=".$List."&Search=".$value['Item_Name']."\"    style=\"color: Lime\">".$value['Item_Name']."</a></tr></td>";
			}
			return $str;
		}
		else if($List == "Weapons"){
			foreach ($result as $value) {
				$str .= "<tr><td><a href=\"Project_RPG_SelectionDisplay.php?List=".$List."&Search=".$value['Weapon_Name']."\"    style=\"color: Lime\">".$value['Weapon_Name']."</a></tr></td>";
			}
			return $str;
		}
		else if($List == "Armor"){
			foreach ($result as $value) {
				$str .= "<tr><td><a href=\"Project_RPG_SelectionDisplay.php?List=".$List."&Search=".$value['Armor_Name']."\"    style=\"color: Lime\">".$value['Armor_Name']."</a></tr></td>";
			}
			return $str;
		}
		else if($List == "Abilities"){
			foreach ($result as $value) {
				$str .= "<tr><td><a href=\"Project_RPG_SelectionDisplay.php?List=".$List."&Search=".$value['Ability_Name']."\"    style=\"color: Lime\">".$value['Ability_Name']."</a></tr></td>";
			}
			return $str;
		}
		else if($List == "Enemy"){
			foreach ($result as $value) {
				$str .= "<tr><td><a href=\"Project_RPG_SelectionDisplay.php?List=".$List."&Search=".$value['Enemy_Name']."\"    style=\"color: Lime\">".$value['Enemy_Name']."</a></tr></td>";
			}
			return $str;
		}
		else if($List == "NPC"){
			foreach ($result as $value) {
				$str .= "<tr><td><a href=\"Project_RPG_SelectionDisplay.php?List=".$List."&Search=".$value['NPC_Name']."\"    style=\"color: Lime\">".$value['NPC_Name']."</a></tr></td>";
			}
			return $str;
		}
		else if($List == "Towns"){
			foreach ($result as $value) {
				$str .= "<tr><td><a href=\"Project_RPG_SelectionDisplay.php?List=".$List."&Search=".$value['Town_Name']."\"    style=\"color: Lime\">".$value['Town_Name']."</a></tr></td>";
			}
			return $str;
		}
		else if($List == "Regions"){
			foreach ($result as $value) {
				$str .= "<tr><td><a href=\"Project_RPG_SelectionDisplay.php?List=".$List."&Search=".$value['Region_Name']."\"    style=\"color: Lime\">".$value['Region_Name']."</a></tr></td>";
			}
			return $str;
		}
		else if($List == "Classes"){
			foreach ($result as $value) {
				$str .= "<tr><td><a href=\"Project_RPG_SelectionDisplay.php?List=".$List."&Search=".$value['Class_Type']."\"    style=\"color: Lime\">".$value['Class_Type']."</a></tr></td>";
			}
			return $str;
		}
		else if($List == "Races"){
			foreach ($result as $value) {
				$str .= "<tr><td><a href=\"Project_RPG_SelectionDisplay.php?List=".$List."&Search=".$value['Race_Type']."\"    style=\"color: Lime\">".$value['Race_Type']."</a></tr></td>";
			}
			return $str;
		}
	}
	
	function Select_Query_For_List($List){
		if($List == "Items")
			return "SELECT Item_Name FROM ITEM;";
		else if($List == "Weapons")
			return "SELECT Weapon_Name FROM WEAPON;";
		else if($List == "Armor")
			return "SELECT Armor_Name FROM ARMOR;";
		else if($List == "Abilities")
			return "SELECT Ability_Name FROM ABILITY;";
		else if($List == "Enemy")
			return "SELECT Enemy_Name FROM ENEMY;";
		else if($List == "NPC")
			return "SELECT NPC_Name FROM NPC;";
		else if($List == "Towns")
			return "SELECT Town_Name FROM TOWN;";
		else if($List == "Regions")
			return "SELECT Region_Name FROM REGION;";
		else if($List == "Classes")
			return "SELECT Class_Type FROM CHARACTER_CLASS_DATA;";
		else if($List == "Races")
			return "SELECT Race_Type FROM CHARACTER_RACE_DATA;";
	}
/******************************************************************************************************************************************/
	
/*Project_RPG_SelectionDisplay.php Functions*/
	function Display_Item($Search){
		$conn = Connect_To_DB();
		$sql = "SELECT * FROM ITEM WHERE Item_Name = \"".$Search."\";";
		$result = $conn->query($sql);
		
		$str ="";
		if ($result->num_rows <= 0) {echo "Empty Table!";}
		else{
			foreach ($result as $value) {
				$str .= "Item Name: ".$value['Item_Name']."<br>"
						.HP_MP_Conversion($value['HP_MP'])
						."Effect_Remove: ".Effects_Conversion($value['Effect_Remove'])."<br>";
				$ID = $value['Item_ID'];
			}
		}  
		
		$sql = "SELECT Enemy_Name, Drop_Rate FROM ENEMY_ITEM_DROP, ENEMY WHERE Item_ID = ".$ID." AND ENEMY.Enemy_ID = ENEMY_ITEM_DROP.Enemy_ID;";
			
		$result = $conn->query($sql);
		
		$str .="<br> <bold> DROPPED BY: </bold> <br>";
		if ($result->num_rows <= 0) {echo "Empty Table!";}
		else{
			foreach ($result as $value) {
				$str .= "&emsp; Enemy Name: ".$value['Enemy_Name']
						."<br> &emsp; &emsp; Drop Rate: ".$value['Drop_Rate']."<br>";
				$str .= "<br>";
			}
		}
		$conn->close(); 
		return $str;
	}
	
	function Display_Weapon($Search){
		$conn = Connect_To_DB();
		$sql = "SELECT * FROM WEAPON WHERE Weapon_Name = \"".$Search."\";";
		$result = $conn->query($sql);
		
		$str ="";
		if ($result->num_rows <= 0) {echo "Empty Table!";}
		else{
			foreach ($result as $value) {
				$str .= "Weapon Name: ".$value['Weapon_Name']."<br>"
					 ."Weapon Type: ".$value['Weapon_Type']."<br>"
					 ."Weapon Handed: ".$value['Handed']."<br>"
					 ."Stats: ".Stats_Conversion_WA($value['Stats'], $value['Stats_Effect'])."<br>"
					 ."Element: ".$value['Element']."<br>";
					 
					 $ID = $value['Weapon_ID'];
			}
		}
		$sql = "SELECT Enemy_Name, Drop_Rate FROM ENEMY_WEAPON_DROP, ENEMY WHERE Weapon_ID = ".$ID." AND ENEMY.Enemy_ID = ENEMY_WEAPON_DROP.Enemy_ID;";
			
		$result = $conn->query($sql);
		
		$str .="<br> <bold> DROPPED BY: </bold> <br>";
		if ($result->num_rows <= 0) {echo "Empty Table!";}
		else{
			foreach ($result as $value) {
				$str .= "&emsp; Enemy Name: ".$value['Enemy_Name']
						."<br> &emsp; &emsp; Drop Rate: ".$value['Drop_Rate']."<br>";
				$str .= "<br>";
			}
		}
		
		$conn->close(); 
		return $str;
	}
	
	function Display_Armor($Search){
		$conn = Connect_To_DB();
		$sql = "SELECT * FROM ARMOR WHERE Armor_Name = \"".$Search."\";";
		$result = $conn->query($sql);
		
		$str = "";
		if ($result->num_rows <= 0) {echo "Empty Table!";}
		else{
			foreach ($result as $value) {
				$str .= "Armor Name: ".$value['Armor_Name']."<br>"
					 ."Armor Type: ".$value['Armor_Type']."<br>"
					 ."Armor Material: ".$value['Armor_Material']."<br>"
					 ."Stats: ".Stats_Conversion_WA($value['Stats'], $value['Stats_Effect'])."<br>"
					 ."Element: ".$value['Element']."<br>";
				$ID = $value['Armor_ID'];
			}
		}
		$sql = "SELECT Enemy_Name, Drop_Rate FROM ENEMY_ARMOR_DROP, ENEMY WHERE Armor_ID = ".$ID." AND ENEMY.Enemy_ID = ENEMY_ARMOR_DROP.Enemy_ID;";
			
		$result = $conn->query($sql);
		
		$str .="<br> <bold> DROPPED BY: </bold> <br>";
		if ($result->num_rows <= 0) {echo "Empty Table!";}
		else{
			foreach ($result as $value) {
				$str .= "&emsp; Enemy Name: ".$value['Enemy_Name']
						."<br> &emsp; &emsp; Drop Rate: ".$value['Drop_Rate']."<br>";
				$str .= "<br>";
			}
		}
		$conn->close(); 
		return $str;
	}
	
	function Display_Ability($Search){
		$conn = Connect_To_DB();
		$sql = "SELECT * FROM ABILITY WHERE Ability_Name = \"".$Search."\";";
		$result = $conn->query($sql);
		
		$str = "";
		if ($result->num_rows <= 0) {echo "Empty Table!";}
		else{
			foreach ($result as $value) {
				$str .= "Ability Name: ".$value['Ability_Name']."<br>"
					 ."Ability Type: ".$value['Ability_Type']."<br>"
					 ."Ability Power Level: ".$value['Power_Level']."<br>"
					 ."Effect_Apply: ".Effects_Conversion($value['Effect_Apply'])."<br>"
					 ."Effect_Remove: ".Effects_Conversion($value['Effect_Remove'])."<br>"
					 ."Element: ".$value['Element']."<br>";
				$ID = $value['Ability_ID'];
			}
		}
		
		$sql = "SELECT Enemy_Name FROM ENEMY_HAS_ABILITY, ENEMY WHERE ABILITY_ID = ".$ID." AND ENEMY.Enemy_ID = ENEMY_HAS_ABILITY.Enemy_ID;";
			
		$result = $conn->query($sql);
		
		$str .="<br> <bold> ENEMY WITH THIS ABILITY: </bold> <br>";
		if ($result->num_rows <= 0) {echo "Empty Table!";}
		else{
			foreach ($result as $value) {
				$str .= "&emsp; Enemy Name: ".$value['Enemy_Name']."<br>";
			}
		}
		
		$sql = "SELECT NPC_Name FROM NPC_HAS_ABILITY, NPC WHERE ABILITY_ID = ".$ID." AND NPC.NPC_ID = NPC_HAS_ABILITY.NPC_ID;";
			
		$result = $conn->query($sql);
		
		$str .="<br> <bold> NPC WITH THIS ABILITY: </bold> <br>";
		if ($result->num_rows <= 0) {echo "Empty Table!";}
		else{
			foreach ($result as $value) {
				$str .= "&emsp; NPC Name: ".$value['NPC_Name']."<br>";
			}
		}
		$conn->close(); 
		return $str;
	}
	
	function Display_Enemy($Search){
		$conn = Connect_To_DB();
		$sql = "SELECT * FROM ENEMY WHERE Enemy_Name = \"".$Search."\";";
		$result = $conn->query($sql);
		
		$str = "";
		if ($result->num_rows <= 0) {echo "Empty Table!";}
		else{
			foreach ($result as $value) {
				$str .= "Enemy Name: ".$value['Enemy_Name']."<br>"
					 ."Stats: ".Stats_Conversion_NE($value['Stats'])."<br>"
					 ."Element: ".$value['Element']."<br>";
				$ID = $value['Enemy_ID'];
			}
		}
		
		$sql = "SELECT Region_Name FROM ENEMY_IN_REGION, REGION WHERE Enemy_ID = ".$ID." AND REGION.REGION_ID = ENEMY_IN_REGION.Region_ID;";
			
		$result = $conn->query($sql);
		
		$str .="<br> <bold> FOUND IN THESE REGIONS: </bold> <br>";
		if ($result->num_rows <= 0) {echo "Empty Table!";}
		else{
			foreach ($result as $value) {
				$str .= "&emsp;".$value['Region_Name']."<br>";
			}
		}
		
		$sql = "SELECT Ability_Name FROM ENEMY_HAS_ABILITY, ABILITY WHERE Enemy_ID = ".$ID." AND ABILITY.Ability_ID = ENEMY_HAS_ABILITY.Ability_ID;";
			
		$result = $conn->query($sql);
		
		$str .="<br> <bold> ABILITIES: </bold> <br>";
		if ($result->num_rows <= 0) {echo "Empty Table!";}
		else{
			foreach ($result as $value) {
				$str .= "&emsp;".$value['Ability_Name']."<br>";
			}
		}
		
		$sql = "SELECT Item_Name, Drop_Rate FROM ENEMY_ITEM_DROP, ITEM WHERE Enemy_ID = ".$ID." AND ITEM.Item_ID = ENEMY_ITEM_DROP.Item_ID;";
			
		$result = $conn->query($sql);
		
		$str .="<br> <bold> ITEM DROPS: </bold> <br>";
		if ($result->num_rows <= 0) {echo "Empty Table!";}
		else{
			foreach ($result as $value) {
				$str .= "&emsp;".$value['Item_Name']
					   ."<br> &emsp; &emsp; Drop Rate: ".$value['Drop_Rate']."<br>";
				$str .= "<br>";
			}
		}
		
		$sql = "SELECT Weapon_Name,Drop_Rate FROM ENEMY_WEAPON_DROP, WEAPON WHERE Enemy_ID = ".$ID." AND WEAPON.Weapon_ID = ENEMY_WEAPON_DROP.Weapon_ID;";
			
		$result = $conn->query($sql);
		
		$str .="<br> <bold> WEAPON DROPS: </bold> <br>";
		if ($result->num_rows <= 0) {echo "Empty Table!";}
		else{
			foreach ($result as $value) {
				$str .= "&emsp;".$value['Weapon_Name']
					   ."<br> &emsp; &emsp; Drop Rate: ".$value['Drop_Rate']."<br>";
				$str .= "<br>";
			}
		}
		
		$sql = "SELECT Armor_Name, Drop_Rate FROM ENEMY_ARMOR_DROP, ARMOR WHERE Enemy_ID = ".$ID." AND ARMOR.Armor_ID = ENEMY_ARMOR_DROP.Armor_ID;";
			
		$result = $conn->query($sql);
		
		$str .="<br> <bold> ARMOR DROPS: </bold> <br>";
		if ($result->num_rows <= 0) {echo "Empty Table!";}
		else{
			foreach ($result as $value) {
				$str .= "&emsp;".$value['Armor_Name']
					   ."<br> &emsp; &emsp; Drop Rate: ".$value['Drop_Rate']."<br>";
				$str .= "<br>";
			}
		}
		$conn->close(); 
		return $str;
	}
	
	function Display_NPC($Search){
		$conn = Connect_To_DB();
		$sql = "SELECT * FROM NPC WHERE NPC_Name = \"".$_GET['Search']."\";";
		$result = $conn->query($sql);
		
		$str = "";
		if ($result->num_rows <= 0) {echo "Empty Table!";}
		else{
			foreach ($result as $value) {
				$str .= "NPC Name: ".$value['NPC_Name']."<br>"
					 ."Stats: ".Stats_Conversion_NE($value['Stats'])."<br>"
					 ."Element: ".$value['Element']."<br>";
				$ID = $value['NPC_ID'];
			}
		}
		
		$sql = "SELECT Region_Name FROM NPC_IN_REGION, REGION WHERE NPC_ID = ".$ID." AND REGION.REGION_ID = NPC_IN_REGION.Region_ID;";
			
		$result = $conn->query($sql);
		
		$str .="<br> <bold> FOUND IN THESE REGIONS: </bold> <br>";
		if ($result->num_rows <= 0) {echo "Empty Table!";}
		else{
			foreach ($result as $value) {
				$str .= "&emsp;".$value['Region_Name']."<br>";
			}
		}
		
		$sql = "SELECT Town_Name FROM NPC_IN_TOWN, TOWN WHERE NPC_ID = ".$ID." AND TOWN.Town_ID = NPC_IN_TOWN.Town_ID;";
			
		$result = $conn->query($sql);
		
		$str .="<br> <bold> FOUND IN THESE TOWNS: </bold> <br>";
		if ($result->num_rows <= 0) {echo "Empty Table!";}
		else{
			foreach ($result as $value) {
				$str .= "&emsp;".$value['Town_Name']."<br>";
			}
		}
		
		$sql = "SELECT Ability_Name FROM NPC_HAS_ABILITY, ABILITY WHERE NPC_ID = ".$ID." AND ABILITY.Ability_ID = NPC_HAS_ABILITY.Ability_ID;";
			
		$result = $conn->query($sql);
		
		$str .="<br> <bold> ABILITIES: </bold> <br>";
		if ($result->num_rows <= 0) {echo "Empty Table!";}
		else{
			foreach ($result as $value) {
				$str .= "&emsp;".$value['Ability_Name']."<br>";
			}
		}
		$conn->close(); 
		return $str;
	}
	
	function Display_Town($Search){
		$conn = Connect_To_DB();
		$sql = "SELECT * FROM TOWN, REGION WHERE Town_Name = \"".$Search."\" AND TOWN.Region_ID = REGION.REGION_ID;";
		$result = $conn->query($sql);
		
		$str = "";
		if ($result->num_rows <= 0) {echo "Empty Table!";}
		else{
			foreach ($result as $value) {
				$str .= "Town Name: ".$value['Town_Name']."<br>"
					   ."In Region: ".$value['Region_Name']."<br>";
				$ID = $value['Town_ID'];
			}
		}
		
		$sql = "SELECT NPC_Name FROM NPC_IN_TOWN, NPC WHERE Town_ID = ".$ID." AND NPC.NPC_ID = NPC_IN_TOWN.NPC_ID;";
			
		$result = $conn->query($sql);
		
		$str .="<br> <bold> NPC FOUND IN THIS TOWN: </bold> <br>";
		if ($result->num_rows <= 0) {echo "Empty Table!";}
		else{
			foreach ($result as $value) {
				$str .= "&emsp;".$value['NPC_Name']."<br>";
			}
		}
		$conn->close(); 
		return $str;
	}
	
	function Display_Region($Search){
		$conn = Connect_To_DB();
		$sql = "SELECT * FROM REGION WHERE Region_Name = \"".$Search."\";";
		$result = $conn->query($sql);
		
		$str = "";
		if ($result->num_rows <= 0) {echo "Empty Table!";}
		else{
			foreach ($result as $value) {
				$str .= "Region Name: ".$value['Region_Name']."<br>"
					 ."Region Description: ".$value['Region_Description']."<br>";
				$ID = $value['Region_ID'];
			}
		}
		
		$sql = "SELECT Town_Name FROM TOWN WHERE  Region_ID = ".$ID.";";
			
		$result = $conn->query($sql);
		
		$str .="<br> <bold> TOWNS IN THIS REGION: </bold> <br>";
		if ($result->num_rows <= 0) {echo "Empty Table!";}
		else{
			foreach ($result as $value) {
				$str .= "&emsp;".$value['Town_Name']."<br>";
			}
		}
		
		$sql = "SELECT NPC_Name FROM NPC_IN_REGION, NPC WHERE Region_ID = ".$ID." AND NPC.NPC_ID = NPC_IN_REGION.NPC_ID;";
			
		$result = $conn->query($sql);
		
		$str .="<br> <bold> NPC FOUND IN THIS REGION: </bold> <br>";
		if ($result->num_rows <= 0) {echo "Empty Table!";}
		else{
			foreach ($result as $value) {
				$str .= "&emsp;".$value['NPC_Name']."<br>";
			}
		}
		
		$sql = "SELECT Enemy_Name FROM ENEMY_IN_REGION, ENEMY WHERE Region_ID = ".$ID." AND ENEMY.Enemy_ID = ENEMY_IN_REGION.Enemy_ID;";
			
		$result = $conn->query($sql);
		
		$str .="<br> <bold> ENEMY FOUND IN THIS REGION: </bold> <br>";
		if ($result->num_rows <= 0) {echo "Empty Table!";}
		else{
			foreach ($result as $value) {
				$str .= "&emsp;".$value['Enemy_Name']."<br>";
			}
		}
		$conn->close(); 
		return $str;
	}
	
	function Display_Class($Search){
		$conn = Connect_To_DB();
		$sql = "SELECT * FROM CHARACTER_CLASS_DATA WHERE Class_Type = \"".$_GET['Search']."\";";
		$result = $conn->query($sql);
		
		$str = "";
		if ($result->num_rows <= 0) {echo "Empty Table!";}
		else{
			foreach ($result as $value) {
				$str .= "Class: ".$value['Class_Type']."<br>"
					 ."Stats: ".Stats_Conversion_NE($value['Stats'])."<br>";
			}
		}
		$conn->close(); 
		return $str;
	}
	
	function Display_Race($Search){
		$conn = Connect_To_DB();
		$sql = "SELECT * FROM CHARACTER_Race_DATA WHERE Race_Type = \"".$_GET['Search']."\";";
		$result = $conn->query($sql);
		
		$str = "";
		if ($result->num_rows <= 0) {echo "Empty Table!";}
		else{
			foreach ($result as $value) {
				$str .= "Race: ".$value['Race_Type']."<br>"
					 ."Stats: ".Stats_Conversion_NE($value['Stats'])."<br>";
			}
		}
		$conn->close(); 
		return $str;
	}
	
	function Display_Elements(){
		$conn = Connect_To_DB();
		$sql = "SELECT * FROM ELEMENT_WEAKNESS_AND_RESISTANCES;";
		$result = $conn->query($sql);
		$str ="";
		if ($result->num_rows <= 0) {echo "Empty Table!";}
		else{
			foreach ($result as $value) {
				$str .= "<BOLD>Element</BOLD>: ".$value['Element']."<br>"
					 ."Weakness: ".$value['Weak_Against']."<br>"
					 ."Resistant: ".$value['Resistant_Against']."<br><br>";
			}
		}
		$conn->close();
		return $str;
	} 
	
	function Display($List, $Search){
		if($List == "Items"){
			return Display_Item($Search);
		}
		
		else if($List == "Weapons"){
			return Display_Weapon($Search);
		}
		
		else if($List == "Armor"){
			return Display_Armor($Search);
		}
		
		else if($List == "Abilities"){
			return Display_Ability($Search);
		}
		
		else if($List == "Enemy"){
			return Display_Enemy($Search);
		}
		
		else if($List == "NPC"){
			return Display_NPC($Search);
		}
		
		else if($List == "Towns"){
			return Display_Town($Search);
		}
		
		else if($List == "Regions"){
			return Display_Region($Search);
		}
		else if($List == "Classes"){
			return Display_Class($Search);
		}
		else if($List == "Races"){
			return Display_Race($Search);
		}
		else if($List == "Elements"){
			return Display_Elements();
		}
		else
			return "SOME SHIT HAPPEN....!";
	}
/******************************************************************************************************************************************/

/*Character_Info_Display.php Functions*/
	function Collect_Character_Information($X){
		$conn = Connect_To_DB();
		$sql = "SELECT * FROM Player_Character WHERE Character_Name = '".$X."'";
		$result = $conn->query($sql);
		if ($result->num_rows <= 0) {echo "empty results!";}
		else{
			foreach ($result as $value) {
				$Character_Information = "		Name: ".$value['Character_Name']."<br>"
										."		Class: ".$value['Class_Type']."<br>"
										."		Race: ".$value['Race_Type']."<br>"
										."		Gender: ".$value['Gender']."<br>"
										."		Level: ".$value['Char_Level']."<br>";

					$Class_Base_Stats = Get_Stats_RC("Class_Type", $value['Class_Type']);
					$Race_Base_Stats = Get_Stats_RC("Race_Type", $value['Race_Type']);
					$LEVEL = $value['Char_Level'];
			}
		}
	
		$conn->close();
		return array($Character_Information, $Class_Base_Stats, $Race_Base_Stats, $LEVEL);
	}

	function Collect_Equipment_Information($X){
		$conn = Connect_To_DB();
		$sql_W = "SELECT * FROM Equipped_Weapon WHERE Character_Name = '".$X."'";
		$sql_A = "SELECT * FROM Equipped_Armor WHERE Character_Name = '".$X."'";
		
		$Equipment = "";
		$Equipment .= "<h3><bold>WEAPON: </bold></h3><br>";
		$result = $conn->query($sql_W);	
		$Weapons = array();
		if ($result->num_rows <= 0) {echo "empty results!";}
		else{
			foreach ($result as $value) {
				$sql = "SELECT * FROM Weapon WHERE Weapon_ID = ".$value['Weapon_ID'];
				$result_2 = $conn->query($sql);
				if ($result_2->num_rows <= 0) {echo "empty results_2!";}
				else{
					foreach ($result_2 as $value_2) {
						$Equipment .= "		Name: ".$value_2['Weapon_Name']."<br>"
								."		Type: ".$value_2['Weapon_Type']."<br>"
								."		Handed: ".$value_2['Handed']."<br>"
								."		Stats: ".Stats_Conversion_WA($value_2['Stats'], $value_2['Stats_Effect'])."<br>"
								."		Element: ".$value_2['Element']."<br><br>";
						array_push($Weapons,Get_Stats_WA("Weapon_Type", $value_2['Weapon_ID'],$value_2['Stats_Effect']) );
					}
				}
			}
		}

		$Equipment .= "<br><br><h3><bold>ARMOR: </bold></h3><br>";
		$result = $conn->query($sql_A);	
		$Armor = array();
		if ($result->num_rows <= 0) {echo "empty results!";}
		else{
			foreach ($result as $value) {
				$sql = "SELECT * FROM Armor WHERE Armor_ID = ".$value['Armor_ID'];
				$result_2 = $conn->query($sql);
				if ($result_2->num_rows <= 0) {echo "empty results_2!";}
				else{
					foreach ($result_2 as $value_2) {
						$Equipment .= "		Name: ".$value_2['Armor_Name']."<br>"
								."		Type: ".$value_2['Armor_Type']."<br>"
								."		Material: ".$value_2['Armor_Material']."<br>"
								."		Stats: ".Stats_Conversion_WA($value_2['Stats'], $value_2['Stats_Effect'])."<br>"
								."		Element: ".$value_2['Element']."<br><br>";

						array_push($Armor,Get_Stats_WA("Armor_Type", $value_2['Armor_ID'], $value_2['Stats_Effect']) );
					}
				}
			}
		}
		$conn->close();
		return array($Equipment, $Weapons, $Armor);
	}
	
	function Abilities_Display($X){
		$conn = Connect_To_DB();
		$sql = "SELECT * FROM Character_Has_Ability WHERE Character_Name = '".$X."'";
		$result = $conn->query($sql);
		
		$Abilities = "";
		if ($result->num_rows <= 0) {echo "empty results!";}
		else{
			foreach ($result as $value) {
				$sql = "SELECT * FROM Ability WHERE Ability_ID = ".$value['Ability_ID'];
				$result_2 = $conn->query($sql);
				if ($result_2->num_rows <= 0) {echo "empty results_2!";}
				else{
					foreach ($result_2 as $value_2) {
						$Abilities .= "		Name: ".$value_2['Ability_Name']."<br>"
								."		Type: ".$value_2['Ability_Type']."<br>"
								."		Power Level: ".$value_2['Power_Level']."<br>"
								."		Effecft Apply: ".Effects_Conversion($value_2['Effect_Apply'])."<br>"
								."		Effecft Remove: ".Effects_Conversion($value_2['Effect_Remove'])."<br>"
								."		Element: ".$value_2['Element']."<br><br>";
					}
				}
			}
		}
		
		$conn->close();
		return $Abilities;
	}
	
	function Display_Complete_Stats($Z){
		return "<pre>	STA:	".$Z['STA']."<br>"
					."	STR:	".$Z['STR']."<br>"
					."	AGI:	".$Z['AGI']."<br>"
					."	DEF:	".$Z['DEF']."<br>"
					."	MIN:	".$Z['MIN']."<br>"
					."	INT:	".$Z['INT']."<br>"
					."	EVA:	".$Z['EVA']."<br>"
					."	ACC:	".$Z['ACC']."<br></pre>";
	}
/******************************************************************************************************************************************/

/*User_Account_Configure.php Functions*/
	function Collect_Account_Information($Email){
		$conn = Connect_To_DB();
		$sql = "Select * From ACCOUNT Where Email = '".$Email."';";
		$result = $conn->query($sql);
		if ($result->num_rows <= 0) {}
		else{
			foreach ($result as $value) {									
				$ACC_INFO = "Account_ID: ".$value['Account_ID']."<br>"
					."Email: ".$value['Email']."<br>"
					."Password: ".$value['Password']."<br>"
					."First Name: ".$value['First_Name']."<br>"
					."Last Name: ".$value['Last_Name']."<br> <br>";

				$ACC_ID = $value['Account_ID'];
			}
		}
		$conn ->close();
		return array($ACC_INFO, $ACC_ID, Collect_Character_List($ACC_ID));
	}
	
	function Collect_Character_List($X){
		$conn = Connect_To_DB();
		$sql = "Select * From PLAYER_CHARACTER Where Account_ID = \"".$X."\";";
		$result = $conn->query($sql);
		
		$List = "";
		if ($result->num_rows <= 0) {echo "Account Has no Characters";}
		else{
			foreach ($result as $value) {
				$List .= "		Name: ".$value['Character_Name']."<br>"
					."		Class: ".$value['Class_Type']."<br>"
					."		Race: ".$value['Race_Type']."<br>"
					."		Gender: ".$value['Gender']."<br>"
					."		Level: ".$value['Char_Level']
					."<br><form action = \"Character_Info_Display.php\" method = \"post\">
					  <input type = \"hidden\" name = \"char_name\" value = \"".$value['Character_Name']."\"></input>
					  <input type = \"submit\" value = \"View\"></input>
					  </form><br>";
			}
		}
		$conn->close();
		return $List;
	}
/******************************************************************************************************************************************/

/*Edit_Account.php Functions*/
	function Display_Edit_Account($X,$Y){
		if($X == "name")
			$Title = "Edit Name:";
		else if($X == "password")
			$Title = "Edit Password:";
		else if($X == "email")
			$Title = "Edit Email:";
		else if($X == "billing")
			$Title = "Edit Billing:";
		
		$Display = "";
		$Display .= "<input type = \"hidden\" name = \"acc_id\" value = \"".$Y."\"></input>";
		$Display .= "<input type = \"hidden\" name = \"edit\" value = \"".$X."\"></input>";
		if($X == "name"){
			$Display .= "
				First Name:<br>
					<input type=\"text\" name=\"First Name\"></input>
					<br>
				Last Name:<br>
					<input type=\"text\" name=\"Last Name\"></input>
					<br><br>
				<input type=\"submit\" value=\"Submit\"></input>";
		}
		else if($X == "password"){
			$Display .= "
				Current Password:<br>
					<input type=\"text\" name=\"current\"></input>
					<br>
				New Password:<br>
					<input type=\"text\" name=\"new\"></input>
					<br>
				Confirm Password:<br>
					<input type=\"text\" name=\"confirm\"></input>
					<br><br>
				<input type=\"submit\" value=\"Submit\"></input>";
		}
		else if($X == "email"){
			$Display .= "
				New Email:<br>
					<input type=\"text\" name=\"new\"></input>
					<br>
				Confirm Email:<br>
					<input type=\"text\" name=\"confirm\"></input>
					<br><br>
				<input type=\"submit\" value=\"Submit\"></input>";
		}
		else if($X == "billing"){
			$conn = Connect_To_DB();
			$sql = "SELECT * FROM ACCOUNT_BILLING WHERE Account_ID = ".$Y.";";
			$result = $conn->query($sql);

			if ($result->num_rows <= 0) {echo "empty results!";}
			else{
				foreach ($result as $value) {
						//ACCOUNT_BILLING(Account_ID, Card_Number, Security_Code, Expiration_Month, Expiration_Year)
						$Display .= "<input type=\"checkbox\" name='card[]' value = '
						".$value['Card_Number'].",
						".$value['Security_Code'].",
						".$value['Expiration_Month'].",
						".$value['Expiration_Year']."'>"
						.$value['Card_Number']."</input><br>";
				}
			}
			$Z = $X."_Add";
			$Display .= "
				<input type=\"submit\" value=\"Delete\"></input><br><br><br>";
				
			$Display_2 = "<form action= 'Change_Information.php' method = 'post'>
							<input type = \"hidden\" name = \"acc_id\" value = \"".$Y."\"></input>
							<input type = \"hidden\" name = \"edit\" value = \"".$Z."\"></input>
							
					Card Number:<br>
					<input type=\"text\" name=\"Number\"></input><br>
					Security Code:<br>
					<input type=\"text\" name=\"Code\"></input><br>
					Expiration Month:<br>
					<input type=\"text\" name=\"Month\"></input><br>
					Expiration Year:<br>
					<input type=\"text\" name=\"Year\"></input><br>
				<input type=\"submit\" value=\"Add\"></input>
				</form>";
				
			$conn->close();
			return array($Title, $Display, $Display_2);
		}
		return array($Title, $Display);
	}

?>