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

    $e1=$e2=$e3=$e4=$e5=$e6=$e7=$e8=$e9=$e10=0;
    $s1=$s2=$s3=$s4=$s5=$s6=$s7=$s8=$s9=$s10="#feacba;"; //e5fbcf

    $domain = substr(strrchr($email, "@"), 1);
    $regDate = '';
    setlocale(LC_MONETARY, 'en_US');
    //$qString = sprintf('select * from toc_register where email="%s"', $dbc->real_escape_string($email));
    $qString = sprintf('SELECT * FROM toc_events inner join toc_register on toc_regEmail = email and toc_regid = idtoc_register where toc_regid = "%s" and toc_regEmail = "%s"',
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
        $toctotal = $tocinfo['welcome'] + $tocadd;

        $entry = array('fname'=>$row['toc_firstname'],
            'lname'=>$row['toc_lastname'],
            'pemail' => $row['toc_email'],
            'title' => $row['toc_title'],
            'size' => $row['toc_charity_tee'],
            'company' => $row['toc_broker_company'],
            'level' => $row['toc_broker_level'],
            'ctype' => $row['toc_broker_type'],
            'bdm' => $row['toc_bdm'],
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
            'lastupdated'=>$row['lastupdated'],
            'hid'=>$row['hid']);
        //print_r($entry);
        array_push($entries, $entry);
    }

    $brokerrow = 100;

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
        }
    }

    $golf = $e4 + $e5;
    if ($e1 == $brokerrow) $s1 = "#e5fbcf";
    if ($e2 == $brokerrow) $s2 = "#e5fbcf";
    if ($e3 == $brokerrow) $s3 = "#e5fbcf";
    if ($golf == $brokerrow) $s4 = "#e5fbcf";
    if ($golf == $brokerrow) $s5 = "#e5fbcf";
    if ($e6 == $brokerrow) $s6 = "#e5fbcf";
    if ($e7 == $brokerrow) $s7 = "#e5fbcf";
    if ($e8 == $brokerrow) $s8 = "#e5fbcf";
    if ($e9 == $brokerrow) $s9 = "#e5fbcf";
    if ($e10 == $brokerrow) $s10 = "#e5fbcf";

    //print session
    //echo '<div style=color:#FFF;>' . $_SESSION['email'] . '-' . $_SESSION['toclevel']
    //    . '<br>' . $_SESSION['company'] . ' - ' . $_SESSION['regid'];
    //echo '<br>entries:' . var_dump($entries);
    //echo '<br>toctotal:' . $toctotal;
    //echo '</div>';

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
            background:false;
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

    </style>
</head>
<body class="pageStyle">
<div id="fnavi"><?php include 'formnavi.php';?>
</div>
<div id="tocform">
    <!-- InstanceBeginEditable name="form" -->
    <form class="jotform-form" action="reg_newEvent_broker_proc.php" method="post" name="form_32946254898168" id="32946254898168" accept-charset="utf-8">
        <input type="hidden" name="formID" value="32946254898168" />
        <input type="hidden" name="noofPeople" value="<? echo $brokerrow ?>">
        <div class="form-all">
            <? if (false) { ?>
                <div id="warning">Your sponsorship is not required to submit this section</div>
            <? } else { ?>
            <div class="alert">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                <img src="/images/exlamation.png" width="35px" style="vertical-align:middle"> Please complete your registration from below.<br>
                <ul>
                    <li>Tour Academy: <?php echo $e1 . ' / ' . $brokerrow ?></li>
                    <li>Private Meeting: <?php echo $e2 . ' / ' . $brokerrow ?></li>
                    <li>Private Dinner: <?php echo $e3 . ' / ' . $brokerrow ?></li>
                    <li>Topgolf / Spain Lieu of Topgolf: <?php echo $golf . ' / ' . $brokerrow ?></li>
                    <li>Sponsor Summit: <?php echo $e6 . ' / ' . $brokerrow ?></li>
                    <li>Welcome Dinner: <?php echo $e7 . ' / ' . $brokerrow ?></li>
                    <li>Charity Work Project: <?php echo $e8 . ' / ' . $brokerrow ?></li>
                    <li>Hall of Fame: <?php echo $e9 . ' / ' . $brokerrow ?></li>
                    <li>General Reception: <?php echo $e10 . ' / ' . $brokerrow ?></li>
                </ul>
                <div style="margin-top:20px;border: 2px #fff4f4 solid; padding: 10px; text-align: center">Remember to click the "Update" button anytime you make changes to this form.</div>
            </div>
            <ul class="form-section">
                <li class="form-line" id="id_4">
                    <div id="cid_4" class="form-input-wide">
                        <table summary="" cellpadding="4" cellspacing="0" class="form-matrix-table" width="100%">
                            <!-- header -->
                            <tr><td colspan="7"><h2><? echo "Events for " . $_SESSION['company']  ?> (Broker)</h2></td></tr>
                            <?php
                            echo '<tr>
			<td align="center" class="form-matrix-values">&nbsp;</td>
			<td align="center" class="form-matrix-values">&nbsp;</td>
			<td align="center" class="form-matrix-values">&nbsp;</td>
			<td align="center" class="form-matrix-values">&nbsp;</td>
			<td align="center" class="form-matrix-values">&nbsp;</td>
			<td align="center" class="form-matrix-values">&nbsp;</td>
			<td align="center" class="form-matrix-values" style="background-color:'.$s1.';width:40px"><strong style="font-size:14px">'.$e1.'</strong>/'.$brokerrow.'</td>
			<td align="center" class="form-matrix-values" style="background-color:'.$s2.';width:40px"><strong style="font-size:14px">'.$e2.'</strong>/'.$brokerrow.'</td>
			<td align="center" class="form-matrix-values" style="background-color:'.$s3.';width:40px"><strong style="font-size:14px">'.$e3.'</strong>/'.$brokerrow.'</td>
			<td colspan="2" align="center" class="form-matrix-values" style="background-color:'.$s4.';width:70px"><strong style="font-size:14px">'.$golf.'</strong>/'.$brokerrow.'</td>
			<td align="center" class="form-matrix-values" style="background-color:'.$s6.';width:40px"><strong style="font-size:14px">'.$e6.'</strong>/'.$brokerrow.'</td>
			<td align="center" class="form-matrix-values" style="background-color:'.$s7.';width:40px"><strong style="font-size:14px">'.$e7.'</strong>/'.$brokerrow.'</td>
			<td align="center" class="form-matrix-values" style="background-color:'.$s8.';width:40px"><strong style="font-size:14px">'.$e8.'</strong>/'.$brokerrow.'</td>
			<td align="center" class="form-matrix-values">&nbsp;</td>
			<td align="center" class="form-matrix-values" style="background-color:'.$s9.';width:40px"><strong style="font-size:14px">'.$e9.'</strong>/'.$brokerrow.'</td>
			<td align="center" class="form-matrix-values" style="background-color:'.$s10.';width:40px"><strong style="font-size:14px">'.$e10.'</strong>/'.$brokerrow.'</td>
			
			</tr>'
                            ?>
                            <th class="form-matrix-column-headers form-matrix-column_0">
                                Sponsorship Level
                            </th>
                            <th class="form-matrix-column-headers form-matrix-column_0">
                                Company Name
                            </th>
                            <th class="form-matrix-column-headers form-matrix-column_0">
                                H-E-B<br>BDM<br>Name
                            </th>
                            <th class="form-matrix-column-headers form-matrix-column_0">
                                My Company is
                            </th>
                            <th class="form-matrix-column-headers form-matrix-column_0">
                                Participant Name
                            </th>
                            <th class="form-matrix-column-headers form-matrix-column_0">
                                Participant Title <br>& Email
                            </th>
                            <th class="form-matrix-column-headers form-matrix-column_0" style="background-color:<?php echo $s1 ?>">
                                <p class="title">Tour Academy (<?php echo FIRST ?>)</p>
                            </th>
                            <th class="form-matrix-column-headers form-matrix-column_0" style="background-color:<?php echo $s2 ?>">
                                <p class="title">Private Meeting (<?php echo SECOND ?>)</p>
                            </th>
                            <th class="form-matrix-column-headers form-matrix-column_1" style="background-color:<?php echo $s3 ?>">
                                <p class="title">Private Dinner (<?php echo SECOND ?>)</p>
                            </th>
                            <th class="form-matrix-column-headers form-matrix-column_2" style="background-color:<?php echo $s4 ?>">
                                <p class="title">Topgolf (<?php echo SECOND ?>)</p>
                            </th>
                            <th class="form-matrix-column-headers form-matrix-column_3" style="background-color:<?php echo $s5 ?>">
                                <p class="title">Spain Lieu of Topgolf</p>
                            </th>
                            <th class="form-matrix-column-headers form-matrix-column_4" style="background-color:<?php echo $s6 ?>">
                                <p class="title">Sponsor Summit (<?php echo THIRD ?>)</p>
                            </th>
                            <th class="form-matrix-column-headers form-matrix-column_5" style="background-color:<?php echo $s7 ?>">
                                <p class="title">Welcome Dinner (<?php echo THIRD ?>)</p>
                            </th>
                            <th class="form-matrix-column-headers form-matrix-column_3" style="background-color:<?php echo $s8 ?>">
                                <p class="title">Charity Work Project (<?php echo FOURTH ?>)</p>
                            </th>
                            <th class="form-matrix-column-headers form-matrix-column_4">
                                <p class="title">T-Shirts for CWP</p>
                            </th>
                            <th class="form-matrix-column-headers form-matrix-column_5" style="background-color:<?php echo $s9 ?>">
                                <p class="title">Hall of Frame (<?php echo FOURTH ?>)</p>
                            </th>
                            <th class="form-matrix-column-headers form-matrix-column_5" style="background-color:<?php echo $s9 ?>">
                                <p class="title">General Reception (<?php echo FOURTH ?>)</p>
                            </th>
                            </tr>
                            <!-- header end-->
                            <!-- entry loop -->
                            <?php
                            for ($i=0; $i<$brokerrow; $i++)
                            {
                                $firstname='';
                                $lastname='';
                                $title='';
                                $pemail='';
                                $size='';
                                $ctype='';
                                $company='';
                                $level='';
                                $bdm='';
                                //$last='';
                                $check0=$check1=$check2=$check3=$check4=$check5=$check6=$check7=$check8=$check9='';
                                $hid='';

                                if (array_key_exists($i, $entries))
                                {
                                    //print_r($entries[$i]);
                                    $firstname = 'value="' .$entries[$i]['fname'] . '"';
                                    $lastname  = 'value="' .$entries[$i]['lname'] . '"';
                                    $company   = 'value="' .$entries[$i]['company'] . '"';
                                    $bdm       = 'value="' .$entries[$i]['bdm'] . '"';
                                    //$ctype     = 'value="' .$entries[$i]['ctype'] . '"';
                                    $pemail    = 'value="' .$entries[$i]['pemail'] . '"';
                                    $title     = 'value="' .$entries[$i]['title'] . '"';

                                    $level   = $entries[$i]['level'];
                                    if ($level != '' && $level != NULL) {
                                        $level = '<option value="'.$level.'" selected>'.$level.'</option>';
                                    }

                                    $size     = $entries[$i]['size'];
                                    if ($size != '' && $size != NULL) {
                                        $size = '<option value="'.$size.'" selected>'.$size.'</option>';
                                    }

                                    $ctype = $entries[$i]['ctype'];
                                    if ($ctype != '' && $ctype != NULL) {
                                        $ctype = '<option value="'.$ctype.'" selected>'.$ctype.'</option>';
                                    }
                                    $hid = $entries[$i]['hid'];
                                    $last= $entries[$i]['lastupdated'];

                                    if ($entries[$i]['e1'] == '1') { $check0 = "checked"; }
                                    if ($entries[$i]['e2'] == '1') { $check1 = "checked"; }
                                    if ($entries[$i]['e3'] == '1') { $check2 = "checked"; }
                                    if ($entries[$i]['e4'] == '1') { $check3 = "checked"; }
                                    if ($entries[$i]['e5'] == '1') { $check4 = "checked"; }
                                    if ($entries[$i]['e6'] == '1') { $check5 = "checked"; }
                                    if ($entries[$i]['e7'] == '1') { $check6 = "checked"; }
                                    if ($entries[$i]['e8'] == '1') { $check7 = "checked"; }
                                    if ($entries[$i]['e9'] == '1') { $check8 = "checked"; }
                                    if ($entries[$i]['e10'] == '1') { $check9 = "checked"; }
                                }
                                echo '
            <tr>
            
            <td align="center" class="form-matrix-values" width="150px">
            <span style="font-size:10px">'.str_pad(($i+1), 2, "0", STR_PAD_LEFT).'</span>&nbsp;
                <select class="form-dropdown" id="level'.$i.'" name="level'.$i.'">
		  		<option value="">Select</option>
				'.$level.'
				<option value="Humanitarian">Humanitarian</option>
			<option value="Chairman">Chairman</option>
			<option value="Presidential">Presidential</option>
          </select>
              </td>
              
			 <td align="center" class="form-matrix-values" width="130px">
                <input type="text" class="form-textbox" id="company'.$i.'" name="company'.$i.'" size="15" ' . $company . '/>
              </td>
              
              <td align="center" class="form-matrix-values" width="80px">
                <span style="font-size:10px"><input type="text" class="form-textbox" id="bdm'.$i.'" name="bdm'.$i.'" size="15" ' . $bdm . '/>
              </td>
			  
			  <td align="center" class="form-matrix-values" width="150px">
                <select class="form-dropdown" id="ctype'.$i.'" name="ctype'.$i.'">
		  		<option value="">Select</option>
				'.$ctype.'
				<option value="Own Brand Exclusive">Own Brand Exclusive</option>
			<option value="National Brand and Own Brand">National Brand and Own Brand</option>
			<option value="National Brand Exclusive">National Brand Exclusive</option>
          </select>
              </td>
			  
              <th align="left" class="form-matrix-row-headers">
                
        <div id="cid_3" class="form-input"><span class="form-sub-label-container">
        <input type="hidden" name="hid'.$i.'" value="'.$hid.'">
        <input class="form-textbox" type="text"  name="first'.$i.'" id="first'.$i.'" ' . $firstname . ' />
            <label class="form-sub-label" for="first_3" id="sublabel_first"> First Name </label></span><span class="form-sub-label-container">
			<input class="form-textbox" type="text" name="last'.$i.'" id="last'.$i.'" ' . $lastname . ' />
            <label class="form-sub-label" for="last_3" id="sublabel_last"> Last Name </label></span><br>
        </div>
              </th>
			  <th align="left" class="form-matrix-row-headers">
                
        <div id="cid_4" class="form-input"><span class="form-sub-label-container">
        <input class="form-textbox" type="text"  name="title'.$i.'" id="title'.$i.'" ' . $title . ' />
            <label class="form-sub-label" for="title_3" id="title"> Title</label></span>
			<span class="form-sub-label-container">
			<input class="form-textbox" type="text"' . $pemail . ' name="pemail'.$i.'" id="pemail'.$i.'" ' . $pemail . ' />
            <label class="form-sub-label" for="last_3" id="sublabel_last"> Email</label></span>
        </div>
              </th>
			  <td align="center" class="form-matrix-values">
			  	<label class="container">
                <input class="form-radio" type="checkbox" name="events'.$i.'[]" value="0" ' . $check0 .'  /><span class="checkmark"></span>
				</label>
              </td>
              <td align="center" class="form-matrix-values">
			  	<label class="container">
                <input class="form-radio" type="checkbox" name="events'.$i.'[]" value="1" ' . $check1 .'  /><span class="checkmark"></span>
				</label>
              </td>
              <td align="center" class="form-matrix-values">
			  	<label class="container">
                <input class="form-radio" type="checkbox" name="events'.$i.'[]" value="2" ' . $check2 .' /><span class="checkmark"></span>
				</label>
              </td>
              <td align="center" class="form-matrix-values">
			  <label class="container">
                <input class="form-radio" type="checkbox" name="events'.$i.'[]" value="3" ' . $check3 .' /><span class="checkmark"></span>
				</label>
              </td>
              <td align="center" class="form-matrix-values">
			  <label class="container">
                <input class="form-radio" type="checkbox" name="events'.$i.'[]" value="4" ' . $check4 .' /><span class="checkmark"></span>
				</label>
              </td>
              <td align="center" class="form-matrix-values">
			  <label class="container">
                <input class="form-radio" type="checkbox" name="events'.$i.'[]" value="5" ' . $check5 .' /><span class="checkmark"></span>
				</label>
              </td>
              <td align="center" class="form-matrix-values">
			  <label class="container">
                <input class="form-radio" type="checkbox" name="events'.$i.'[]" value="6" ' . $check6 .' /><span class="checkmark"></span>
				</label>
              </td>
			  <td align="center" class="form-matrix-values">
			  <label class="container">
                <input class="form-radio" type="checkbox" name="events'.$i.'[]" value="7" ' . $check7 .' /><span class="checkmark"></span>
				</label>
              </td>
              <td align="center" class="form-matrix-values">
                <select class="form-dropdown" style="width:50px" id="size'.$i.'" name="size'.$i.'">
		  		<option value="">Select</option>
				'.$size.'
				<option value="S">S</option>
				<option value="M">M</option>
				<option value="L">L</option>
				<option value="XL">XL</option
				<option value="2XL">2XL</option>
				<option value="3XL">3XL</option>
          </select>
              </td>
              <td align="center" class="form-matrix-values">
			  <label class="container">
                <input class="form-radio" type="checkbox" name="events'.$i.'[]" value="8" ' . $check8 .' /><span class="checkmark"></span>
				</label>
              </td>
              <td align="center" class="form-matrix-values">
			  <label class="container">
                <input class="form-radio" type="checkbox" name="events'.$i.'[]" value="9" ' . $check9 .' /><span class="checkmark"></span>
				</label>
              </td>
            </tr>';
                            }
                            echo '<tr>
			<td align="center" class="form-matrix-values">&nbsp;</td>
			<td align="center" class="form-matrix-values">&nbsp;</td>
			<td align="center" class="form-matrix-values">&nbsp;</td>
			<td align="center" class="form-matrix-values">&nbsp;</td>
			<td align="center" class="form-matrix-values">&nbsp;</td>
			<td align="center" class="form-matrix-values">&nbsp;</td>
			<td align="center" class="form-matrix-values" style="background-color:'.$s1.';"><strong style="font-size:14px">'.$e1.'</strong>/'.$brokerrow.'</td>
			<td align="center" class="form-matrix-values" style="background-color:'.$s2.';"><strong style="font-size:14px">'.$e2.'</strong>/'.$brokerrow.'</td>
			<td align="center" class="form-matrix-values" style="background-color:'.$s3.';"><strong style="font-size:14px">'.$e3.'</strong>/'.$brokerrow.'</td>
			<td colspan="2" align="center" class="form-matrix-values" style="background-color:'.$s4.';"><strong style="font-size:14px">'.$golf.'</strong>/'.$brokerrow.'</td>
			<td align="center" class="form-matrix-values" style="background-color:'.$s6.';"><strong style="font-size:14px">'.$e6.'</strong>/'.$brokerrow.'</td>
			<td align="center" class="form-matrix-values" style="background-color:'.$s7.';"><strong style="font-size:14px">'.$e7.'</strong>/'.$brokerrow.'</td>
			<td align="center" class="form-matrix-values" style="background-color:'.$s8.';"><strong style="font-size:14px">'.$e8.'</strong>/'.$brokerrow.'</td>
			<td align="center" class="form-matrix-values">&nbsp;</td>
			<td align="center" class="form-matrix-values" style="background-color:'.$s9.';"><strong style="font-size:14px">'.$e9.'</strong>/'.$brokerrow.'</td>
			<td align="center" class="form-matrix-values" style="background-color:'.$s10.';"><strong style="font-size:14px">'.$e10.'</strong>/'.$brokerrow.'</td>
			
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
