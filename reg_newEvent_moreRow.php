<?php
ini_set('display_errors', 1);
error_reporting(~0);
//error_reporting(E_ALL);


//require ('./includes/config.inc.php');
require ('./includes/mysqli_connect.php');
require ('./includes/functions.php');

session_start();

$sp='';
if(isset($_GET['sp']))
{
    $sp = $_GET['sp'];
}

if(isset($_SESSION['email']))
{
	$regEmail = $_SESSION['email'];
	$regID = $_SESSION['regid'];
	$tocadd = getExtraRows($regID) + 5; //get current toc_add value + 5 new rows;

	$qString = sprintf('update toc_events set toc_add = "%s" where toc_regid = "%s"',
			$dbc->real_escape_string($tocadd),
			$dbc->real_escape_string($regID));
    $dbc->query($qString);
    //echo $qString;
	$dbc->close();
	//send_notice("hotel");
    if ($sp=='broker') {
        header("Location: reg_newEvent_broker.php");
    } else if ($sp=='broker100') {
        header("Location: reg_newEvent_broker_100.php");
    } else {
        header("Location: reg_newEvent.php");
    }
	exit();
} else {
	header("Location: login_proc.php");
	die();
}
