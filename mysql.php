<?php
// MYSQL
mysql_connect('localhost', 'root', 'PASSWORD');
mysql_select_db('DATABASE');

// CONFIG
$ppls_page = "100";
$sig_support = true;
$maxhiscorelevel = 99;
$sig_image = "http://localhost/highscores/images/sig.png";
$top_hiscore = 1000001;
$minlvltohiscore = 10;
$website = "http://localhost/highscores";
$images = "http://localhost/highscores/images/";
$file = "index.php";

// ARRAY REMEMBER ALWAYS START WITH MALL LETTER
$webbers	= array("");
$admins		= array("Delta", "Jeff");
$mods		= array("");
$high_mods	= array("");
$donators	= array("");
$banned		= array("");

// ICONS
$webbers_icon	= "http://img264.imageshack.us/img264/3287/moddws8.gif";
$admins_icon	= "http://i7.tinypic.com/8foy68l.gif";
$mods_icon	= "http://img264.imageshack.us/img264/3287/moddws8.gif";
$high_mods_icon	= "http://img264.imageshack.us/img264/3287/moddws8.gif";
$donators_icon	= "http://img243.imageshack.us/img243/5434/donnf7.gif";

// BBCODE
$webbers_code	= '<img src="'.$webbers_icon.'" border="0"> <b><font color="darkgreen">'; $webbers2_code	= '</font></b>';
$admins_code	= '<img src="'.$admins_icon.'" border="0"> <b><font color="darkblue">'; $admins2_code	= '</font></b>';
$mods_code	= '<img src="'.$mods_icon.'" border="0"> <b><font color="orange">'; $mods2_code	= '</font></b>';
$high_mods_code	= '<img src="'.$high_mods_icon.'" border="0"> <b><font color="silver">'; $high_mods2_code	= '</font></b>';
$donators_code	= '<img src="'.$donators_icon.'" border="0"> <b><font color="yellow">'; $donators2_code	= '</font></b>';
?>