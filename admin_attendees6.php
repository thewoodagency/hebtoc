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

	//Private Dinner Attendees
	$qString = 'SELECT toc_attendees.hid as hid, toc_golf.regID as rid, toc_register.company as co, toc_golf.htitle as title, toc_golf.hfirst as first, toc_golf.hlast as last, welcome, toc_attendees.summit, general, halloffame, private, charity ' .
'FROM toc_golf left join toc_attendees ' .
'on toc_attendees.regID=toc_golf.regid and toc_attendees.hfirst = toc_golf.hfirst and toc_attendees.hlast = toc_golf.hlast ' .
'inner join toc_register on toc_golf.regID=idtoc_register ' .
'inner join toc_level on toclevel = tlName where toc_level.tlamount >= 125000 and toc_golf.hlast <> \'\'' ;
	$r = $dbc->query($qString);
	$qStringInsert = '';
	$i=0; $j=0;
	while ($row = $r->fetch_assoc())
	{	 
		if(is_null($row['welcome'])) { $welcome = 'No'; } else {$welcome = $row['welcome'];}
		if(is_null($row['summit'])) { $summit = 'No'; } else {$summit = $row['summit'];}
		if(is_null($row['general'])) { $general = 'No'; } else {$general = $row['general'];}
		if(is_null($row['halloffame'])) { $halloffame = 'No'; } else {$halloffame = $row['halloffame'];}
        if(is_null($row['private'])) { $private = 'No'; } else {$private = $row['private'];}
		if(is_null($row['charity'])) { $charity = 'No'; } else {$charity = $row['charity'];}

		$qStringInsert .= sprintf('replace into toc_attendees (hid, regID, hfirst, hlast, title, company, welcome, summit, general, halloffame, private, charity, golf1) values ("%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s")',
		$dbc->real_escape_string($row['hid']),
		$dbc->real_escape_string($row['rid']),
		$dbc->real_escape_string($row['first']),
		$dbc->real_escape_string($row['last']),
		$dbc->real_escape_string($row['title']),
		$dbc->real_escape_string($row['co']),
		$dbc->real_escape_string($welcome),
		$dbc->real_escape_string($summit),
		$dbc->real_escape_string($general),
		$dbc->real_escape_string($halloffame),
        $dbc->real_escape_string($private),
		$dbc->real_escape_string($charity),
		$dbc->real_escape_string('Yes')) . ';';
		$j++;
	}

	//execute the query
	if ($dbc->multi_query($qStringInsert) === TRUE) {
    	echo "New records created successfully - submit";
	} else {
    	echo "Error: " . $dbc->error;
	}
	echo "<br>" . $i . "+" . $j . "<br>";
	//echo $qStringInsert;
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
