<?php
//for redirect to Donation only form
/** after event
header('Location: register_donationOnly.php');
exit;
**/
//
require ('./includes/config.inc.php');
require ('./includes/mysqli_connect.php');
require ('./includes/functions.php');
setlocale(LC_MONETARY, 'en_US');

session_start();
//if(isset($_SESSION['admin']))
//{
//	header("Location: admin_panel.php");
//	die();	

//}
if(isset($_SESSION['email']) && hasPartnerAccount($_SESSION['email']))
{
	header("Location: reg_partnerinfo.php");
	die();	

}
$sp='';
if(isset($_GET['sp']))
{
	$sp = $_GET['sp'];
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta name="HandheldFriendly" content="true" />
<title>Sponsorship Forms</title>
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
	#level {
		font-size: 16px;
	}
	#info {
		padding: 10px 30px 10px 35px;
		background:  #e7b22f;
	}
	#info a {
	color: #990000;
	text-decoration: underline;
	font-weight: bold;
}

#info a:hover {
	color: #990000;
	text-decoration: underline;
	font-weight: bold;
}

.sp { padding: 7px 0 0 20px }
</style>

<script src="lib/jotform.js?3.1.26" type="text/javascript"></script>
<script type="text/javascript">
   JotForm.init(function(){
      $('input_10_confirm').hint('Confirm Email');
      $('input_10').hint('ex: myname@example.com');
   });
   
   function checklevel() {
	   var e = document.getElementById("level");
	   var v = e.options[e.selectedIndex].value;
	   if (v == "Donation Only")
	   	 self.location="register_donationOnly.php";
   }
</script>
</head>
<body>
<form class="jotform-form" action="register_proc_partner.php" method="post" name="form_32814544278863" id="32814544278863" accept-charset="utf-8">
  <input type="hidden" name="formID" value="32814544278863" />
  <input type="hidden" name="new_reg" value="true" />
  <div class="form-all">
  <div id="info">
  <h3>If you have already registered, <a href="login_partner_proc.php">please login to your account</a> to review or modify your information</h3><h3 align="right"><a href="/">Back to homepage</a></h3></div> 
    <ul class="form-section">
      <li class="form-line" id="id_9">
        <label class="form-label-left" id="label_9" for="input_9">
          Name<span class="form-required">*</span>
        </label>
        <div id="cid_9" class="form-input"><span class="form-sub-label-container"><input class="form-textbox validate[required]" type="text" size="15" name="fname" id="fname" />
            <label class="form-sub-label" for="first_9" id="sublabel_first"> First Name </label></span><span class="form-sub-label-container"><input class="form-textbox validate[required]" type="text" size="15" name="lname" id="lname" />
            <label class="form-sub-label" for="last_9" id="sublabel_last"> Last Name </label></span>
        </div>
     </li>
     <li class="form-line" id="id_13">
        <label class="form-label-left" id="label_13" for="input_13">
          Title<span class="form-required">*</span>
        </label>
        <div id="cid_13" class="form-input">
          <input type="text" class=" form-textbox validate[required]" data-type="input-textbox" id="title" name="title" size="20" value="" />
        </div>
      </li>
     <li class="form-line" id="id_13">
        <label class="form-label-left" id="label_13" for="input_13">
          Department<span class="form-required">*</span>
        </label>
        <div id="cid_13" class="form-input">
          <input type="text" class=" form-textbox validate[required]" data-type="input-textbox" id="department" name="department" size="20" value="" />
        </div>
      </li>
      <li class="form-line" id="id_10">
        <label class="form-label-left" id="label_10" for="input_10">
          E-mail<span class="form-required">*</span>
        </label>
        <div id="cid_10" class="form-input">
          <input type="email" class=" form-textbox validate[required, Email]" id="input_10" name="q10_email10" size="30" value="" />
          <br>
          <input type="email" class="form-textbox validate[required, Email, Email_Confirm]" id="input_10_confirm" style="margin-top:8px;" size="30" />
        </div>
      </li>
      <li class="form-line" id="id_1">
        <label class="form-label-left" id="label_1" for="input_1">
          Password<span class="form-required">*</span>
        </label>
        <div id="cid_1" class="form-input">
          <input type="text" class=" form-textbox validate[required]" data-type="input-textbox" id="password" name="password" size="20" value="" />
        </div>
      </li>
      <li class="form-line" id="id_12">
        <label class="form-label-left" id="label_12" for="input_12">
          Office #<span class="form-required">*</span>
        </label>
        <div id="cid_12" class="form-input"><span class="form-sub-label-container"><input class="form-textbox validate[required]" type="tel" name="oarea" id="oarea" size="3">
            -
            <label class="form-sub-label" for="input_12_area" id="sublabel_area"> Area Code </label></span><span class="form-sub-label-container"><input class="form-textbox validate[required]" type="tel" name="ophone" id="ophone" size="8">
            <label class="form-sub-label" for="input_12_phone" id="sublabel_phone"> Phone Number </label></span>
        </div>
      </li>
      <li class="form-line" id="id_11">
        <label class="form-label-left" id="label_11" for="input_11">
          Cell #<span class="form-required">*</span>
        </label>
        <div id="cid_11" class="form-input"><span class="form-sub-label-container"><input class="form-textbox validate[required]" type="tel" name="carea" id="carea" size="3">
            -
            <label class="form-sub-label" for="input_11_area" id="sublabel_area"> Area Code </label></span><span class="form-sub-label-container"><input class="form-textbox validate[required]" type="tel" name="cphone" id="cphone" size="8">
            <label class="form-sub-label" for="input_11_phone" id="sublabel_phone"> Phone Number </label></span>
        </div>
      </li>
      <!-- event registration -->
      <li class="form-line" id="id_4">
        <div id="cid_4" class="form-input-wide">
          <table summary="" cellpadding="4" cellspacing="0" class="form-matrix-table">
            <!-- header -->
            <tr>
              <td colspan="7"><h3>Golf Tournament</h3> 
                <strong><input class="form-radio" type="checkbox" name="golf1" value="June 3" />
 Wednesday, June 3 (AM Round Only at TPC           7:30 Tee Off) : Golf Tournament at TPC for $125,000 - $175,000 Sponsors (if you have suppliers that are participating at this level and you want to play golf with them, please sign up)<br>
 <br>
                <input class="form-radio" type="checkbox" name="golf2" value="June 5" /> 
                Friday, June 5 : Golf Tournament for $5,000 - $100,000 Sponsor Levels</strong><div class="sp">
                6:00 a.m. - Breakfast on all courses<br>
                7:30 a.m. - Shotgun Start (please arrive no later than 6:30 a.m.)<br>
                12:30 - 2:00 p.m. - Lunch served on all courses<br>
                Courses: TPC AT&amp;T Oaks &amp; Canyons, La Cantera Palmer, The Dominion, Canyon Springs, River Crossing, + three additional to be determined.</div></td></tr>
            <tr>
              <th class="form-matrix-column-headers form-matrix-column_0">
                Name
              </th>
              <th class="form-matrix-column-headers form-matrix-column_0">
                Department</th>
              <th class="form-matrix-column-headers form-matrix-column_1">
                Golf Shirt Size
              </th>
            </tr>
            <!-- header end-->
            <!-- entry loop -->
            
            <tr>
              <th align="left" class="form-matrix-row-headers">
                
        <div id="cid_3" class="form-input"><span class="form-sub-label-container"><input type="hidden" name="hid0" value="697"><input class="form-textbox" type="text" size="25" name="g_first" id="g_first" />
            <label class="form-sub-label" for="first_3" id="sublabel_first"> First Name </label></span><span class="form-sub-label-container"><input class="form-textbox" type="text" size="25" name="g_last" id="g_last" />
            <label class="form-sub-label" for="last" id="sublabel_last"> Last Name </label></span>
        </div>
              </th>
              <td align="center" class="form-matrix-values">
                <input type="text" class="form-textbox" id="department1" name="g_department" size="25"/>
              </td>
              <td align="center" class="form-matrix-values">
          <select class="form-dropdown" style="width:50px" id="g_size" name="g_size">
		  		<option value="">Select</option>
				<option value="S">S</option>
				<option value="M">M</option>
				<option value="L">L</option>
				<option value="XL">XL</option>
				<option value="2XL">2XL</option>
				<option value="3XL">3XL</option>
          </select>
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
              <td colspan="7"><h3>Wednesday, June 3 - Welcome Dinner</h3>
                <p> 5:30 -  7:30 p.m. - Welcome Dinner Buffet - Grand Oaks Ballrom<br>
                  7:30 - 10:00 p.m.Social Time with all Sponsors - Exhibit Hall A-B<br>
                </p>                <strong>
            </strong></td></tr>
            <tr>
              <th class="form-matrix-column-headers form-matrix-column_0">
                Name
              </th>
              <th class="form-matrix-column-headers form-matrix-column_0">
                Department</th>
            </tr>
            <!-- header end-->
            <!-- entry loop -->
            
            <tr>
              <th align="left" class="form-matrix-row-headers">
                
        <div id="cid_3" class="form-input"><span class="form-sub-label-container"><input type="hidden" name="hid0" value="697"><input class="form-textbox" type="text" size="25" name="w_first" id="w_first" />
            <label class="form-sub-label" for="first_3" id="sublabel_first"> First Name </label></span><span class="form-sub-label-container"><input class="form-textbox" type="text" size="25" name="w_last" id="w_last" />
            <label class="form-sub-label" for="last" id="sublabel_last"> Last Name </label></span>
        </div>
              </th>
              <td align="center" class="form-matrix-values">
                <input type="text" class="form-textbox" id="w_department" name="w_department" size="25"/>
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
            <tr><td colspan="7"><h3>Thursday, June 4 - Charity Work Project</h3>
            <p>Charity Work Project for all Sponsorship levels (if you have suppliers that are participating and you want to work beside them, please sign up)</p>
            <p>6:30 - 7:15 a.m. - Register at the JW Marriott Exhibit Hall &quot;C&quot; Foyer to pick up your name badge (this badge will include your name, company, charity organization, bus #, and group name/# to which you are assigned) </p>
            <p>Full Breakfast Buffet will be served in Exhibit Hall &quot;C&quot;</p>
            <p>7:15 - 7:25 a.m. - Load buses<br>
              7:30 a.m. - BUSES LEAVING to Charity Work Projects<br>
              8:00  – 12:00 a.m. - Charity Work Projects<br>
              12:00 - 12:30 p.m. - Load buses for return to JWM - Lunch will be provided in Exhibit Hall &quot;C&quot;<br>
            </p></td></tr>
            <tr>
              <th class="form-matrix-column-headers form-matrix-column_0">
                Name
              </th>
              <th class="form-matrix-column-headers form-matrix-column_0">
                Department</th>
              <th class="form-matrix-column-headers form-matrix-column_1">
                T-Shirt Size
              </th>
            </tr>
            <!-- header end-->
            <!-- entry loop -->
            
            <tr>
              <th align="left" class="form-matrix-row-headers">
                
        <div id="cid_3" class="form-input"><span class="form-sub-label-container"><input type="hidden" name="hid0" value="697"><input class="form-textbox" type="text" size="25" name="ch_first" id="ch_first" />
            <label class="form-sub-label" for="first_3" id="sublabel_first"> First Name </label></span><span class="form-sub-label-container"><input class="form-textbox" type="text" size="25" name="ch_last" id="ch_last" />
            <label class="form-sub-label" for="last" id="sublabel_last"> Last Name </label></span>
        </div>
              </th>
              <td align="center" class="form-matrix-values">
                <input type="text" class="form-textbox" id="ch_department" name="ch_department" size="25"/>
              </td>
              <td align="center" class="form-matrix-values">
          <select class="form-dropdown" style="width:50px" id="ch_size" name="ch_size">
		  		<option value="">Select</option>
				<option value="S">S</option>
				<option value="M">M</option>
				<option value="L">L</option>
				<option value="XL">XL</option>
				<option value="2XL">2XL</option>
				<option value="3XL">3XL</option>
          </select>
              </td>
            </tr>
            <tr><td colspan="7" class="form-matrix-values form-matrix-column-headers" ><strong>Name of Sponsoring Company that you want to work beside</strong>              <input type="text" class="form-textbox" id="ch_company" name="ch_company" size="30"/></td></tr>
            </table>
            </div>
            </li>
      <!-- event registration ends-->
       <!-- event registration -->
      <li class="form-line" id="id_4">
        <div id="cid_4" class="form-input-wide">
          <table summary="" cellpadding="4" cellspacing="0" class="form-matrix-table">
            <!-- header -->
            <tr><td colspan="7"><h3>Thursday, June 4</h3>
            <p><strong>Hall of Fame Reception - $125,000 - $175,000 Sponsor Levels</strong><br>
              4:30 - 6:30 p.m. - Cibolo Canyons Ballroom - Suite 3<br>
              6:30 - 7:00 p.m. - Move to Grand Oaks Ballroom &amp; everyone seated</p>
            <p><strong>Sponsor Reception - $5,000 - $100,000 Sponsor Levels</strong><br>
              4:30 - 6:30 p.m. - Cibolo Canyons Main Ballroom<br>
              6:30 - 7:00 p.m. - Move to Grand Oaks Ballroom &amp; everyone seated<br>
              7:00 - 9:00 p.m. - Sponsor Dinner &amp; Program - Grand Oaks Ballroom</p></td></tr>
            <tr>
              <th class="form-matrix-column-headers form-matrix-column_0">
                Name
              </th>
              <th class="form-matrix-column-headers form-matrix-column_0">
                Department</th>
            </tr>
            <!-- header end-->
            <!-- entry loop -->
            
            <tr>
              <th align="left" class="form-matrix-row-headers">
                
        <div id="cid_3" class="form-input"><span class="form-sub-label-container"><input type="hidden" name="hid0" value="697"><input class="form-textbox" type="text" size="25" name="r_first" id="r_first" />
            <label class="form-sub-label" for="first_3" id="sublabel_first"> First Name </label></span><span class="form-sub-label-container"><input class="form-textbox" type="text" size="25" name="r_last" id="r_last" />
            <label class="form-sub-label" for="last" id="sublabel_last"> Last Name </label></span>
        </div>
              </th>
              <td align="center" class="form-matrix-values">
                <input type="text" class="form-textbox" id="r_department" name="r_department" size="25"/>
              </td>
            </tr>
            </table>
            </div>
            </li>
      <!-- event registration ends-->
      <li class="form-line" id="id_2">
        <div id="cid_2" class="form-input-wide">
          <div style="margin-left:156px" class="form-buttons-wrapper">
            <button id="input_2" type="submit" class="form-submit-button">
              Submit
            </button>
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

</form></body>
</html>