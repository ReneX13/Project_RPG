<?php
function HP_MP_Conversion($HM){
	$Item_HP_MP_Ratio = (20000/51);
	$STR = str_split($HM);
	$HP = "";
	$MP = "";
	
	for ($i=0; $i<strlen($HM); $i++){
		if($i<8)
			$HP .= $STR[$i];
		if($i>=8)
			$MP .= $STR[$i];
	}
	
	if(strlen($HM) != 16)
		return "HP_MP: NOT IN CORRECT FORMAT! <br>";
	
	return "HP: ".round(bindec($HP)*$Item_HP_MP_Ratio)."<br> MP: ".round(bindec($MP)*$Item_HP_MP_Ratio)."<br>";
}

function Effects_Conversion($E){
	$STR = str_split($E);
	$Results = "";
	
	for ($i=0; $i<strlen($E); $i++){
		if($i == 0 && $STR[$i] == 1)
			$Results .= "	Poisoned<br>";
		else if($i == 1 && $STR[$i] == 1)
			$Results .= "	Slow<br>";
		else if($i == 2 && $STR[$i] == 1)
			$Results .= "	Blind<br>";
		else if($i == 3 && $STR[$i] == 1)
			$Results .= "	Paralyzed<br>";
		else if($i == 4 && $STR[$i] == 1)
			$Results .= "	Sapped<br>";
		else if($i == 5 && $STR[$i] == 1)
			$Results .= "	Frozen<br>";
		else if($i == 6 && $STR[$i] == 1)
			$Results .= "	Sleep<br>";
		else if($i == 7 && $STR[$i] == 1)
			$Results .= "	Confused<br>";
	}
	
	if(strlen($E) != 8)
		return "Effects! NOT IN CORRECT FORMAT! <br>";
	return "<pre>".$Results."</pre>";
}

function Stats_Conversion_NE($S){
	$STR_S = str_split($S);
	$Stat_Counter = "";
	$Results = "";
	
	$j=0;
	for ($i=0; $i<strlen($S); $i++){
		
		
		$Stat_Counter.= $S[$i];
		
		if(strlen($Stat_Counter)==8){
			//$Results .= "Binary: ".$Stat_Counter;
			if($j == 0)
				$Results .= "	STA: ".bindec($Stat_Counter)."<br>";

			
			else if($j == 1)
				$Results .= "	STR: ".bindec($Stat_Counter)."<br>";
				
			
			else if($j == 2)
				$Results .= "	AGI: ".bindec($Stat_Counter)."<br>";
				
			
			else if($j == 3)
				$Results .= "	DEF: ".bindec($Stat_Counter)."<br>";
			
			
			else if($j == 4)
				$Results .= "	MIN: ".bindec($Stat_Counter)."<br>";
				
			
			else if($j == 5)
				$Results .= "	INT: ".bindec($Stat_Counter)."<br>";
			
			
			else if($j == 6)
				$Results .= "	EVA: ".bindec($Stat_Counter)."<br>";
				
			else if($j == 7)
				$Results .= "	ACC: ".bindec($Stat_Counter)."<br>";
				
			$j++;
			$Stat_Counter = "";
		}
	}
	
	if(strlen($S) != 64)
		return "Stats NOT IN CORRECT FORMAT! <br>";
	return "<pre>".$Results."</pre>";
}

function Stats_Conversion_WA($S, $SE){
	$STR_S = str_split($S);
	$STR_SE = str_split($SE);
	
	$Stat_Counter = "";
	$Results = "";
	
	$j=0;
	for ($i=0; $i<strlen($S); $i++){
		
		
		$Stat_Counter.= $S[$i];
		
		if(strlen($Stat_Counter)==8){
			//$Results .= "Binary: ".$Stat_Counter;
			if($j == 0){
				$Results .= "	STA: ";
				if($STR_SE[$j] == 0)
					$Results .="- ".bindec($Stat_Counter)."<br>";
				else
					$Results .="+ ".bindec($Stat_Counter)."<br>";
			}
			
			else if($j == 1){
				$Results .= "	STR: ";
				if($STR_SE[$j] == 0)
					$Results .="- ".bindec($Stat_Counter)."<br>";
				else
					$Results .="+ ".bindec($Stat_Counter)."<br>";
			}
			
			else if($j == 2){
				$Results .= "	AGI: ";
				if($STR_SE[$j] == 0)
					$Results .="- ".bindec($Stat_Counter)."<br>";
				else
					$Results .="+ ".bindec($Stat_Counter)."<br>";
			}
			
			else if($j == 3){
				$Results .= "	DEF: ";
				if($STR_SE[$j] == 0)
					$Results .="- ".bindec($Stat_Counter)."<br>";
				else
					$Results .="+ ".bindec($Stat_Counter)."<br>";
			}
			
			else if($j == 4){
				$Results .= "	MIN: ";
				if($STR_SE[$j] == 0)
					$Results .="- ".bindec($Stat_Counter)."<br>";
				else
					$Results .="+ ".bindec($Stat_Counter)."<br>";
			}
			
			else if($j == 5){
				$Results .= "	INT: ";
				if($STR_SE[$j] == 0)
					$Results .="- ".bindec($Stat_Counter)."<br>";
				else
					$Results .="+ ".bindec($Stat_Counter)."<br>";
			}
			
			else if($j == 6){
				$Results .= "	EVA: ";
				if($STR_SE[$j] == 0)
					$Results .="- ".bindec($Stat_Counter)."<br>";
				else
					$Results .="+ ".bindec($Stat_Counter)."<br>";
			}
			
			else if($j == 7){
				$Results .= "	ACC: ";
				if($STR_SE[$j] == 0)
					$Results .="- ".bindec($Stat_Counter)."<br>";
				else
					$Results .="+ ".bindec($Stat_Counter)."<br>";
			}
			$j++;
			$Stat_Counter = "";
		}
	}
	
	if(strlen($S) != 64)
		return "Stats NOT IN CORRECT FORMAT! <br>";
	return "<pre>".$Results."</pre>";
}
/*************************************************************************************************************************************/





	function Calculating_Complete_Stats($CS, $RS, $WS, $AR, $L){
		$COMPLETE_STATS = array("STA" => 0, "STR" => 0, "AGI" => 0, "DEF" => 0, "MIN" => 0, "INT" => 0, "EVA" => 0, "ACC" => 0);
		$COMPLETE_STATS = addstats($COMPLETE_STATS, $CS);
		$COMPLETE_STATS = addstats($COMPLETE_STATS, $RS);
		$COMPLETE_STATS = Base_Stats_Level_Dependency($COMPLETE_STATS,$L);
		foreach($WS as $value)
			$COMPLETE_STATS = addstats($COMPLETE_STATS, $value);
		foreach($AR as $value)
			$COMPLETE_STATS = addstats($COMPLETE_STATS, $value);
		return Display_Complete_Stats($COMPLETE_STATS);
	}
	function Base_Stats_Level_Dependency($Z, $L){
		$Z['STA'] = floor($Z['STA']*pow((pow(10, (1/114))), $L - 1));
		$Z['STR'] = floor($Z['STR']*pow((pow(10, (1/114))), $L - 1));
		$Z['AGI'] = floor($Z['AGI']*pow((pow(10, (1/114))), $L - 1));
		$Z['DEF'] = floor($Z['DEF']*pow((pow(10, (1/114))), $L - 1));
		$Z['MIN'] = floor($Z['MIN']*pow((pow(10, (1/114))), $L - 1));
		$Z['INT'] = floor($Z['INT']*pow((pow(10, (1/114))), $L - 1));
		$Z['EVA'] = floor($Z['EVA']*pow((pow(10, (1/114))), $L - 1));
		$Z['ACC'] = floor($Z['ACC']*pow((pow(10, (1/114))), $L - 1));
		return $Z;
	}
	
	function addstats($X, $Y){
		$X['STA'] += $Y['STA'];
		$X['STR'] += $Y['STR'];
		$X['AGI'] += $Y['AGI'];
		$X['DEF'] += $Y['DEF'];
		$X['MIN'] += $Y['MIN'];
		$X['INT'] += $Y['INT'];
		$X['EVA'] += $Y['EVA'];
		$X['ACC'] += $Y['ACC'];
		return $X;
	}
	
	function Get_Stats_RC($type, $name){
		$conn = Connect_To_DB();
		if($type === "Class_Type")
			$sql = "SELECT Stats FROM Character_Class_Data WHERE Class_Type = '".$name."'";
			
		else if($type === "Race_Type")
			$sql = "SELECT Stats FROM Character_Race_Data WHERE Race_Type = '".$name."'";
		
		$result = $conn->query($sql);
		$stats_bs = "";
		if ($result->num_rows <= 0) {echo "Empty Table!";}
		else{
			foreach ($result as $value) {
				$stats_bs .= $value['Stats'];
			}
		}
		$conn->close();
		return Stats_Collect($stats_bs);
	}
		
	function Get_Stats_WA($type, $name, $SE){
		$conn = Connect_To_DB();
		if($type === "Weapon_Type")
			$sql = "SELECT Stats FROM Weapon WHERE Weapon_ID = '".$name."'";
		else if($type === "Armor_Type")
			$sql = "SELECT Stats FROM Armor WHERE Armor_ID = '".$name."'";
		
		$result = $conn->query($sql);
		$stats_bs = "";
		if ($result->num_rows <= 0) {echo "Empty Table!";}
		else{
			foreach ($result as $value) {
				$stats_bs .= $value['Stats'];
			}
		}
		$conn->close();
		return Stats_Collect_WA($stats_bs, $SE);
	}
		
	function Stats_Collect($S){
		$STR_S = str_split($S);
		$Stat_Counter = "";
		$Results = array();
		
		//$Results['STA'] = bindec('0011');
		$j=0;
		for ($i=0; $i<strlen($S); $i++){
			
			$Stat_Counter.= $S[$i];
			
			if (strlen($Stat_Counter)==8){
				if($j == 0)
					$Results['STA'] = bindec($Stat_Counter);

				
				else if($j == 1)
					$Results['STR'] = bindec($Stat_Counter);
					
				
				else if($j == 2)
					$Results['AGI'] = bindec($Stat_Counter);
					
				
				else if($j == 3)
					$Results['DEF'] = bindec($Stat_Counter);
				
				
				else if($j == 4)
					$Results['MIN'] = bindec($Stat_Counter);
					
				
				else if($j == 5)
					$Results['INT'] = bindec($Stat_Counter);
				
				
				else if($j == 6)
					$Results['EVA'] = bindec($Stat_Counter);
					
				else if($j == 7)
					$Results['ACC'] = bindec($Stat_Counter);
					
				$j++;
				$Stat_Counter = "";
			}
		}
		
		if(strlen($S) != 64){
			echo strlen($S);
			return "Stats NOT IN CORRECT FORMAT! <br>";
		}
		return $Results;
	}
	
	function Stats_Collect_WA($S, $SE){
		$STR_S = str_split($S);
		$Stat_Counter = "";
		$Results = array();
		
		//$Results['STA'] = bindec('0011');
		$j=0;
		$STR = str_split($SE);
		for ($i=0; $i<strlen($S); $i++){
			
			$Stat_Counter.= $S[$i];
			
			if (strlen($Stat_Counter)==8){
				if($j == 0){
					if($STR[$j] == 1)
						$Results['STA'] = bindec($Stat_Counter);
					else
						$Results['STA'] = -bindec($Stat_Counter);
				}
					
				
				else if($j == 1){
					if($STR[$j] == 1)
						$Results['STR'] = bindec($Stat_Counter);
					else
						$Results['STR'] = -bindec($Stat_Counter);
				}
				
				else if($j == 2){
					if($STR[$j] == 1)
						$Results['AGI'] = bindec($Stat_Counter);
					else
						$Results['AGI'] = bindec($Stat_Counter);
				}
					
				else if($j == 3){
					if($STR[$j] == 1)
						$Results['DEF'] = bindec($Stat_Counter);
					else
						$Results['DEF'] = -bindec($Stat_Counter);
				}
				
				else if($j == 4){
					if($STR[$j] == 1)
						$Results['MIN'] = bindec($Stat_Counter);
					else
						$Results['MIN'] = -bindec($Stat_Counter);
				}
				
				else if($j == 5){
					if($STR[$j] == 1)
						$Results['INT'] = bindec($Stat_Counter);
					else
						$Results['INT'] = -bindec($Stat_Counter);
				}
				
				else if($j == 6){
					if($STR[$j] == 1)
						$Results['EVA'] = bindec($Stat_Counter);
					else
						$Results['EVA'] = -bindec($Stat_Counter);
				}	
				
				else if($j == 7){
					if($STR[$j] == 1)
						$Results['ACC'] = bindec($Stat_Counter);
					else
						$Results['ACC'] = -bindec($Stat_Counter);
				}
				$j++;
				$Stat_Counter = "";
			}
		}
		
		if(strlen($S) != 64){
			echo strlen($S);
			return "Stats NOT IN CORRECT FORMAT! <br>";
		}
		return $Results;
	}
?>