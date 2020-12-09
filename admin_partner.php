<?php
require ('./includes/config.inc.php');
require ('./includes/mysqli_connect.php');
require ('./includes/functions.php');
session_start();
$gfirstdate = THIRD;
$gseconddate = FIFTH;

if(isset($_SESSION['admin']) && $_SESSION['admin'] == 'kashwin50@hotmail.com')
{
	$email = $_SESSION['email'];
	$gfirstplay = $gsecondplay = $welcome = $charity = $sponsor = 'No';
	$regDate = '';
	setlocale(LC_MONETARY, 'en_US');
	$qString = "select * from toc_partnerregister where tocflag='p' order by idtoc_register desc";
	$r = $dbc->query($qString);
	$tbrows = '';
	$rowcolor = 0;

	while ($row = $r->fetch_assoc())
	{
		$gfirstplay = $gsecondplay = $welcome = $charity = $sponsor = 'No';
		if ($row["gfirstdate"] == '1') { $gfirstplay = 'Yes'; }
		if ($row["gseconddate"] == '1') { $gsecondplay = 'Yes'; }
		if ($row["wattend"] == '1')  { $welcome = 'Yes'; }
		if ($row["chattend"] == '1') {
			$charity = 'Yes | ' . $row['chsize'] . '<br>Sponsoring Company: ' . $row["chcompany"];
		}
		if ($row["rattend"] == '1') { $sponsor = 'Yes'; }
		
		if ($rowcolor%2==0)$tbrows .= '<tr class="even">';
		else $tbrows.='<tr>';
		$tbrows .= '<td>' . '<a target="_blank" href="reg_partnerinfo.php?remail=' . $row["email"] . '">'.
					$row["fname"] . ' ' . $row['lname'] . '</a></td><td>' .
					$row["title"] . '</td><td>' .
					$row["department"] . '</td><td>' .
					$row["email"] . '</td><td>(' .
					$row["oarea"] . ') ' . $row['ophone'] . '</td><td>(' .
					$row["carea"] . ') ' . $row['cphone'] . '</td><td>' .
					//$row['gsize'] . ' | ' . $row['ggender']. '<br>' .
					$gfirstdate . ' golf: ' . $gfirstplay . ' <br>' . 
					$gseconddate . ' golf: ' . $gsecondplay . '</td><td>' .
					$welcome . '</td><td>' .
					$charity . '</td><td>' .
					$sponsor . '</td><td align="center">' .
					'<a href="javascript:remove(' . $row["idtoc_register"] . ',\'' . $row["fname"] . ' ' . $row["lname"] . '\')"><img src="images/remove.gif" border="0"></a></td></tr>';
					$rowcolor++;
	}
} else {
	header("Location: login_proc.php");
	die();
}
?>
<script>
function remove(rid, name)
{
var x;
var r=confirm("Are you sure you want to delete " + name + "'s information ");
if (r==true)
  {
    window.location = "_removeRecord_Partner.php?tocflag=p&rid=" + rid;
  }
else
  {
  
  }
}
</script>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><!-- InstanceBegin template="/Templates/adminPage.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<title>Admin Panel | H-E-B TOC</title>
<!-- InstanceBeginEditable name="doctitle" -->


<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta name="HandheldFriendly" content="true" />
<link rel="stylesheet" href="lib/style.css" type="text/css" id="" media="print, projection, screen" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta name="HandheldFriendly" content="true" />
<link href="lib/formCss.css?3.1.26" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="lib/nova.css?3.1.26" />
<link type="text/css" media="print" rel="stylesheet" href="lib/printForm.css?3.1.26" />
<script type="text/javascript" src="lib/jquery-latest.js"></script> 
<script type="text/javascript" src="lib/jquery.tablesorter.js"></script> 
<style type="text/css">  
    body, html{
        margin: auto 0;
        padding:0;
        background:false;
    }
	#content {
		background: #FFF;
		margin: 0 auto;
		margin-bottom: 15px;
		padding: 20px;
		font-family:'Verdana';
        font-size:12px;
	}
	.even {
		background-color:#EAEAEA;
	}

#fnavi {
	text-align: center;
	width: 1024px;
}
#footer {
	padding-top: 10px;
	padding-bottom: 15px;
	text-align: center;
	font-family:"Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", "DejaVu Sans", Verdana, sans-serif;
	font-size:12px;
	color: #FFF;
	background-color:rgba(12,27,2,0.5);
	margin: 0 auto;
}
#footer a{
	color: #FF0;
}

#tocform {
	margin-top: -30px;
}
.important {
	color: #FF0004;
	font-size: 14px;
}

</style>
<script>
$(document).ready(function() 
    { 
        $("#myTable").tablesorter(); 
    } 
); 
</script>
</head>
<body>
<div id="fnavi"><iframe frameborder="0" allowtransparency="true" scrolling="no" src="admin_formnavi_n.html" width="1500" height="50"></iframe>
</div></div>
<div id="tocform">
<!-- InstanceBeginEditable name="form" -->
<div id="content">
<p><a href="admin_partner_excel.php">Excel</a> | <a style="background-color:#0F0" href="admin_officer_adminusers.php">Department Admin Users</a></p>
<table id="myTable" class="tablesorter"> 
<thead><tr><th>Name</th><th>Title</th><th>Department</th><th>Email</th><th>Password</th><th>Office #</th><th>Cell #</th><th width="100px">Golf</th><th>Welcome Dinner</th><th>Charity Work</th><th>Reception</th><th>&nbsp;</th></tr></thead>
<? echo $tbrows; ?>
</table>
</div>
<!-- InstanceEndEditable -->
</div>
<div id="footer">
<!--<p>Please make your tax deductible donation to:  <strong>“H-E-B Tournament of Champions”  
 [ Tax ID #:  76-6187819 ]       501(c)(3)</strong></p>
<p>Electronic Funds Transfer (ACH) is available, please complete the EFT form on our website www.hebtoc.com to receive our banking information.</p>
<p>If you are sending a check, please send check along with this form to:</p>
<p>H-E-B Tournament of Champions<br>
c/o KATHY ASHWIN<br>         
 646 S. Main Avenue<br>
 San Antonio, TX 78204</p>
 <p>Phone: (210)367-1225</p>
 <p>Fax: (210)481-2247
 <p>E-Mail: <a href="mailto:kashwin50@hotmail.com">kashwin50@hotmail.com</a></p>
<p class='important'><strong>All sponsorship money MUST be received on or before Friday, May 16, 2014</strong></p> -->
</div>
</body>
<!-- InstanceEnd --></html>
<?
	$r->close();
	$dbc->close();
?>
