<?php
ini_set('display_errors', 1);
error_reporting(~0);

require ('./includes/config.inc.php');
require ('./includes/mysqli_connect.php');
require ('./includes/functions.php');

session_start();

if(isset($_SESSION['email']) && isset($_POST['formID']))
{
	$regEmail = $_SESSION['email'];
	$regID = $_SESSION['regid'];
	$toclevel = $_SESSION['toclevel'];
	$noofPeople = $_POST['noofPeople'];
	$hid = '';
	
	for ($i=0; $i<$noofPeople; $i++)
	{
		//if (isset($_POST['first'.$i]) && $_POST['first'.$i]<>'')
		//{
			$fname=$_POST['first'.$i];
			$lname=$_POST['last'.$i];
			$hid=$_POST['hid'.$i];
			$room = array(1=>0,0,0,0,0,0);
			if (isset($_POST['room'.$i])) 
			{
				foreach ($_POST['room'.$i] as $night)
				{
					$room[$night] = 1;
				}
			}
		print_r($room);
			$qString = sprintf('replace into toc_hotel (hid, regID, regEmail, hfirst, hlast, night1, night2, night3, night4, night5, night6) values ("%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s")',
			$dbc->real_escape_string($hid),
			$dbc->real_escape_string($regID),
			$dbc->real_escape_string($regEmail),
			$dbc->real_escape_string($fname),
			$dbc->real_escape_string($lname),
			$dbc->real_escape_string($room[1]),
			$dbc->real_escape_string($room[2]),
			$dbc->real_escape_string($room[3]),
			$dbc->real_escape_string($room[4]),
			$dbc->real_escape_string($room[5]),
			$dbc->real_escape_string($room[6]));
	
			//$dbc->query($qString);
		//}
	} //end for
	$dbc->close();
	//send_notice("hotel");
	header("Location: reg_hotel.php");
} else {
	header("Location: login_proc.php");
	die();
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
</style>

</head>
<body>
<form class="jotform-form" action="" method="post" name="form_32814544278863" id="32814544278863" accept-charset="utf-8">
  <input type="hidden" name="formID" value="32814544278863" />
  <div class="form-all">
    <ul class="form-section">
     <li class="form-line" id="id_5">
        <label class="form-label-left" id="label_5" for="input_5">
          Message : Thanks for registering.<br> Your invoice has been sent.
          Please finish the rest of the forms.<br>
          <a href="login_proc.php">Click here to continue</a>
        </label>
        <div id="cid_5" class="form-input">
          
        </div>
      </li>
      
    </ul>
  </div>
  <input type="hidden" id="simple_spc" name="simple_spc" value="32814544278863" />

</form></body>
</html>