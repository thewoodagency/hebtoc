<?php
//handle Donation Only 
ini_set('display_errors', 1);
error_reporting(~0);

/*recapcha lib*/
$secret = '6LedNBEUAAAAAO-pDwh8OHobCIJRxwp3I7ArdWMW';

// reCAPTCHA supported 40+ languages listed here: https://developers.google.com/recaptcha/docs/language
$lang = 'en';
require('./lib/recaptcha/src/autoload.php');
$recaptcha = new \ReCaptcha\ReCaptcha($secret);

$resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

//require ('./includes/config.inc.php');
require ('./includes/mysqli_connect.php');
require ('./includes/functions.php');

$message = '';
if(isset($_POST['formID']) && $resp->isSuccess())
{
	$reg_id=''; //check reg_id error;
	$today=date('m-d-Y');
	if (isset($_POST['reg_id'])) 
	{
		$reg_id=validate_input($_POST['reg_id']);
		$today=validate_input($_POST['reg_date']);
	}
	$level=validate_input($_POST['level']);
	$damount=validate_input($_POST['damount']);

    $cname=validate_input($_POST['cname']);
    $ctype=validate_input($_POST['ctype']);
    $fname=validate_input($_POST['fname']);
    $lname=validate_input($_POST['lname']);
    $addr1=validate_input($_POST['addr1']);
    $addr2=validate_input($_POST['addr2']);
    $city=validate_input($_POST['city']);
    $state=validate_input($_POST['state']);
    $zip=validate_input($_POST['zip']);
    $email=validate_input2($_POST['q10_email10']);
    $password=validate_input($_POST['password']);
    if (isset($_POST['token'])) {
        $hash=$password;
    } else {
        $hash=password_hash($password, PASSWORD_DEFAULT);
    }
    $oarea=validate_input($_POST['oarea']);
    $ophone=validate_input($_POST['ophone']);
    $carea=validate_input($_POST['carea']);
    $cphone=validate_input($_POST['cphone']);
    $bdm=validate_input($_POST['bdm']);
	$qString = sprintf('replace into toc_register (idtoc_register, toclevel, damount, company, comtype, fname, lname, addr1, addr2, city, state, zip, email, password, oarea, ophone, carea, cphone, bdm, registerd_date) values ("%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s")',
			$dbc->real_escape_string($reg_id),
			$dbc->real_escape_string($level),
			$dbc->real_escape_string($damount),
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
} else {
    $errors = $resp->getErrorCodes();
    $message = "<h2>Something went wrong</h2>
        <p>reCAPTCHA has not been varified. Please <a href='javascript:history.back(-1)'>go back</a> and verify you are not a robot</p>";
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
       <?php if ($message !== '') { echo $message; }
       else { ?>
          <p>Thanks for registering. Your invoice link has been sent to <? echo $email ?> and your invoice will be available for printing when you login to your account.</p><p>
          <a href="login_proc.php">Click here to login</a></p>
       <?php } ?>
  </div>
  <input type="hidden" id="simple_spc" name="simple_spc" value="32814544278863" />

</form></body>
</html>