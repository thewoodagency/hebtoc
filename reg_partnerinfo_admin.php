<?php
require ('../../lib/config.inc.php');
require ('../../lib/mysqli_connect.php');
require ('../../lib/functions.php');
session_start();

//off season Kathy editing only
//$_SESSION['email'] = $_GET["remail"];
//

if(isset($_SESSION['admin']))
{
	$email = $_GET["remail"];
	$message = '';
	if (isset($_GET["data"]) && $_GET["data"] == true)
		$message = '<p>Updated! Please close this window (tab) if you are done.</p>'; 	
	$regDate = '';
	setlocale(LC_MONETARY, 'en_US');
	$qString = sprintf('select * from toc_partnerregister where email="%s"', $dbc->real_escape_string($email));
	$r = $dbc->query($qString);
	if ($row = $r->fetch_assoc())
	{
		$_SESSION['toclevel'] = 'partner';
		$_SESSION['regid'] = $row["idtoc_register"];
		$_SESSION['regdate'] = $row["registerd_date"];
		//$tocinfo = getLevelInfo($_SESSION['toclevel']);
		//if ($row['damount'] == '0') $amount = $tocinfo['amount'];
		//else $amount = $row['damount'];
		$regDate = 'Registered date: ' . $_SESSION['regdate'];
		$firstgolf = $secondgolf = $charity = $welcome = $sponsor = '';
		$gsize = '<option value="No Shirt">Select</option>';
		$chsize = '<option value="No Shirt">Select</option>';
		if (isset($row["gsize"]) && $row["gsize"] != '') $gsize = '<option selected value="'. $row["gsize"] . '">' . $row["gsize"] . '</option>';
		if (isset($row["chsize"]) && $row["chsize"] != '') $chsize = '<option selected value="'. $row["chsize"] . '">' . $row["chsize"] . '</option>';
		if ($row["gfirstdate"]=='1') $firstgolf = "checked";
		if ($row["gseconddate"]=='1') $secondgolf = "checked";
		if ($row["chattend"]=='1') $charity = "checked";
		if ($row["rattend"]=='1') $sponsor = "checked";
		if ($row["wattend"]=='1') $welcome = "checked";	
		
		$male="checked"; 
		$female="";
		if ($row["ggender"]=="female") { 
			$male = "";
			$female = "checked";
		}
	}
} else {
	header("Location: login_partner_proc.php");
	die();
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>H-E-B Tournament of Champions</title>
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
      $('input_10_confirm').hint('Confirm Email');
      $('input_10').hint('ex: myname@example.com');
   });
</script>
<style>
#fnavi {
	width: 1024px;
	margin: 0 auto;
	text-align: center;
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
<div id="fnavi"><iframe frameborder="0" allowtransparency="true" scrolling="no" src="formnavi_partner.php" width="1024" height="50"></iframe>
</div>
<div id="tocform">
<form class="jotform-form" action="register_proc_partner.php" method="post" name="form_32814544278863" id="32814544278863" accept-charset="utf-8">
  <input type="hidden" name="formID" value="32814544278863" />
  <input type="hidden" name="reg_id" value="<? echo $_SESSION['regid'] ?>" />
  <input type="hidden" name="reg_date" value="<? echo $_SESSION['regdate'] ?>" />
  <input type="hidden" name="tocflag" value="<? echo $row["tocflag"]; ?>" />
  <div class="form-all">
  	<?php echo $message ?>
    <ul class="form-section">
      <li class="form-line" id="id_9">
        <label class="form-label-left" id="label_9" for="input_9">
          Name<span class="form-required">*</span>
          </label>
        <div id="cid_9" class="form-input"><span class="form-sub-label-container"><input class="form-textbox validate[required]" type="text" size="15" name="fname" id="fname" value="<?php echo $row["fname"]; ?>" />
          <label class="form-sub-label" for="first_9" id="sublabel_first"> First Name </label></span><span class="form-sub-label-container"><input class="form-textbox validate[required]" type="text" size="15" name="lname" id="lname" value="<?php echo $row["lname"]; ?>" />
            <label class="form-sub-label" for="last_9" id="sublabel_last"> Last Name </label></span>
          </div>
        </li>
      <li class="form-line" id="id_13">
        <label class="form-label-left" id="label_13" for="input_13">
          Title<span class="form-required">*</span>
          </label>
        <div id="cid_13" class="form-input">
          <input type="text" class=" form-textbox validate[required]" data-type="input-textbox" id="title" name="title" size="20" value="<?php echo $row["title"]; ?>" />
          </div>
        </li>
      <? if ($row["tocflag"]=='p') { ?>
      <li class="form-line" id="id_13">
        <label class="form-label-left" id="label_13" for="input_13">
          Department<span class="form-required">*</span>
          </label>
        <div id="cid_13" class="form-input">
          <input type="text" readonly class=" form-textbox validate[required]" data-type="input-textbox" id="department" name="department" size="20" value="<?php echo $row["department"]; ?>" />
          </div>
        </li>
       <? } else { ?>
       <input type="hidden" id="department" name="department" value="" />
       <? } ?>
      <li class="form-line" id="id_10">
        <label class="form-label-left" id="label_10" for="input_10">
          E-mail<span class="form-required">*</span>
          </label>
        <div id="cid_10" class="form-input">
          <input type="email" class=" form-textbox validate[required, Email]" id="input_10" name="q10_email10" size="30" value="<?php echo $row["email"]; ?>" />
          <br>
          <input type="email" class="form-textbox validate[required, Email, Email_Confirm]" id="input_10_confirm" style="margin-top:8px;" size="30" value="<?php echo $row["email"]; ?>" />
          </div>
        </li>
      <li class="form-line" id="id_1">
        <label class="form-label-left" id="label_1" for="input_1">
          Password<span class="form-required">*</span>
          </label>
        <div id="cid_1" class="form-input">
          <input type="text" class=" form-textbox validate[required]" data-type="input-textbox" id="password" name="password" size="20" value="<?php echo $row["password"]; ?>" />
          </div>
        </li>
      <li class="form-line" id="id_12">
        <label class="form-label-left" id="label_12" for="input_12">
          Office #<span class="form-required">*</span>
          </label>
        <div id="cid_12" class="form-input"><span class="form-sub-label-container"><input class="form-textbox validate[required]" type="tel" name="oarea" id="oarea" size="3" value="<?php echo $row["oarea"]; ?>">
          -
          <label class="form-sub-label" for="input_12_area" id="sublabel_area"> Area Code </label></span><span class="form-sub-label-container"><input class="form-textbox validate[required]" type="tel" name="ophone" id="ophone" size="8" value="<?php echo $row["ophone"]; ?>">
            <label class="form-sub-label" for="input_12_phone" id="sublabel_phone"> Phone Number </label></span>
          </div>
        </li>
      <li class="form-line" id="id_11">
        <label class="form-label-left" id="label_11" for="input_11">
          Cell #<span class="form-required">*</span>
          </label>
        <div id="cid_11" class="form-input"><span class="form-sub-label-container"><input class="form-textbox validate[required]" type="tel" name="carea" id="carea" size="3" value="<?php echo $row["carea"]; ?>">
          -
          <label class="form-sub-label" for="input_11_area" id="sublabel_area"> Area Code </label></span><span class="form-sub-label-container"><input class="form-textbox validate[required]" type="tel" name="cphone" id="cphone" size="8" value="<?php echo $row["cphone"]; ?>">
            <label class="form-sub-label" for="input_11_phone" id="sublabel_phone"> Phone Number </label></span>
          </div>
        </li>
      <!-- event registration -->
      <li class="form-line" id="id_4">
        <div id="cid_4" class="form-input-wide">
          <table summary="" cellpadding="4" cellspacing="0" class="form-matrix-table">
            <!-- header -->
            <tr>
              <td colspan="3"><h3>Golf Tournament</h3> 
                <p><strong>
                  <input class="form-radio" type="checkbox" name="golf1" value="June 8" <? echo $firstgolf ?> />
                  Wednesday,  June 8 (AM Round  Only at TPC 7:30 Tee Off) : Golf Tournament at TPC for $125,000 - $175,000  Sponsors (if you have suppliers that are participating at this level and you  want to play golf with them, please sign up)</strong><br><br><strong>
                    <input class="form-radio" type="checkbox" name="golf2" value="June 10" <? echo $secondgolf ?> />
                    Friday,  June 10 : Golf  Tournament for $5,000 - $100,000 Sponsor Levels</strong>
                <p><strong>(Golf Tournament locations determined by Department &amp;  Sponsorship Level)</strong></p>
                <div class="sp" style="background-color:#EAEAEA">
                  <p><strong><em><u>TOPGOLF - 5539 North Loop  1604 West, San Antonio, TX 78249</u></em></strong></p>
                  <p><strong>- Drug Store ($5,000 - $30,000 Sponsors)</strong><br>
                    <strong>- Facility Procurement ($5,000 - $30,000 Sponsors)</strong><br>
                    <strong>- General Merchandise ($5,000 - $30,000 Sponsors)</strong><br>
                    <strong>- Grocery ($5,000 - $30,000 Sponsors)</strong><br>
                    <strong>- Information Systems (all sponsorship levels)</strong><br>
                    <strong>- Petroleum (all sponsorship levels)</strong><br>
                    <strong>- Seafood (all sponsorship levels)</strong></p>
                  <p><strong>7:00 a.m. - Registration &amp; Buffet Breakfast</strong><br>
                    <strong>8:00 - 11:00 a.m. - Golf Tournament</strong><br>
                    <strong>11:00 - 12:00 noon - Buffet Lunch &amp; Winners Announced</strong></p>
                  <p><strong><em><u>TPC San Antonio AT&amp;T Oaks  &amp; Canyons Courses</u></em></strong></p>
                  <p><strong>- $50,000 - $100,000 Sponsorship levels (all departments)</strong></p>
                  <p><strong><em><u>Canyon Springs Golf Club  &amp; River Crossing Golf Club</u></em></strong></p>
                  <p><strong>- Advertising</strong><br>
                    <strong>- Bakery</strong><br>
                    <strong>- Deli</strong><br>
                    <strong>- Finance</strong><br>
                    <strong>- Human Resources</strong><br>
                    <strong>- Market</strong><br>
                    <strong>- Pharmacy</strong><br>
                    <strong>- Produce</strong></p>
                  <p><strong>6:00 a.m. - Texas Breakfast Tacos, fruit and beverages</strong><br>
                    <strong>7:30 a.m. - Shotgun start (please arrive no later than 6:30 a.m.)</strong><br>
                    <strong>12:30 - 2:00 - Lunch<br>
                    <br>
                    </strong>                </p>
                </div></td></tr>
            <!-- header end-->
            <!-- entry loop -->
            
            <tr>
            
              <td class="form-matrix-values">
                <strong>Shirt Size:</strong><select class="form-dropdown" style="width:50px" id="g_size" name="g_size">
  <? echo $gsize ?>
  <option value="No Shirt">No Shirt</option>
</select> <input type="radio" name="gender" value="male" <? echo $male ?>> Male | 
  <input type="radio" name="gender" value="female" <? echo $female ?>> Female
                </td>
              </tr>
            </table>
          </div>
        </li>
      <!-- event registration ends-->
      
      <!-- event registration -->
      <li class="form-line" id="id_4">
        <div id="cid_4" class="form-input-wide">
          <table summary="" cellpadding="4" cellspacing="0" class="form-matrix-table">
            <!-- header -->
            <tr>
              <td colspan="7"><h3><input class="form-radio" type="checkbox" name="welcome" value="welcome" <? echo $welcome ?> />
                Wednesday, June 8 - Welcome Dinner</h3>
                <p> 5:30 -  7:30 p.m. - Welcome Dinner Buffet - Grand Oaks Ballrom<br>
                  7:30 - 10:00 p.m. - Social Time - Event Lawn 2 (outside main lobby - lower level)<br>
                </p>                <strong>
              </strong></td></tr>
           
            <!-- header end-->
            <!-- entry loop -->
            
            </table>
          </div>
        </li>
      <!-- event registration ends-->
      
      <!-- event registration -->
      <li class="form-line" id="id_4">
        <div id="cid_4" class="form-input-wide">
          <table summary="" cellpadding="4" cellspacing="0" class="form-matrix-table">
            <!-- header -->
            <tr><td colspan="6"><h3><input class="form-radio" type="checkbox" name="charity" value="charity" <? echo $charity ?> />
              Thursday, June 9 - Charity Work Project</h3>
                <p>Charity Work Project for all Sponsorship levels (please  indicate the charity organization where you would like to participate) </p>
                <p>6:30 - 7:15 a.m. - Register at the JW Marriott Exhibit Hall &quot;B&quot; Foyer to pick up your name badge (this badge will include your name, company, charity organization, bus #, and group name/# to which you are assigned) </p>
                <p>Full Breakfast Buffet will be served in Exhibit Hall &quot;B&quot;</p>
                <p>7:15 - 7:25 a.m. - Load buses<br>
                  7:30 a.m. - BUSES LEAVING to Charity Work Projects<br>
                  8:00  – 12:00 a.m. - Charity Work Projects<br>
              12:00 - 12:30 p.m. - Load buses for return to JWM - Lunch will be provided in Exhibit Hall &quot;B&quot;</p></td></tr>
            <!-- header end-->
            <!-- entry loop -->
            
            <tr>
              <td class="form-matrix-values">
                <strong>Shirt Size:</strong> <select class="form-dropdown" style="width:50px" id="ch_size" name="ch_size">
  <? echo $chsize ?>
  <option value="No Shirt">No Shirt</option>
  <option value="S">S</option>
  <option value="M">M</option>
  <option value="L">L</option>
  <option value="XL">XL</option>
  <option value="2XL">2XL</option>
  <option value="3XL">3XL</option>
</select>
                </td>
              </tr>
            <tr><td colspan="7" class="form-matrix-values" ><strong>Name of Sponsoring Company that you want to work beside</strong>              <input type="text" class="form-textbox" id="ch_company" name="ch_company" size="30" value="<?php echo $row["chcompany"]; ?>" /></td></tr>
            </table>
          </div>
        </li>
      <!-- event registration ends-->
      <!-- event registration -->
      <li class="form-line" id="id_4">
        <div id="cid_4" class="form-input-wide">
          <table summary="" cellpadding="4" cellspacing="0" class="form-matrix-table">
            <!-- header -->
            <tr><td colspan="7"><h3><input class="form-radio" type="checkbox" name="sponsor" value="sponsor" <? echo $sponsor ?> />
              Thursday, June 9</h3>
                <p><strong>Hall of Fame Reception - $125,000 - $175,000 Sponsor Levels</strong><br>
                  4:30 - 6:30 p.m. - Cibolo Canyons Ballroom - Suite 3<br>
                  6:30 - 7:00 p.m. - Move to Grand Oaks Ballroom &amp; everyone seated</p>
                <p><strong>Sponsor Reception - $5,000 - $100,000 Sponsor Levels</strong><br>
                  4:30 - 6:30 p.m. - Cibolo Canyons Main Ballroom<br>
                  6:30 - 7:00 p.m. - Move to Grand Oaks Ballroom &amp; everyone seated<br>
              7:00 - 9:00 p.m. - Sponsor Dinner &amp; Program - Grand Oaks Ballroom</p></td></tr>
            <!-- header end-->
            <!-- entry loop -->
            
            </table>
          </div>
        </li>
      <!-- event registration ends-->
      <li class="form-line" id="id_2">
        <div id="cid_2" class="form-input-wide">
          <div style="margin-left:156px" class="form-buttons-wrapper">
            <? include 'reg_submit_no.php'; ?>
            
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
