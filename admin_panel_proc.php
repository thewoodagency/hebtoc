<?php
ini_set('display_errors', 1);
error_reporting(~0);
//error_reporting(E_ALL);


//require ('./includes/config.inc.php');
require ('./includes/mysqli_connect.php');
require ('./includes/functions.php');

session_start();

if(isset($_SESSION['admin']) && $_SESSION['admin'] == 'kashwin50@hotmail.com')
{
	$regEmail = validate_input2($_SESSION['email']);
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
                $qString = sprintf('update toc_register set hebdepartment = "%s" where idtoc_register = "%s"',
                    $dbc->real_escape_string($loc),
                    $dbc->real_escape_string($hid));
                $dbc->query($qString);
                //echo $qString . '<br>';
			}
	} //end for
	$dbc->close();
	//send_notice("hotel");
    $redirect = 'admin_panel.php';
	header('Location: '.$redirect);
	exit();
} else {
	header("Location: login_proc.php");
	die();
}
