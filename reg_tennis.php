<?php
ini_set('display_errors', 1);
error_reporting(~0);

require ('../../lib/config.inc.php');
require ('../../lib/mysqli_connect.php');
require ('../../lib/functions.php');
session_start();
$entries = array();
if(isset($_SESSION['email']))
{
	$regEmail = $_SESSION['email'];
	$regID = $_SESSION['regid'];
	$toclevel = $_SESSION['toclevel'];
	$tocInfo = getLevelInfo($toclevel);
	$qString = sprintf('select * from toc_tennis where regEmail="%s" order by hid', $dbc->real_escape_string($regEmail));
	
	$r = $dbc->query($qString);
	while ($row = $r->fetch_assoc())
	{	
		$entry = array('fname'=>$row['hfirst'], 
						'lname'=>$row['hlast'],
						'email'=>$row['hemail'],
						'rating'=>$row['hrating'],
						'hid'=>$row['hid'],
						'lastupdated'=>$row['lastupdated']);
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
        width:715px;
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
<form class="jotform-form" action="tennis_proc.php" method="post" name="form_32946254898168" id="32946254898168" accept-charset="utf-8">
  <input type="hidden" name="formID" value="32946254898168" />
  <input type="hidden" name="noofPeople" value="<? echo $tocInfo['tennis'] ?>">
  <div class="form-all">
  <? if ($tocInfo['tennis'] == 0) { ?>
  <div id="warning">Your sponsorship is not required to submit this section</div>
  <? } else { ?>
    <ul class="form-section">
      <li class="form-line" id="id_4">
        <div id="cid_4" class="form-input-wide">
          <table summary="" cellpadding="4" cellspacing="0" class="form-matrix-table">
            <!-- header -->
            <tr><td colspan="7"><h3><? echo $tocInfo['tennish'] ?></h3></td></tr>
            <tr>
              <th class="form-matrix-column-headers form-matrix-column_0">
                Name
              </th>
              <th class="form-matrix-column-headers form-matrix-column_0">
                Email
              </th>
              <th class="form-matrix-column-headers form-matrix-column_1">
                Rating
              </th>
            </tr>
            <!-- header end-->
            <!-- entry loop -->
            <?php
			for ($i=0; $i<$tocInfo['tennis']; $i++)
			{
				$firstname='';
				$lastname='';
				$email='';
				$rating='';
				$hid='';
				if (array_key_exists($i, $entries))
				{
					//print_r($entries[$i]);
					$firstname = 'value="' . $entries[$i]['fname'] . '"';
					$lastname = 'value="' . $entries[$i]['lname'] . '"';
					$email = 'value="' . $entries[$i]['email']. '"';
					$rating = '<option selected value="'. $entries[$i]['rating'] . '">' . $entries[$i]['rating'] . '</option>';
					$hid = $entries[$i]['hid'];
					$last= $entries[$i]['lastupdated'];
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
                <input type="email" class="form-textbox validate[Email]" id="email'.$i.'" name="email'.$i.'" size="30" ' . $email . '/>
              </td>
              <td align="center" class="form-matrix-values">
          <select class="form-dropdown" style="width:50px" id="rating'.$i.'" name="rating'.$i.'">'.$rating.'
		  		<option value="">Select</option>
				<option value="A">A</option>
				<option value="B">B</option>
				<option value="C">C</option>
				<option value="D">D</option>
          </select>
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
            <button id="input_2" type="submit" class="form-submit-button">
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
