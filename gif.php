<?php
include "mysql.php";
include "config.php";
if($_GET['playerName']) {
$query = mysql_query("SELECT * FROM skills WHERE playerName = '".addslashes($_GET['playerName'])."' LIMIT 1") or die(mysql_error());
$row = mysql_fetch_array($query);


if($row['playerName'] && $sig_support == "true") {

$playerName = ucwords($row['playerName']);
$Attack = getLevelForXP($row['Attackxp']); $Defence = getLevelForXP($row['Defencexp']); $Strength = getLevelForXP($row['Strengthxp']); $Hitpoints = getLevelForXP($row['Hitpointsxp']); $Range = getLevelForXP($row['Rangexp']); $Runecraft = getLevelForXP($row['Runecraftxp']); $Construction = getLevelForXP($row['Constructionxp']);
$Prayer = getLevelForXP($row['Prayerxp']); $Magic = getLevelForXP($row['Magicxp']); $Cooking = getLevelForXP($row['Cookingxp']); $Woodcutting = getLevelForXP($row['Woodcuttingxp']); $Fletching = getLevelForXP($row['Fletchingxp']); $Farming = getLevelForXP($row['Farmingxp']);
$Fishing = getLevelForXP($row['Fishingxp']); $Firemaking = getLevelForXP($row['Firemakingxp']); $Crafting = getLevelForXP($row['Craftingxp']); $Smithing = getLevelForXP($row['Smithingxp']); $Mining = getLevelForXP($row['Miningxp']);
$Herblore = getLevelForXP($row['Herblorexp']); $Agility = getLevelForXP($row['Agilityxp']); $Thieving = getLevelForXP($row['Thievingxp']); $Slayer = getLevelForXP($row['Slayerxp']);
$totalxp = $row['Attackxp'] + $row['Defencexp'] + $row['Strengthxp'] + $row['Hitpointsxp'] + $row['Rangexp'] + $row['Prayerxp'] + $row['Magicxp'] + $row['Cookingxp'] + $row['Woodcuttingxp'] + $row['Fletchingxp'] + $row['Fishingxp'] + $row['Firemakingxp'] + $row['Craftingxp'] + $row['Smithingxp'] + $row['Miningxp'] + $row['Herblorexp'] + $row['Agilityxp'] + $row['Thievingxp'] + $row['Slayerxp'] + $row['Farmingxp'] + $row['Runecraftxp'] + $row['Constructionxp'];
$totallvl = getLevelForXP($row['Attackxp']) + getLevelForXP($row['Defencexp']) + getLevelForXP($row['Strengthxp']) + getLevelForXP($row['Hitpointsxp']) + getLevelForXP($row['Rangexp']) + getLevelForXP($row['Prayerxp']) + getLevelForXP($row['Magicxp']) + getLevelForXP($row['Cookingxp']) + getLevelForXP($row['Woodcuttingxp']) + getLevelForXP($row['Fletchingxp']) + getLevelForXP($row['Fishingxp']) + getLevelForXP($row['Firemakingxp']) + getLevelForXP($row['Craftingxp']) + getLevelForXP($row['Smithingxp']) + getLevelForXP($row['Miningxp']) + getLevelForXP($row['Herblorexp']) + getLevelForXP($row['Agilityxp']) + getLevelForXP($row['Thievingxp']) + getLevelForXP($row['Slayerxp']) + getLevelForXP($row['Farmingxp']) + getLevelForXP($row['Runecraftxp']) + getLevelForXP($row['Constructionxp']);

$im = ImageCreateFromgif("http://img243.imageshack.us/img243/6295/pkislehc0.gif");
$sort = ImageColorAllocate($im,0,0,0);
imagettftext($im,9,0,16,30,$sort,"images/arial.ttf",$playerName." - Rank #".findRank($_GET['playerName'],"0"));
imagettftext($im,7,0,28,59,$sort,"images/arial.ttf",$Attack);
imagettftext($im,7,0,72,59,$sort,"images/arial.ttf",$Defence);
imagettftext($im,7,0,114,59,$sort,"images/arial.ttf",$Strength);
imagettftext($im,7,0,158,59,$sort,"images/arial.ttf",$Hitpoints);
imagettftext($im,7,0,203,59,$sort,"images/arial.ttf",$Range);
imagettftext($im,7,0,246,59,$sort,"images/arial.ttf",$Runecraft);
imagettftext($im,7,0,28,80,$sort,"images/arial.ttf",$Prayer);
imagettftext($im,7,0,72,80,$sort,"images/arial.ttf",$Magic);
imagettftext($im,7,0,114,80,$sort,"images/arial.ttf",$Cooking);
imagettftext($im,7,0,158,80,$sort,"images/arial.ttf",$Woodcutting);
imagettftext($im,7,0,203,80,$sort,"images/arial.ttf",$Fletching);
imagettftext($im,7,0,246,80,$sort,"images/arial.ttf",$Farming);
imagettftext($im,7,0,28,101,$sort,"images/arial.ttf",$Fishing);
imagettftext($im,7,0,72,101,$sort,"images/arial.ttf",$Firemaking);
imagettftext($im,7,0,114,101,$sort,"images/arial.ttf",$Crafting);
imagettftext($im,7,0,158,101,$sort,"images/arial.ttf",$Smithing);
imagettftext($im,7,0,203,101,$sort,"images/arial.ttf",$Mining);
imagettftext($im,7,0,28,122,$sort,"images/arial.ttf",$Herblore);
imagettftext($im,7,0,72,122,$sort,"images/arial.ttf",$Agility);
imagettftext($im,7,0,114,122,$sort,"images/arial.ttf",$Thieving);
imagettftext($im,7,0,158,122,$sort,"images/arial.ttf",$Slayer);
imagettftext($im,7,0,185,122,$sort,"images/arial.ttf",dots($totalxp));
imagettftext($im,7,0,230,102,$sort,"images/arial.ttf",dots($totallvl));
header("Content-type: image/gif");
Imagegif($im);
ImageDestroy($im);
}
}
?>