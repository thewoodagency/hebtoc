<?php
ini_set('display_errors', 1);
error_reporting(~0);

require ('../../lib/config.inc.php');
require ('../../lib/mysqli_connect.php');
require ('../../lib/functions.php');
$message = '';
if(isset($_POST['formID']))
{
	$reg_id=''; //check reg_id error;
	$today=date('m-d-Y');
	$rattend = $wattend = $chattend = $gfirst = $gsecond ='0';
	$gdepartment = $chdepartment = $rdepartment = $wdepartment = '';
	
	if (isset($_POST['reg_id'])) 
	{
		$reg_id=$_POST['reg_id'];
		$today=$_POST['reg_date'];
	}
	$tocflag=$_POST['tocflag'];
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$title=$_POST['title'];
	$department=$_POST['department']; //no department - officers
	$email=$_POST['q10_email10'];
	$password=$_POST['password'];
	$oarea=$_POST['oarea'];
	$ophone=$_POST['ophone'];
	$carea=$_POST['carea'];
	$cphone=$_POST['cphone'];

	//golf
	$gsize=$_POST['g_size'];
	$ggender='female';
	if (isset($_POST['golf1'])) $gfirst = '1';
	if (isset($_POST['golf2'])) $gsecond = '1';
	
	//welcome dinner
	if (isset($_POST['welcome'])) $wattend = '1';
	
	//charity
	if (isset($_POST['charity'])) $chattend = '1';
	$chsize=$_POST['ch_size'];
	$chcompany=$_POST['ch_company'];
	
	//sponsor dinner
	if (isset($_POST['sponsor'])) $rattend = '1';
	
	$qString = sprintf('replace into toc_partnerregister (idtoc_register, fname, lname, title, department, email, password, oarea, ophone, carea, cphone, gfirstdate, gseconddate, gsize, ggender, chattend, chsize, chcompany, rattend, wattend, tocflag, registerd_date) values ("%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s")',
			$dbc->real_escape_string($reg_id),
			$dbc->real_escape_string($fname),
			$dbc->real_escape_string($lname),
			$dbc->real_escape_string($title),
			$dbc->real_escape_string($department),
			$dbc->real_escape_string($email),
			$dbc->real_escape_string($password),
			$dbc->real_escape_string($oarea),
			$dbc->real_escape_string($ophone),
			$dbc->real_escape_string($carea),
			$dbc->real_escape_string($cphone),
			$dbc->real_escape_string($gfirst),
			$dbc->real_escape_string($gsecond),
			$dbc->real_escape_string($gsize),
			$dbc->real_escape_string($ggender),
			$dbc->real_escape_string($chattend),
			$dbc->real_escape_string($chsize),
			$dbc->real_escape_string($chcompany),
			$dbc->real_escape_string($rattend),
			$dbc->real_escape_string($wattend),
			$dbc->real_escape_string($tocflag),
			$dbc->real_escape_string($today));
	if (isset($_POST['new_reg'])) 
	{
		if (hasPartnerAccount($email)) {
			$message = '<h3>You (' . $email . ') have already registered.</h3>';
		} else {
			$dbc->query($qString);
			$dbc->close();
			$message = '<p>Thanks for registering.</p><p>Please <a href="login_partner_proc.php">login to your account</a> if you need to update your information.</p>';
			if ($tocflag == 'o')
				$message = '<p>Thanks for registering.</p><p>Please <a href="login_officer_proc.php">login to your account</a> if you need to update your information.</p>';
			
			//off season - no email notification.
			
			//sendNotification_partner($email);
			
			//printf("New record has id %d. \n", $dbc->insert_id);
		}
	} else {
		$dbc->query($qString);
		$dbc->close();
		$message = '<p>Updated! Please close this window.</p>';
		//header("Location: reg_partnerinfo.php");
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