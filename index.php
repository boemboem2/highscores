<?php
ob_start();
include "mysql.php";
include "config.php";
?>
<title>HighScore OverloadX</title>
<body bgcolor="#99CCCC">
<style>
a, a:link, a:visited, a:active {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-style: normal;
	color: #000000;
	text-decoration: none;
}
a:hover {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-style: normal;
	color: #000000;
	text-decoration: underline;
}
body, p, td {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-style: normal;
	color: #000000;
	text-decoration: none;
}
input {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #000000;
	text-decoration: none;
	text-align: center;
	background-color: #FFFFFF;
	border-bottom: 1px solid #000000;
	border-top-style: none;
	border-right-style: none;
	border-left-style: none;
}
button, .button {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #FFFFFF;
	text-decoration: none;
	background-color: #000000;
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
	border-top-color: #FFFFFF;
	border-right-color: #FFFFFF;
	border-bottom-color: #FFFFFF;
	border-left-color: #FFFFFF;
}
</style>
<table border="0" width="100%">
<tr>
	<td width="10%" valign="top">
		<? if(!$_GET['name']) { ?>
		<table border="0" width="100%">
		<tr>
			<td width="20"><img src="<?=$website?>/images/overall.png"></td>
			<td><a href="<?=$website?>/<?=$file?>" target="_self"><b>Overall</b></a></td>
		</tr><tr>
			<td width="20"><img src="<?=$website?>/images/attack.gif"></td>
			<td><? if($_GET['type'] == "1") { echo "Attack"; } else { echo "<a href=\"".$website."/".$file."?type=1\" target=\"_self\">Attack</a>"; } ?></td>
		</tr><tr>
			<td width="20"><img src="<?=$website?>/images/defence.gif"></td>
			<td><? if($_GET['type'] == "2") { echo "Defence"; } else { echo "<a href=\"".$website."/".$file."?type=2\" target=\"_self\">Defence</a>"; } ?></td>
		</tr><tr>
			<td width="20"><img src="<?=$website?>/images/strength.gif"></td>
			<td><? if($_GET['type'] == "3") { echo "Strength"; } else { echo "<a href=\"".$website."/".$file."?type=3\" target=\"_self\">Strength</a>"; } ?></td>
		</tr><tr>
			<td width="20"><img src="<?=$website?>/images/hitpoints.gif"></td>
			<td><? if($_GET['type'] == "4") { echo "Hitpoints"; } else { echo "<a href=\"".$website."/".$file."?type=4\" target=\"_self\">Hitpoints</a>"; } ?></td>
		</tr><tr>
			<td width="20"><img src="<?=$website?>/images/range.gif"></td>
			<td><? if($_GET['type'] == "5") { echo "Ranged"; } else { echo "<a href=\"".$website."/".$file."?type=5\" target=\"_self\">Ranged</a>"; } ?></td>
		</tr><tr>
			<td width="20"><img src="<?=$website?>/images/prayer.gif"></td>
			<td><? if($_GET['type'] == "6") { echo "Prayer"; } else { echo "<a href=\"".$website."/".$file."?type=6\" target=\"_self\">Prayer</a>"; } ?></td>
		</tr><tr>
			<td width="20"><img src="<?=$website?>/images/magic.gif"></td>
			<td><? if($_GET['type'] == "7") { echo "Magic"; } else { echo "<a href=\"".$website."/".$file."?type=7\" target=\"_self\">Magic</a>"; } ?></td>
		</tr><tr>
			<td width="20"><img src="<?=$website?>/images/cooking.gif"></td>
			<td><? if($_GET['type'] == "8") { echo "Cooking"; } else { echo "<a href=\"".$website."/".$file."?type=8\" target=\"_self\">Cooking</a>"; } ?></td>
		</tr><tr>
			<td width="20"><img src="<?=$website?>/images/woodcutting.gif"></td>
			<td><? if($_GET['type'] == "9") { echo "Woodcutting"; } else { echo "<a href=\"".$website."/".$file."?type=9\" target=\"_self\">Woodcutting</a>"; } ?></td>
		</tr><tr>
			<td width="20"><img src="<?=$website?>/images/fletching.gif"></td>
			<td><? if($_GET['type'] == "10") { echo "Fletching"; } else { echo "<a href=\"".$website."/".$file."?type=10\" target=\"_self\">Fletching</a>"; } ?></td>
		</tr><tr>
			<td width="20"><img src="<?=$website?>/images/fishing.gif"></td>
			<td><? if($_GET['type'] == "11") { echo "Fishing"; } else { echo "<a href=\"".$website."/".$file."?type=11\" target=\"_self\">Fishing</a>"; } ?></td>
		</tr><tr>
			<td width="20"><img src="<?=$website?>/images/firemaking.gif"></td>
			<td><? if($_GET['type'] == "12") { echo "Firemaking"; } else { echo "<a href=\"".$website."/".$file."?type=12\" target=\"_self\">Firemaking</a>"; } ?></td>
		</tr><tr>
			<td width="20"><img src="<?=$website?>/images/crafting.gif"></td>
			<td><? if($_GET['type'] == "13") { echo "Crafting"; } else { echo "<a href=\"".$website."/".$file."?type=13\" target=\"_self\">Crafting</a>"; } ?></td>
		</tr><tr>
			<td width="20"><img src="<?=$website?>/images/smithing.gif"></td>
			<td><? if($_GET['type'] == "14") { echo "Smithing"; } else { echo "<a href=\"".$website."/".$file."?type=14\" target=\"_self\">Smithing</a>"; } ?></td>
		</tr><tr>
			<td width="20"><img src="<?=$website?>/images/mining.gif"></td>
			<td><? if($_GET['type'] == "15") { echo "Mining"; } else { echo "<a href=\"".$website."/".$file."?type=15\" target=\"_self\">Mining</a>"; } ?></td>
		</tr><tr>
			<td width="20"><img src="<?=$website?>/images/herblore.gif"></td>
			<td><? if($_GET['type'] == "16") { echo "Herblore"; } else { echo "<a href=\"".$website."/".$file."?type=16\" target=\"_self\">Herblore</a>"; } ?></td>
		</tr><tr>
			<td width="20"><img src="<?=$website?>/images/agility.gif"></td>
			<td><? if($_GET['type'] == "17") { echo "Agility"; } else { echo "<a href=\"".$website."/".$file."?type=17\" target=\"_self\">Agility</a>"; } ?></td>
		</tr><tr>
			<td width="20"><img src="<?=$website?>/images/thieving.gif"></td>
			<td><? if($_GET['type'] == "18") { echo "Thieving"; } else { echo "<a href=\"".$website."/".$file."?type=18\" target=\"_self\">Thieving</a>"; } ?></td>
		</tr><tr>
			<td width="20"><img src="<?=$website?>/images/slayer.gif"></td>
			<td><? if($_GET['type'] == "19") { echo "Slayer"; } else { echo "<a href=\"".$website."/".$file."?type=19\" target=\"_self\">Slayer</a>"; } ?></td>
		</tr><tr>
			<td width="20"><img src="<?=$website?>/images/farming.gif"></td>
			<td><? if($_GET['type'] == "20") { echo "Farming"; } else { echo "<a href=\"".$website."/".$file."?type=20\" target=\"_self\">Farming</a>"; } ?></td>
		</tr><tr>
			<td width="20"><img src="<?=$website?>/images/runecraft.gif"></td>
			<td><? if($_GET['type'] == "21") { echo "Runecraft"; } else { echo "<a href=\"".$website."/".$file."?type=21\" target=\"_self\">Runecraft</a>"; } ?></td>
		</tr><tr>
			<td width="20"><img src="<?=$website?>/images/hunter.gif"></td>
			<td><? if($_GET['type'] == "22") { echo "Hunter"; } else { echo "<a href=\"".$website."/".$file."?type=22\" target=\"_self\">Hunter</a>"; } ?></td>
		</tr><tr>
			<td width="20"><img src="<?=$website?>/images/construction.gif"></td>
			<td><? if($_GET['type'] == "23") { echo "Constrution"; } else { echo "<a href=\"".$website."/".$file."?type=23\" target=\"_self\">Construction</a>"; } ?></td>
		</tr><tr>
			<td width="20"><img src="<?=$website?>/images/summoning.gif"></td>
			<td><? if($_GET['type'] == "24") { echo "Summoning"; } else { echo "<a href=\"".$website."/".$file."?type=24\" target=\"_self\">Summoning</a>"; } ?></td>
		</tr>
		</table>
		<? } else { ?>
		<table border="0" width="100%">
		<tr>
			<td><a href="<?=$website?>/<?=$file?>" target="_self">Back</a></td>
		</tr>
		</table>
		<? } ?>
	</td>
	<td width="80%" valign="top" align="center">
		<?
		if(!$_GET['playerName']) {
			if(!$_GET['name']) {
				if($_GET['type'] != "0" && $_GET['type'] != "") {
					showPlayers($_GET['type']);
				} else {
					OverallHiscore();
				}
			} else {
				showPlayer($_GET['name']);
			}
		} else {
			showSig($_GET['playerName']);
		}
		?>
	</td>
	<td width="10%" valign="top">
		<table border="0" width="100%">
		<tr>
			<td align="center"><b>Search by name</b></td>
		</tr>
		<tr>
			<td align="center"><input type="input" size="11" name="character" id="character"></td>
		</tr>
		<tr>
			<td align="center"><button onclick="if(document.getElementById('character').value) { location.href = '<?=$website?>/<?=$file?>?name='+document.getElementById('character').value; } else { alert('Please write a name'); }">Search</button></td>
		</tr>
		<tr>
			<td></td>
		</tr>
		<?
		if($sig_support == "true") {
		?>
		<tr>
			<td align="center"><b>Create Signature</b></td>
		</tr>
		<tr>
			<td align="center"><input type="input" size="11" name="character2" id="character2"></td>
		</tr>
		<tr>
			<td align="center"><button onclick="if(document.getElementById('character2').value) { location.href = '<?=$website?>/<?=$file?>?playerName='+document.getElementById('character2').value; } else { alert('Please write a name'); }">Create</button></td>
		</tr>
		<?
		}
		?>
		</table>
	</td>
</tr>
</table>
</body>