<?php
ini_set('display_errors', 1);
error_reporting(~0);
require ('./includes/config.inc.php');
require ('./includes/mysqli_connect.php');
require ('./includes/functions.php');
session_start();
$entries = array();

if(isset($_SESSION['email']))
{
    $email = $_SESSION['email'];
    $regid = $_SESSION['regid'];
    $tocinfo = getLevelInfo($_SESSION['toclevel']);
    $alertImage = '<img src="/images/exlamation.png" width="20px">';
    $errorMessage = getErrorMessage($tocinfo);

    $e1=$e2=$e3=$e4=$e5=$e6=$e7=$e8=$e9=$e10=$e11=0; //event flag 0 or 1
    $s1=$s2=$s3=$s4=$s5=$s6=$s7=$s8=$s9=$s10=$s11="#feacba;"; //e5fbcf - cell color if to is full or not

    $domain = substr(strrchr($email, "@"), 1);
    $regDate = '';
    setlocale(LC_MONETARY, 'en_US');
    //$qString = sprintf('select * from toc_register where email="%s"', $dbc->real_escape_string($email));
    $qString = sprintf('SELECT * FROM toc_events inner join toc_register on toc_regEmail = email and toc_regid = idtoc_register where isbroker=0 and toc_regid = "%s" and toc_regEmail = "%s"',
        $dbc->real_escape_string($regid), $dbc->real_escape_string($email));

    $r = $dbc->query($qString);

    while ($row = $r->fetch_assoc())
    {
        $_SESSION['toclevel'] = $row["toclevel"];
        $_SESSION['regdate'] = $row["registerd_date"];

        if ($row['damount'] == '0') $amount = $tocinfo['amount'];
        else $amount = $row['damount'];
        $regDate = 'Registered date: ' . $_SESSION['regdate'];
        $tocadd = $row["toc_add"]; //add more participants
        $active_bdm = $row['bdm'];
        if ($row['toc_bdm'] != null && $row['toc_bdm'] != '') $active_bdm = $row['toc_bdm'];

        $entry = array('fname'=>$row['toc_firstname'],
            'lname'=>$row['toc_lastname'],
            'pemail' => $row['toc_email'],
            'title' => $row['toc_title'],
            'size' => $row['toc_charity_tee'],
            'company' => $row['toc_broker_company'],
            'ctype' => $row['toc_broker_type'],
            'bdm' => $active_bdm,
            'waiver' => $row['toc_charity_waiver'],
            'signed' => $row['toc_charity_waiver_signed'],
            'e1'=>$row['toc_tour'],
            'e2'=>$row['toc_pmeeting'],
            'e3'=>$row['toc_pdinner'],
            'e4'=>$row['toc_topgolf'],
            'e5'=>$row['toc_topgolf2'],
            'e6'=>$row['toc_summit'],
            'e7'=>$row['toc_welcome'],
            'e8'=>$row['toc_charity'],
            'e9'=>$row['toc_hall'],
            'e10'=>$row['toc_general'],
            'e11'=>$row['toc_golf'],
            'lastupdated'=>$row['lastupdated'],
            'hid'=>$row['hid']);
        array_push($entries, $entry);
    }

    $toctotal = $tocinfo['welcome'] + $tocadd; //total entry rows

    $e1display=$e2display=$e3display=$e4display=$e5display=$e6display=$e7display=$e8display=$e9display=$e10display=$spa=$e11display="";
    if ($tocinfo['tour'] == 0) $e1display = 'none';
    if ($tocinfo['private'] == 0) $e2display = 'none';
    if ($tocinfo['pdinner'] == 0) $e3display = 'none';
    if ($tocinfo['golf'] == 0) $e4display = 'none';
    if ($tocinfo['golf'] == 0) $e5display = 'none';
    if ($tocinfo['summit'] == 0) $e6display = 'none';
    if ($tocinfo['welcome'] == 0) $e7display = 'none';
    if ($tocinfo['charity'] == 0) $e8display = 'none';
    if ($tocinfo['hall'] < 19) $e9display = 'none';
    if ($tocinfo['hall'] >= 19) $e10display = 'none';
    //Spa display
    if ($tocinfo['table'] == 0) $spa = 'none';
    //regular golf
    if ($tocinfo['golf'] == 0) $e11display = 'none';

    for ($i=0; $i<count($entries); $i++)
    {
        if ($entries[$i]['fname'] != null) {
            if ($entries[$i]['e1']==1) $e1++;
            if ($entries[$i]['e2']==1) $e2++;
            if ($entries[$i]['e3']==1) $e3++;
            if ($entries[$i]['e4']==1) $e4++;
            if ($entries[$i]['e5']==1) $e5++;
            if ($entries[$i]['e6']==1) $e6++;
            if ($entries[$i]['e7']==1) $e7++;
            if ($entries[$i]['e8']==1) $e8++;
            if ($entries[$i]['e9']==1) $e9++;
            if ($entries[$i]['e10']==1) $e10++;
            if ($entries[$i]['e11']==1) $e11++;
        }
    }

    $golf = $e4 + $e5 + $e11;
    if ($e1 == $tocinfo['tour']) $s1 = "#e5fbcf";
    if ($e2 == $tocinfo['private']) $s2 = "#e5fbcf";
    if ($e3 == $tocinfo['pdinner']) $s3 = "#e5fbcf";
    if ($golf == $tocinfo['golf']) $s4 = "#e5fbcf";
    if ($golf == $tocinfo['golf']) $s5 = "#e5fbcf";
    if ($golf == $tocinfo['golf']) $s11 = "#e5fbcf";
    if ($e6 == $tocinfo['summit']) $s6 = "#e5fbcf";
    if ($e7 == $tocinfo['welcome']) $s7 = "#e5fbcf";
    if ($e8 == $tocinfo['charity']) $s8 = "#e5fbcf";
    if ($e9 == $tocinfo['hall']) $s9 = "#e5fbcf";
    if ($e10 == $tocinfo['hall']) $s10 = "#e5fbcf";

    //print session
    //echo '<div style=color:#FFF;>' . $_SESSION['email'] . '-' . $_SESSION['toclevel']
    //    . '<br>' . $_SESSION['company'] . ' - ' . $_SESSION['regid'];
    //echo 'tour: ' . $tocinfo['tour'];
    //echo '</div>';

} else {
    header("Location: login_proc.php");
    die();
}

function getErrorMessage($tocinfo) {
    $error = "";
    if($_GET["e0"]==1) $error .= "<li>Tour Academy &ndash;". $tocinfo['tour']. " participant(s) available</li>";
    if($_GET["e1"]==1) $error .= "<li>Private Meeting &ndash;". $tocinfo['private']. " participant(s) available</li>";
    if($_GET["e2"]==1) $error .= "<li>Private Dinner &ndash;". $tocinfo['pdinner']. " participant(s) available</li>";
    if($_GET["golf"]==1) $error .= "<li>Golf &ndash;". $tocinfo['golf']. " participant(s) available</li>";
    if($_GET["e5"]==1) $error .= "<li>Sponsor Summit &ndash;". $tocinfo['summit']. " participant(s) available</li>";
    if($_GET["e6"]==1) $error .= "<li>Welcome Buffet &ndash;". $tocinfo['welcome']. " participant(s) available</li>";
    if($_GET["e7"]==1) $error .= "<li>Charity Work Project &ndash;". $tocinfo['charity']. " participant(s) available</li>";
    if($_GET["e8"]==1) $error .= "<li>Hall of Fame/Sponsor Dinner &ndash;". $tocinfo['hall']. " participant(s) available</li>";
    if($_GET["e9"]==1) $error .= "<li>Reception/Sponsor Dinner &ndash;". $tocinfo['hall']. " participant(s) available</li>";

    if ($error != "")
        $error = "<p><img src=\"/images/exlamation.png\" width=\"35px\" style=\"vertical-align:middle\">&nbsp;
# of participants for the following event(s) exceeded. Please review them and save it again.</p><ul>" . $error . "</ul>";

    return $error;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><!-- InstanceBegin template="/Templates/formPage.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <title>H-E-B Tournament of Champions</title>
    <!-- InstanceBeginEditable name="doctitle" -->
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
            margin:0 auto;
            padding:0;

        }

        .form-all{
            margin:0 auto;
            padding-top:20px;
            width:95%;
            font-family:'Verdana';
            font-size:12px;
        }

        .form-matrix-column-headers { font-weight: bold; font-size: 14px;}
        #level {
            font-size: 16px;
        }
        #warning {
            padding: 30px;
            font-size: 16px;
            font-weight: bold;
            height: 300px;
        }
        .title {
            writing-mode: vertical-lr;
            text-orientation: sideways;
            font-size: 12px;
            display: inline-block;
            padding: 10px 0;
        }

        /* The container */
        .container {
            display: block;
            position: relative;
            margin-bottom: 24px;
            margin-left: 5px;
            cursor: pointer;
            font-size: 22px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Hide the browser's default checkbox */
        .container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;

        }

        /* Create a custom checkbox */
        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 25px;
            width: 25px;
            background-color: #eee;
            border: 1px solid #000;
        }

        /* On mouse-over, add a grey background color */
        .container:hover input ~ .checkmark {
            background-color: #ccc;
        }

        /* When the checkbox is checked, add a blue background */
        .container input:checked ~ .checkmark {
            background-color: #2196F3;
        }

        /* Create the checkmark/indicator (hidden when not checked) */
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        /* Show the checkmark when checked */
        .container input:checked ~ .checkmark:after {
            display: block;
        }

        /* Style the checkmark/indicator */
        .container .checkmark:after {
            left: 9px;
            top: 5px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 3px 3px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }
        .form-textbox {
            width: 85%;
            padding: 5px;
            margin: 0;
            font-size: 10px;
        }
        .form-dropdown {
            font-size: 12px;
            width: 75%;
            padding: 5px;
            margin: 0;
        }
        .alert {
            padding: 20px;
            background-color: #ff9800;
            color: white;
            opacity: 1;
            transition: opacity 0.6s;
            font-size: 16px;
            font-weight: bold;
            line-height: 18px;
            padding-left: 50px;
        }

        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .closebtn:hover {
            color: black;
        }

        .button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        .button:hover {
            text-decoration: underline;
        }
    </style>

    <script src="lib/jotform.js?3.1.26" type="text/javascript"></script>
    <script>
        var intTourValue = 0;

        function openPrinter(url) {
            if (url=='invoice') {
                window.open('_invoice.php');
            } else if (url == 'sponsorship') {
                window.open('_print_sponsorship.php');
            }
        }
    </script>
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

        /* Tooltip container */
        .tooltip1 {
            position: relative;
            display: inline-block;
            border-bottom: 1px dotted #4CAF50; /* If you want dots under the hoverable text */
        }

        /* Tooltip text */
        .tooltip1 .tooltiptext1 {
            visibility: hidden;
            width: 250px;
            background-color: #4CAF50;
            color: #fff;
            text-align: center;
            padding: 5px 0;
            border-radius: 6px;

            /* Position the tooltip text - see examples below! */
            position: absolute;
            z-index: 1;
        }

        .tooltip1 .tooltiptext1 {
            top: -5px;
            right: 105%;
        }

        /* Show the tooltip text when you mouse over the tooltip container */
        .tooltip1:hover .tooltiptext1 {
            visibility: visible;
        }

        /*tooltip2 */
        .tooltip2 {
            position: relative;
            display: inline-block;
            border-bottom: 1px dotted #fe8900; /* If you want dots under the hoverable text */
        }

        .tooltip2 .tooltiptext2 {
            visibility: hidden;
            width: 450px;
            background-color: #fe8900;
            color: #fff;
            text-align: center;
            padding: 10px;
            border-radius: 6px;

            /* Position the tooltip text - see examples below! */
            position: absolute;
            z-index: 1;
        }

        .tooltip2 .tooltiptext2 {
            top: -5px;
            right: 105%;
        }

        /* Show the tooltip text when you mouse over the tooltip container */
        .tooltip2:hover .tooltiptext2 {
            visibility: visible;
        }
        button {border: 2px solid;
            border-radius: 10px;
            padding: 7px;}
    </style>
</head>
<body class="pageStyle">
<div id="fnavi"><?php include 'formnavi.php';?>
</div>
<div id="tocform">
    <!-- InstanceBeginEditable name="form" -->
    <form class="jotform-form" action="reg_newEvent_proc.php" method="post" name="form_32946254898168" id="32946254898168" accept-charset="utf-8">
        <input type="hidden" name="formID" value="32946254898168" />
        <input type="hidden" name="noofPeople" value="<? echo $toctotal ?>">
        <input type="hidden" name="tocadd" value="<? echo $tocadd ?>">
        <div class="form-all">
            <? if (false) { ?>
                <div id="warning">Your sponsorship is not required to submit this section</div>
            <? } else { ?>
            <div class="alert">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                <img src="/images/exlamation.png" width="35px" style="vertical-align:middle"> Please complete your registration from below.<br>
                <ul>
                    <li style="display: <?php echo $e1display ?>">Tour Academy: <?php echo $e1 . ' / ' . $tocinfo['tour'] ?></li>
                    <li style="display: <?php echo $e2display ?>">Private Meeting: <?php echo $e2 . ' / ' . $tocinfo['private'] ?></li>
                    <li style="display: <?php echo $e3display ?>">Private Dinner: <?php echo $e3 . ' / ' . $tocinfo['pdinner'] ?></li>
                    <li style="display: <?php echo $e4display ?>">Topgolf / Golf <?php if ($spa!='none') echo ' / Spa in Lieu of Topgolf'; ?>: <?php echo $golf . ' / ' . $tocinfo['golf'] ?></li>
                    <li style="display: <?php echo $e6display ?>">Sponsor Summit: <?php echo $e6 . ' / ' . $tocinfo['summit'] ?></li>
                    <li style="display: <?php echo $e7display ?>">Welcome Dinner: <?php echo $e7 . ' / ' . $tocinfo['welcome'] ?></li>
                    <li style="display: <?php echo $e8display ?>">Charity Work Project: <?php echo $e8 . ' / ' . $tocinfo['charity'] ?></li>
                    <li style="display: <?php echo $e9display ?>">Hall of Fame/Sponsor Dinner: <?php echo $e9 . ' / ' . $tocinfo['hall'] ?></li>
                    <li style="display: <?php echo $e10display ?>">Reception/Sponsor Dinner: <?php echo $e10 . ' / ' . $tocinfo['hall'] ?></li>
                </ul>
                <div style="margin-top:20px;border: 2px #fff4f4 solid; padding: 10px; text-align: center">Remember to click the "Update" button anytime you make changes to this form.</div>
            </div>
            <ul class="form-section">
                <li class="form-line" id="id_4">
                    <div id="cid_4" class="form-input-wide">
                        <table summary="" cellpadding="4" cellspacing="0" class="form-matrix-table" width="100%">
                            <!-- header -->
                            <tr><td colspan="7"><h2><? echo "Events" . " for " . $_SESSION['company'] . ' ($' . number_format($tocinfo['amount']) . ')';  ?>
                                        <button style="cursor:pointer" onClick="javascript:openPrinter('invoice');" type="button">Print Invoice</button>
                                    </h2></td></tr>
                            <?php if ($errorMessage) {
                                echo "<tr><td colspan='15' style='font-size:12px;font-weight:bold;background-color: #fec2c2;padding:20px;'>".$errorMessage."</td></tr>";
                            }
                            ?>
                            <?php
                            $middle=$end='';
                            $top3 = (int)$tocinfo['tour'];
                            if ( $top3 > 0) {
                                $middle = '<td colspan="3" align="center" class="form-matrix-values" style="background-color:'.$s4.';display:'.$e4display.';width:40px">
                                        <strong style="font-size:14px">'.$golf.'</strong>/'.$tocinfo['golf'].'</td>';
                            } else {
                                $end = '<td colspan="3" align="center" class="form-matrix-values" style="background-color:'.$s4.';display:'.$e4display.';width:40px">
                                        <strong style="font-size:14px">'.$golf.'</strong>/'.$tocinfo['golf'].'</td>';
                            }

                            echo '<tr>
			<td align="center" class="form-matrix-values">&nbsp;</td>
			<td align="center" class="form-matrix-values">&nbsp;</td>
			<td align="center" class="form-matrix-values">&nbsp;</td>
			<td align="center" class="form-matrix-values" style="background-color:'.$s1.';display:'.$e1display.';width:40px"><strong style="font-size:14px">'.$e1.'</strong>/'.$tocinfo['tour'].'</td>
			<td align="center" class="form-matrix-values" style="background-color:'.$s2.';display:'.$e2display.';width:40px"><strong style="font-size:14px">'.$e2.'</strong>/'.$tocinfo['private'].'</td>
			<td align="center" class="form-matrix-values" style="background-color:'.$s3.';display:'.$e3display.';width:40px"><strong style="font-size:14px">'.$e3.'</strong>/'.$tocinfo['private'].'</td>
			'.$middle.'
			<td align="center" class="form-matrix-values" style="background-color:'.$s6.';display:'.$e6display.';width:40px"><strong style="font-size:14px">'.$e6.'</strong>/'.$tocinfo['summit'].'</td>
			<td align="center" class="form-matrix-values" style="background-color:'.$s7.';display:'.$e7display.';width:40px"><strong style="font-size:14px">'.$e7.'</strong>/'.$tocinfo['welcome'].'</td>
			<td align="center" class="form-matrix-values" style="background-color:'.$s8.';display:'.$e8display.';width:40px"><strong style="font-size:14px">'.$e8.'</strong>/'.$tocinfo['charity'].'</td>
			<td align="center" class="form-matrix-values">&nbsp;</td>
			<td align="center" class="form-matrix-values">&nbsp;</td>
			<td align="center" class="form-matrix-values" style="background-color:'.$s9.';display:'.$e9display.';width:40px"><strong style="font-size:14px">'.$e9.'</strong>/'.$tocinfo['hall'].'</td>
			<td align="center" class="form-matrix-values" style="background-color:'.$s10.';display:'.$e10display.';width:40px"><strong style="font-size:14px">'.$e10.'</strong>/'.$tocinfo['hall'].'</td>
			'.$end.'
			</tr>';
                            ?>
                            <th class="form-matrix-column-headers form-matrix-column_0" width="25%">
                                Participant Name <div style="color:red;margin:10px;">Please ensure that you spell all names correctly (use upper and lower case)
                                    - DO NOT use ALL CAPS or all LOWER CASE. <span style="text-decoration: underline;">Name badges will be made from your entries below.</span></div>
                            </th>
                            <th class="form-matrix-column-headers form-matrix-column_0" width="25%">
                                Participant Title <br>& Email
                            </th>
                            <th class="form-matrix-column-headers form-matrix-column_0" width="10%">
                                H-E-B Business Dev. Manager
                            </th>
                            <th class="form-matrix-column-headers form-matrix-column_0" style="background-color:<?php echo $s1 ?>; display: <?php echo $e1display ?>"  >
                                <?php if ($s1=='#feacba;') echo $alertImage ?><br/><p class="title">Tour Academy (<?php echo FIRST ?>)</p>
                            </th>
                            <th class="form-matrix-column-headers form-matrix-column_0" style="background-color:<?php echo $s2 ?>; display: <?php echo $e2display ?>"  >
                                <?php if ($s2=='#feacba;') echo $alertImage ?><br/><p class="title">Private Meeting (<?php echo SECOND ?>)</p>
                            </th>
                            <th class="form-matrix-column-headers form-matrix-column_1" style="background-color:<?php echo $s3 ?>; display: <?php echo $e3display ?>"  >
                                <?php if ($s3=='#feacba;') echo $alertImage ?><br/><p class="title">Private Dinner (<?php echo SECOND ?>)</p>
                            </th>
                            <!-- golf -->
                            <?php if ($top3 > 0) { ?>
                                <th width="40px" class="form-matrix-column-headers form-matrix-column_2" style="background-color:<?php echo $s4 ?>; display: <?php echo $e4display ?>"  >
                                    <?php if ($s4=='#feacba;') echo $alertImage ?><br/><p class="title">Topgolf (<?php echo THIRD ?>)</p>
                                </th>
                                <th width="40px" class="form-matrix-column-headers form-matrix-column_2" style="background-color:<?php echo $s11 ?>; display: <?php echo $e11display ?>"  >
                                    <?php if ($s11=='#feacba;') echo $alertImage ?><br/><p class="title">Golf (<?php echo FIFTH ?>)</p>
                                </th>
                                <th <?php if ($spa!='none') echo 'width="40px"'; else echo 'width="0"' ?> class="form-matrix-column-headers form-matrix-column_3" style="background-color:<?php echo $s5 ?>; display: <?php echo $e5display ?>"  >
                                    <?php if ($s5=='#feacba;' && $spa!='none') echo $alertImage ?><br/><p class="title" style="display: <?php echo $spa; ?>">Spa in Lieu of Topgolf</p>
                                </th>
                            <?php } ?>
                            <!-- golf -->
                            <th class="form-matrix-column-headers form-matrix-column_4" style="background-color:<?php echo $s6 ?>; display: <?php echo $e6display ?>"  >
                                <?php if ($s6=='#feacba;') echo $alertImage ?><br/><p class="title">Sponsor Summit (<?php echo THIRD ?>)</p>
                            </th>
                            <th class="form-matrix-column-headers form-matrix-column_5" style="background-color:<?php echo $s7 ?>; display: <?php echo $e7display ?>"  >
                                <?php if ($s7=='#feacba;') echo $alertImage ?><br/><p class="title">Welcome Dinner (<?php echo THIRD ?>)</p>
                            </th>
                            <th class="form-matrix-column-headers form-matrix-column_3" style="background-color:<?php echo $s8 ?>; display: <?php echo $e8display ?>"  >
                                <?php if ($s8=='#feacba;') echo $alertImage ?> <br/><p class="title">Charity Work Project (<?php echo FOURTH ?>)</p>
                            </th>
                            <th class="form-matrix-column-headers form-matrix-column_4"  >
                                <p>T-Shirt Size for CWP</p>
                            </th>
                            <th class="form-matrix-column-headers form-matrix-column_4" style="width:15px" >
                                <p class="title">CWP Waiver Status</p>
                            </th>
                            <th class="form-matrix-column-headers form-matrix-column_5" style="background-color:<?php echo $s9 ?>; display: <?php echo $e9display ?>"  >
                                <?php if ($s9=='#feacba;') echo $alertImage ?><br/><p class="title">Sponsor Dinner<br>Hall of Fame (<?php echo FOURTH ?>)</p>
                            </th>
                            <th class="form-matrix-column-headers form-matrix-column_5" style="background-color:<?php echo $s10 ?>; display: <?php echo $e10display ?>"  >
                                <?php if ($s10=='#feacba;') echo $alertImage ?><br/><p class="title">Sponsor Dinner<br>Reception (<?php echo FOURTH ?>)</p>
                            </th>
                            <!-- golf -->
                            <?php if ($top3 == 0) { ?>
                                <th width="40px" class="form-matrix-column-headers form-matrix-column_2" style="background-color:<?php echo $s4 ?>; display: <?php echo $e4display ?>"  >
                                    <?php if ($s4=='#feacba;') echo $alertImage ?><br/><p class="title">Topgolf (<?php echo FIFTH ?>)</p>
                                </th>
                                <th width="40px" class="form-matrix-column-headers form-matrix-column_2" style="background-color:<?php echo $s11 ?>; display: <?php echo $e11display ?>"  >
                                    <?php if ($s11=='#feacba;') echo $alertImage ?><br/><p class="title">Golf (<?php echo FIFTH ?>)</p>
                                </th>
                                <th <?php if ($spa!='none') echo 'width="40px"'; else echo 'width="0"' ?> class="form-matrix-column-headers form-matrix-column_3" style="background-color:<?php echo $s5 ?>; display: <?php echo $e5display ?>"  >
                                    <?php if ($s5=='#feacba;' && $spa!='none') echo $alertImage ?><br/><p class="title" style="display: <?php echo $spa; ?>">Spa in Lieu of Topgolf</p>
                                </th>
                            <?php } ?>
                            <!-- golf -->
                            </tr>
                            <!-- header end-->
                            <!-- entry loop -->
                            <?php
                            for ($i=0; $i<$toctotal; $i++)
                            {
                                $firstname='';
                                $lastname='';
                                $title='';
                                $pemail='';
                                $size='';
                                //$ctype='';
                                //$company='';
                                $bdm='';
                                //$last='';
                                $check0=$check1=$check2=$check3=$check4=$check5=$check6=$check7=$check8=$check9=$check10='';
                                $hid='';
                                $waiver='';
                                $waiverStatus='';
                                $signed='';

                                if (array_key_exists($i, $entries))
                                {
                                    //print_r($entries[$i]);
                                    $firstname = 'value="' .$entries[$i]['fname'] . '"';
                                    $lastname  = 'value="' .$entries[$i]['lname'] . '"';
                                    //$company   = 'value="' .$entries[$i]['company'] . '"';
                                    $bdm       = 'value="' .$entries[$i]['bdm'] . '"';
                                    //$ctype     = 'value="' .$entries[$i]['ctype'] . '"';
                                    $pemail    = 'value="' .$entries[$i]['pemail'] . '"';
                                    $title     = 'value="' .$entries[$i]['title'] . '"';
                                    $size     = $entries[$i]['size'];
                                    if ($size != '' && $size != NULL) {
                                        $size = '<option value="'.$size.'" selected>'.$size.'</option>';
                                    }
                                    $ctype = $entries[$i]['ctype'];
                                    if ($ctype != '' && $ctype != NULL) {
                                        $ctype = '<option value="'.$ctype.'" selected>'.$ctype.'</option>';
                                    }
                                    $hid = $entries[$i]['hid'];

                                    $waiver = $entries[$i]['waiver'];
                                    $signed = $entries[$i]['signed'];
                                    $waiverMesssage = '';
                                    $show = 'display:none'; //tooltip
                                    $tooltip = '';
                                    if($waiver == 1) {
                                        $waiverStatus = '<img src="/images/check4.gif">';
                                        $waiverMesssage = 'Signed at '.$signed;
                                        $tooltip = 1;
                                    } else {
                                        $waiverStatus = '<img src="/images/q.png" width="25px">';
                                        $waiverMesssage = '<div><p>All participants listed below that will attend the Charity Work Project must sign an electronic 
Photo & Work Waiver form. Once you have entered a participant(s) name, please email the following link to each individual listed below. Request that the participant 
read both Waivers and fill out the information requested at the bottom of both forms. Please note that you must have their name listed below, before they will be able 
to complete the electronic form.</p>
<p>Waiver form link: <a style="font-size:16px;color:#0000CC;font-weight:bold" target="_blank" href="https://hebtoc.com/waiver/Charity_Waiver">https://hebtoc.com/waiver/Charity_Waiver</a></p>
<p>PASSWORD for Wavier form: <span style="font-size:18px;font-weight: bold;color:#0000CC">'.WAIVERCODE.'</span></p></div>';
                                        $tooltip = 2;
                                    }

                                    $last= $entries[$i]['lastupdated'];

                                    if ($entries[$i]['e1'] == '1') { $check0 = "checked"; }
                                    if ($entries[$i]['e2'] == '1') { $check1 = "checked"; }
                                    if ($entries[$i]['e3'] == '1') { $check2 = "checked"; }
                                    if ($entries[$i]['e4'] == '1') { $check3 = "checked"; }
                                    if ($entries[$i]['e5'] == '1') { $check4 = "checked"; }
                                    if ($entries[$i]['e6'] == '1') { $check5 = "checked"; }
                                    if ($entries[$i]['e7'] == '1') { $check6 = "checked"; }
                                    if ($entries[$i]['e8'] == '1') { $check7 = "checked"; $show=""; }
                                    if ($entries[$i]['e9'] == '1') { $check8 = "checked"; }
                                    if ($entries[$i]['e10'] == '1') { $check9 = "checked"; }
                                    if ($entries[$i]['e11'] == '1') { $check10 = "checked"; } //regular golf
                                }
                                $middle_check=$end_check='';
                                $col_content = '<!-- golf -->
              <td align="center" class="form-matrix-values" style="display:'.$e4display.'">
			  <label class="container">
                <input class="form-radio" type="checkbox" name="events'.$i.'[]" value="3" ' . $check3 .' /><span class="checkmark"></span>
				</label>
              </td>
              <!-- regular golf -->
              <td align="center" class="form-matrix-values" style="display:'.$e11display.'">
			  <label class="container">
                <input class="form-radio" type="checkbox" name="events'.$i.'[]" value="10" ' . $check10 .' /><span class="checkmark"></span>
				</label>
              </td>
              <!-- new golf-->
              <td align="center" class="form-matrix-values" style="display:'.$e5display.'">
			  <label class="container" style="display:'.$spa.'">
                <input class="form-radio" type="checkbox" name="events'.$i.'[]" value="4" ' . $check4 .' /><span class="checkmark"></span>
				</label>
              </td>
              <!-- golf -->';
                                if ($top3 > 0) {
                                    $middel_check = $col_content;
                                } else {
                                    $end_check = $col_content;
                                }
                                echo '
            <tr>	  
              <th align="left" class="form-matrix-row-headers">
        <div id="cid_3" class="form-input"><span class="form-sub-label-container">
        <span style="font-size:10px">'.str_pad(($i+1), 2, "0", STR_PAD_LEFT).'</span>
        <input type="hidden" name="hid'.$i.'" value="'.$hid.'">
        <input class="form-textbox" type="text"  name="first'.$i.'" id="first'.$i.'" ' . $firstname . ' />
            <label class="form-sub-label" for="first_3" id="sublabel_first"> First Name </label></span><span class="form-sub-label-container">
			<input class="form-textbox" type="text" name="last'.$i.'" id="last'.$i.'" ' . $lastname . ' />
            <label class="form-sub-label" for="last_3" id="sublabel_last"> Last Name </label></span><br>
        </div>
              </th>
		<th align="left" class="form-matrix-row-headers">        
        <div id="cid_4" class="form-input"><span class="form-sub-label-container">
        <input type="hidden" name="hid'.$i.'" value="'.$hid.'">
        <input class="form-textbox" type="text"  name="title'.$i.'" id="title'.$i.'" ' . $title . ' />
            <label class="form-sub-label" for="title_3" id="title"> Title</label></span>
			<span class="form-sub-label-container">
			<input class="form-textbox" type="text"' . $pemail . ' name="pemail'.$i.'" id="pemail'.$i.'" ' . $pemail . ' />
            <label class="form-sub-label" for="last_3" id="sublabel_last"> Email</label></span>
        </div>
              </th>
              <td align="center" class="form-matrix-values">
                <span style="font-size:10px"><input type="text" class="form-textbox" id="bdm'.$i.'" name="bdm'.$i.'" size="25" ' . $bdm . '/>
              </td>
			  <td align="center" class="form-matrix-values" style="display:'.$e1display.'">
			  	<label class="container">
                <input class="form-radio" type="checkbox" name="events'.$i.'[]" value="0" ' . $check0 .'  /><span class="checkmark"></span>
				</label>
              </td>
              <td align="center" class="form-matrix-values" style="display:'.$e2display.'">
			  	<label class="container">
                <input class="form-radio" type="checkbox" name="events'.$i.'[]" value="1" ' . $check1 .'  /><span class="checkmark"></span>
				</label>
              </td>
              <td align="center" class="form-matrix-values" style="display:'.$e3display.'">
			  	<label class="container">
                <input class="form-radio" type="checkbox" name="events'.$i.'[]" value="2" ' . $check2 .' /><span class="checkmark"></span>
				</label>
              </td>
              <!-- golf -->
              '.$middel_check.'
              <!-- golf -->
              <td align="center" class="form-matrix-values" style="display:'.$e6display.'">
			  <label class="container">
                <input class="form-radio" type="checkbox" name="events'.$i.'[]" value="5" ' . $check5 .' /><span class="checkmark"></span>
				</label>
              </td>
              <td align="center" class="form-matrix-values" style="display:'.$e7display.'">
			  <label class="container">
                <input class="form-radio" type="checkbox" name="events'.$i.'[]" value="6" ' . $check6 .' /><span class="checkmark"></span>
				</label>
              </td>
			  <td align="center" class="form-matrix-values" style="display:'.$e8display.'">
			  <label class="container">
                <input class="form-radio" type="checkbox" name="events'.$i.'[]" value="7" ' . $check7 .' /><span class="checkmark"></span>
				</label>
              </td>
              <td align="center" class="form-matrix-values">
                <select class="form-dropdown" style="width:120px" id="size'.$i.'" name="size'.$i.'">
		  		<option value="">Select</option>
				'.$size.'
				<option value="S">S</option>
				<option value="M">M</option>
				<option value="L">L</option>
				<option value="XL">XL</option>
				<option value="2XL">2XL</option>
				<option value="3XL">3XL</option>
          </select>
              </td>
              <td align="center" class="form-matrix-values">
                <div class="tooltip'.$tooltip.'" style="'.$show.'">'.$waiverStatus.'<span class="tooltiptext'.$tooltip.'">'.$waiverMesssage.'</span></div>
                <input type="hidden" name="waiver'.$i.'" value="'.$waiver.'">
                <input type="hidden" name="signed'.$i.'" value="'.$signed.'">
              </td>
              <td align="center" class="form-matrix-values" style="display:'.$e9display.'">
			  <label class="container">
                <input class="form-radio" type="checkbox" name="events'.$i.'[]" value="8" ' . $check8 .' /><span class="checkmark"></span>
				</label>
              </td>
              <td align="center" class="form-matrix-values" style="display:'.$e10display.'">
			  <label class="container">
                <input class="form-radio" type="checkbox" name="events'.$i.'[]" value="9" ' . $check9 .' /><span class="checkmark"></span>
				</label>
              </td>
              <!-- golf -->
              '.$end_check.'
              <!-- golf -->
            </tr>';
                            }
                            echo '<tr>
			<td align="center" class="form-matrix-values"><a href="./reg_newEvent_moreRow.php">+ Add more rows</a> <br><span style="color:red">If you make changes on this form, please click the "Update" button first before adding more rows.
			<strong>* You need to add at least one participant in order to add more rows.</strong></span></td>
			<td align="center" class="form-matrix-values">&nbsp;</td>
			<td align="center" class="form-matrix-values">&nbsp;</td>
			<td align="center" class="form-matrix-values" style="background-color:'.$s1.';display:'.$e1display.'"><strong style="font-size:14px">'.$e1.'</strong>/'.$tocinfo['tour'].'</td>
			<td align="center" class="form-matrix-values" style="background-color:'.$s2.';display:'.$e2display.'"><strong style="font-size:14px">'.$e2.'</strong>/'.$tocinfo['private'].'</td>
			<td align="center" class="form-matrix-values" style="background-color:'.$s3.';display:'.$e3display.'"><strong style="font-size:14px">'.$e3.'</strong>/'.$tocinfo['private'].'</td>
			<!-- golf -->
              '.$middle.'
              <!-- golf -->
			<td align="center" class="form-matrix-values" style="background-color:'.$s6.';display:'.$e6display.'"><strong style="font-size:14px">'.$e6.'</strong>/'.$tocinfo['summit'].'</td>
			<td align="center" class="form-matrix-values" style="background-color:'.$s7.';display:'.$e7display.'"><strong style="font-size:14px">'.$e7.'</strong>/'.$tocinfo['welcome'].'</td>
			<td align="center" class="form-matrix-values" style="background-color:'.$s8.';display:'.$e8display.'"><strong style="font-size:14px">'.$e8.'</strong>/'.$tocinfo['charity'].'</td>
			<td align="center" class="form-matrix-values">&nbsp;</td>
			<td align="center" class="form-matrix-values">&nbsp;</td>
			<td align="center" class="form-matrix-values" style="background-color:'.$s9.';display:'.$e9display.'"><strong style="font-size:14px">'.$e9.'</strong>/'.$tocinfo['hall'].'</td>
			<td align="center" class="form-matrix-values" style="background-color:'.$s10.';display:'.$e10display.'"><strong style="font-size:14px">'.$e10.'</strong>/'.$tocinfo['hall'].'</td>
			<!-- golf -->
              '.$end.'
              <!-- golf -->
			</tr>';
                            ?>
                            <!-- entry loop end -->

                        </table>
                    </div>
                </li>
                <li class="form-line" id="id_2">
                    <div id="cid_2" class="form-input-wide">
                        <div style="text-align:left" class="form-buttons-wrapper">
                            <button id="input_2" type="submit" class="button">
                                Update
                            </button>
                            <? echo '<span class="lastinfo">&nbsp;Last updated: '.$last.'</span>'; ?>
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
        <p>Please make your tax deductible donation to:  <strong>“H-E-B Tournament of Champions”
                [ Tax ID #:  76-6187819 ]       501(c)3</strong></p>
        <p><strong>Electronic Funds  Transfer (ACH) is available, please refer to the &ldquo;PAYMENTS&rdquo; tab on the homepage  for instructions.</strong></p>
        <p><strong>If you are paying by  check, please send your payment to our new lockbox address:</strong></p>
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
<!-- InstanceEnd --></html>
<?
$r->close();
$dbc->close();
?>
