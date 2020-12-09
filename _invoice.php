<?php
require ('./includes/config.inc.php');
require ('./includes/mysqli_connect.php');
require ('./includes/functions.php');
session_start();

if(isset($_SESSION['email']))
{
	$email = $_SESSION['email'];
	$rid = $_SESSION['regid'];
		
	$regDate = '';
	setlocale(LC_MONETARY, 'en_US');
	//$qString = sprintf('select * from toc_register where email="%s"', $dbc->real_escape_string($email));
	$qString = sprintf('select * from toc_register where idtoc_register="%s" and email="%s"', 
			$dbc->real_escape_string($rid), $dbc->real_escape_string($email));
	$r = $dbc->query($qString);
	if ($row = $r->fetch_assoc())
	{
		$_SESSION['toclevel'] = $row["toclevel"];
		$_SESSION['regid'] = $row["idtoc_register"];
		$_SESSION['regdate'] = $row["registerd_date"];
		$tocinfo = getLevelInfo($_SESSION['toclevel']);
		if ($row['damount'] == '0') $amount = $tocinfo['amount'];
		else $amount = $row['damount'];
		$regDate = $_SESSION['regdate'];
		$name = $row["fname"] . ' ' . $row['lname'];
		$company = $row["company"];
		$invFormat = formatInvoiceDate($_SESSION['regdate']);
		$invoce = $invFormat[2].$invFormat[0].$invFormat[1].sprintf('%1$05d',$_SESSION['regid']);
	}
} else {
	header("Location: login_proc.php");
	die();
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Invoice - H-E-B Tournament of Champions</title>
<style>
.pageWrapper {
	margin: 0 auto;
	padding: 0;
	width: 800px;
}
.imgarea { text-align: center; }
table { width: 800px; margin-left: 25px;}
td {
	vertical-align: top;
	padding-bottom: 18px;
	font-size: 18px;
}
.warning { color: #CF0000; }
#footer { padding-top:15px; }
.footer1 { color:#d29e2c;  }
.footer2 { color:#d29e2c; font-size:14px; }
</style>
</head>

<body class="pageWrapper" onLoad="javascript:window.print();">
<div class="imgarea"><img src="images/toclogo_30th.gif" width="300" height="177" alt=""/> <br> 
<h2>-<?php echo TOCYEAR ?> Invoice-</h2></div>
<table border="0">
<tr>
  <td width="190">Date:</td><td colspan="2"><? echo $invFormat[2].'/'.$invFormat[0].'/'.$invFormat[1]; ?></td></tr>
<tr><td width="190">To:</td><td colspan="2"><? echo $company . '<br>' . $name ?></td></tr>
<tr><td>For:</td><td colspan="2">H-E-B Tournament of Champions<br><? echo $_SESSION['toclevel'] ?></td></tr>
<tr><td>Invoice #:</td><td colspan="2"><? echo $invoce ?></td></tr>
<tr><td>Balance due:</td><td colspan="2"><? echo money_format('%(#10n', intval($amount)) ?></td></tr>
<tr class="warning"><td>Due Date:</td><td colspan="2">On Receipt of this Invoice</td></tr>
<tr><td>CK Payable to:</td><td colspan="2">H-E-B Tournament of Champions</td></tr>
<tr><td>FED. TAX ID#: </td><td colspan="2">76-6187819<br>
[501(c)3 Charitable Trust]</td></tr>
<tr>
	<td colspan="2"><u>Send Check U.S. Mail:</u><br>
    <br>
    H-E-B Tournament of Champions<br>
Dept. 667<br>
P. O. Box 4346<br>
Houston, TX  77210 </td>
	<td width="50%"><u>Send Check Fed Ex:</u><br>
    <br>
    H-E-B Tournament of Champions<br>
    1801 Main Street<br>
    1st  Floor - Lockbox 667<br>
    Houston, TX 77002</td>
  </tr>
<tr>
  <td colspan="3"><strong>Electronic Funds Transfer information is available on our website and is our preferred method of payment</strong></td></tr>
<tr><td colspan="3">Phone: (210) 367-1225<br>
E-Mail: kashwin50@hotmail.com<br>
Thank you,
<br>
<em>Kathy Ashwin</em><br>
Director</td></tr>
<tr><td colspan="3" align="center"><div id="footer"><span class="footer1">H-E-B Tournament of Champions Charitable Trust</span><br>
<span class="footer2">646 S. Flores, San Antonio, TX 78204 | Phone: (210) 367-1225 </span></div></td></tr>
</table>
<div class="imgarea"><img src="images/w9_20.gif" /></div>
	<div class="imgarea"><img src="images/achbank2.gif" /></div>
</body>
</html>
<?
	$r->close();
	$dbc->close();
?>