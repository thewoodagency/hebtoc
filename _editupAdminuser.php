<?php
ini_set('display_errors', 1);
error_reporting(~0);

require ('../../lib/config.inc.php');
require ('../../lib/mysqli_connect.php');
require ('../../lib/functions.php');
$message = '';
if(isset($_POST['formID']))
{
	$adminid=validate_input($_POST['adminid']);
	$username=validate_input2($_POST['username']);
	$password=validate_input2($_POST['password']);
    $hash=password_hash($password, PASSWORD_DEFAULT);
	$department=validate_input($_POST['department']);
	$lastlogin= date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $_POST['lastlogin'])));
	
	$qString = sprintf('replace into toc_admin (idtoc_admin, adminid, adminpwd, department, lastlogin) values ("%s", "%s", "%s", "%s", "%s")',
			$dbc->real_escape_string($adminid),
			$dbc->real_escape_string($username),
			$dbc->real_escape_string($hash),
			$dbc->real_escape_string($department),
			$dbc->real_escape_string($lastlogin));
	$dbc->query($qString);
	$dbc->close();
	if (isset($_POST['new_reg'])) 
	{
		header("Location: admin_officer_adminusers.php");
	} else if (isset($_POST['source'])) {
		header("Location: admin_partner_department.php");
	} else {
		header("Location: _editAdminuser.php?data=true&remail=".$username);
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