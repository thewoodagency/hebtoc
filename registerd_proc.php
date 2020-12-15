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

require ('../../lib/config.php');
require ('../../lib/functions.php');

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
    /* shift-alt-a  ctr-/*/
            
    $query = $connection->prepare('replace into toc_register (idtoc_register, toclevel, damount, company, comtype, 
    fname, lname, addr1, addr2, city, state, zip, email, password, oarea, ophone, carea, cphone, bdm, registerd_date) 
    values (:rid, :level, :damount, :cname, :ctype, :fname, :lname, :addr1, :addr2, :city, :state, :zip, :email, :password, 
    :oarea, :ophone, :carea, :cphone, :bdm, :today)');

    $query->bindParam('rid', $reg_id, PDO::PARAM_STR);
    $query->bindParam('level', $level, PDO::PARAM_STR);
    $query->bindParam('damount', $damount, PDO::PARAM_STR);
    $query->bindParam('cname', $cname, PDO::PARAM_STR);
    $query->bindParam('ctype', $ctype, PDO::PARAM_STR);
    $query->bindParam('fname', $fname, PDO::PARAM_STR);
    $query->bindParam('lname', $lname, PDO::PARAM_STR);
    $query->bindParam('addr1', $addr1, PDO::PARAM_STR);
    $query->bindParam('addr2', $addr2, PDO::PARAM_STR);
    $query->bindParam('city', $city, PDO::PARAM_STR);
    $query->bindParam('state', $state, PDO::PARAM_STR);
    $query->bindParam('zip', $zip, PDO::PARAM_STR);
    $query->bindParam('email', $email, PDO::PARAM_STR);
    $query->bindParam('password', $hash, PDO::PARAM_STR);
    $query->bindParam('oarea', $oarea, PDO::PARAM_STR);
    $query->bindParam('ophone', $ophone, PDO::PARAM_STR);
    $query->bindParam('carea', $carea, PDO::PARAM_STR);
    $query->bindParam('cphone', $cphone, PDO::PARAM_STR);
    $query->bindParam('bdm', $bdm, PDO::PARAM_STR);
    $query->bindParam('today', $today, PDO::PARAM_STR);
	
	$query->execute(); 
	sendNotification($email);
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
<title>Donation Form</title>
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