<?php
//for redirect to Donation only form
//after event
//header('Location: login_officer_proc.php');
//exit;
//
//
require ('../../lib/config.inc.php');
require ('../../lib/mysqli_connect.php');
require ('../../lib/functions.php');
setlocale(LC_MONETARY, 'en_US');

session_start();
if(isset($_SESSION['admin']))
{
	header("Location: admin_panel.php");
	die();	

}
if(isset($_SESSION['email']))
{
	header("Location: reg_partnerinfo.php");
	die();	

}
$sp='';
if(isset($_GET['sp']))
{
	$sp = validate_input($_GET['sp']);
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
	<meta name="robots" content="noindex">
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
	
	select: {
		font-size: 16px;
		height: 50px;
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
	.note {
		color: red;
		font-weight: bold;
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
.agreed { display: none;}
#waiver { background: #F0F0F0; padding: 7px; border:1px solid #000;}
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
	function showSubmit() {
	   if(document.getElementById('charity').checked) {
	   		document.getElementById('input_2').style.display = "none";
	   } else {
	   	    document.getElementById('input_2').style.display = "";
		    document.getElementById('CWPWaivers').checked = false;
		    document.getElementById("waiver").style.display = "";
		    let myElements = document.querySelectorAll(".agreed");
 			for (var i = 0; i < myElements.length; i++) {
    			myElements[i].style.display = "none";
			}
	   }
   }
   function isWaiverChecked() {
		if(document.getElementById('CWPWaivers').checked) {
    		document.getElementById("waiver").style.display = "none";
			document.getElementById("charity").checked = true;
			document.getElementById('input_2').style.display = "";
			var myElements = document.querySelectorAll(".agreed");
 			for (var i = 0; i < myElements.length; i++) {
    			myElements[i].style.display = "inline";
			}
		//} else if (document.getElementById('CWPWaivers').checked && !document.getElementById('charity').checked) {
	   	//	alert ("Please select the Chariy Work Event first if you want to particiate");
   		} else {
			document.getElementById("waiver").style.display = "";
			document.getElementById("charity").checked = false;
			let myElements = document.querySelectorAll(".agreed");
 			for (var i = 0; i < myElements.length; i++) {
    			myElements[i].style.display = "none";
			}
		}
	}
</script>
<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
<form class="jotform-form" action="register_proc_partner.php" method="post" name="form_32814544278863" id="32814544278863" accept-charset="utf-8">
  <input type="hidden" name="formID" value="32814544278863" />
  <input type="hidden" name="new_reg" value="true" />
  <input type="hidden" name="tocflag" value="o" />
  <div class="form-all">
  <div id="info">
  <h2>H-E-B Officer Registration Form</h2>
  <h3><!--Registration for the event has closed.-->If you have already registered, <a href="login_officer_proc.php">please login to your account</a> to review your information</h3><h3 align="right"><a href="/">Back to homepage</a></h3></div>
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
     <!--li class="form-line" id="id_13">
        <label class="form-label-left" id="label_13" for="input_13">
          Department<span class="form-required">*</span>
        </label>
        <div id="cid_13" class="form-input">
          <input type="text" class=" form-textbox validate[required]" data-type="input-textbox" id="department" name="department" size="20" value="" />
        </div>
      </li>-->
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
                <p>
                  <h3><input class="form-radio" type="checkbox" name="golf1" value="June 6" />
				  Wednesday, <?php echo THIRD ?> – TOPGOLF Tournament</h3><br>This event is for $125,000 - $175,000 Sponsors (if you have suppliers that are participating at this level, please check this box and make plans to attend)
                  <br><br>
                  <span class="note">Note:  Partners will not be assigned to a specific Bay, they are required to spend time in each Bay where they have sponsoring companies participating.  Sponsor Bay assignments will be sent to you prior to this event.</span><br>
                  <br>
                  7:00 a.m.  – Registration at JWM Exhibit Hall level <span class="note">(wear your TOC barcode name badge)</span><br>
                7:30 a.m.  - Buses leave for Topgolf<br>
                8:30 a.m.  - Buffet Breakfast <br>
                9:00 –  11:00 a.m. – Golf Tournament<br>
                11:00 –  12:00 noon - Buffet Lunch &amp; Winners Announced
                <br>
                12:15 p.m. – Load  buses for return to JWM<br>
                <br>
                <h3><input class="form-radio" type="checkbox" name="golf2" value="June 8" />
					Friday, <?php echo FIFTH ?> -  Golf Tournament for $5,000 - $100,000 Sponsor Levels</h3>
                
<p><strong>(Golf Tournament locations determined by Department &amp;  Sponsorship Level)</strong></p>
               <p style="background: #FFF505">PLEASE NOTE:  Any Sponsoring company that does not want to  play at Topgolf and wants to play at a regular golf course will be  accommodated. Please have the sponsoring company contact Kathy Ashwin for this  change.</p>
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
                  <p><strong>- Accounting</strong><br>
                    <strong>- Advertising</strong><br>
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
            
            <!--<tr>
              <td class="form-matrix-values"> <strong>Golf Shirt Size: </strong><select class="form-dropdown" style="width:50px" id="g_size" name="g_size">
  <option value="">Select</option>
  <option value="S">S</option>
  <option value="M">M</option>
  <option value="L">L</option>
  <option value="XL">XL</option>
  <option value="2XL">2XL</option>
  <option value="3XL">3XL</option>
</select> <input type="radio" name="gender" value="male" checked> Male | 
  <input type="radio" name="gender" value="female"> Female
              </td>
            </tr>-->
            <input type="hidden" name="g_size" value="none" />
            <input type="hidden" name="gender" value="none" />
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
              <td colspan="7"><h3><input class="form-radio" type="checkbox" name="welcome" value="Welcome Dinner" /> 
              Wednesday, <?php echo THIRD ?> - Welcome Dinner</h3>
                <p> 5:30 -  7:30 p.m. - Welcome Dinner Buffet - Exhibit Hall Level "B-C"<br>
                  7:30 - 10:00 p.m. - Social Time - Event Lawn 2 (outside main lobby - lower level)<br>
                </p>                <strong>
            </strong></td></tr>
            </table>
            </div>
            </li>
      <!-- event registration ends-->
      
      <!-- event registration -->
      <li class="form-line" id="id_4">
        <div id="cid_4" class="form-input-wide">
          <table summary="" cellpadding="4" cellspacing="0" class="form-matrix-table">
            <!-- header -->
            <tr><td colspan="7"><h3><input class="form-radio" type="checkbox" id="charity" name="charity" value="Charity Work Project" onClick="showSubmit();" />  
            Thursday, <?php echo FOURTH ?> - Charity Work Project</h3>
            <p>Charity Work Project for all Sponsorship levels (please  indicate the charity organization where you would like to participate)            </p>
            <p>6:30 - 7:15 a.m. - Register at the JW Marriott Exhibit Hall &quot;B&quot; Foyer to pick up your name badge (this badge will include your name, company, charity organization, bus #, and group name/# to which you are assigned) </p>
            <p>Full Breakfast Buffet will be served in Exhibit Hall &quot;B&quot;</p>
            <p>7:15 - 7:25 a.m. - Load buses<br>
              7:30 a.m. - BUSES LEAVING to Charity Work Projects<br>
              8:00  – 12:00 a.m. - Charity Work Projects<br>
              12:00 - 12:30 p.m. - Load buses for return to JWM - Lunch will be provided in Exhibit Hall &quot;B&quot;
            </p>
            <p><strong style="background: yellow">In order to participate in the Charity Work Project, you  must read and agree to the following two RELEASES.  Once you have checked the box below, the  registration information will appear for you to complete.</strong></p>
            <p><input class="form-radio" type="checkbox" id="CWPWaivers" name="CWPWaivers" value="CWPWaiversAgreed" onClick="isWaiverChecked();" /><strong>By checking this box, you agree that you have  read the following two Photo &amp; Work Waivers and agree to their content:</strong></p>
            <div id="waiver">
              <p align="center"><u><strong><br>
    RELEASE, Authorization  To Reproduce Physical Likeness</strong></u></p>
				<p>For good and valuable  consideration, receipt of which is hereby acknowledged, I grant unto H-E-B  Tournament of Champions Charitable Trust (&ldquo;TOC&rdquo;), H-E-B, LP (&ldquo;H-E-B&rdquo;), including  its affiliates, agents, successors, assigns and licensees (the &ldquo;Released Parties&rdquo;),  and the following participating organizations: Homes for Our Troops, the San  Antonio Food Bank, Daughters of Charity Services of San Antonio, Boys and Girls  Club of San Antonio, YMCA of Greater San Antonio and Tragedy Assistance Program  for Survivors; the unqualified and irrevocable right and permission to  photograph or otherwise record my physical likeness, name, and/or voice and to  use said photograph, or reproduction of my physical likeness, name and/or voice  in whole or in part, for any lawful purpose in any published or publishable  form or media (including without limitation, still, motion, print, billboard,  sign, radio, television, film, Internet, social media or other digital medium)  in perpetuity throughout the world.</p>
                <p>I further grant the right to  edit, distort, make composites and combinations and otherwise make derivative  works of this and any other photograph or likeness and/or voice for any lawful  purpose, and to use or reuse any and all such photograph or lines for, included  but not limited to, promotional, commercial, merchandising, advertising, art,  publicity, editorial, exhibition, gift, sale, distribution and syndication  purposes that TOC, H-E-B, or the Released Parties may deem proper. </p>
                <p>I agree and acknowledge that I  have not, and will not claim to have, either under this instrument or  otherwise, any right, copyright, moral right, title, right of privacy or  publicity, property interest or interest of any kind or nature whatsoever in  and to any photograph or physical likeness and/or use of my name or voice, and  I hereby release, discharge, and agree to save TOC, H-E-B, and the Released  Parties from any liability arising from such right or interest.  I hereby waive any right I may have to inspect  and/or approve the finished reproduction of my physical likeness, name, and/or  voice or the use to which it may be put.</p>
                <p>I warrant that I have not been  convicted of any felony and have not engaged in any act of moral turpitude. I  hereby indemnify and hold TOC, H-E-B and the Released Parties harmless against  any claim, damage, injury or loss suffered as a result of a breach of the  foregoing warranty. </p>
                <p>I hereby certify that I am over  the age of eighteen (18), I have read the foregoing and fully understand the  meaning and effect thereof, and I intend to be legally bound thereby. <br>
                </p>
				<p align="center"><strong><u>WAIVER, RELEASE AND INDEMNITY AGREEMENT<br>
				  TOURNAMENT OF CHAMPIONS CHARITY WORK  PROJECT</u></strong></p>
				<p>This Release,  Waiver of Liability and Indemnity Agreement (&quot;Agreement&quot;) is made and  entered into effective <strong><u><? echo date("F j, Y"); ?></u></strong>, by and among H-E-B,  LP (&ldquo;H-E-B&rdquo;), the H-E-B Tournament of Champions Charitable Trust (the &ldquo;TOC Trust&rdquo;),  the Participating Organizations (as defined below), and the undersigned  individual (&ldquo;Participant&rdquo;).  </p>
                <p>Whereas, H-E-B will be sponsoring and the TOC  Trust will be hosting the H-E-B Tournament of Champions (the &ldquo;TOC&rdquo;) and related  activities, a charitable fundraiser benefitting various and numerous charities  throughout the state of Texas, on or about June 2, 2020 through June 5, 2020;   </p>
                <p>Whereas, the TOC  includes Charity Work Projects (the &ldquo;Charity Projects&rdquo;) held at several  locations in the Greater San Antonio area, including but not limited to those hosted  by the following participating organizations: Homes for Our Troops, Fisher  House Foundation, Inc., the Warrior Family Support Center, the San Antonio Food  Bank, Madonna Center, Inc., Magdalena House/Magdalena Ministries, Guadalupe  Community Center/Catholic Charities of San Antonio, and the Eastside Education  &amp; Training Center/Alamo Colleges District (collectively, the &ldquo;Participating  Organizations&rdquo;); </p>
                <p>Whereas, the TOC  and the Charity Projects include various activities designed to assist and  better the community and individuals in need, including but not limited to,  building fences, landscaping, assembling furniture, distributing food,  painting, roofing, building and installing storage sheds, benches, and tables,  picking up litter, and general cleaning; and</p>
                <p>Whereas,  Participant has volunteered to participate in the TOC and/or the Charity  Projects and has agreed to release the sponsoring and hosting entities from any  liability associated therewith;</p>
                <p> NOW, THEREFORE, in consideration of the  covenants and mutual promises herein contained, and other consideration, the  parties hereby agree as follow:</p>
                <p>1.         In consideration for my participation in the TOC  and/or the Charity Projects, <strong>I HEREBY release, waive,  discharge and covenant not to sue, HEB, the toc trust, THE PARTICIPATING  ORGANIZATIONS, AND EACH OF THEIR RESPECTIVE affiliates, officers, DIRECTORS,  SHAREHOLDERS, agents, servants, representatives and employees (hereinafter  referred to collectively as the &ldquo;Released Parties&rdquo;) from any and all  liabilities, claims, demands, actions and causes of action whatsoever arising  out of or related to any loss, damage, (including but not limited to property  damage to any personal or real property), personal injury, including death,  that may be sustained by me, or any of the property belonging to me, whether  caused by the negligence of the Released Parties, other parTicipants, attendees  or otherwise, while participating in the TOC  AND/OR THE CHARITY PROJECTS, or while in, on or upon the premises where the TOC  OR THE CHARITY PROJECTS ARE being conducted.</strong></p>
                <p>2.         I am aware that during the course of my  participation in the TOC and/or the Charity Projects, I may be exposed to a  variety of potential hazards, and that I should not participate unless medically  able and properly trained.  I assume all  risks associated with these events including, but not limited to: property  damage, personal injury, death, health conditions and ailments, falls, contact  with other participants, all such risks being known and appreciated by me.<strong> </strong>I am further aware of the type and  nature of the work associated with the TOC and/or the Charity Projects and will  only participate where I am knowledgeable, have proper training (if applicable),  and understand the associated work.<strong> </strong>I  hereby elect to voluntarily participate in the TOC and/or the Charity Projects  with full knowledge that my participation may be hazardous to me.  <strong>I  voluntarily assume full responsibility for any risks of loss, property damage  or personal injury, including death, that may be sustained by me or any loss or  damage to property owned by me as a result of my participation in the TOC  AND/OR THE CHARITY </strong><strong>PROJECTS</strong><strong>, whether caused by the negligence of the Released Parties  or otherwise.</strong>  I also agree  that for the duration of the TOC and/or the Charity Projects, I will comply  with all state, county and city laws.</p>
                <p>3.         <strong>I FURTHER HEREBY AGREE TO INDEMNIFY AND HOLD HARMLESS  THE RELEASED PARTIES FROM ANY LOSS, LIABILITY, CLAIMS, DAMAGE OR COSTS,  INCLUDING COURT COSTS AND ATTORNEY FEES, THAT THEY MAY INCUR DUE TO MY PARTICIPATION  IN THE TOC AND/OR THE CHARITY PROJECTS, WHETHER CAUSED BY NEGLIGENCE OF THE Released Parties OR OTHERWISE.</strong></p>
                <p>4.         It is my express intent that this <strong>WAIVER OF  LIABILITY AND INDEMNITY AGREEMENT </strong>shall also bind the members of my  family and/or spouse, if I am alive, and my heirs, assigns and personal  representative, if I am deceased, and shall be deemed as a <strong>release, waiver, discharge and covenant not to sue  the above-named Released Parties.  </strong>I  hereby further agree that this Waiver of Liability and Indemnity Agreement  shall be construed in accordance with the laws of the State of Texas.</p>
                <p>5.         By signing this release or manifesting  my consent electronically (e.g., by clicking &ldquo;I Accept&rdquo; or clicking a  corresponding checkbox), I acknowledge and represent that I have read the  foregoing agreement in full, that I understand it and sign it voluntarily as my  own free act and deed; that no oral representations, statements, or  inducements, apart from the foregoing written agreement, have been made; that I  am at least eighteen (18) years of age and fully competent; and that I execute  this release for full, adequate and complete consideration fully intending to  be bound by same.  </p>
            </div>
				</p>
            </td></tr>
            <!-- header end-->
            <!-- entry loop -->
            
            <tr class="agreed">
              <td class="form-matrix-values"><strong>T-Shirt Size:</strong> <select class="form-dropdown" style="width:50px" id="ch_size" name="ch_size">
  <option value="">Select</option>
  <option value="S">S</option>
  <option value="M">M</option>
  <option value="L">L</option>
  <option value="XL">XL</option>
  <option value="2XL">2XL</option>
  <option value="3XL">3XL</option>
                      <option value="4XL">4XL</option>
</select>
              </td>
            </tr>
            <tr class="agreed"><td colspan="7" class="form-matrix-values" ><strong>Name of charity organization where you would like to participate:</strong>              
            <select class="form-dropdown" id="ch_company" name="ch_company">
		  		<option value="">Select</option>
                <option value="Home Build">Home Build</option>
                <option value="Warrior & Family Support Center">Warrior & Family Support Center</option>
                <option value="Fisher House">Fisher House</option>
                <option value="S. A. Food Bank">S. A. Food Bank</option>
                <option value="Eastside Education & Training Center">Eastside Education & Training Center</option>
                <option value="Magdalena House">Magdalena House</option>
                <option value="Madonna Center">Madonna Center</option>
                <option value="Guadalupe Community Center">Guadalupe Community Center</option>
          </select></td></tr>
            </table>
            </div>
            </li>
      <!-- event registration ends-->
       <!-- event registration -->
      <li class="form-line" id="id_4">
        <div id="cid_4" class="form-input-wide">
          <table width="506" cellpadding="4" cellspacing="0" class="form-matrix-table" summary="">
            <!-- header -->
            <tr><td colspan="7"><h3><input class="form-radio" type="checkbox" name="sponsor" value="Sponsor Dinner" /> 
            Thursday, <?php echo FOURTH ?> – Receptions and Sponsor Dinner</h3>
            <p><strong>Hall of Fame Reception - $125,000 - $175,000 Sponsor Levels</strong><br>
              4:30 - 6:30 p.m. - Cibolo Canyons Ballroom - Suite 3<br>
              6:30  - 6:45 p.m. - Move to Grand Oaks Ballroom &amp; everyone seated<br>
              7:00  - 9:00 p.m. - Dinner &amp; Program<br>
              <span class="note">(You will be notified if you are to attend this reception)</span></p>
<p><strong>Sponsor Reception - $5,000 - $100,000 Sponsor Levels</strong><br>
  5:30  - 6:30 p.m. - Cibolo Canyons Main Ballroom<br>
6:40 - 6:55 p.m. - Move to Grand Oaks Ballroom &amp; everyone seated<br>
7:00 - 9:00 p.m. -  Dinner &amp; Program </p></td></tr>
            
            </table>
            </div>
            </li>
      <!-- event registration ends-->
      <li class="form-line" id="id_2">
        <div id="cid_2" class="form-input-wide">
			<div class="g-recaptcha" data-sitekey="6LedNBEUAAAAAD9xMlt_eS3KtBHIGmClNMx9rge7"></div>
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