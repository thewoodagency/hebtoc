<?php
ini_set('display_errors', 1);
error_reporting(~0);

require ('../../lib/config.php');
require ('../../lib/functions.php');

session_start();
require_once('../../lib/session.php');

if (isset($_SESSION['admin']) && $_SESSION['admin'] == TOCEMAIL)
{
	//$regEmail = validate_input2($_SESSION['email']);
	//$regID = $_SESSION['regid'];
	$noofPeople = validate_input($_POST['numRows']);
	//$golf = $_POST['golf'];

	for ($i=0; $i<$noofPeople; $i++)
	{
		//if (isset($_POST['first'.$i]) && $_POST['first'.$i]<>'')
		//
			$hid=validate_input($_POST['hid'.$i]);
      $loc=validate_input($_POST['dep'.$i]);
			if ($loc != '' && !is_null($loc))
			{
				$query = $connection->prepare('update toc_register set hebdepartment=:loc where idtoc_register=:hid');
				$query->bindParam('loc', $loc, PDO::PARAM_STR);
				$query->bindParam('hid', $hid, PDO::PARAM_STR);
				$query->execute();
			}
	} //end for
	//send_notice("hotel");
  $redirect = 'admin_panel.php';
	header('Location: '.$redirect);
	exit();
} else {
	header("Location: login_proc.php");
	die();
}

