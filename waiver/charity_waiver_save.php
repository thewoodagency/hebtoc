<?php
ini_set('display_errors', 1);
error_reporting(~0);

require ('../includes/config.inc.php');
require ('../includes/mysqli_connect.php');
require ('../includes/functions.php');

$message = "";
if(isset($_POST['formID']))
{
	$yourid = $_POST['yourid'];
    $signed = date("Y-m-d h:i:sa");
	$qString = "Update toc_charity SET waiver = 1, signed='". $signed . "' WHERE hid=" . $yourid;
    //echo $signed;
	if($dbc->query($qString) === TRUE) {
        $message = "Thank you. Your waiver form has been successfully submitted.";
    } else {
        $message = "Something went wrong. Please try again later";
    }

	$dbc->close();
} else {
	$message = "Something went wrong. Please try again later";
    die();
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta name="HandheldFriendly" content="true" />
<title>Form</title>
<link href="../lib/formCss.css?3.1.26" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="../lib/nova.css?3.1.26" />
<link type="text/css" media="print" rel="stylesheet" href="../lib/printForm.css?3.1.26" />
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
  <div class="form-all" style="padding: 20px">
      <h3><?php echo $message ?></h3>
      <a href="/">Go back to Homepage</a>
    <ul class="form-section">
     <li class="form-line" id="id_5">
        <label class="form-label-left" id="label_5" for="input_5">
        </label>
        <div id="cid_5" class="form-input">
          
        </div>
      </li>
      
    </ul>
  </div>
  <input type="hidden" id="simple_spc" name="simple_spc" value="32814544278863" />

</form></body>
</html>