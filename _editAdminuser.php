<?php
require ('../../lib/config.inc.php');
require ('../../lib/mysqli_connect.php');
require ('../../lib/functions.php');
session_start();

//off season Kathy editing only
//$_SESSION['email'] = $_GET["remail"];
//

if(isset($_SESSION['email']))
{
    $email = validate_input2($_SESSION['email']);
    $message = '';
    $readonly = '';
    $hidden = '';
    $source = false;
    if (isset($_SESSION['admin'])) //if session has admin emails
    {
        if ($_GET["remail"]) {
            $email = validate_input2($_GET["remail"]);
            if (isset($_GET["data"])) {
                $message = '<p>Updated! Please close this window if you are done.</p>';
            }
            if (isset($_GET["source"])) {
                $source = true;
                $readonly = "readonly";
                $hidden = '<input type="hidden" name="source" value="department" />';
            }
        } else if ($_GET["new"]) {
            $email = '';
            $hidden = '<input type="hidden" name="new_reg" value="true" />';
        }
    }

    setlocale(LC_MONETARY, 'en_US');
    $qString = sprintf('select * from toc_admin where adminid="%s"', $dbc->real_escape_string($email));
    $r = $dbc->query($qString);
    if ($row = $r->fetch_assoc())
    {
        $adminid = $row["idtoc_admin"];
        $password = $row["adminpwd"];
        $department = $row["department"];
        $lastlogin = $row["lastlogin"];
    }
} else {
    header("Location: login_proc.php");
    die();
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>H-E-B Tournament of Champions</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <meta name="HandheldFriendly" content="true" />
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
            width:710px;
            font-family:'Verdana';
            font-size:12px;
        }
        #level {
            font-size: 16px;
        }
        .sp {padding: 7px 0 0 20px }
    </style>

    <script src="lib/jotform.js?3.1.26" type="text/javascript"></script>
    <script type="text/javascript">
        JotForm.init(function(){
            //$('input_10_confirm').hint('Confirm Email');
           // $('input_10').hint('ex: myname@example.com');
        });
    </script>
    <style>
        #fnavi {
            margin-bottom: 30px;
        }
        #footer {
            padding-top: 10px;
            text-align: center;
            font-family:"Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", "DejaVu Sans", Verdana, sans-serif;
            font-size:12px;
            color: #FFF;
            background-color:rgba(12,27,2,0.5);
            width: 1024px;
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
</head>
<body class="pageStyle">
<div id="fnavi">
    <iframe frameborder="0" allowtransparency="true" scrolling="no" src="" width="1024" height="50"></iframe>
</div>
<div id="tocform">
    <form class="jotform-form" action="_editupAdminuser.php" method="post" name="form_32814544278863" id="32814544278863" accept-charset="utf-8">
        <input type="hidden" name="formID" value="32814544278863" />
        <input type="hidden" name="adminid" value="<?php echo $adminid ?>" />
        <input type="hidden" name="lastlogin" value="<?php echo $lastlogin ?>" />
        <?php echo $hidden ?>
        <div class="form-all">
            <?php echo $message ?>
            <ul class="form-section">
                <li class="form-line" id="id_10">
                    <label class="form-label-left" id="label_10" for="input_10">
                        E-mail<span class="form-required">*</span>
                    </label>
                    <div id="cid_10" class="form-input">
                        <input type="email" class=" form-textbox validate[required, Email]" id="username" name="username"  size="20" value="<?php echo $email ?>" />
                       <!-- <br>
                        <input type="email" class="form-textbox validate[required, Email, Email_Confirm]" id="input_10_confirm" style="margin-top:8px;" size="30" />
                        -->
                    </div>
                </li>
                <li class="form-line" id="id_1">
                    <label class="form-label-left" id="label_1" for="input_1">
                        Password<span class="form-required">*</span>
                    </label>
                    <div id="cid_1" class="form-input">
                        <input type="password" class="form-textbox validate[required]" data-type="input-textbox" id="password" name="password" size="20"/>
                    </div>
                </li>
                <li class="form-line jf-required" data-type="control_dropdown" id="id_1">
                    <label class="form-label form-label-left form-label-auto" id="label_1" for="input_1">
                        Department
                        <span class="form-required">
            *
          </span>
                    </label>
                    <div id="cid_1" class="form-input jf-required">
                        <?php if ($source) { ?>
                            <input readonly type="text" class=" form-textbox validate[required]" data-type="input-textbox" id="department" name="department" size="20" value="<?php echo $department ?>" />
                        <?php } else { ?>
                            <select class="form-dropdown validate[required]" style="width:150px" id="department" name="department">
                                <?php echo '<option value="'.$department.'"> '.$department.' </option>' ?>
                                <option value="">Select </option>
                                <option value="Accounting"> Accounting </option>
                                <option value="Advertising"> Advertising </option>
                                <option value="Bakery"> Bakery </option>
                                <option value="Deli"> Deli </option>
                                <option value="Drug Store"> Drug Store </option>
                                <option value="Facility Procurement"> Facility Procurement </option>
                                <option value="Finance"> Finance </option>
                                <option value="General Merchandise"> General Merchandise </option>
                                <option value="Grocery"> Grocery </option>
                                <option value="Human Resources"> Human Resources </option>
                                <option value="Information Systems"> Information Systems </option>
                                <option value="Meat"> Meat </option>
                                <option value="Own Brands"> Own Brands </option>
                                <option value="Petroleum"> Petroleum </option>
                                <option value="Pharmacy"> Pharmacy </option>
                                <option value="Produce"> Produce </option>
                                <option value="Public Affairs"> Public Affairs </option>
                                <option value="Seafood"> Seafood </option>
                                <option value="All"> All </option>
                            </select>
                        <?php } //if end : source validation ?>
                    </div>
                </li>
                <li class="form-line" id="id_2">
                    <div id="cid_2" class="form-input-wide">
                        <div class="g-recaptcha" data-sitekey="6LedNBEUAAAAAD9xMlt_eS3KtBHIGmClNMx9rge7"></div>
                        <div style="margin-left:156px" class="form-buttons-wrapper">
                            <? include 'reg_submit.php'; ?>
                        </div>
                    </div>
                </li>
                <li style="display:none">
                    Should be Empty:
                    <input type="text" name="website" value="" />
                </li>
            </ul>
        </div>
        <input type="hidden" id="simple_spc" name="simple_spc" value="32814544278863" />

    </form>
</div>

</body>
</html>
<?
$r->close();
$dbc->close();
?>
