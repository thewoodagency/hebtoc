<?php
ini_set('display_errors', 1);
error_reporting(~0);

require ('./includes/config.inc.php');
require ('./includes/mysqli_connect.php');
require ('./includes/functions.php');
$message = '';
if(isset($_POST['formID']))
{
	$reg_id=''; //check reg_id error;
	$today=date('m-d-Y');
	if (isset($_POST['reg_id'])) 
	{
		$reg_id=$_POST['reg_id'];
		$today=$_POST['reg_date'];
	}
	$level=$_POST['level'];
	$cname=htmlentities($_POST['cname'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
	$ctype=$_POST['ctype'];
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$addr1=$_POST['addr1'];
	$addr2=$_POST['addr2'];
	$city=$_POST['city'];
	$state=$_POST['state'];
	$zip=$_POST['zip'];
	$email=$_POST['q10_email10'];
	$password=$_POST['password'];
	$oarea=$_POST['oarea'];
	$ophone=$_POST['ophone'];
	$carea=$_POST['carea'];
	$cphone=$_POST['cphone'];
	$bdm=$_POST['bdm'];
	$amount=$_POST['amount'];
	$qString = sprintf('replace into toc_register (idtoc_register, toclevel, damount, company, comtype, fname, lname, addr1, addr2, city, state, zip, email, password, oarea, ophone, carea, cphone, bdm, registerd_date) values ("%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s")',
			$dbc->real_escape_string($reg_id),
			$dbc->real_escape_string($level),
			$dbc->real_escape_string($amount),
			$dbc->real_escape_string($cname),
		    $dbc->real_escape_string($ctype),
			$dbc->real_escape_string($fname),
			$dbc->real_escape_string($lname),
			$dbc->real_escape_string($addr1),
			$dbc->real_escape_string($addr2),
			$dbc->real_escape_string($city),
			$dbc->real_escape_string($state),
			$dbc->real_escape_string($zip),
			$dbc->real_escape_string($email),
			$dbc->real_escape_string($password),
			$dbc->real_escape_string($oarea),
			$dbc->real_escape_string($ophone),
			$dbc->real_escape_string($carea),
			$dbc->real_escape_string($cphone),
			$dbc->real_escape_string($bdm),
			$dbc->real_escape_string($today));
	console.log($qString);
	if (isset($_POST['new_reg'])) 
	{
		if (hasAccount($email) && !isset($_POST['add'])) { //new registration and multiple company
			$message = '<h3>You (' . $email . ') have already registered. If you try to add an additional company under ' . $email . ', please <a href="javascript:history.back(-1)">go back</a> and check the checkbox at the bottom. </h3>';
		} else {
			//$dbc->query($qString);
			$dbc->close();
			$message = '<p>Thanks for registering. Your invoice link has been sent to ' . $email . ' and your invoice will be available for printing when you login to your account.</p><p>
          Please login to your account to keep working on the rest of the forms. Please note that you can come back later to finish the forms. <a href="login_proc.php">Click here to continue</a></p>';
			sendNotification($email);
			//printf("New record has id %d. \n", $dbc->insert_id);
		}
	} else {
		$dbc->query($qString);
		$dbc->close();
		header("Location: reg_info.php");
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta name="HandheldFriendly" content="true" />
<title>Form</title>
<link href="lib/formCss.css?3.1.26" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="lib/nova.css?3.1.26" />
<link type="text/css" media="print" rel="stylesheet" href="lib/printForm.css?3.1.26" />
<style type="text/css">
    .form-label{
        width:150px !important;
    }
    .form-label-left{
        width:150px !important;
    }
    .form-line{
        padding-top:12px;
        padding-bottom:12px;
    }
    .form-label-right{
        width:150px !important;
    }
    body, html{
        margin:0;
        padding:0;
        background:false;
    }

    .form-all{
        margin:0px auto;
        padding-top:20px;
        width:690px;
        font-family:'Verdana';
        font-size:12px;
    }
#info {
		padding: 10px 30px 10px 35px;
		background:  #e7b22f;
	}
	#info a {
	color: #990000;
	text-decoration: underline;
	font-weight: bold;
}

#info a:hover {
	color: #990000;
	text-decoration: underline;
	font-weight: bold;
}
</style>

</head>
<body>
<form class="jotform-form" action="" method="post" name="form_32814544278863" id="32814544278863" accept-charset="utf-8">
  <input type="hidden" name="formID" value="32814544278863" />
  <div id="info">
  <? echo $message ?>
  </div>
  <input type="hidden" id="simple_spc" name="simple_spc" value="32814544278863" />

</form></body>
</html>