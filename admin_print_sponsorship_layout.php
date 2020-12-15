<style>
body {
	font-family: Verdana, Geneva, sans-serif;
}
h3 {
	font-size: 14px;
}
h4 {
	font-size: 12px;
	text-decoration: underline;
}
.title {
	width: 300px;
	font-weight: bold;
}
td {
	font-size: 12px;
}
.putbg {
	background-color: #CCC;
	font-weight: bold;
}
</style>
<?php

//ini_set('display_errors', 1);
//error_reporting(~0);

//require ('../../lib/config.inc.php');
require ('../../lib/mysqli_connect.php');
require ('../../lib/functions.php');
session_start();

if(isset($_SESSION['admin']) && $_SESSION['admin'] == 'kashwin50@hotmail.com' && isset($_GET['rid']) && $_GET['rid'] <> '')
{
	$rid = $_GET['rid'];
	echo getRegistration($rid);
	echo '<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td width="50%">';
	echo getHotelInfo($rid);
	echo '</td><td>';
	echo getTennisInfo($rid);
	echo '</td></tr><tr><td>';
	echo getPrivateInfo($rid);
	echo '</td><td>';
	echo getSummitInfo($rid);
	echo '</td></tr><tr><td>';
	echo getDinnerBuffetInfo($rid);
	echo '</td><td>';
	echo getCharityWorkInfo($rid);
	echo '</td></tr><tr><td>';
	echo getReceptionInfo1($rid);
	echo '</td><td>';
	echo getReceptionInfo2($rid);
	echo '</td></tr><tr><td>';
	echo getTableInfo($rid);
	echo '</td><td>';
	echo getGolfInfo($rid);
	echo '</td></tr></table>';
	
} else {
	header("Location: login_proc.php");
	die();
}
?>
