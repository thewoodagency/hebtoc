<?php
//handle Donation Only
ini_set('display_errors', 1);
error_reporting(~0);
session_start();
//require ('./includes/config.inc.php');
require ('./includes/mysqli_connect.php');
require ('./includes/functions.php');

if(isset($_POST['formID']))
{
	$reg_id=''; //check reg_id error;
	$today=date('m-d-Y');
    if (isset($_POST['reg_id']))
    {
        $reg_id=validate_input($_POST['reg_id']);
        $today=validate_input2($_POST['reg_date']);
    }
    $level=validate_input($_POST['level']);
    $damount = '0';
    if (isset($_POST['damount'])) {
        $damount=validate_input($_POST['damount']);
    }
    $cname=validate_input($_POST['cname']);
    $ctype='Broker';
    $isbroker=1;
    $fname=validate_input($_POST['fname']);
    $lname=validate_input($_POST['lname']);
    $addr1=validate_input($_POST['addr1']);
    $addr2=validate_input($_POST['addr2']);
    $city=validate_input($_POST['city']);
    $state=validate_input($_POST['state']);
    $zip=validate_input($_POST['zip']);
    $email=validate_input2($_POST['q10_email10']);
    $password=validate_input2($_POST['password']);
    $hash=password_hash($password, PASSWORD_DEFAULT);
    $oarea=validate_input($_POST['oarea']);
    $ophone=validate_input($_POST['ophone']);
    $carea=validate_input($_POST['carea']);
    $cphone=validate_input($_POST['cphone']);
    $bdm=validate_input($_POST['bdm']);
    
	$qString = sprintf('replace into toc_register (idtoc_register, toclevel, damount, company, comtype, isbroker, fname, lname, addr1, addr2, city, state, zip, email, password, oarea, ophone, carea, cphone, bdm, registerd_date) values ("%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s")',
			$dbc->real_escape_string($reg_id),
			$dbc->real_escape_string($level),
			$dbc->real_escape_string($damount),
			$dbc->real_escape_string($cname),
            $dbc->real_escape_string($ctype),
			$dbc->real_escape_string($isbroker),
			$dbc->real_escape_string($fname),
			$dbc->real_escape_string($lname),
			$dbc->real_escape_string($addr1),
			$dbc->real_escape_string($addr2),
			$dbc->real_escape_string($city),
			$dbc->real_escape_string($state),
			$dbc->real_escape_string($zip),
			$dbc->real_escape_string($email),
			$dbc->real_escape_string($hash),
			$dbc->real_escape_string($oarea),
			$dbc->real_escape_string($ophone),
			$dbc->real_escape_string($carea),
			$dbc->real_escape_string($cphone),
			$dbc->real_escape_string($bdm),
			$dbc->real_escape_string($today));
	
	if (isset($_POST['new_reg'])) 
	{
		$dbc->query($qString);
		$dbc->close();
		sendNotification($email);
		//if (hasAccount($email)) {
		//	echo "<h3>You (" . $email . ") have already registered, please <a href='reg_info.php'>login to your account</a> or request your password.</h3>";
		//} else {
		//	$dbc->query($qString);
		//	$dbc->close();
		//	sendNotification($email);
			
		//}
	} else {
		$dbc->query($qString);
		$dbc->close();
		sendNotification($email);
	}

    if (login_process($email, $password)) {
        $_SESSION['email']=$email;
        $_SESSION['toclevel']=$level;
        $_SESSION['broker']=1;
        $_SESSION['broker100'] = 0;
        $_SESSION['company']=$cname;
    }
    if ($_SERVER['HTTP_REFERER'] == 'https://hebtoc.com/reg_info.php')
    {
        header("Location: reg_info.php");
    } else {
        header("Location: reg_newEvent_broker.php"); /* Redirect browser */
    }
}