<?php
require ('./includes/config.inc.php');
require ('./includes/mysqli_connect.php');
require ('./includes/functions.php');
setlocale(LC_MONETARY, 'en_US');

session_start();
/*if(isset($_SESSION['admin']))
{
	header("Location: admin_panel.php");
	die();	

}
if(isset($_SESSION['email']))
{
	header("Location: reg_info.php");
	die();	

}
$sp='';
if(isset($_GET['sp']))
{
	$sp = $_GET['sp'];
}
*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta name="HandheldFriendly" content="true" />
<title>Sponsorship Forms</title>
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
	#level {
		font-size: 16px;
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
.button { padding: 10px;
    border-radius: 10px;
    -moz-border-radius: 10px;
    -webkit-border-radius: 10px;
	width: 350px;
	height: 250;
	font-weight: bold;
	font-size: 18px;
}
</style>

</head>
<body>
  <div class="form-all">
  <div id="info"><h2>ELECTRONIC FUNDS TRANSFER REQUEST</h2>
  
<div style="width: 100%; text-align: center;"><input class="button" style="color: rgb(0, 0, 0); font-family: Arial; background-color: rgb(255, 255, 255);" onclick="window.open('https://abt.rpropayments.com/Buyer/CheckOutFormPay/PI4d4G--zI6kmO-v1PeMv22-aBM-')" type="button" value="PAY"><a style="margin: 4px 0px 0px; color: rgb(153, 153, 153); font-size: 8px; display: block;" href="http://www.paysimple.com/security.html">Secure Payments</a></div>

  <h3>H-E-B Tournament of Champions accepts funds deposited electronically (Electronic Funds Transfer or ACH) for the convenience of our sponsoring companies.
<br><br>Please click the "PAY" button above to enter your banking information and authorize H-E-B TOC to initiate an ACH Debit on your bank account.  In order to ensure that the transaction is successful, please establish H-E-B TOC and our Company ID #9766187819 in your ACH debit blocking/filtering services at your bank.
</h3><h3 align="right"><a href="/">Back to homepage</a></h3></div> 
</div>
</body>
</html>