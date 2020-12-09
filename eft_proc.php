<?php
ini_set('display_errors', 1);
error_reporting(~0);

require ('./includes/config.inc.php');
require ('./includes/mysqli_connect.php');
require ('./includes/functions.php');
$message = '';
if(isset($_POST['formID']))
{
	$today=date('m-d-Y');
	$com1=$_POST['com1'];
	$dba=$_POST['dba'];
	$com2=$_POST['com2'];
	$addr1=$_POST['addr1'];
	$addr2=$_POST['addr2'];
	$city=$_POST['city'];
	$state=$_POST['state'];
	$zip=$_POST['zip'];
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$email=$_POST['q10_email10'];
	$ophone='('.$_POST['oarea'].')'.$_POST['ophone'];
	$cphone='('.$_POST['carea'].')'.$_POST['cphone'];

	$qString = sprintf('insert into toc_eft (company1, dba, company2, address1, address2, city, state, zip, apfname, aplname, apemail, apphone, apfax, sbdate) values ("%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s")',
			$dbc->real_escape_string($com1),
			$dbc->real_escape_string($dba),
			$dbc->real_escape_string($com2),
			$dbc->real_escape_string($addr1),
			$dbc->real_escape_string($addr2),
			$dbc->real_escape_string($city),
			$dbc->real_escape_string($state),
			$dbc->real_escape_string($zip),
			$dbc->real_escape_string($fname),
			$dbc->real_escape_string($lname),
			$dbc->real_escape_string($email),
			$dbc->real_escape_string($ophone),
			$dbc->real_escape_string($cphone),
			$dbc->real_escape_string($today));

	$dbc->query($qString);
	$dbc->close();
	$message = '<h3>Our Financial Institution Information link has been sent to '.$email.'<br/>
	Thank you.</h3><p><a href="/">Back to homepage</a></p>';
	sendeft($email);
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