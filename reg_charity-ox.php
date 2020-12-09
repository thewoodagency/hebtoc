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
	$regEmail = $_SESSION['email'];
	$regID = $_SESSION['regid'];
	$toclevel = $_SESSION['toclevel'];
	$tocInfo = getLevelInfo($toclevel);
	//$qString = sprintf('select * from toc_charity where regEmail="%s" order by hid', $dbc->real_escape_string($regEmail));
	$qString = "select * from toc_charity where hfirst <> '' and regID =" . $rid . " order by hid";
	
    $qString = sprintf('select * from toc_charity where hfirst <> \'\' and regID="%s" and regEmail="%s" order by hid',
        $dbc->real_escape_string($regID), $dbc->real_escape_string($regEmail));
	
	$r = $dbc->query($qString);
	while ($row = $r->fetch_assoc())
	{	
		$entry = array('fname'=>$row['hfirst'], 
						'lname'=>$row['hlast'],
						'title'=>$row['htitle'],
						'size'=>$row['hsize'],
						'hid'=>$row['hid'],
						'lastupdated'=>$row['lastupdated'],
					    'waiver'=>$row['waiver']
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
<html><!-- InstanceBegin template="/Templates/formPage.dwt.php" codeOutsideHTMLIsLocked="false" -->
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
        width:720px;
        font-family:'Verdana';
        font-size:12px;
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
<form class="jotform-form" action="charity_proc.php" method="post" name="form_32946254898168" id="32946254898168" accept-charset="utf-8">
  <input type="hidden" name="formID" value="32946254898168" />
  <input type="hidden" name="noofPeople" value="<? echo $tocInfo['charity'] ?>">
  <div class="form-all">
  <? if ($tocInfo['charity'] == 0) { ?>
  <div id="warning">Your sponsorship is not required to submit this section</div>
  <? } else { ?>
    <ul class="form-section">
      <li class="form-line" id="id_4">
        <div id="cid_4" class="form-input-wide">
          <table summary="" cellpadding="4" cellspacing="0" class="form-matrix-table">
            <!-- header -->
            <tr><td colspan="7">
                    <p style="background-color: yellow;padding: 7px"><b style="font-size: 18px"><u>VERY IMPORTANT - PLEASE READ!</u></b><br><br>All participants listed below that will attend the Charity Work Project <b><u>must</u></b> sign an electronic Photo & Work Waiver form.  Once you have entered a participant(s) name, please email the following link to each individual listed below.  Request that the participant read both Waivers and fill out the information requested at the bottom of both forms.  Please note that you <b><u>must</u></b> have their name listed below, before they will be able to complete the electronic form.<br><br>
                        Waiver form link: <b><a target="_blank" href="http://hebtoc.com/waiver/Charity_Waiver">http://hebtoc.com/waiver/Charity_Waiver</a></b><br><br>
                    Waiver form password: <b>HEBTOC2018</b></p>
                    <h3><? echo $tocInfo['charityh'] ?></h3>
            <strong><? echo $tocInfo['charitym'] ?></strong></td></tr>
            <tr>
              <th class="form-matrix-column-headers form-matrix-column_0">
                Name
              </th>
              <th class="form-matrix-column-headers form-matrix-column_0">
                Title
              </th>
              <th class="form-matrix-column-headers form-matrix-column_1">
                Shirt Size
              </th>
              <th>
              	Waiver
              </th>
            </tr>
            <!-- header end-->
            <!-- entry loop -->
            <?php
			
			for ($i=0; $i<$tocInfo['charity']; $i++)
			{
				$firstname='';
				$lastname='';
				$title='';
				$size='';
				$hid='';
				$waiverStatus = '';
				if (array_key_exists($i, $entries))
				{
					//print_r($entries[$i]);
					$firstname = 'value="' . $entries[$i]['fname'] . '"';
					$lastname = 'value="' . $entries[$i]['lname'] . '"';
					$title = 'value="' . $entries[$i]['title']. '"';
					$size = '<option selected value="'. $entries[$i]['size'] . '">' . $entries[$i]['size'] . '</option>';
					$hid = $entries[$i]['hid'];
					$last= $entries[$i]['lastupdated'];
					$waiver = $entries[$i]['waiver'];
					if($waiver == 1) $waiverStatus = '<img src="images/check4.gif">';
				}
			echo '
            <tr>
              <th align="left" class="form-matrix-row-headers">
                
        <div id="cid_3" class="form-input"><span class="form-sub-label-container">'.($i+1).'&nbsp;<input type="hidden" name="hid'.$i.'" value="'.$hid.'"><input class="form-textbox" type="text" size="25" name="first'.$i.'" id="first'.$i.'" ' . $firstname . ' />
            <label class="form-sub-label" for="first_3" id="sublabel_first"> First Name </label></span><span class="form-sub-label-container"><input class="form-textbox" type="text" size="25" name="last'.$i.'" id="last'.$i.'" ' . $lastname . ' />
            <label class="form-sub-label" for="last_3" id="sublabel_last"> Last Name </label></span>
        </div>
              </th>
              <td align="center" class="form-matrix-values">
                <input type="text" class="form-textbox" id="title'.$i.'" name="title'.$i.'" size="30" ' . $title . '/>
              </td>
              <td align="center" class="form-matrix-values">
          <select class="form-dropdown" style="width:50px" id="size'.$i.'" name="size'.$i.'">'.$size.'
		  		<option value="">Select</option>
				<option value="S">S</option>
				<option value="M">M</option>
				<option value="L">L</option>
				<option value="XL">XL</option>
				<option value="2XL">2XL</option>
				<option value="3XL">3XL</option>
          </select>
              </td>
			  <td>'.$waiverStatus.'</td>
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
            <? include 'reg_submit_no.php'; ?>
            
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
