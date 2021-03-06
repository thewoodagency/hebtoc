<?php
ini_set('display_errors', 1);
error_reporting(~0);

require ('../../lib/config.php');
require ('../../lib/functions.php');

session_start();

if(isset($_SESSION['email']) && isset($_POST['formID']) && isset($_SESSION['token']))
{
    $regEmail = validate_input2($_SESSION['email']);
    $regID = validate_input($_SESSION['regid']);
    $toclevel = validate_input($_SESSION['toclevel']);
    $noofPeople = validate_input($_POST['noofPeople']);
    $hid = '';

    for ($i=0; $i<$noofPeople; $i++)
    {
        //if (isset($_POST['table'.$i]) && $_POST['table'.$i]<>'')
        //{
        $table=validate_input($_POST['table'.$i]);
        $first=validate_input($_POST['first'.$i]);
        $second=validate_input($_POST['second'.$i]);
        $hid=validate_input($_POST['hid'.$i]);

        $query = $connection->prepare('replace into toc_table (hid, regID, regEmail, htable, hchoice1, hchoice2) values (:hid, :regID, :regEmail, :tablename, :firstchoice, :secondchoice)');
        $query->bindParam('hid', $hid, PDO::PARAM_STR);
        $query->bindParam('regID', $regID, PDO::PARAM_STR);
        $query->bindParam('regEmail', $regEmail, PDO::PARAM_STR);
        $query->bindParam('tablename', $table, PDO::PARAM_STR);
        $query->bindParam('firstchoice', $first, PDO::PARAM_STR);
        $query->bindParam('secondchoice', $second, PDO::PARAM_STR);
        //$query->debugDumpParams();
        $query->execute();
        //}
    } //end for
    header("Location: reg_table.php");

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