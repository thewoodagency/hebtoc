<?php
require ('./includes/config.inc.php');
require ('./includes/mysqli_connect.php');
require ('./includes/functions.php');
setlocale(LC_MONETARY, 'en_US');

session_start();
/*if(isset($_SESSION['admin']))
{
	header("Location: admin_panel.php");
	die();	

}
if(isset($_SESSION['email']))
{
	header("Location: reg_info.php");
	die();	

}
$sp='';
if(isset($_GET['sp']))
{
	$sp = $_GET['sp'];
}
*/
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
<form class="jotform-form" action="eft_proc.php" method="post" name="form_32814544278863" id="32814544278863" accept-charset="utf-8">
  <input type="hidden" name="formID" value="32814544278863" />
  <div class="form-all">
  <div id="info"><h2>ELECTRONIC FUNDS TRANSFER REQUEST</h2>
  <h3>H-E-B Tournament of Champions accepts funds deposited electronically (Electronic Funds Transfer or ACH) for the convenience of our sponsoring companies.  <br>
    <br>
    Please have your Accounts Payable Dept. complete the information below and submit to initiate EFT to the H-E-B Tournament of Champions.  Once this form is received, our "Financial Institution Information" will be sent to the AP Contact Person listed below:</h3><h3 align="right"><a href="/">Back to homepage</a></h3></div> 
    <ul class="form-section">
     <li class="form-line" id="id_5">
        <label class="form-label-left" id="label_5" for="input_5">
          Company Name<br>(listed on the sponsorship form):<span class="form-required">*</span>
        </label>
        <div id="cid_5" class="form-input">
          <input type="text" class=" form-textbox validate[required]" data-type="input-textbox" id="com1" name="com1" size="55" />
        </div>
      </li>
      <li class="form-line" id="id_1">
        <label class="form-label-left" id="label_1" for="input_1">
          DBA<br>(if different from Company Name)</label>
        <div id="cid_1" class="form-input">
          <input type="text" class=" form-textbox validate" data-type="input-textbox" id="dba" name="dba" size="55" />
        </div>
      </li>
      <li class="form-line" id="id_5">
        <label class="form-label-left" id="label_5" for="input_5">
          Company Name that will be transferring funds:<span class="form-required">*</span>
        </label>
        <div id="cid_5" class="form-input">
          <input type="text" class=" form-textbox validate[required]" data-type="input-textbox" id="com2" name="com2" size="55" />
        </div>
      </li>
      <li class="form-line" id="id_8">
        <label class="form-label-left" id="label_8" for="input_8">
          Address
        </label>
        <div id="cid_8" class="form-input">
          <table summary="" class="form-address-table" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td colspan="2"><span class="form-sub-label-container"><input class="form-textbox form-address-line" type="text" name="addr1" id="addr1" />
                  <label class="form-sub-label" for="input_8_addr_line1" id="sublabel_8_addr_line1"> Street Address </label></span>
              </td>
            </tr>
            <tr>
              <td colspan="2"><span class="form-sub-label-container"><input class="form-textbox form-address-line" type="text" name="addr2" id="addr2" size="46" />
                  <label class="form-sub-label" for="input_8_addr_line2" id="sublabel_8_addr_line2"> Street Address Line 2 </label></span>
              </td>
            </tr>
            <tr>
              <td width="50%"><span class="form-sub-label-container"><input class="form-textbox form-address-city" type="text" name="city" id="city" size="21" />
                  <label class="form-sub-label" for="input_8_city" id="sublabel_8_city"> City </label></span>
              </td>
              <td><span class="form-sub-label-container"><input class="form-textbox form-address-state" type="text" name="state" id="state" size="22" />
                  <label class="form-sub-label" for="input_8_state" id="sublabel_8_state"> State</label></span>
              </td>
            </tr>
            <tr>
              <td width="50%" function zip(){var iterator=Prototype.K,args=$A(arguments);if(Object.isFunction(args.last())) iterator=args.pop();var collections=[this].concat(args).map($A);return this.map(function(value,index){return iterator(collections.pluck(index));});}><span class="form-sub-label-container"><input class="form-textbox form-address-postal" type="text" name="zip" id="zip" size="10" />
                  <label class="form-sub-label" for="input_8_postal" id="sublabel_8_postal"> Zip Code </label></span>
              </td>
              <td><span class="form-sub-label-container"><select class="form-dropdown form-address-country" name="q8_address8[country]" id="input_8_country" disabled>
                    <option value="" selected> Please Select </option>
                    <option selected="selected" value="United States"> United States </option>
                  </select>
                  <label class="form-sub-label" for="country" id="country"> Country </label></span>
              </td>
            </tr>
          </table>
        </div>
      </li>
      <li class="form-line" id="id_9">
        <label class="form-label-left" id="label_9" for="input_9">
          AP Contact<span class="form-required">*</span>
        </label>
        <div id="cid_9" class="form-input"><span class="form-sub-label-container"><input class="form-textbox validate[required]" type="text" size="15" name="fname" id="fname" />
            <label class="form-sub-label" for="first_9" id="sublabel_first"> First Name </label></span><span class="form-sub-label-container"><input class="form-textbox validate[required]" type="text" size="15" name="lname" id="lname" />
            <label class="form-sub-label" for="last_9" id="sublabel_last"> Last Name </label></span>
        </div>
      </li>
      
      <li class="form-line" id="id_10">
        <label class="form-label-left" id="label_10" for="input_10">
          AP E-mail<span class="form-required">*</span>
        </label>
        <div id="cid_10" class="form-input">
          <input type="email" class=" form-textbox validate[required, Email]" id="input_10" name="q10_email10" size="30" value="" />
          <br>
          <input type="email" class="form-textbox validate[required, Email, Email_Confirm]" id="input_10_confirm" style="margin-top:8px;" size="30" />
        </div>
      </li>
      <li class="form-line" id="id_12">
        <label class="form-label-left" id="label_12" for="input_12">
          AP Phone<span class="form-required">*</span>
        </label>
        <div id="cid_12" class="form-input"><span class="form-sub-label-container"><input class="form-textbox validate[required]" type="tel" name="oarea" id="oarea" size="3">
            -
            <label class="form-sub-label" for="input_12_area" id="sublabel_area"> Area Code </label></span><span class="form-sub-label-container"><input class="form-textbox validate[required]" type="tel" name="ophone" id="ophone" size="8">
            <label class="form-sub-label" for="input_12_phone" id="sublabel_phone"> Phone Number </label></span>
        </div>
      </li>
      <li class="form-line" id="id_11">
        <label class="form-label-left" id="label_11" for="input_11">
          AP Fax<span class="form-required">*</span>
        </label>
        <div id="cid_11" class="form-input"><span class="form-sub-label-container"><input class="form-textbox validate[required]" type="tel" name="carea" id="carea" size="3">
            -
            <label class="form-sub-label" for="input_11_area" id="sublabel_area"> Area Code </label></span><span class="form-sub-label-container"><input class="form-textbox validate[required]" type="tel" name="cphone" id="cphone" size="8">
            <label class="form-sub-label" for="input_11_phone" id="sublabel_phone"> Phone Number </label></span>
        </div>
      </li>
      
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