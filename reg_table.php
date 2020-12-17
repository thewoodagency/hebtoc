<?php
ini_set('display_errors', 1);
error_reporting(~0);

require('../../lib/config.php');
require('../../lib/functions.php');
session_start();
$entries = array();
if (isset($_SESSION['email'])) {
  $regEmail = validate_input2($_SESSION['email']);
  $regID = validate_input($_SESSION['regid']);
  $toclevel = validate_input($_SESSION['toclevel']);
  $tocInfo = getLevelInfo($toclevel);
  $last = "";

  //$qString = sprintf('select * from toc_table where regEmail="%s" order by hid', $dbc->real_escape_string($regEmail));
  //$qString = sprintf('select * from toc_table where regID="%s" and regEmail="%s" order by hid',

  $query = $connection->prepare('select * from toc_table where regID=:regID and regEmail=:regEmail order by hid');
  $query->bindParam('regEmail', $regEmail, PDO::PARAM_STR);
  $query->bindParam('regID', $regID, PDO::PARAM_STR);

  $query->execute();

  while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $entry = array(
      'first' => $row['hchoice1'],
      'second' => $row['hchoice2'],
      'hid' => $row['hid'],
      'lastupdated' => $row['lastupdated']
    );
    //print_r($entry);
    array_push($entries, $entry);
  }
  //print_r($entries);
} else {
  header("Location: login_proc.php");
  die();
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<!-- InstanceBegin template="/Templates/formPage.dwt.php" codeOutsideHTMLIsLocked="false" -->

<head>
  <title>H-E-B Tournament of Champions</title>
  <!-- InstanceBeginEditable name="doctitle" -->
  <title>Untitled Document</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
  <meta name="HandheldFriendly" content="true" />
  <title>Form</title>
  <link href="lib/formCss.css?3.1.26" rel="stylesheet" type="text/css" />
  <link type="text/css" rel="stylesheet" href="lib/nova.css?3.1.26" />
  <link type="text/css" media="print" rel="stylesheet" href="lib/printForm.css?3.1.26" />
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

    body,
    html {
      margin: 0;
      padding: 0;
      background: false;
    }

    .form-all {
      margin: 0px auto;
      padding-top: 20px;
      width: 695px;
      font-family: 'Verdana';
      font-size: 12px;
    }

    #level {
      font-size: 16px;
    }

    #warning {
      padding: 30px;
      font-size: 16px;
      font-weight: bold;
      height: 300px;
    }
  </style>

  <script src="lib/jotform.js?3.1.26" type="text/javascript"></script>
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
    <form class="jotform-form" action="table_proc.php" method="post" name="form_32946254898168" id="32946254898168" accept-charset="utf-8">
      <input type="hidden" name="formID" value="32946254898168" />
      <input type="hidden" name="noofPeople" value="<? echo $tocInfo['table'] ?>">
      <div class="form-all">
        <? if ($tocInfo['table'] == 0) { ?>
        <div id="warning">Your sponsorship is not required to submit this section</div>
        <? } else { ?>
        <ul class="form-section">
          <li class="form-line" id="id_4">
            <div id="cid_4" class="form-input-wide">
              <table summary="" cellpadding="4" cellspacing="0" class="form-matrix-table">
                <!-- header -->
                <tr>
                  <td colspan="7">
                    <h3>
                      <? echo $tocInfo['tableh'] ?>
                    </h3>
                  </td>
                </tr>
                <tr>
                  <th class="form-matrix-column-headers form-matrix-column_0">
                    Table
                  </th>
                  <th class="form-matrix-column-headers form-matrix-column_0">
                    1st Choice (Preferred)
                  </th>
                  <th class="form-matrix-column-headers form-matrix-column_0">
                    2nd Choice
                  </th>
                </tr>
                <!-- header end-->
                <!-- entry loop -->
                <?php

                for ($i = 0; $i < $tocInfo['table']; $i++) {
                  $table = 'value="Table' . ($i + 1) . '"';
                  $first = '';
                  $second = '';
                  $hid = '';
                  if (array_key_exists($i, $entries)) {
                    //$table = 'value="' . $entries[$i]['table']. '"';
                    $first = 'value="' . $entries[$i]['first'] . '"';
                    $second = 'value="' . $entries[$i]['second'] . '"';
                    $hid = $entries[$i]['hid'];
                    $last = $entries[$i]['lastupdated'];
                  }
                  echo '
            <tr>
              <td align="center" class="form-matrix-values"><input type="hidden" name="hid' . $i . '" value="' . $hid . '">
                <input type="text" readonly class="form-textbox" id="table' . $i . '" name="table' . $i . '" size="20" ' . $table . '/>
              </td>
			   <td align="center" class="form-matrix-values">
                <input type="text" class="form-textbox" id="first' . $i . '" name="first' . $i . '" size="20" ' . $first . '/>
              </td>
			  <td align="center" class="form-matrix-values">
                <input type="text" class="form-textbox" id="second' . $i . '" name="second' . $i . '" size="20" ' . $second . '/>
              </td>
            </tr>';
                }
                ?>
                <!-- entry loop end -->

              </table>
            </div>
          </li>
          <li class="form-line" id="id_2">
            <div id="cid_2" class="form-input-wide">
              <div style="text-align:left" class="form-buttons-wrapper">
                <? include 'reg_submit.php';//reg_submit_kathyOnly.php';//'reg_submit_no.php'; ?>

                <? echo '<span class="lastinfo">&nbsp;Last updated: '. $last .'</span>'; ?>
              </div>
            </div>
          </li>

        </ul>
      </div>
      <input type="hidden" id="simple_spc" name="simple_spc" value="32946254898168" />
      <script type="text/javascript">
        document.getElementById("si" + "mple" + "_spc").value = "32946254898168-32946254898168";
      </script>
      <? } //end else ?>
    </form>
    <!-- InstanceEndEditable -->
  </div>
  <div id="footer">
    <? 
$email = $_SESSION['admin'];
if ($email == 'kashwin50@hotmail.com' || $email == 'mistyc123@gmail.com')
{
}else {
	?>
    <p>Please make your tax deductible donation to: <strong>“H-E-B Tournament of Champions”
        [ Tax ID #: 76-6187819 ] 501(c)3</strong></p>
    <p><strong>Electronic Funds Transfer (ACH) is available, please refer to the &ldquo;PAYMENTS&rdquo; tab on the homepage for instructions.</strong></p>
    <p><strong>If you are paying by check, please send your payment to our new lockbox address:</strong></p>
    <p>H-E-B Tournament of Champions<br>
      Dept. 667<br>
      P. O. Box 4346<br>
      Houston, Texas 77210</p>
    <p>Phone: (210)367-1225</p>
    <p>Fax: (210)481-2247
      <p>E-Mail: <a href="mailto:kashwin50@hotmail.com">kashwin50@hotmail.com</a></p>
      <p class='important'><strong>All sponsorship money MUST be received on or before <?php echo PAYMENT ?>.</strong></p>
      <? } ?>
  </div>
</body>
<!-- InstanceEnd -->

</html>