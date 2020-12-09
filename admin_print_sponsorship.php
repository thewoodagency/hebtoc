<?php

//ini_set('display_errors', 1);
//error_reporting(~0);
error_reporting(0);

//require ('includes/config.inc.php');
require ('includes/mysqli_connect.php');
require ('includes/functions.php');
session_start();

if(isset($_SESSION['admin']) && $_SESSION['admin'] == 'kashwin50@hotmail.com' && isset($_GET['rid']) && $_GET['rid'] <> '')
{
	$rid = validate_input($_GET['rid']);
	//echo $rid;
	echo getRegistration($rid);
	//echo getHotelInfo($rid);
	//echo getTennisInfo($rid);
    echo getTourAcademy($rid);
	echo getPrivateInfo2($rid);
	echo getPrivateDinner2($rid);
	echo getSummitInfo2($rid);
	echo getDinnerBuffetInfo2($rid);

    echo getTopGolf($rid, THIRD); //for third
	echo getCharityWorkInfo2($rid);
	echo getReceptionInfo12($rid);
	echo getReceptionInfo22($rid);
	echo getTableInfo($rid);

	echo getTopGolf($rid, FIFTH); //for fifth
    echo getGolf($rid);
	echo getSpaInfo2($rid);
	
} else {
	header("Location: login_proc.php");
	die();
}
?>
<style>
body {
	font-family: Verdana, Geneva, sans-serif;
	page-break-after: auto;
}
h3 {
	font-size: 14px;
}
h4 {
	font-size: 12px;
	text-decoration: underline;
}

table { /*page-break-after:always*/ }
    tr    { page-break-inside:avoid; page-break-after:auto }
.title {
	width: 300px;
	font-weight: bold;
}
#reg td {
	font-size: 13px;
}

td {
	font-size: 11px;
}
.putbg {
	background-color: #CCC;
	font-weight: bold;
}
</style>
