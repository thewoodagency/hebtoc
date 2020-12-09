<?php
require ('./includes/config.inc.php');
require ('./includes/mysqli_connect.php');
require ('./includes/functions.php');
session_start();

if(isset($_SESSION['admin']) && $_SESSION['admin'] == 'kashwin50@hotmail.com')
{
	$email = $_SESSION['email'];
	$regDate = '';
	setlocale(LC_MONETARY, 'en_US');
	
	//Welcome Attendees
	$qString = 'SELECT hid, company, regID, hfirst, hlast, htitle FROM toc_welcome inner join toc_register on regID=idtoc_register inner join toc_level on toclevel = tlName where hlast <> \'\' order by company, hlast';
	$r = $dbc->query($qString);
	$qStringInsert = '';
	while ($row = $r->fetch_assoc())
	{
		$qStringInsert .= sprintf('replace into toc_attendees (hid, regID, hfirst, hlast, title, company, welcome) values ("%s", "%s", "%s", "%s", "%s", "%s", "%s")',
		$dbc->real_escape_string($row['hid']),
		$dbc->real_escape_string($row['regID']),
		$dbc->real_escape_string($row['hfirst']),
		$dbc->real_escape_string($row['hlast']),
		$dbc->real_escape_string($row['htitle']),
		$dbc->real_escape_string($row['company']),
		$dbc->real_escape_string('Yes')) . ';';
		
	}
	
	//execute the query
	if ($dbc->multi_query($qStringInsert) === TRUE) {
    	echo "New records created successfully - submit";
	} else {
    	echo "Error: " . $dbc->error;
	}
	//echo "done";
} else {
	header("Location: login_proc.php");
	die();
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Admin Panel | H-E-B TOC</title>
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
</body>
</html>
<?
	$r->close();
	$dbc->close();
?>
