<?php
ini_set('display_errors', 1);
error_reporting(~0);

require ('../../../lib/config.php');
require ('../../../lib/functions.php');

if(isset($_POST['formID'])) {
    $password = validate_input($_POST['password']); //HEBTOC2019
    $company = validate_input($_POST['companyName']);
    $employees = "";
    $participants = "";
    if ($password === WAIVERCODE)
    {
        //$employees = getEmployees($company);
        $employees = getEmployeesFromEvents($company);

        //get current status
        $qString = 'SELECT * FROM toc_events inner join toc_register on toc_regid = idtoc_register ' .
            'where toc_charity=1 and company=:company';//, $dbc->real_escape_string($company));

        $query = $connection->prepare($qString);
        $query->bindParam('company', $company, PDO::PARAM_STR);
        $query->execute();

        while ($row = $query->fetch(PDO::FETCH_ASSOC))
        {
            $signed = '<strong>Need to sign waiver</strong>';
            if ($row["toc_charity_waiver"] == 1) $signed = 'Signed at ' . $row["toc_charity_waiver_signed"];
            $participants .= '<li>' . $row["toc_firstname"] . ' ' . $row["toc_lastname"] . ', '. $row["toc_title"] . ' (' . $signed . ')</li>';
        }
    }
    else header("Location: charity_waiver.php?e=false");
} else {
    header("Location: charity_waiver.php?e=false");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta name="HandheldFriendly" content="true" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href='http://fonts.googleapis.com/css?family=Great+Vibes' rel='stylesheet' type='text/css'>
    <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
<title>Form</title>
<style type="text/css">

    body, html{
        margin:20 auto;
        padding:0;
        background:false;
    }
	

    .form-all{
        margin:0px auto;
        padding-top:20px;
        width:800px;
        font-family:'Verdana';
        font-size:12px;
    }

    ::-webkit-input-placeholder {
        font-style: italic;
    }
    :-moz-placeholder {
        font-style: italic;
    }
    ::-moz-placeholder {
        font-style: italic;
    }
    :-ms-input-placeholder {
        font-style: italic;
    }

    #yourname2 {
        font: 400 36px/0.8 'Great Vibes', Helvetica, sans-serif;
        color: #000;
        text-shadow: 4px 4px 3px rgba(0,0,0,0.1);
    }
</style>
    <script>
        <!--
        function verify() {
            var themessage = "Required fields: ";
            if (document.form_32814544278863.yourname1.value=="Select your name") {
                themessage = themessage + "\n-Select your name";
            }
            if (document.form_32814544278863.yourname2.value=="") {
                themessage = themessage + "\n-Type your name";
            }
            if (document.form_32814544278863.yourname2.value.toLowerCase() != document.form_32814544278863.yourname1.value.toLowerCase()) {
                themessage = themessage + "\n-Names don't match";
            }

            if (themessage == "Required fields: ") {
                document.form_32814544278863.submit();
            }
            else {
                alert(themessage);
                return false;
            }
        }
        -->
    </script>
</head>
<body>
<form onsubmit="return verify();" action="charity_waiver_save_events.php" method="post" name="form_32814544278863" id="32814544278863" accept-charset="utf-8">
  <input type="hidden" name="formID" value="32814544278863" />
  <div class="form-all">
        <label class="form-label-left" id="label_5" for="input_5">
           <p align="center"><strong><u>Authorization To Reproduce Physical Likeness</u></strong></p>
            <p>For good and valuable consideration, receipt of which is hereby acknowledged, I grant unto H-E-B Tournament of Champions Charitable Trust (“TOC”), HEB Grocery Company, LP (“HEB”), including its affiliates, agents, successors, assigns and licensees (the “Released Parties”), and the following participating organizations: Homes for Our Troops, the San Antonio Food Bank, Boys & Girls Club of San Antonio Calderon Branch, Daughters of Charity, Davis Scott YMCA, and Tragedy Assistance Program for Survivors; the unqualified and irrevocable right and permission to photograph or otherwise record my physical likeness, name, and/or voice and to use said photograph, or reproduction of my physical likeness, name and/or voice in whole or in part, for any lawful purpose in any published or publishable form or media (including without limitation, still, motion, print, billboard, sign, radio, television, film, Internet, social media or other digital medium) in perpetuity throughout the world.</p>

                <p>I further grant the right to edit, distort, make composites and combinations and otherwise make derivative works of this and any other photograph or likeness and/or voice for any lawful purpose, and to use or reuse any and all such photograph or lines for, included but not limited to, promotional, commercial, merchandising, advertising, art, publicity, editorial, exhibition, gift, sale, distribution and syndication purposes that TOC, HEB or the Released Parties may deem proper.</p>

                <p>I agree and acknowledge that I have not, and will not claim to have, either under this instrument or otherwise, any right, copyright, moral right, title, right of privacy or publicity, property interest or interest of any kind or nature whatsoever in and to any photograph or physical likeness and/or use of my name or voice, and I hereby release, discharge, and agree to save TOC, HEB and the Released Parties from any liability arising from such right or interest.  I hereby waive any right I may have to inspect and/or approve the finished reproduction of my physical likeness, name, and/or voice or the use to which it may be put.</p>

                <p>I warrant that I have not been convicted of any felony and have not engaged in any act of moral turpitude. I hereby indemnify and hold TOC, HEB and the Released Parties harmless against any claim, damage, injury or loss suffered as a result of a breach of the foregoing warranty.</p>

                <p>I hereby certify that I am over the age of eighteen (18), I have read the foregoing and fully understand the meaning and effect thereof, and I intend to be legally bound thereby.
            </p>
            <p align="center"><strong><u>WAIVER, RELEASE AND INDEMNITY AGREEMENT</u></strong><br>
                <strong><u>TOURNAMENT OF CHAMPIONS CHARITY WORK  PROJECT</u></strong></p>
            <p>This Release,  Waiver of Liability and Indemnity Agreement (&quot;Agreement&quot;) is made and  entered into effective <span style="background-color: yellow"><u><?php echo date("m") ?></u>(month), <u><?php echo date("d") ?></u>(date), <u><?php echo date("Y") ?></u>(year)</span>, by and among  HEB Grocery Company, LP (&quot;HEB&quot;), the H-E-B Tournament of Champions  Charitable Trust (the &ldquo;TOC Trust&rdquo;), the Participating Organizations (as defined  below), and the undersigned individual (&ldquo;Participant&rdquo;).  </p>
            <p> Whereas, H-E-B will be sponsoring and the TOC  Trust will be hosting the H-E-B Tournament of Champions (the &ldquo;TOC&rdquo;) and related  activities, a charitable fundraiser benefitting various and numerous charities  throughout the state of Texas, on or about <?php echo FIRST ?>, <?php echo TOCYEAR ?> through <?php echo FIFTH ?>, <?php echo TOCYEAR ?>;  </p>
            <p>Whereas, the TOC  includes Charity Work Projects (the &ldquo;Charity Projects&rdquo;) held at several  locations in the Greater San Antonio area, including but not limited to those hosted  by the following participating organizations: Homes for Our Troops, Fisher  House Foundation, Inc., the Warrior Family Support Center, the San Antonio Food  Bank, Madonna Center, Inc., Magdalena House/Magdalena Ministries, Guadalupe  Community Center/Catholic Charities of San Antonio, and the Eastside Education  &amp; Training Center/Alamo Colleges District (collectively, the &ldquo;Participating  Organizations&rdquo;); </p>
<p>Whereas, the TOC  and the Charity Projects include various activities designed to assist and  better the community and individuals in need, including but not limited to,  building fences, landscaping, assembling furniture, distributing food,  painting, roofing, building and installing storage sheds, benches, and tables,  picking up litter, and general cleaning; and</p>
<p>Whereas,  Participant has volunteered to participate in the TOC and/or the Charity  Projects and has agreed to release the sponsoring and hosting entities from any  liability associated therewith;</p>
<p> NOW, THEREFORE, in consideration of the  covenants and mutual promises herein contained, and other consideration, the  parties hereby agree as follow:<strong><u>  </u></strong></p>
            <p>1.         In consideration for my participation  in the TOC and/or the Charity Projects, <strong>I HEREBY </strong><strong>release, waive, discharge and covenant not to sue, HEB,  the toc trust, THE PARTICIPATING ORGANIZATIONS, AND EACH OF THEIR RESPECTIVE affiliates,  officers, DIRECTORS, SHAREHOLDERS, agents, servants, representatives and  employees (hereinafter referred to collectively as the &ldquo;Released Parties&rdquo;) from  any and all liabilities, claims, demands, actions and causes of action  whatsoever arising out of or related to any loss, damage, (including but not  limited to property damage to any personal or real property), personal injury,  including death, that may be sustained by me, or any of the property belonging  to me, whether caused by the negligence of the Released Parties, other parTicipants,  attendees or otherwise, while participating in the </strong><strong>TOC AND/OR  THE CHARITY PROJECTS,</strong><strong> or while in, on or upon the premises where the TOC OR THE CHARITY </strong><strong>PROJECTS</strong><strong> ARE being conducted.</strong></p>
            <p>2.         I am aware that during the course of my  participation in the TOC and/or the Charity Projects, I may be exposed to a  variety of potential hazards, and that I should not participate unless medically  able and properly trained.  I assume all  risks associated with these events including, but not limited to: property  damage, personal injury, death, health conditions and ailments, falls, contact  with other participants, all such risks being known and appreciated by me.<strong> </strong>I am further aware of the type and  nature of the work associated with the TOC and/or the Charity Projects and will  only participate where I am knowledgeable, have proper training (if  applicable), and understand the associated work.<strong> </strong>I hereby elect to voluntarily participate in the TOC and/or the  Charity Projects with full knowledge that my participation may be hazardous to me.   <strong>I  voluntarily assume full responsibility for any risks of loss, property damage  or personal injury, including death, that may be sustained by me or any loss or  damage to property owned by me as a result of my participation in the TOC  AND/OR THE CHARITY </strong><strong>PROJECTS</strong><strong>, whether caused by the negligence of the Released  Parties or otherwise.</strong>  I also  agree that for the duration of the TOC and/or the Charity Projects, I will  comply with all state, county and city laws.</p>
            <p>3.         <strong>I FURTHER HEREBY AGREE TO INDEMNIFY AND HOLD HARMLESS  THE RELEASED PARTIES FROM ANY LOSS, LIABILITY, CLAIMS, DAMAGE OR COSTS,  INCLUDING COURT COSTS AND ATTORNEY FEES, THAT THEY MAY INCUR DUE TO MY PARTICIPATION  IN THE TOC AND/OR THE CHARITY PROJECTS, WHETHER CAUSED BY NEGLIGENCE OF THE Released Parties OR OTHERWISE.</strong></p>
            <p>4.         It is my express intent that this <strong>WAIVER OF  LIABILITY AND INDEMNITY AGREEMENT </strong>shall also bind the members of my  family and/or spouse, if I am alive, and my heirs, assigns and personal  representative, if I am deceased, and shall be deemed as a <strong>release, waiver, discharge and covenant not to sue  the above-named Released Parties.  </strong>I  hereby further agree that this Waiver of Liability and Indemnity Agreement  shall be construed in accordance with the laws of the State of Texas.</p>
            <p>5.         By  signing this release or manifesting my consent electronically (e.g., by  clicking &ldquo;I Accept&rdquo; or clicking a corresponding checkbox), I acknowledge and  represent that I have read the foregoing agreement in full, that I understand  it and sign it voluntarily as my own free act and deed; that no oral  representations, statements, or inducements, apart from the foregoing written  agreement, have been made; that I am at least eighteen (18) years of age and  fully competent; and that I execute this release for full, adequate and  complete consideration fully intending to be bound by same. 
            </p>
        </label>
      <div class="form-group">
          <label for="inputlg">Company Name</label>
          <input type="text" readonly class="form-control input-lg" data-type="input-textbox" id="yourcompany" name="yourcompany" size="55" value="<?php echo $company ?>" />
      </div>
      <div class="form-group">
          <label for="inputlg">Participants</label>
          <ul><?php echo $participants ?></ul>
      </div>
      <?php if ($employees=="<option>Select your name</option>") {
          echo "<h4 style='color:#ff0000'>If your name is not listed in the drop down menu, please contact the person that sent you this link, and let them know that your name is not listed on the Charity Work Project registration form for your company.</h4>" .
          "<p><a href='/'>Back to Home</a></p>";
      } else { ?>
      <div class="form-group">
          <label for="inputlg">Please pick your name</label>
          <select id="employees">
              <?php echo $employees ?>
          </select>
          <input type="hidden" readonly class="form-control input-lg" data-type="input-textbox" id="yourid" name="yourid" size="55" value="" />
          <input type="text" readonly class="form-control input-lg" data-type="input-textbox" id="yourname1" name="yourname1" size="55" value="" />
      </div>
      <div class="form-group">
          <label for="inputlg">Please type your name</label>
          <input type="text" class="form-control input-lg" style="font-style:italic" data-type="input-textbox" id="yourname2" name="yourname2" size="55" value="" />
      </div>

      <div id="cid_7" class="form-input">
          <button type="submit" id="input_2" class="btn btn-success">
              I Accept
          </button>
      </div>
      <?php } ?>
      <div>&nbsp;</div>
  </div>
  <input type="hidden" id="simple_spc" name="simple_spc" value="32814544278863" />

</form>
<script>
    $(function(){ /* DOM ready */
        $("#employees").change(function() {
            $("#yourname1").val( $("#employees option:selected").text() );
            $("#yourid").val( $("#employees option:selected").val() );
        });
    });
</script>

</body>
</html>