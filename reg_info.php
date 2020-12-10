<?php
require('./includes/config.inc.php');
//require ('./includes/mysqli_connect.php');
require('./includes/config.php');
require('./includes/functions.php');
session_start();

if (isset($_SESSION['token']) && isset($_SESSION['email'])) {

        $email = $_SESSION['email'];

        $regDate = '';
        $isbroker = 0;
        $submit = 'register_proc2.php';
        setlocale(LC_MONETARY, 'en_US');
        //$qString = sprintf('select * from toc_register where email="%s"', $dbc->real_escape_string($email));

        $query = $connection->prepare('select * from toc_register where email=:email');
        $query->bindParam('email', $email, PDO::PARAM_STR);

        if (isset($_GET['rid']) && $_GET['rid'] != '') //if rid is available from URL
        {
            $rid = $_GET['rid'];
            //$qString = sprintf('select * from toc_register where idtoc_register="%s" and email="%s"',
            //    $dbc->real_escape_string($rid), $dbc->real_escape_string($email));
            $query = $connection->prepare('select * from toc_register where idtoc_register=:rid and email=:email');
            $query->bindParam('rid', $rid, PDO::PARAM_STR);
            $query->bindParam('email', $email, PDO::PARAM_STR);

        } else if (isset($_SESSION['regid'])) { //if seesion has rid
            $rid = $_SESSION['regid'];
            $query = $connection->prepare('select * from toc_register where idtoc_register=:rid and email=:email');
            $query->bindParam('rid', $rid, PDO::PARAM_STR);
            $query->bindParam('email', $email, PDO::PARAM_STR);
        }

        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $_SESSION['toclevel'] = $row["toclevel"];
            $_SESSION['regid'] = $row["idtoc_register"];
            $_SESSION['regdate'] = $row["registerd_date"];
            $_SESSION['company'] = $row["company"];
            $isbroker = $row["isbroker"];
            $isbroker100 = $row["broker100"];
            if ($isbroker == 1) $submit = 'register_proc2_broker.php';
            if ($isbroker100 == 1) $submit = 'register_proc2_broker_100.php';
            $_SESSION['broker'] = $isbroker;
            $_SESSION['broker100'] = $row["broker100"];
            $tocinfo = getLevelInfo($_SESSION['toclevel']);
            if ($row['damount'] == '0') {
                $amount = $tocinfo['amount'];
            } else {
                $amount = $row['damount'];
                //$submit = 'registerd_proc.php';
            }
            $regDate = 'Registered date: ' . $_SESSION['regdate'];
            $participant = getNumParticipants($row["idtoc_register"]);
        }
} else {
    header("Location: login_proc.php");
    die();
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><!-- InstanceBegin template="/Templates/formPage.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <title>H-E-B Tournament of Champions</title>
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>Untitled Document</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <meta name="HandheldFriendly" content="true"/>
    <title>Form</title>
    <link href="lib/formCss.css?3.1.26" rel="stylesheet" type="text/css"/>
    <link type="text/css" rel="stylesheet" href="lib/nova.css?3.1.26"/>
    <link type="text/css" media="print" rel="stylesheet" href="lib/printForm.css?3.1.26"/>
    <style type="text/css">
        .form-label {
            width: 150px !important;
        }

        .form-label-left {
            width: 150px !important;
        }

        .form-line {
            padding-top: 12px;
            padding-bottom: 12px;
        }

        .form-label-right {
            width: 150px !important;
        }

        body, html {
            margin: 0 auto;
            padding: 0;
        }

        .form-all {
            margin: 0 auto;
            padding-top: 20px;
            width: 710px;
            font-family: 'Verdana';
            font-size: 12px;
        }

        #level {
            font-size: 16px;
        }

        button {
            border: 2px solid;
            border-radius: 10px;
            padding: 7px;
        }
    </style>

    <script src="lib/jotform.js?3.1.26" type="text/javascript"></script>
    <script type="text/javascript">
        JotForm.init(function () {
            $('input_10_confirm').hint('Confirm Email');
            $('input_10').hint('ex: myname@example.com');
        });

        function openPrinter(url) {
            if (url == 'invoice') {
                window.open('_invoice.php');
            } else if (url == 'sponsorship') {
                window.open('_print_sponsorship.php');
            }
        }
    </script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <!-- InstanceEndEditable -->
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->
    <style>
        #fnavi {
            margin-bottom: 30px;
        }

        #footer {
            padding-top: 10px;
            text-align: center;
            font-family: "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", "DejaVu Sans", Verdana, sans-serif;
            font-size: 12px;
            color: #FFF;
            background-color: rgba(12, 27, 2, 0.5);
            width: 1024px;
            margin: 0 auto;
        }

        #footer a {
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
<div id="fnavi"><?php include 'formnavi.php'; ?>
</div>
<div id="tocform">
    <!-- InstanceBeginEditable name="form" -->
    <form class="jotform-form" action="<?php echo $submit; ?>" method="post" name="form_32814544278863"
          id="32814544278863" accept-charset="utf-8">
        <input type="hidden" name="formID" value="32814544278863"/>
        <input type="hidden" name="reg_id" value="<?php echo $_SESSION['regid'] ?>"/>
        <input type="hidden" name="reg_date" value="<?php echo $_SESSION['regdate'] ?>"/>
        <input type="hidden" name="token" value="<? echo $_SESSION['token']; ?>"/>
        <div class="form-all">
            <div style="text-align:right;padding:5px;">
                <?php if ($participant == 0 && $row["toclevel"] != "Donation Only") { ?>
                    <div style="line-height:20px;text-align:left;padding:10px; border: solid 1px #CFCFCF; background: #F89A22">
                        <img src="/images/exlamation.png" width="20" style="vertical-align: middle">&nbsp;<strong>No
                            participants are registered to attend from your company - if this is correct, nothing else
                            is required.
                            If you have Participants that want to attend, please click the "Events" tab and complete all
                            information."</strong></div><br><? } ?>
                <button style="cursor:pointer" onClick="javascript:openPrinter('invoice');" type="button">Print
                    Invoice
                </button>&nbsp;&nbsp;<button style="cursor:pointer" onClick="javascript:openPrinter('sponsorship');"
                                             type="button">Print Sponsorship information
                </button>
            </div>
            <ul class="form-section">
                <li class="form-line" id="id_5">
                    <label class="form-label-left" id="label_5" for="input_5">
                        Sponsorship Level<span class="form-required">*</span>
                    </label>
                    <div id="cid_5" class="form-input">
                        <select class="form-dropdown validate[required]" style="width:235px" id="level" name="level">
                            <?php if ($isbroker100 == 1) { ?>
                                <option value="<?php echo $_SESSION['toclevel']; ?>" selected>Humanitarian Plus</option>
                            <?php } else { ?>
                                <option value="<?php echo $_SESSION['toclevel']; ?>"
                                        selected><?php echo $_SESSION['toclevel'] . ' -' . money_format('%(#10n', intval($amount)); ?></option>
                            <?php } ?>
                            <?php //echo getTocLevel(); ?>
                        </select>
                        <input type="hidden" id="amount" name="amount" value="<?php echo $amount; ?>"/>
                        <input type="hidden" id="damount" name="damount" value="<?php echo $amount; ?>"/>
                    </div>
                </li>
                <li class="form-line" id="id_1">
                    <label class="form-label-left" id="label_1" for="input_1">
                        <?php if ($isbroker == 1) echo 'Broker '; ?>Company Name<span class="form-required">*</span>
                    </label>
                    <div id="cid_1" class="form-input">
                        <input type="text" class=" form-textbox validate[required]" data-type="input-textbox" id="cname"
                               name="cname" size="55" value="<?php echo $row["company"]; ?>"/>
                    </div>
                </li>
                <?php if ($isbroker == 0) { ?>
                    <li class="form-line" id="id_55">
                        <label class="form-label-left" id="label_55" for="input_55">
                            My company is<span class="form-required">*</span>
                        </label>
                        <div id="cid_55" class="form-input">
                            <select class="form-dropdown validate[required] selectfont" style="width:300px" id="ctype"
                                    name="ctype">
                                <option value="<?php echo $row["comtype"]; ?>"><?php echo $row["comtype"]; ?></option>
                                <option value="Own Brand Exclusive">Own Brand Exclusive</option>
                                <option value="National Brand and Own Brand">National Brand and Own Brand</option>
                                <option value="National Brand Exclusive">National Brand Exclusive</option>
                            </select>
                        </div>
                    </li>
                <?php } ?>
                <li class="form-line" id="id_9">
                    <label class="form-label-left" id="label_9" for="input_9">
                        Person to receive all information<span class="form-required">*</span>
                    </label>
                    <div id="cid_9" class="form-input"><span class="form-sub-label-container"><input
                                    class="form-textbox validate[required]" type="text" size="15" name="fname"
                                    id="fname" value="<?php echo $row["fname"]; ?>"/>
            <label class="form-sub-label" for="first_9" id="sublabel_first"> First Name </label></span><span
                                class="form-sub-label-container"><input class="form-textbox validate[required]"
                                                                        type="text" size="15" name="lname" id="lname"
                                                                        value="<?php echo $row["lname"]; ?>"/>
            <label class="form-sub-label" for="last_9" id="sublabel_last"> Last Name </label></span>
                    </div>
                </li>
                <li class="form-line" id="id_8">
                    <label class="form-label-left" id="label_8" for="input_8">
                        Address<span class="form-required">*</span>
                    </label>
                    <div id="cid_8" class="form-input">
                        <table summary="" class="form-address-table" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td colspan="2"><span class="form-sub-label-container"><input
                                                class="form-textbox validate[required] form-address-line" type="text"
                                                name="addr1" id="addr1" value="<?php echo $row["addr1"]; ?>"/>
                  <label class="form-sub-label" for="input_8_addr_line1"
                         id="sublabel_8_addr_line1"> Street Address </label></span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><span class="form-sub-label-container"><input
                                                class="form-textbox form-address-line" type="text" name="addr2"
                                                id="addr2" size="46" value="<?php echo $row["addr2"]; ?>"/>
                  <label class="form-sub-label" for="input_8_addr_line2" id="sublabel_8_addr_line2"> Street Address Line 2 </label></span>
                                </td>
                            </tr>
                            <tr>
                                <td width="50%"><span class="form-sub-label-container"><input
                                                class="form-textbox validate[required] form-address-city" type="text"
                                                name="city" id="city" size="21" value="<?php echo $row["city"]; ?>"/>
                  <label class="form-sub-label" for="input_8_city" id="sublabel_8_city"> City </label></span>
                                </td>
                                <td><span class="form-sub-label-container"><input
                                                class="form-textbox validate[required] form-address-state" type="text"
                                                name="state" id="state" size="22" value="<?php echo $row["state"]; ?>"/>
                  <label class="form-sub-label" for="input_8_state" id="sublabel_8_state"> State</label></span>
                                </td>
                            </tr>
                            <tr>
                                <td width="50%" function zip(){var
                                    iterator=Prototype.K,args=$A(arguments);if(Object.isFunction(args.last()))
                                    iterator=args.pop();var collections=[this].concat(args).map($A);return
                                    this.map(function(value,index){return iterator(collections.pluck(index));});}><span
                                            class="form-sub-label-container"><input
                                                class="form-textbox validate[required] form-address-postal" type="text"
                                                name="zip" id="zip" size="10" value="<?php echo $row["zip"]; ?>"/>
                  <label class="form-sub-label" for="input_8_postal" id="sublabel_8_postal"> Zip Code </label></span>
                                </td>
                                <td><span class="form-sub-label-container"><select
                                                class="form-dropdown validate[required] form-address-country"
                                                name="q8_address8[country]" id="input_8_country" disabled>
                    <option selected="selected"
                            value="<?php echo $row["country"]; ?>"> <?php echo $row["country"]; ?> </option>
                  </select>
                  <label class="form-sub-label" for="country" id="country"> Country </label></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </li>
                <li class="form-line" id="id_10">
                    <label class="form-label-left" id="label_10" for="input_10">
                        E-mail<span class="form-required">*</span>
                    </label>
                    <div id="cid_10" class="form-input">
                        <input type="email" class=" form-textbox validate[required, Email]" id="input_10"
                               name="q10_email10" size="30" value="<?php echo $row["email"]; ?>" readonly/>
                        <!--br>
          <input type="email" class="form-textbox validate[required, Email, Email_Confirm]" id="input_10_confirm" style="margin-top:8px;" size="30" value="<?php //echo $row["email"]; ?>"  readonly /> -->
                        <input type="hidden" class="form-textbox" data-type="input-textbox" id="password"
                               name="password" size="20" value="<?php echo $row["password"]; ?>"/>
                    </div>
                </li>
                <!--li class="form-line" id="id_1">
        <label class="form-label-left" id="label_1" for="input_1">
          Password<span class="form-required">*</span>
        </label>
        <div id="cid_1" class="form-input">
          <input type="text" class=" form-textbox validate[required]" data-type="input-textbox" id="password" name="password" size="20" value="<?php //echo $row["password"]; ?>" />
        </div>
      </li-->
                <li class="form-line" id="id_12">
                    <label class="form-label-left" id="label_12" for="input_12">
                        Office #<span class="form-required">*</span>
                    </label>
                    <div id="cid_12" class="form-input"><span class="form-sub-label-container"><input
                                    class="form-textbox validate[required]" type="tel" name="oarea" id="oarea" size="3"
                                    value="<?php echo $row["oarea"]; ?>">
            -
            <label class="form-sub-label" for="input_12_area" id="sublabel_area"> Area Code </label></span><span
                                class="form-sub-label-container"><input class="form-textbox validate[required]"
                                                                        type="tel" name="ophone" id="ophone" size="8"
                                                                        value="<?php echo $row["ophone"]; ?>">
            <label class="form-sub-label" for="input_12_phone" id="sublabel_phone"> Phone Number </label></span>
                    </div>
                </li>
                <li class="form-line" id="id_11">
                    <label class="form-label-left" id="label_11" for="input_11">
                        Cell #<span class="form-required">*</span>
                    </label>
                    <div id="cid_11" class="form-input"><span class="form-sub-label-container"><input
                                    class="form-textbox validate[required]" type="tel" name="carea" id="carea" size="3"
                                    value="<?php echo $row["carea"]; ?>">
            -
            <label class="form-sub-label" for="input_11_area" id="sublabel_area"> Area Code </label></span><span
                                class="form-sub-label-container"><input class="form-textbox validate[required]"
                                                                        type="tel" name="cphone" id="cphone" size="8"
                                                                        value="<?php echo $row["cphone"]; ?>">
            <label class="form-sub-label" for="input_11_phone" id="sublabel_phone"> Phone Number </label></span>
                    </div>
                </li>
                <?php if ($isbroker100 == 0 && $isbroker == 0) { ?>
                    <li class="form-line" id="id_13">
                        <label class="form-label-left" id="label_13" for="input_13">
                            H-E-B BDM with whom you work<span class="form-required">*</span>
                        </label>
                        <div id="cid_13" class="form-input">
                            <input type="text" class=" form-textbox validate[required]" data-type="input-textbox"
                                   id="bdm" name="bdm" size="20" value="<?php echo $row["bdm"]; ?>"/>
                        </div>
                    </li>
                <?php } else {
                    echo '<input type="hidden" data-type="input-textbox" id="bdm" name="bdm" size="20" value="bdm"';
                } ?>
                <li class="form-line" id="id_2">
                    <div id="cid_2" class="form-input-wide">
                        <div style="margin-left:156px" class="form-buttons-wrapper">
                            <br>
                            <div class="g-recaptcha" data-sitekey="6LedNBEUAAAAAD9xMlt_eS3KtBHIGmClNMx9rge7"></div>
                            <? include 'reg_submit.php'; //'reg_submit_kathyOnly.php';  ?>
                            <? echo '<span class="lastinfo">&nbsp; ' . $regDate . '</span>'; ?>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <input type="hidden" id="simple_spc" name="simple_spc" value="32814544278863"/>

    </form>
    <!-- InstanceEndEditable -->
</div>
<div id="footer">
    <?
    $email = $_SESSION['admin'];
    if ($email == 'kashwin50@hotmail.com' || $email == 'mistyc123@gmail.com') {
    } else {
        ?>
        <p>Please make your tax deductible donation to: <strong>“H-E-B Tournament of Champions”
                [ Tax ID #: 76-6187819 ] 501(c)3</strong></p>
        <p><strong>Electronic Funds Transfer (ACH) is available, please refer to the &ldquo;PAYMENTS&rdquo; tab on the
                homepage for instructions.</strong></p>
        <p><strong>If you are paying by check, please send your payment to our new lockbox address:</strong></p>
        <p>H-E-B Tournament of Champions<br>
            Dept. 667<br>
            P. O. Box 4346<br>
            Houston, Texas 77210</p>
        <p>Phone: (210)367-1225</p>
        <p>Fax: (210)481-2247
        <p>E-Mail: <a href="mailto:kashwin50@hotmail.com">kashwin50@hotmail.com</a></p>
        <p class='important'><strong>All sponsorship money MUST be received on or before <?php echo PAYMENT ?>.</strong>
        </p>
    <? } ?>
</div>
</body>
<!-- InstanceEnd --></html>
