<?php
//after event
//header('Location: login_partner_proc.php');
//exit;
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
.agreed { display: none;}
#waiver { background: #F0F0F0; padding: 7px; border:1px solid #000;}
.sp { padding: 7px 0 0 20px }
/*ul {display: none} offseason / close notice */
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
  <input type="hidden" name="tocflag" value="p" />
  <div class="form-all">
  <div id="info">
	  <h2>H-E-B Employee Registration Form</h2>
  <h3><!--Registration is now closed. -->If you have already registered, <a href="login_partner_proc.php">please login to your account</a> to review or modify your information</h3><h3 align="right"><a href="/">Back to homepage</a></h3>
   </div> 
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
     <li class="form-line jf-required" data-type="control_dropdown" id="id_1">
        <label class="form-label form-label-left form-label-auto" id="label_1" for="input_1">
          Department
          <span class="form-required">
            *
          </span>
        </label>
        <div id="cid_1" class="form-input jf-required">
          <select class="form-dropdown validate[required]" style="width:150px" id="department" name="department">
            <option value="">Select </option>
            <option value="Accounting"> Accounting </option>
            <option value="Advertising"> Advertising </option>
            <option value="Bakery"> Bakery </option>
            <option value="Deli"> Deli </option>
            <option value="Drug Store"> Drug Store </option>
            <option value="Facility Procurement"> Facility Procurement </option>
            <option value="Finance"> Finance </option>
            <option value="General Merchandise"> General Merchandise </option>
            <option value="Grocery"> Grocery </option>
            <option value="Human Resources"> Human Resources </option>
            <option value="Information Systems"> Information Systems </option>
            <option value="Meat"> Meat </option>
            <option value="Own Brands"> Own Brands </option>
            <option value="Petroleum"> Petroleum </option>
            <option value="Pharmacy"> Pharmacy </option>
            <option value="Produce"> Produce </option>
            <option value="Public Affairs"> Public Affairs </option>
            <option value="Seafood"> Seafood </option>
          </select>
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
                Wednesday, June 5 – TOPGOLF Tournament<br>
                <br>
</strong>
                <p>This event is for $125,000 - $175,000 Sponsors (if you have suppliers that are participating at this level and you want to participate with them, please check this box)<br>
                  <br>
                  <strong>Note:  Partners will not be assigned to a specific Bay, they are required to spend time in each Bay where they have sponsoring companies participating.  Sponsor Bay assignments will be sent to you prior to this event.</strong><br>
                  <a name="_Hlk497480822">7:00 a.m. – Registration at JWM Exhibit Hall level  - pick up badge w/name, level &amp; bay #</a><br>
                  7:30 a.m. - Buses leave for Topgolf<br>
                  8:30 a.m. - Buffet Breakfast <br>
                  9:00 – 11:00 a.m. – Golf Tournament<br>
                  11:00 – 12:00 noon - Buffet Lunch &amp;  Winners Announced<br>
                12:15 p.m. – Load buses for return to JWM<strong><br>
 <br>
                <input class="form-radio" type="checkbox" name="golf2" value="June 5" /> 
                </strong><strong>Friday, June 7: Golf Tournament for $5,000 - $100,000 Sponsor Levels </strong>
                </p>
                <p><strong>(Golf Tournament locations determined by Department &amp;  Sponsorship Level)</strong></p>
				  <p style="background: #FFF505">PLEASE NOTE:  Any Sponsoring company that does not want to play at Topgolf and wants to play at a regular golf course, will be accommodated.  Please have the sponsoring company contact Kathy Ashwin for this change.</p>
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
                  <p>
					  <strong>- Accounting</strong><br>
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
                </div>
                </td></tr>
            
            <!-- header end-->
            <!-- entry loop -->
            <!--
            <tr>
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
            </tr>
            -->
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
              Wednesday, June 5 - Welcome Dinner</h3>
                5:30 -  7:30 p.m. - Welcome Dinner Buffet - Grand Oaks Ballrom<br>
                  7:30 - 10:00 p.m. - Social Time - Event Lawn 2 (outside main lobby - lower level)</td></tr>
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
            Thursday, June 6 - Charity Work Project</h3>
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
				<p>For good and valuable  consideration, receipt of which is hereby acknowledged, I grant unto HEB  Tournament of Champions Charitable Trust (&ldquo;HEB&rdquo;), its affiliates, agents,  successors, assigns and licensees, along with any charitable organization(s)  partnering with HEB to host Charity Work Projects, including but not limited to  Homes for Our Troops, the San Antonio Food Bank, (the  &ldquo;Charitable Organizations&rdquo;), the unqualified and irrevocable right to  photograph or otherwise record my physical likeness and/or voice and to use  said photograph, or reproduction of my physical likeness and/or voice in whole  or in part, in any published or publishable form or media (including without  limitation still, motion, print, billboard, sign, radio, television, or film or  Internet, social media or other digital medium) in perpetuity throughout the  world.</p>
				<p>				  I further grant the right to edit,  distort, make composites and combinations and otherwise make derivative works  of this and any other photograph or likeness and/or voice for any and all other  lawful purposes, and to use or reuse any and all such photograph or lines for,  included but not limited to, promotional, commercial, merchandising,  advertising, art, publicity, editorial, exhibition, gift, sale, distribution  and syndication purposes that HEB or the Charitable Organizations may deem  proper. </p>
				<p>				  I agree and acknowledge that I  have not, and will not claim to have, either under this instrument or  otherwise, any right, copyright, moral right, title, right of privacy or  publicity, property interest or interest of any kind or nature whatsoever in  and to any photograph or physical likeness and or voice, and I hereby  relinquish any and all such right or interest. </p>
				<p>				  I warrant that I have not been  convicted of any felony and have not engaged in any act of moral turpitude. I  hereby indemnify and hold HEB and the Charitable Organizations harmless against  any claim, damage, injury or loss suffered as a result of a breach of the  foregoing warranty. <br>
				  I hereby certify that I am over  the age of eighteen, I have read the foregoing and fully understand the meaning  and effect thereof, and I intend to be legally bound thereby. I hereby waive  inspection and approval of the finished photograph and reproduction of my  physical likeness and/or voice or the use to which it may be put. <br>
				  </p>
				<p align="center"><strong><u>WAIVER, RELEASE AND INDEMNITY AGREEMENT<br>
				  TOURNAMENT OF CHAMPIONS CHARITY WORK  PROJECT</u></strong></p>
				<p>This Release,  Waiver of Liability and Indemnity Agreement (&quot;Agreement&quot;) is made and  entered into effective <strong><u><? echo date("F j, Y"); ?></u></strong>, by and between HEB  GROCERY COMPANY, LP (&quot;HEB&quot;), and the undersigned individual.  </p>
                <p>Whereas,  HEB will be sponsoring the HEB TOURNAMENT OF CHAMPIONS and related activities,  a charitable fundraiser benefitting various and numerous charities throughout  the state of Texas, on or around June 6, 2017;  </p>
                <p>Whereas, the HEB  TOURNAMENT OF CHAMPIONS includes Charity Work Projects (the &ldquo;Projects&rdquo;) at  several locations in the Greater San Antonio area, including but not limited to  those hosted by the charitable organizations Homes for Our Troops, the San  Antonio Food Bank, (the &ldquo;Charitable Organizations&rdquo;);  and  </p>
                <p>Whereas, the Projects  include various activities designed to assist and better the community and  individuals in need, including but not limited to, building fences,  landscaping, assembling furniture, distributing food, painting, roofing,  building and installing storage sheds, benches, and tables, picking up litter,  and general cleaning; </p>
                <p> NOW, THEREFORE, in consideration of the  covenants and mutual promises herein contained, and other consideration, the  parties hereby agree as follow:</p>
                <p>1.In consideration for my  participation in the Projects, <strong>I  HEREBY release, waive, discharge and  covenant not to sue, HEB GROCERY COMPANY, LP, THE CHARITABLE ORGANIZATIONS, AND  EACH OF THEIR RESPECTIVE affiliates, officers, DIRECTORS, SHAREHOLDERS, agents,  servants, representatives and employees (hereinafter referred to collectively  as the &ldquo;Released Parties&rdquo;) from any and all liabilities, claims, demands,  actions and causes of action whatsoever arising out of or related to any loss,  damage, (including but not limited to property damage to any personal or real  property), personal injury, including death, that may be sustained by me, or  any of the property belonging to me, whether caused by the negligence of the  Released Parties, other parTicipants, attendees or otherwise, while  participating in the PROJECTS, or  while in, on or upon the premises where the PROJECTS ARE being conducted.</strong></p>
                <p>2.I know that during the course of my  participation in the Projects, I will be exposed to a variety of potential  hazards, and that I should not participate unless medically able and properly  trained.  I assume all risks associated  with these events including, but not limited to: property damage, personal  injury, death, health conditions and ailments, falls, contact with other  participants, all such risks being known and appreciated by me.<strong> </strong>I am further aware of the type and  nature of the work associated with the Projects and will only participate in  those Projects in which I am knowledgeable, have proper training (if  applicable), and understand the work associated with the Project.<strong> </strong>I hereby elect to voluntarily  participate in said Projects with full knowledge that my participation in the Projects  may be hazardous to me.  <strong>I  voluntarily assume full responsibility for any risks of loss, property damage  or personal injury, including death, that may be sustained by me or any loss or  damage to property owned by me as a result of my participation in the </strong><strong>PROJECTS, whether caused by the negligence of the Released Parties or  otherwise.</strong>  I also agree that for the duration of the  Projects, I will comply with all state, county and city laws.</p>
                <p>3. <strong>I  FURTHER HEREBY AGREE TO INDEMNIFY AND HOLD HARMLESS THE RELEASED PARTIES FROM  ANY LOSS, LIABILITY, CLAIMS, DAMAGE OR COSTS, INCLUDING COURT COSTS AND  ATTORNEY FEES, THAT THEY MAY INCUR DUE TO MY PARTICIPATION IN THE PROJECTS,  WHETHER CAUSED BY NEGLIGENCE OF</strong><strong> </strong><strong>THE Released  Parties OR OTHERWISE.</strong></p>
                <p>4.It is my express intent that this <strong>WAIVER OF LIABILITY AND INDEMNITY  AGREEMENT</strong><strong> </strong>shall also bind the  members of my family and/or spouse, if I am alive, and my heirs, assigns and  personal representative, if I am deceased, and shall be deemed as <strong>a release, waiver, discharge and covenant not to  sue the above-named Released Parties.</strong><strong>  </strong>I  hereby further agree that this Waiver of Liability and Indemnity Agreement  shall be construed in accordance with the laws of the State of Texas.</p>
                <p>5.<strong>In  signing this release, I acknowledge and represent that</strong> I have read the  foregoing <strong>Waiver  of Liability and Indemnity Agreement</strong>, understand it and sign it  voluntarily as my own free act and deed; no oral representations, statements,  or inducements, apart from the foregoing written agreement, have been made; I  am at least eighteen (18) years of age and fully competent; and I execute this  release for full, adequate and complete consideration fully intending to be  bound by same. <br>
                  <br>
                </p>
          </div>
				</p></td></tr>
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
</select>
              </td>
            </tr>
            <tr class="agreed"><td colspan="7" class="form-matrix-values" ><strong>Name of Sponsoring Company that you want to work beside </strong><input type="text" class="form-textbox" id="ch_company" name="ch_company" size="30"/></td></tr>
            </table>
            </div>
            </li>
      <!-- event registration ends-->
       <!-- event registration -->
      <li class="form-line" id="id_4">
        <div id="cid_4" class="form-input-wide">
          <table summary="" cellpadding="4" cellspacing="0" class="form-matrix-table">
            <!-- header -->
            <tr><td width="453" colspan="7"><h3><input class="form-radio" type="checkbox" name="sponsor" value="Sponsor Dinner" /> 
            Thursday, June 6 – Receptions and Sponsor Dinner</h3>
            <p><strong>Hall of Fame Reception - $125,000 - $175,000 Sponsor Levels</strong><br>
              5:30  - 6:30 p.m. - Cibolo Canyons Ballroom - Suite 3<br>
                6:30 - 6:45 p.m. - Move to Grand Oaks Ballroom &amp; everyone seated<br>
  7:00  - 9:00 p.m. - Dinner &amp; Program<br>
  (You will be notified if you are to attend this reception)</p>
<p><strong>General Reception - $5,000 - $100,000 Sponsor Levels</strong><br>
  5:30  - 6:30 p.m. - Cibolo Canyons Main Ballroom<br>
6:40 - 6:55 p.m. - Move to Grand Oaks Ballroom &amp; everyone seated<br>
7:00 - 9:00 p.m. -  Dinner &amp; Program </p></td></tr>
            
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
         
          <div class="g-recaptcha" data-sitekey="6LedNBEUAAAAAD9xMlt_eS3KtBHIGmClNMx9rge7"></div>
          
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