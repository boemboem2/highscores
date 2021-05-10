<?php
include("mysql.php");

function getLevelForXP($xp) {
	$lvl =1;
	if(!$xp || $xp==0) $xp = 1;

	while($xp > $output){
		$points = $points + floor($lvl + 300 * pow(2, ($lvl / 7)));
		$output = floor($points / 4);
		if($lvl > 99){
			return 99;
			break;
		} else if($xp < 83){
			return 1;
			break;
		} else if($output >= $xp){
			return $lvl;
			break;
		}
		$lvl++;
	}
}

function findType($type) {
	if($type == "") {
		return "Hitpoints";
	} else if($type == "0") {
		return "Hitpoints";
	} else if($type == "1") {
		return "Attack";
	} else if($type == "2") {
		return "Defence";
	} else if($type == "3") {
		return "Strength";
	} else if($type == "4") {
		return "Hitpoints";
	} else if($type == "5") {
		return "Range";
	} else if($type == "6") {
		return "Prayer";
	} else if($type == "7") {
		return "Magic";
	} else if($type == "8") {
		return "Cooking";
	} else if($type == "9") {
		return "Woodcutting";
	} else if($type == "10") {
		return "Fletching";
	} else if($type == "11") {
		return "Fishing";
	} else if($type == "12") {
		return "Firemaking";
	} else if($type == "13") {
		return "Crafting";
	} else if($type == "14") {
		return "Smithing";
	} else if($type == "15") {
		return "Mining";
	} else if($type == "16") {
		return "Herblore";
	} else if($type == "17") {
		return "Agility";
	} else if($type == "18") {
		return "Thieving";
	} else if($type == "19") {
		return "Slayer";
	} else if($type == "20") {
		return "Farming";
	} else if($type == "21") {
		return "Runecraft";
	} else if($type == "22") {
		return "Hunter";
	} else if($type == "23") {
		return "Construction";
	} else if($type == "24") {
		return "Summoning";
	}
}

function fixName($name) {
	return strtolower($name);
}

function dots($num) {
	if($num) {
		$num = number_format($num);
	} else {
		$num = "0";
	}
	return $num;
}

function findRank($playerName,$skill) {
	include "mysql.php";
	$playerName = fixName($playerName);
	if(!$top_hiscore) { $top_hiscore = "101"; }
	if($skill != "0") {
		$i=1;
		$xptype = findType($skill)."xp";
		$query = mysql_query("SELECT * FROM skills ORDER BY $xptype DESC") or die(mysql_error());

		while($row = mysql_fetch_array($query)){
			if (!in_array(fixName($row["playerName"]), $banned)) {
				if(fixName($row["playerName"]) == $playerName) {
					if($i > $top_hiscore) {
						return "Not Ranked";
					} else {
						return $i;
					}
				}
				$i++;
			}
		}
	} else {
		$i=1;
		$query = mysql_query ("SELECT * FROM skillsoverall ORDER BY lvl DESC") or die(mysql_error());
		while($row = mysql_fetch_array($query)){
			if (!in_array(fixName($row["playerName"]), $banned)) {
				if(fixName($row["playerName"]) == $playerName) {
					if($i > $top_hiscore) {
						return "Not Ranked";
					} else {
						return $i;
					}
				}
				$i++;
			}
		}
	}
}

function BBCode($playerName) {
	include "mysql.php";
	if (in_array(fixName($playerName), $webbers)) {
		return $webbers_code.ucwords($playerName).$webbers2_code;
	} else if (in_array(fixName($playerName), $admins)) {
		return $admins_code.ucwords($playerName).$admins2_code;
	} else if (in_array(fixName($playerName), $high_mods)) {
		return $high_mods_code.ucwords($playerName).$high_mods2_code;
	} else if (in_array(fixName($playerName), $mods)) {
		return $mods_code.ucwords($playerName).$mods2_code;
	} else if (in_array(fixName($playerName), $donators)) {
		return $donators_code.ucwords($playerName).$donators2_code;
	} else {
		return ucwords($playerName);
	}
}

function showSig($playerName) {
	include "mysql.php";
	if($sig_support == "true") {
		$query = mysql_query("SELECT * FROM skills WHERE playerName = '".$playerName."' LIMIT 1") or die(mysql_error());
		$row = mysql_fetch_array($query);
		if(isset($playerName) && isset($row["playerName"]) && !in_array(fixName($row["playerName"]), $banned)) {
			echo "Use this image link to show your signature<br />";
			echo "<input type='text' size='100' value='".$website."/image.php?playerName=".$playerName."' class='button'><br /><br />";
			echo "<b>Demo:</b><br />";
			echo "<img src='".$website."/image.php?playerName=".$playerName."'>";
		} else {
			echo "The user dosent exist";
		}
	} else {
		echo "Signatures isent supported.";
	}
}

function OverallHiscore() {
	include "mysql.php";
	if(!$top_hiscore) { $top_hiscore = "101"; }
		echo '<table border="0" width="100%">
<tr>
<td align="center"><b>Overall Hiscores</b></td>
</tr>
</table>
<table border="0" width="100%">
<tr>
<td align="right" width="40"><b>Rank</b></td>
<td align="left"><b>Name</b></td>
<td align="center" width="50"><b>Level</b></td>
<td align="right" width="100"><b>XP</b></td>
</tr>
';
		$count = mysql_result(mysql_query("SELECT COUNT(*) FROM skillsoverall"),0) or die(mysql_error());
		$from = (isset($_GET["from"]) && is_numeric($_GET["from"]) && $_GET["from"] < $count) ? $_GET["from"] : 0;
		$query = mysql_query ("SELECT * FROM skillsoverall ORDER BY lvl DESC limit $from, $ppls_page") or die(mysql_error());
		$i = $from;
		while($row = mysql_fetch_array($query)){
		$i++;
		if($i < $top_hiscore) {
		echo '<tr>
<td align="right">'.$i.'</td>
<td align="left"><a href="'.$website.'/'.$file.'?name='.$row["playerName"].'" target="_self">'.BBCode($row["playerName"]).'</a></td>
<td align="center">'.dots($row["lvl"]).'</td>
<td align="right">'.dots($row["xp"]).'</td>
</tr>
';
		}
		}
		echo '</table>
';
		if($count >= $ppls_page) {
		echo '<table border="0" width="100%">
		<tr>
		<td align="center">
';
		if ($from > 0) {
			$back= $from - $ppls_page;
			echo '<a href="'.$website.'/'.$file.'?type=0&from='.$back.'"><b>Back</b></a> ';
		}
		$page = 1;

		for ($start = 0; $count > $start; $start = $start + $ppls_page) {
			if($from != $page * $ppls_page - $ppls_page) {
				if($start < $top_hiscore) {
					echo '<a href="'.$website.'/'.$file.'?type=0&from='.$start.'"><b>'.$page.'</b></a> ';
				}
			} else {
				echo $page.' ';
			}
			$page++;
		}

		if ($from < $count - $ppls_page || $from < $top_hiscore) {
			$next = $from + $ppls_page;
			if($next < $top_hiscore) {
				echo ' <a href="'.$website.'/'.$file.'?type=0&from='.$next.'"><b>Next</b></a>';
			}
		}
		echo "</td>
</tr>
</table>";
		}
}

function showPlayers($type) {
	include "mysql.php";
	if(!$top_hiscore) { $top_hiscore = "101"; }
	echo '<table border="0" width="100%">
<tr>
<td align="center"><img src="'.$website.'/images/'.strtolower(findType($type)).'.gif"> <b>Hiscore for '.ucwords(findType($type)).'</b></td>
</tr>
</table>
<table border="0" width="100%">
<tr>
<td align="right" width="40"><b>Rank</b></td>
<td align="left"><b>Name</b></td>
<td align="center" width="50"><b>Level</b></td>
<td align="right" width="100"><b>XP</b></td>
</tr>
';

	$xptype = findType($type)."xp";
	$count = mysql_result(mysql_query("SELECT COUNT(*) FROM skills"),0) or die(mysql_error());
	$from = (isset($_GET["from"]) && is_numeric($_GET["from"]) && $_GET["from"] < $count) ? $_GET["from"] : 0;
	$query = mysql_query ("SELECT * FROM skills ORDER BY $xptype DESC limit $from, $ppls_page") or die(mysql_error());
	$i = $from;
	while($row = mysql_fetch_array($query)){
	$i++;
		if($i < $top_hiscore && !in_array($row["playerName"], $banned) && !in_array(ucwords($row["playerName"]), $banned)) {
			echo '<tr>
<td align="right">'.$i.'</td>
<td align="left"><a href="'.$website.'/'.$file.'?name='.$row["playerName"].'" target="_self">'.BBCode($row["playerName"]).'</a></td>
<td align="center">'.getLevelForXP($row[$xptype]).'</td>
<td align="right">'.dots($row[$xptype]).'</td>
</tr>
';
		}
	}
	echo '</table>
';
	if($count >= $ppls_page) {
	echo '<table border="0" width="100%">
<tr>
<td align="center">
';
	if ($from > 0) {
		$back= $from - $ppls_page;
		echo '<a href="'.$website.'/'.$file.'?type='.$_GET["type"].'&from='.$back.'"><b>Back</b></a> ';
	}
	$page = 1;
		for ($start = 0; $count > $start; $start = $start + $ppls_page) {
		if($from != $page * $ppls_page - $ppls_page) {
			if($start < $top_hiscore) {
				echo '<a href="'.$website.'/'.$file.'?type='.$_GET["type"].'&from='.$start.'"><b>'.$page.'</b></a> ';
			}
		} else {
			echo $page." ";
		}
		$page++;
	}

	if ($from < $count - $ppls_page || $from < $top_hiscore) {
		$next = $from + $ppls_page;
		if($next < $top_hiscore) {
			echo ' <a href="'.$website.'/'.$file.'?type='.$_GET["type"].'&from='.$next.'"><b>Next</b></a>';
		}
	}
	echo "</td>
</tr>
</table>";
	}
}

function showPlayer($name) {
	include "mysql.php";
	$query = mysql_query("SELECT * FROM skills WHERE playerName LIKE '".fixName($name)."' LIMIT 1") or die(mysql_error());
	$row = mysql_fetch_array($query);
	$overall["lvl"] = getLevelForXP($row["Attackxp"]) + getLevelForXP($row["Defencexp"]) + getLevelForXP($row["Strengthxp"]) + getLevelForXP($row["Hitpointsxp"]) + getLevelForXP($row["Rangexp"]) + getLevelForXP($row["Prayerxp"]) + getLevelForXP($row["Magicxp"]) + getLevelForXP($row["Cookingxp"]) + getLevelForXP($row["Woodcuttingxp"]) + getLevelForXP($row["Fletchingxp"]) + getLevelForXP($row["Fishingxp"]) + getLevelForXP($row["Firemakingxp"]) + getLevelForXP($row["Craftingxp"]) + getLevelForXP($row["Smithingxp"]) + getLevelForXP($row["Miningxp"]) + getLevelForXP($row["Herblorexp"]) + getLevelForXP($row["Agilityxp"]) + getLevelForXP($row["Thievingxp"]) + getLevelForXP($row["Slayerxp"]) + getLevelForXP($row["Farmingxp"]) + getLevelForXP($row["Runecraftxp"]) + getLevelForXP($row["Hunterxp"]) + getLevelForXP($row["Constructionxp"]) + getLevelForXP($row["Summoningxp"]);
	$overall["xp"] = $row["Attackxp"] + $row["Defencexp"] + $row["Strengthxp"] + $row["Hitpointsxp"] + $row["Rangexp"] + $row["Prayerxp"] + $row["Magicxp"] + $row["Cookingxp"] + $row["Woodcuttingxp"] + $row["Fletchingxp"] + $row["Fishingxp"] + $row["Firemakingxp"] + $row["Craftingxp"] + $row["Smithingxp"] + $row["Miningxp"] + $row["Herblorexp"] + $row["Agilityxp"] + $row["Thievingxp"] + $row["Slayerxp"] + $row["Farmingxp"] + $row["Runecraftxp"] + $row["Hunterxp"] + $row["Constructionxp"] + $row["Summoningxp"];
	echo '<table border="0" width="100%">
<tr>
<td align="center"><b>Personal stats for '.BBCode($name).'</b></td>
</tr>
</table>
';
	if(!isset($row["playerName"])) {
		echo '<table border="0" width="100%">
<tr>
<td>
<table border="0" width="100%">
<tr>
<td width="20"></td>
<td><b>Skill</b></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/overall.png"></td>
<td><a href="'.$website.'/'.$file.'" target="_self">Overall</a></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/attack.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=1" target="_self">Attack</a></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/defence.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=2" target="_self">Defence</a></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/strength.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=3" target="_self">Strength</a></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/hitpoints.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=4" target="_self">Hitpoints</a></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/range.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=5" target="_self">Ranged</a></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/prayer.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=6" target="_self">Prayer</a></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/magic.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=7" target="_self">Magic</a></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/cooking.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=8" target="_self">Cooking</a></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/woodcutting.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=9" target="_self">Woodcutting</a></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/fletching.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=10" target="_self">Fletching</a></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/fishing.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=11" target="_self">Fishing</a></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/firemaking.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=12" target="_self">Firemaking</a></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/crafting.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=13" target="_self">Crafting</a></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/smithing.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=14" target="_self">Smithing</a></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/mining.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=15" target="_self">Mining</a></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/herblore.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=16" target="_self">Herblore</a></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/agility.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=17" target="_self">Agility</a></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/thieving.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=18" target="_self">Thieving</a></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/slayer.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=19" target="_self">Slayer</a></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/farming.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=20" target="_self">Farming</a></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/runecraft.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=21" target="_self">Runecraft</a></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/hunter.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=22" target="_self">Hunter</a></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/construction.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=23" target="_self">Construction</a></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/summoning.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=24" target="_self">Summoning</a></td>
</tr>
</table>
</td>
<td>'.ucwords($_GET["name"]).' is not on the hiscore.</td>
</tr>
</table>';
	} else if (!in_array($row["playerName"], $banned) && !in_array(ucwords($row["playerName"]), $banned)) {
		echo '<table border="0" width="100%">
<tr>
<td width="20"></td>
<td><b>Skill</b></td>
<td align="center" width="100"><b>Rank</b></td>
<td align="center" width="50"><b>Level</b></td>
<td align="right" width="100"><b>XP</b></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/overall.png"></td>
<td><a href="'.$website.'/'.$file.'" target="_self">Overall</a></td>
<td align="center" width="100">'.findRank($_GET["name"],"0").'</td>
<td align="center"><b>'.dots($overall["lvl"]).'</b></td>
<td align="right"><b>'.dots($overall["xp"]).'</b></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/attack.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=1" target="_self">Attack</a></td>
<td align="center" width="100">'.findRank($_GET["name"],"1").'</td>
<td align="center"><b>'.getLevelForXP($row["Attackxp"]).'</b></td>
<td align="right"><b>'.dots($row["Attackxp"]).'</b></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/defence.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=2" target="_self">Defence</a></td>
<td align="center" width="100">'.findRank($_GET["name"],"2").'</td>
<td align="center"><b>'.getLevelForXP($row["Defencexp"]).'</b></td>
<td align="right"><b>'.dots($row["Defencexp"]).'</b></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/strength.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=3" target="_self">Strength</a></td>
<td align="center" width="100">'.findRank($_GET["name"],"3").'</td>
<td align="center"><b>'.getLevelForXP($row["Strengthxp"]).'</b></td>
<td align="right"><b>'.dots($row["Strengthxp"]).'</b></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/hitpoints.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=4" target="_self">Hitpoints</a></td>
<td align="center" width="100">'.findRank($_GET["name"],"4").'</td>
<td align="center"><b>'.getLevelForXP($row["Hitpointsxp"]).'</b></td>
<td align="right"><b>'.dots($row["Hitpointsxp"]).'</b></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/range.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=5" target="_self">Ranged</a></td>
<td align="center" width="100">'.findRank($_GET["name"],"5").'</td>
<td align="center"><b>'.getLevelForXP($row["Rangexp"]).'</b></td>
<td align="right"><b>'.dots($row["Rangexp"]).'</b></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/prayer.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=6" target="_self">Prayer</a></td>
<td align="center" width="100">'.findRank($_GET["name"],"6").'</td>
<td align="center"><b>'.getLevelForXP($row["Prayerxp"]).'</b></td>
<td align="right"><b>'.dots($row["Prayerxp"]).'</b></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/magic.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=7" target="_self">Magic</a></td>
<td align="center" width="100">'.findRank($_GET["name"],"7").'</td>
<td align="center"><b>'.getLevelForXP($row["Magicxp"]).'</b></td>
<td align="right"><b>'.dots($row["Magicxp"]).'</b></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/cooking.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=8" target="_self">Cooking</a></td>
<td align="center" width="100">'.findRank($_GET["name"],"8").'</td>
<td align="center"><b>'.getLevelForXP($row["Cookingxp"]).'</b></td>
<td align="right"><b>'.dots($row["Cookingxp"]).'</b></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/woodcutting.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=9" target="_self">Woodcutting</a></td>
<td align="center" width="100">'.findRank($_GET["name"],"9").'</td>
<td align="center"><b>'.getLevelForXP($row["Woodcuttingxp"]).'</b></td>
<td align="right"><b>'.dots($row["Woodcuttingxp"]).'</b></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/fletching.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=10" target="_self">Fletching</a></td>
<td align="center" width="100">'.findRank($_GET["name"],"10").'</td>
<td align="center"><b>'.getLevelForXP($row["Fletchingxp"]).'</b></td>
<td align="right"><b>'.dots($row["Fletchingxp"]).'</b></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/fishing.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=11" target="_self">Fishing</a></td>
<td align="center" width="100">'.findRank($_GET["name"],"11").'</td>
<td align="center"><b>'.getLevelForXP($row["Fishingxp"]).'</b></td>
<td align="right"><b>'.dots($row["Fishingxp"]).'</b></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/firemaking.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=12" target="_self">Firemaking</a></td>
<td align="center" width="100">'.findRank($_GET["name"],"12").'</td>
<td align="center"><b>'.getLevelForXP($row["Firemakingxp"]).'</b></td>
<td align="right"><b>'.dots($row["Firemakingxp"]).'</b></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/crafting.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=13" target="_self">Crafting</a></td>
<td align="center" width="100">'.findRank($_GET["name"],"13").'</td>
<td align="center"><b>'.getLevelForXP($row["Craftingxp"]).'</b></td>
<td align="right"><b>'.dots($row["Craftingxp"]).'</b></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/smithing.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=14" target="_self">Smithing</a></td>
<td align="center" width="100">'.findRank($_GET["name"],"14").'</td>
<td align="center"><b>'.getLevelForXP($row["Smithingxp"]).'</b></td>
<td align="right"><b>'.dots($row["Smithingxp"]).'</b></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/mining.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=15" target="_self">Mining</a></td>
<td align="center" width="100">'.findRank($_GET["name"],"15").'</td>
<td align="center"><b>'.getLevelForXP($row["Miningxp"]).'</b></td>
<td align="right"><b>'.dots($row["Miningxp"]).'</b></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/herblore.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=16" target="_self">Herblore</a></td>
<td align="center" width="100">'.findRank($_GET["name"],"16").'</td>
<td align="center"><b>'.getLevelForXP($row["Herblorexp"]).'</b></td>
<td align="right"><b>'.dots($row["Herblorexp"]).'</b></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/agility.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=17" target="_self">Agility</a></td>
<td align="center" width="100">'.findRank($_GET["name"],"17").'</td>
<td align="center"><b>'.getLevelForXP($row["Agilityxp"]).'</b></td>
<td align="right"><b>'.dots($row["Agilityxp"]).'</b></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/thieving.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=18" target="_self">Thieving</a></td>
<td align="center" width="100">'.findRank($_GET["name"],"18").'</td>
<td align="center"><b>'.getLevelForXP($row["Thievingxp"]).'</b></td>
<td align="right"><b>'.dots($row["Thievingxp"]).'</b></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/slayer.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=19" target="_self">Slayer</a></td>
<td align="center" width="100">'.findRank($_GET["name"],"19").'</td>
<td align="center"><b>'.getLevelForXP($row["Slayerxp"]).'</b></td>
<td align="right"><b>'.dots($row["Slayerxp"]).'</b></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/farming.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=20" target="_self">Farming</a></td>
<td align="center" width="100">'.findRank($_GET["name"],"20").'</td>
<td align="center"><b>'.getLevelForXP($row["Farmingxp"]).'</b></td>
<td align="right"><b>'.dots($row["Farmingxp"]).'</b></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/runecraft.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=21" target="_self">Runecraft</a></td>
<td align="center" width="100">'.findRank($_GET["name"],"21").'</td>
<td align="center"><b>'.getLevelForXP($row["Runecraftxp"]).'</b></td>
<td align="right"><b>'.dots($row["Runecraftxp"]).'</b></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/hunter.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=22" target="_self">Hunter</a></td>
<td align="center" width="100">'.findRank($_GET["name"],"22").'</td>
<td align="center"><b>'.getLevelForXP($row["Hunterxp"]).'</b></td>
<td align="right"><b>'.dots($row["Hunterxp"]).'</b></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/construction.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=23" target="_self">Construction</a></td>
<td align="center" width="100">'.findRank($_GET["name"],"23").'</td>
<td align="center"><b>'.getLevelForXP($row["Constructionxp"]).'</b></td>
<td align="right"><b>'.dots($row["Constructionxp"]).'</b></td>
</tr><tr>
<td width="20"><img src="'.$website.'/images/summoning.gif"></td>
<td><a href="'.$website.'/'.$file.'?type=24" target="_self">Summoning</a></td>
<td align="center" width="100">'.findRank($_GET["name"],"24").'</td>
<td align="center"><b>'.getLevelForXP($row["Summoningxp"]).'</b></td>
<td align="right"><b>'.dots($row["Summoningxp"]).'</b></td>
</tr>
</table>
';
		if($sig_support == "true") {
			echo ucwords($_GET["name"]).'s Signature<br />
<img src="'.$website.'/image.php?playerName='.$_GET["name"].'">';
		}
	} else {
		echo "This user has been banned from hiscore";
	}
}
?>