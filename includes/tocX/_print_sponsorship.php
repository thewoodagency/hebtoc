<html>
<style>
body {
	font-family: Verdana, Geneva, sans-serif;
	page-break-after: auto;
}
#pfooter {margin-top: 10px; padding: 10px; border: 1px #999 solid;}
#pfooter p { text-align:center; font-size:11; }
h3 {
	font-size: 14px;
}
h4 {
	font-size: 12px;
	text-decoration: underline;
}

table { /*page-break-after:always*/ }
    tr    { page-break-inside:avoid; page-break-after:auto }
.title {
	width: 300px;
	font-weight: bold;
}
#reg td {
	font-size: 13px;
}

td {
	font-size: 11px;
}
.putbg {
	background-color: #CCC;
	font-weight: bold;
}
</style>
<?php
//ini_set('display_errors', 0);
//error_reporting(~0);
//require ('includes/config.inc.php');
require ('includes/mysqli_connect.php');
require ('includes/functions.php');
session_start();


	$email = $_SESSION['email'];
	$rid = '7815';
	//$rid = $_GET['rid'];
	echo '<div style="text-align:center; padding-bottom:7px"><img src="images/toclogo_30th.gif" width="190" height="112" alt=""/></div>';
	echo getRegistration($rid);
	echo getHotelInfo($rid);
	//echo getTennisInfo($rid);
	echo getPrivateInfo($rid);
	echo getPrivateDinner($rid);
	echo getSummitInfo($rid);
	echo getDinnerBuffetInfo($rid);
	echo getCharityWorkInfo($rid);
	echo getReceptionInfo1($rid);
	echo getReceptionInfo2($rid);
	echo getTableInfo($rid);
	echo getGolfInfo($rid);
	

?>
<body onLoad="javascript:window.print();">
<div id="pfooter">
<p>Please make your tax deductible donation to:  <strong>&quot;H-E-B Tournament of Champions&quot;  
 [ Tax ID #:  76-6187819 ]       501(c)(3)</strong></p>
<p>Electronic Funds Transfer (ACH) is available, please complete the EFT form on our website www.hebtoc.com to receive our banking information.</p>
<p>If you are sending a check, please send check along with this form to:</p>
<p><strong>H-E-B Tournament of Champions</strong><br>
  <strong>Dept. 667</strong><br>
  <strong>P. O. Box 4346</strong><br>
  <strong>Houston, Texas 77210</strong></p>
 <p>Phone: (210)367-1225 </p>
 <p>E-Mail: <a href="mailto:kashwin50@hotmail.com">kashwin50@hotmail.com</a></p>
<p class='important'><strong>All sponsorship money MUST be received on or before <?php echo PAYMENT ?>.</strong></p></div>
</body>
</html>
