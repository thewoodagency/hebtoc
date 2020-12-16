<?php
ini_set('display_errors', 1);
error_reporting(~0);
//error_reporting(E_ALL);


//require ('../../lib/config.inc.php');
require('../../lib/config.php');
require('../../lib/functions.php');

session_start();
require_once('../../lib/session.php');

if (isset($_SESSION['admin']) && $_SESSION['admin'] == TOCEMAIL) {
	//$regEmail = validate_input2($_SESSION['email']);
	//$regID = $_SESSION['regid'];
	$noofPeople = validate_input($_POST['numRows']);
	//$golf = $_POST['golf'];

	for ($i = 0; $i < $noofPeople; $i++) {
		//if (isset($_POST['first'.$i]) && $_POST['first'.$i]<>'')
		//
		$hid = validate_input($_POST['hid' . $i]);
		$loc = validate_input($_POST['cloc' . $i]);
		if ($loc != '' && !is_null($loc)) {
			// $qString = sprintf(
			// 	'update toc_events set toc_charity_loc = "%s" where hid = "%s"',
			// 	$dbc->real_escape_string($loc),
			// 	$dbc->real_escape_string($hid)
			// );
			// $dbc->query($qString);

			$query = $connection->prepare('update toc_events set toc_charity_loc=:loc where hid =:hid');
			$query->bindParam('loc', $loc, PDO::PARAM_STR);
			$query->bindParam('hid', $hid, PDO::PARAM_STR);
			$query->execute();
		}
	} //end for
	//send_notice("hotel");
	$redirect = 'admin_charity_n.php';
	header('Location: ' . $redirect);
	exit();
} else {
	header("Location: login_proc.php");
	die();
}
