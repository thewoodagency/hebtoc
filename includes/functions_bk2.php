<?
require ('./includes/config.inc.php');
setlocale(LC_MONETARY, 'en_US');

define("PAYMENT", "Thursday, April 30, 2020");
define("WAIVERCODE", "HEBTOC2020");
define("TOCYEAR", "2020");
define("FIRST", "June 1");
define("SECOND", "June 2");
define("THIRD", "June 3");
define("FOURTH", "June 4");
define("FIFTH", "June 5");
//define("SIXTH", "6/10");
# ###################################################################

function getTocLevel($sp) {
	$dbc = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
	$qString = "select * from toc_level order by tlGolf desc";
	$r = $dbc->query($qString);
	$toclevel = "<option value=''>Select</option>";
	while($row = $r->fetch_assoc())
	{
	  $amount = '('. money_format('%(#10n', intval($row["tlAmount"])) . ')';
	  if ($row["tlAmount"] != '0')
	  {
		  if (trim($row["tlName"])==trim($sp))
		  	$toclevel .= "<option value='" . $row["tlName"] . "' selected>" . $row["tlName"] . ' ' . $amount . "</option>";
		  else
	  		$toclevel .= "<option value='" . $row["tlName"] . "'>" . $row["tlName"] . ' ' . $amount . "</option>";
	  }
	  else $toclevel .= "<option value='" . $row["tlName"] . "'>" . $row["tlName"] . "</option>";
	}
	$r->close();
	$dbc->close();
	
	return $toclevel;
}

# ###################################################################

function getLevelInfo($toclevel) {
	$dbc = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
	$qString = "select * from toc_level where tlName='". $toclevel . "'";
	$r = $dbc->query($qString);
	$levelInfo = array();
	while($row = $r->fetch_assoc())
	{
		$levelInfo = array('hotel' => $row['tlHotel'], 
		'golf' => $row['tlGolf'],
		'tour' => $row['tlTour'],
		'private' => $row['tlPrivateMeeting'],
		'pdinner' => $row['tlPDinner'],
		'summit' => $row['tlSummit'],
		'welcome' => $row['tlWelcome'],
		'charity' => $row['tlCharity'],
		'hall' => $row['tlHall'],
		'table' => $row['tlTable'],
		'hotelh' => $row['tlHotelh'],
		'hotelm' => $row['tlHotelm'],
		'privatem' => $row['tlPrivatem'],
		'summitm' => $row['tlSummitm'],
		'welcomem' => $row['tlWelcomem'],
		'charitym' => $row['tlCharitym'],
		'hallm' => $row['tlHallm'],
		'tennish' => $row['tlTennish'],
		'privateh' => $row['tlPrivateh'],
		'summith' => $row['tlSummith'],
		'welcomeh' => $row['tlWelcomeh'],
		'charityh' => $row['tlCharityh'],
		'hallh' => $row['tlHallh'],
		'tableh' => $row['tlTableh'],
		'golfh' => $row['tlGolfh'],
		'golfm' => $row['tlGolfm'],
		'pdinnerh' => $row['tlPDinnerh'],
		'pdinnerm' => $row['tlPDinnerm'],
		'amount' => $row['tlAmount']);
	}
	$r->close();
	$dbc->close();
	
	return $levelInfo;
}

# ###################################################################

function getRegid($email) {
	$dbc = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
	$qString = sprintf('select idtoc_register from toc_register where email="%s"', $dbc->real_escape_string($email));
	$r = $dbc->query($qString);
	$rid = '';
	//if ($dbc->connect_errno()) {
	 // 	printf("Connect failed: %s\n", $dbc->connect_error());
	 // 	exit();
	
	if ($row = $r->fetch_assoc()) 
	{
		$rid = $row["idtoc_register"];
		$r->close();
	}
	$dbc->close();
	
	return $rid;
}

# ###################################################################

function hasAccount($email) {
	$dbc = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
	$account = false;
	//if ($dbc->connect_errno()) {
	 // 	printf("Connect failed: %s\n", $dbc->connect_error());
	 // 	exit();
	//}
	
	$qString = sprintf('select * from toc_register where email="%s"', $dbc->real_escape_string($email));
	
	if ($r = $dbc->query($qString)) 
	{
		$row_cnt = $r->num_rows;
		if ($row_cnt > 0) {
			$account = true;
		}
		$r->close();
	}
	$dbc->close();
	
	return $account;
}

# ###################################################################

function hasMultipleAccount($email) {
	$dbc = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
	$account = false;
	//if ($dbc->connect_errno()) {
	 // 	printf("Connect failed: %s\n", $dbc->connect_error());
	 // 	exit();
	//}
	
	$qString = sprintf('select * from toc_register where email="%s"', $dbc->real_escape_string($email));
	
	if ($r = $dbc->query($qString)) 
	{
		$row_cnt = $r->num_rows;
		if ($row_cnt > 1) {
			$account = true;
		}
		$r->close();
	}
	$dbc->close();
	
	return $account;
}

# ###################################################################

function getCompanies($email) {
	$dbc = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
	$qString = sprintf('select * from toc_register where email="%s"', $dbc->real_escape_string($email));
	$r = $dbc->query($qString);
	$rowcolor = 0;
	$data = '';
	$thead = '<tr class="putbg"><td>Sponsorship</td><td>Company</td><td>Email</td><td>Registered Date</td></tr>';
	while($row = $r->fetch_assoc())
	{
	  if ($rowcolor%2==0)$tbrows .= '<tr class="even">';
		else $tbrows.='<tr>';

		$data .= '<td>' . $row["toclevel"] . '</td><td><a href="reg_info.php?rid='. $row["idtoc_register"] . '">' .
					$row["company"] . '</a></td><td align="center">' .
					$row["email"] . '</td><td>' .
					$row["registerd_date"] . '</tr>';
					$rowcolor++;
	}
	$data = '<h4>You have multiple companies registered under your account.<br> Please click one to review the sponsorship forms.</h4><table align="center"  border="1" cellpadding="5" cellspacing="0">' . $thead . $data . '</table>';
	$r->close();
	$dbc->close();
	
	return $data;
}


# ###################################################################

function hasPartnerAccount($email) {
	$dbc = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
	$account = false;
	//if ($dbc->connect_errno()) {
	 // 	printf("Connect failed: %s\n", $dbc->connect_error());
	 // 	exit();
	//}
	
	$qString = sprintf('select * from toc_partnerregister where email="%s"', $dbc->real_escape_string($email));
	
	if ($r = $dbc->query($qString)) 
	{
		$row_cnt = $r->num_rows;
		if ($row_cnt > 0) {
			$account = true;
		}
		$r->close();
	}
	$dbc->close();
	
	return $account;
}

# ###################################################################

function login_process($email, $password) {
	$dbc = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
	$success = false;
	//if ($dbc->connect_errno()) {
	 // 	printf("Connect failed: %s\n", $dbc->connect_error());
	 // 	exit();
	//}
	if ($email == 'kashwin50@hotmail.com' && $password == 'H4BT0C') 
	{
		$success = true;
	} 
	else if ($email == 'mistyc123@gmail.com' && $password == 'H3BT0C') 
	{
		$success = true;
	}
	else if ($email == 'kotzur.lacey@heb.com' && $password == 'h3&T0C')
    {
        $success = true;
    }
	else {
	$qString = sprintf('select * from toc_register where email="%s" and password="%s"', $dbc->real_escape_string($email), $dbc->real_escape_string($password));
	
	//$r = $dbc->query($qString);
	//if ($row = $r->fetch_assoc())
	if ($r = $dbc->query($qString)) 
	{
		$row_cnt = $r->num_rows;
		if ($row_cnt > 0) {
			$success = true;
			if ($row = $r->fetch_assoc()) {
				$_SESSION['toclevel'] = $row["toclevel"];
				$_SESSION['company'] = $row["company"];
				$_SESSION['broker'] = $row["isbroker"];
                $_SESSION['broker100'] = $row["broker100"];
				$_SESSION['regid'] = $row["idtoc_register"];
			}
		}
		$r->close();
	}
	$dbc->close();
	}
	return $success;
}

# ###################################################################

function login_partner_process($email, $password) {
	$dbc = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
	$success = false;
	//if ($dbc->connect_errno()) {
	 // 	printf("Connect failed: %s\n", $dbc->connect_error());
	 // 	exit();
	//}
	
	$qString = sprintf('select * from toc_partnerregister where email="%s" and password="%s"', $dbc->real_escape_string($email), $dbc->real_escape_string($password));
	
	if ($r = $dbc->query($qString)) 
	{
		$row_cnt = $r->num_rows;
		if ($row_cnt > 0) {
			$success = true;
		}
		$r->close();
	}
	$dbc->close();
	
	return $success;
}

# ###################################################################

function isAdminUser($email, $password) {
	$dbc = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
	$success = false;

	$qString = sprintf('select * from toc_admin where adminid="%s" and adminpwd="%s"', $dbc->real_escape_string($email), $dbc->real_escape_string($password));

	if ($r = $dbc->query($qString))
	{
		$row_cnt = $r->num_rows;
		if ($row_cnt > 0) {
			$success = true;
			$query = sprintf('UPDATE toc_admin SET lastlogin = CURRENT_TIMESTAMP where adminid="%s"', $dbc->real_escape_string($email));
  			$dbc->query($query);
		}
		$r->close();
	}
	$dbc->close();

	return $success;
}

# ###################################################################

function getDepartment($email) {
	$dbc = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
	$qString = sprintf('select department from toc_admin where adminid="%s"', $dbc->real_escape_string($email));
	$r = $dbc->query($qString);
	$department = '';

	if ($row = $r->fetch_assoc())
	{
		$department = $row["department"];
		$r->close();
	}
	$dbc->close();

	return $department;
}

# ###################################################################

function formatInvoiceDate($invDate) { //month-day-year
	$newformat = explode('-', $invDate);
	return $newformat;
}

# ###################################################################

function sendNotification($email) {

$to  = $email;
//$to .= ', '.'wez@example.com';
$subject = 'H-E-B TOC Notification';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// message
$message = '<h3>Thank you for registering. Your information has been submitted successfully.</h3>
<h3>Please log back into your account at the link below, using the password you created, to <u>PRINT YOUR INVOICE AND COMPLETE THE SPONSORSHIP FORM</u>.</h3>
<a href="http://www.hebtoc.com/login_proc.php">Click here to log in</a>

<h4><u>DO NOT MAIL YOUR CHECK TO THE SAN ANTONIO ADDRESS, IT MUST BE RECEIVED IN OUR AMEGY BANK HOUSTON LOCKBOX, WHICH IS INDICATED ON THE INVOICE.</u></h4>
<h4>DO NOT REPLY TO THE EMAIL ADDRESS ABOVE!<br>
IT IS USED TO SEND OUT MAIL, AND WILL NOT RECEIVE INBOUND MAIL.</h4>

<h4>Please email Kathy Ashwin at <a href="mailto:kashwin50@hotmail.com">kashwin50@hotmail.com</a> for any questions.</h4>
';

// To send HTML mail, the Content-type header must be set
$headers .= 'From: H-E-B TOC <info@hebtoc.com>' . "\r\n";
//$headers .= 'Cc: kashwin50@hotmail.com' . "\r\n";
//$headers .= 'Cc: kashwin50@hotmail.com' . "\r\n";
$headers .= 'Bcc: thewoodagencysanantonio@gmail.com;mis@thewoodagency.com' . "\r\n";
mail($to, $subject, $message, $headers);

}

# ###################################################################

function sendNotification_partner($email) {

$to  = $email;
//$to .= ', '.'wez@example.com';
$subject = 'H-E-B TOC Notification';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// message
$message = '<h3>Thank you for registering. Your information has been submitted successfully.</h3>

<h4>DO NOT REPLY TO THE EMAIL ADDRESS ABOVE!<br>
IT IS USED TO SEND OUT MAIL, AND WILL NOT RECEIVE INBOUND MAIL.</h4>

<h4>Please email Kathy Ashwin at <a href="mailto:kashwin50@hotmail.com">kashwin50@hotmail.com</a> for any questions.</h4>
';

// To send HTML mail, the Content-type header must be set
$headers .= 'From: H-E-B TOC <info@hebtoc.com>' . "\r\n";
//$headers .= 'Cc: kashwin50@hotmail.com' . "\r\n";
//$headers .= 'Cc: kashwin50@hotmail.com' . "\r\n";
$headers .= 'Bcc: jay@thewoodagency.com' . "\r\n";
mail($to, $subject, $message, $headers);

}

# ###################################################################

function sendeft($email) {

$to  = $email;
//$to .= ', '.'wez@example.com';
$subject = 'ELECTRONIC FUNDS TRANSFER REQUEST - TOC';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// message
$message = '<h3>Thank you for submitting the information.</h3>
<h3>Please open the following link to get our financial institution information.<br>
http://www.hebtoc.com/pdfs/ACH.pdf</h3>

<h4>DO NOT REPLY TO THE EMAIL ADDRESS ABOVE!<br>
IT IS USED TO SEND OUT MAIL, AND WILL NOT RECEIVE INBOUND MAIL.</h4>

<h4>Please email Kathy Ashwin at <a href="mailto:kashwin50@hotmail.com">kashwin50@hotmail.com</a> for any questions.</h4>
';

// To send HTML mail, the Content-type header must be set
$headers .= 'From: H-E-B TOC <info@hebtoc.com>' . "\r\n";
//$headers .= 'Cc: kashwin50@hotmail.com' . "\r\n";
//$headers .= 'Cc: kashwin50@hotmail.com' . "\r\n";
$headers .= 'Bcc: jay@thewoodagency.com' . "\r\n";
mail($to, $subject, $message, $headers);

}

# ###################################################################

function getRegistration($rid) {
	$dbc = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
	$qString = "select * from toc_register where idtoc_register =" . $rid;
	$r = $dbc->query($qString);
	$data = '<table id="reg">';
	while($row = $r->fetch_assoc())
	{
	  $donation = '';
	  if ($row['damount'] != 0) {
		$amount = money_format('%(#10.0n', $row['damount']);
	  	$donation = '<tr><td class="title">Amount</td><td>' . $amount . '</td></tr>';
	  }
	  $comtype = '';	
	  if ($row['comtype'])
		  $comtype = '<tr><td class="title">Type of Company</td><td>' . $row['comtype'] . '</td></tr>';
	  	
	  $data .= '<tr><td colspan=2><h3>'. TOCYEAR . ' ' . $row['toclevel'] . ' Sponsorship</h3>(printed on ' . date("m/d/Y") . ')</td></tr>';
	  $data .= $donation;
	  $data .= '<tr><td class="title">Company Name</td><td>' . $row['company'] . '</td></tr>';
	  $data .= $comtype;
	  $data .= '<tr><td class="title">Person to receive information</td><td>' . $row['fname'] . ' ' . $row['lname'] . '</td></tr>';
	  $data .= '<tr><td class="title">Address</td><td>' . $row['addr1'] . ' ' . $row['addr2'] . '</td></tr>';
	  $data .= '<tr><td class="title">City, State, Zip</td><td>' . $row['city'] . ', ' . $row['state'] . ' ' . $row['zip'] . '</td></tr>';
	  $data .= '<tr><td class="title">Email</td><td>' . $row['email'] . '</td></tr>';
	  $data .= '<tr><td class="title">Office #</td><td>(' . $row['oarea'] . ') ' . $row['ophone'] . '</td></tr>';
	  $data .= '<tr><td class="title">Cell #</td><td>(' . $row['carea'] . ') ' . $row['cphone'] . '</td></tr>';
	  $data .= '<tr><td class="title">H-E-B BDM with whom you work</td><td>' . $row['bdm'] . '</td></tr>';
	  $data .= '<tr><td class="title">Registered Date</td><td>' . $row['registerd_date'] . '</td></tr>';
	}
	$data .= '</table>';
	$r->close();
	$dbc->close();
	
	return $data;
}

# ###################################################################

function getHotelInfo($rid) {
	$dbc = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
	$qString = "select * from toc_hotel where hfirst <> '' and regID =" . $rid . " order by hid";
	$r = $dbc->query($qString);
	$rowcolor = 0;
	$data = '';
	$thead = '<tr class="putbg"><td>Name</td><td>'.FIRST.'</td><td>'.SECOND.'</td><td>'.THIRD.'</td><td>'.FOURTH.'</td></tr>';//<td>'.FIFTH.'</td><td>'.SIXTH.'</td></tr>';
	while($row = $r->fetch_assoc())
	{
	  if ($rowcolor%2==0)$tbrows .= '<tr class="even">';
		else $tbrows.='<tr>';
		$check1=$check2=$check3=$check4=$check5=$check6='';
		if ($row["night1"] == 1) $check1 = '<img src="images/check4.gif">';
		if ($row["night2"] == 1) $check2 = '<img src="images/check4.gif">'; 
		if ($row["night3"] == 1) $check3 = '<img src="images/check4.gif">'; 
		if ($row["night4"] == 1) $check4 = '<img src="images/check4.gif">';
		if ($row["night5"] == 1) $check5 = '<img src="images/check4.gif">'; 
		if ($row["night6"] == 1) $check6 = '<img src="images/check4.gif">'; 
		 
		$data .= '<td>' . $row["hlast"] . ', ' .$row["hfirst"] . '</td><td align="center">' .
					$check1 . '</td><td align="center">' .
					$check2 . '</td><td align="center">' .
					$check3 . '</td><td align="center">' .
					$check4 . '</td></tr>';//<td align="center">' .
					//$check5 . '</td><td align="center">' .
					//$check6 . '</td></tr>';
					$rowcolor++;
	}
	if ($rowcolor > 0)
		$data = '<h4>Hotel Information</h4><table border="1" cellpadding="3" cellspacing="0">' . $thead . $data . '</table>';
	$r->close();
	$dbc->close();
	
	return $data;
}

# ###################################################################

function getTennisInfo($rid) {
	$dbc = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
	$qString = "select * from toc_tennis where regID =" . $rid;
	$r = $dbc->query($qString);
	$rowcolor = 0;
	$data = '';
	$thead = '<tr class="putbg"><td>Name</td><td>Email</td><td>Rating</td></tr>';
	while($row = $r->fetch_assoc())
	{
	  if ($rowcolor%2==0)$tbrows .= '<tr class="even">';
		else $tbrows.='<tr>';

		$data .= '<td>' . $row["hlast"] . ', ' .$row["hfirst"] . '</td><td>' .
					$row["hemail"] . '</td><td align="center">' .
					$row["hrating"] . '</td></tr>';
					$rowcolor++;
	}
	if ($rowcolor > 0)
		$data = '<h4>Tennis Information - '.THIRD.'</h4><table border="1" cellpadding="3" cellspacing="0">' . $thead . $data . '</table>';
	$r->close();
	$dbc->close();
	
	return $data;
}

# ###################################################################

function getTourAcademy($rid) {
    $dbc = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    $qString = "select * from toc_events where toc_firstname <> '' and toc_regid =" . $rid . " and toc_tour=1 order by hid";
    $r = $dbc->query($qString);
    $rowcolor = 0;
    $data = '';
    $thead = '<tr class="putbg"><td>Name</td><td>Title</td></tr>';
    while($row = $r->fetch_assoc())
    {
        //broker
        $broker='';
        if (isset($row['toc_broker_company'])) {
            $broker = '<td>'.$row['toc_broker_company'].'</td>';
            $thead = '<tr class="putbg"><td>Company</td><td>Name</td><td>Title</td></tr>';
        }
        //
        if ($rowcolor%2==0)$tbrows .= '<tr class="even">';
        else $tbrows.='<tr>';

        $data .= $broker . '<td>' . $row["toc_lastname"] . ', ' .$row["toc_firstname"] . '</td><td>' .
            $row["toc_title"] . '</td></tr>';
        $rowcolor++;
    }
    if ($rowcolor > 0)
        $data = '<h4>Tour Academy - '.FIRST.'</h4><table border="1" cellpadding="3" cellspacing="0">' . $thead . $data . '</table>';
    $r->close();
    $dbc->close();

    return $data;
}

function getPrivateInfo($rid) {
	$dbc = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
	$qString = "select * from toc_private where hfirst <> '' and regID =" . $rid . " order by hid";
	$r = $dbc->query($qString);
	$rowcolor = 0;
	$data = '';
	$thead = '<tr class="putbg"><td>Name</td><td>Title</td></tr>';
	while($row = $r->fetch_assoc())
	{
	  if ($rowcolor%2==0)$tbrows .= '<tr class="even">';
		else $tbrows.='<tr>';

		$data .= '<td>' . $row["hlast"] . ', ' .$row["hfirst"] . '</td><td>' .
					$row["htitle"] . '</td></tr>';
					$rowcolor++;
	}
	if ($rowcolor > 0)
		$data = '<h4>Private Meeting - '.FIRST.'</h4><table border="1" cellpadding="3" cellspacing="0">' . $thead . $data . '</table>';
	$r->close();
	$dbc->close();
	
	return $data;
}

function getPrivateInfo2($rid) {
    $dbc = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    $qString = "select * from toc_events where toc_firstname <> '' and toc_regid =" . $rid . " and toc_pmeeting=1 order by hid";
    $r = $dbc->query($qString);
    $rowcolor = 0;
    $data = '';
    $thead = '<tr class="putbg"><td>Name</td><td>Title</td></tr>';
    while($row = $r->fetch_assoc())
    {
        //broker
        $broker='';
        if (isset($row['toc_broker_company'])) {
            $broker = '<td>'.$row['toc_broker_company'].'</td>';
            $thead = '<tr class="putbg"><td>Company</td><td>Name</td><td>Title</td></tr>';
        }
        //

        if ($rowcolor%2==0)$tbrows .= '<tr class="even">';
        else $tbrows.='<tr>';

        $data .= $broker. '<td>' . $row["toc_lastname"] . ', ' .$row["toc_firstname"] . '</td><td>' .
            $row["toc_title"] . '</td></tr>';
        $rowcolor++;
    }
    if ($rowcolor > 0)
        $data = '<h4>Private Meeting - '.SECOND.'</h4><table border="1" cellpadding="3" cellspacing="0">' . $thead . $data . '</table>';
    $r->close();
    $dbc->close();

    return $data;
}

# ###################################################################

function getPrivateDinner($rid) {
	$dbc = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
	$qString = "select * from toc_pdinner where hfirst <> '' and regID =" . $rid . " order by hid";
	$r = $dbc->query($qString);
	$rowcolor = 0;
	$data = '';
	$thead = '<tr class="putbg"><td>Name</td><td>Title</td></tr>';
	while($row = $r->fetch_assoc())
	{
	  if ($rowcolor%2==0)$tbrows .= '<tr class="even">';
		else $tbrows.='<tr>';

		$data .= '<td>' . $row["hlast"] . ', ' .$row["hfirst"] . '</td><td>' .
					$row["htitle"] . '</td></tr>';
					$rowcolor++;
	}
	if ($rowcolor > 0)
		$data = '<h4>Private Dinner with H-E-B Top Executives - '.FIRST.'</h4><table border="1" cellpadding="3" cellspacing="0">' . $thead . $data . '</table>';
	$r->close();
	$dbc->close();
	
	return $data;
}

function getPrivateDinner2($rid) {
    $dbc = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    $qString = "select * from toc_events where toc_firstname <> '' and toc_regid =" . $rid . " and toc_pdinner=1 order by hid";
    $r = $dbc->query($qString);
    $rowcolor = 0;
    $data = '';
    $thead = '<tr class="putbg"><td>Name</td><td>Title</td></tr>';
    while($row = $r->fetch_assoc())
    {
        //broker
        $broker='';
        if (isset($row['toc_broker_company'])) {
            $broker = '<td>'.$row['toc_broker_company'].'</td>';
            $thead = '<tr class="putbg"><td>Company</td><td>Name</td><td>Title</td></tr>';
        }
        //

        if ($rowcolor%2==0)$tbrows .= '<tr class="even">';
        else $tbrows.='<tr>';

        $data .= $broker . '<td>' . $row["toc_lastname"] . ', ' .$row["toc_firstname"] . '</td><td>' .
            $row["toc_title"] . '</td></tr>';
        $rowcolor++;
    }
    if ($rowcolor > 0)
        $data = '<h4>Private Dinner with H-E-B Top Executives - '.SECOND.'</h4><table border="1" cellpadding="3" cellspacing="0">' . $thead . $data . '</table>';
    $r->close();
    $dbc->close();

    return $data;
}

# ###################################################################

function getSummitInfo($rid) {
	$dbc = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
	$qString = "select * from toc_summit where hfirst <> '' and regID =" . $rid . " order by hid";
	$r = $dbc->query($qString);
	$rowcolor = 0;
	$data = '';
	$thead = '<tr class="putbg"><td>Name</td><td>Title</td></tr>';
	while($row = $r->fetch_assoc())
	{
	  if ($rowcolor%2==0)$tbrows .= '<tr class="even">';
		else $tbrows.='<tr>';

		$data .= '<td>' . $row["hlast"] . ', ' .$row["hfirst"] . '</td><td>' .
					$row["htitle"] . '</td></tr>';
					$rowcolor++;
	}
	if ($rowcolor > 0)
		$data = '<h4>Sponsor Summit - '.SECOND.'</h4><table border="1" cellpadding="3" cellspacing="0">' . $thead . $data . '</table>';
	$r->close();
	$dbc->close();
	
	return $data;
}

function getSummitInfo2($rid) {
    $dbc = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    $qString = "select * from toc_events where toc_firstname <> '' and toc_regid =" . $rid . " and toc_summit=1 order by hid";
    $r = $dbc->query($qString);
    $rowcolor = 0;
    $data = '';
    $thead = '<tr class="putbg"><td>Name</td><td>Title</td></tr>';
    while($row = $r->fetch_assoc())
    {
        //broker
        $broker='';
        if (isset($row['toc_broker_company'])) {
            $broker = '<td>'.$row['toc_broker_company'].'</td>';
            $thead = '<tr class="putbg"><td>Company</td><td>Name</td><td>Title</td></tr>';
        }
        //

        if ($rowcolor%2==0)$tbrows .= '<tr class="even">';
        else $tbrows.='<tr>';

        $data .= $broker . '<td>' . $row["toc_lastname"] . ', ' .$row["toc_firstname"] . '</td><td>' .
            $row["toc_title"] . '</td></tr>';
        $rowcolor++;
    }
    if ($rowcolor > 0)
        $data = '<h4>Sponsor Summit - '.THIRD.'</h4><table border="1" cellpadding="3" cellspacing="0">' . $thead . $data . '</table>';
    $r->close();
    $dbc->close();

    return $data;
}
# ###################################################################

function getDinnerBuffetInfo($rid) {
	$dbc = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    $qString = "select * from toc_welcome where hfirst <> '' and regID =" . $rid . " order by hid";
	$r = $dbc->query($qString);
	$rowcolor = 0;
	$data = '';
	$thead = '<tr class="putbg"><td>Name</td><td>Title</td></tr>';
	while($row = $r->fetch_assoc())
	{
	  if ($rowcolor%2==0)$tbrows .= '<tr class="even">';
		else $tbrows.='<tr>';

		$data .= '<td>' . $row["hlast"] . ', ' .$row["hfirst"] . '</td><td>' .
					$row["htitle"] . '</td></tr>';
					$rowcolor++;
	}
	if ($rowcolor > 0)
		$data = '<h4>Welcome Dinner Buffet & Social - '.SECOND.'</h4><table border="1" cellpadding="3" cellspacing="0">' . $thead . $data . '</table>';
	$r->close();
	$dbc->close();
	
	return $data;
}

function getDinnerBuffetInfo2($rid) {
    $dbc = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    $qString = "select * from toc_events where toc_firstname <> '' and toc_regid =" . $rid . " and toc_welcome=1 order by hid";
    $r = $dbc->query($qString);
    $rowcolor = 0;
    $data = '';
    $thead = '<tr class="putbg"><td>Name</td><td>Title</td></tr>';
    while($row = $r->fetch_assoc())
    {
        //broker
        $broker='';
        if (isset($row['toc_broker_company'])) {
            $broker = '<td>'.$row['toc_broker_company'].'</td>';
            $thead = '<tr class="putbg"><td>Company</td><td>Name</td><td>Title</td></tr>';
        }
        //

        if ($rowcolor%2==0)$tbrows .= '<tr class="even">';
        else $tbrows.='<tr>';

        $data .= $broker . '<td>' . $row["toc_lastname"] . ', ' .$row["toc_firstname"] . '</td><td>' .
            $row["toc_title"] . '</td></tr>';
        $rowcolor++;
    }
    if ($rowcolor > 0)
        $data = '<h4>Welcome Dinner Buffet & Social - '.THIRD.'</h4><table border="1" cellpadding="3" cellspacing="0">' . $thead . $data . '</table>';
    $r->close();
    $dbc->close();

    return $data;
}

# ###################################################################

function getCharityWorkInfo($rid) {
	$dbc = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
	$qString = "select * from toc_charity where hfirst <> '' and regID =" . $rid . " order by hid";
	$r = $dbc->query($qString);
	$rowcolor = 0;
	$data = '';
	$thead = '<tr class="putbg"><td>Name</td><td>Title</td><td>Shirt Size</td></tr>';
	while($row = $r->fetch_assoc())
	{
	  if ($rowcolor%2==0)$tbrows .= '<tr class="even">';
		else $tbrows.='<tr>';

		$data .= '<td>' . $row["hlast"] . ', ' .$row["hfirst"] . '</td><td>' .
					$row["htitle"] . '</td><td align="center">' .
					$row["hsize"] . '</td></tr>';
					$rowcolor++;
	}
	if ($rowcolor > 0)
		$data = '<h4>Charity Work Project - '.THIRD.'</h4><table border="1" cellpadding="3" cellspacing="0">' . $thead . $data . '</table>';
	$r->close();
	$dbc->close();
	
	return $data;
}

function getCharityWorkInfo2($rid) {
    $dbc = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    $qString = "select * from toc_events where toc_firstname <> '' and toc_regid =" . $rid . " and toc_charity=1 order by hid";
    $r = $dbc->query($qString);
    $rowcolor = 0;
    $data = '';
    $thead = '<tr class="putbg"><td>Name</td><td>Title</td><td>Shirt Size</td></tr>';
    while($row = $r->fetch_assoc())
    {
        //broker
        $broker='';
        if (isset($row['toc_broker_company'])) {
            $broker = '<td>'.$row['toc_broker_company'].'</td>';
            $thead = '<tr class="putbg"><td>Company</td><td>Name</td><td>Title</td><td>Shirt Size</td></tr>';
        }
        //

        if ($rowcolor%2==0)$tbrows .= '<tr class="even">';
        else $tbrows.='<tr>';
        $waiver = $row[toc_charity_waiver]?'Yes':'No';

        $data .= $broker . '<td>' . $row["toc_lastname"] . ', ' .$row["toc_firstname"] . '</td><td>' .
            $row["toc_title"] . '</td><td align="right">' .
            $row["toc_charity_tee"] . ' [Waiver signed: ' .$waiver. ']</td></tr>';
        $rowcolor++;
    }
    if ($rowcolor > 0)
        $data = '<h4>Charity Work Project - '.FOURTH.'</h4><table border="1" cellpadding="3" cellspacing="0">' . $thead . $data . '</table>';
    $r->close();
    $dbc->close();

    return $data;
}

# ###################################################################

function getReceptionInfo1($rid) {
	$dbc = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
	$qString = "SELECT hfirst, hlast, htitle FROM toc_hall inner join toc_register on regID=idtoc_register
inner join toc_level on toclevel = tlName where tlAmount > 100000 and regID=" . $rid . " and hfirst <> '' order by hid";
	$r = $dbc->query($qString);
	$rowcolor = 0;
	$data = '';
	$thead = '<tr class="putbg"><td>Name</td><td>Title</td></tr>';
	while($row = $r->fetch_assoc())
	{
	  if ($rowcolor%2==0) $tbrows .= '<tr class="even">';
		else $tbrows.='<tr>';

		$data .= '<td>' . $row["hlast"] . ', ' .$row["hfirst"] . '</td><td>' .
					$row["htitle"] . '</td></tr>';
					$rowcolor++;
	}
	if ($rowcolor > 0)
		$data = '<h4>Hall of Fame Reception & Dinner - '.THIRD.'</h4><table border="1" cellpadding="3" cellspacing="0">' . $thead . $data . '</table>';
	$r->close();
	$dbc->close();
	
	return $data;
}

function getReceptionInfo12($rid) {
    $dbc = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    $qString = "SELECT toc_firstname, toc_lastname, toc_title FROM toc_events inner join toc_register on toc_regid=idtoc_register
inner join toc_level on toclevel = tlName where tlAmount > 100000 and toc_regid=" . $rid . " and toc_firstname <> '' and toc_hall=1 order by hid";
    $r = $dbc->query($qString);
    $rowcolor = 0;
    $data = '';
    $thead = '<tr class="putbg"><td>Name</td><td>Title</td></tr>';
    while($row = $r->fetch_assoc())
    {
        //broker
        $broker='';
        if (isset($row['toc_broker_company'])) {
            $broker = '<td>'.$row['toc_broker_company'].'</td>';
            $thead = '<tr class="putbg"><td>Company</td><td>Name</td><td>Title</td></tr>';
        }
        //

        if ($rowcolor%2==0) $tbrows .= '<tr class="even">';
        else $tbrows.='<tr>';

        $data .= $broker . '<td>' . $row["toc_lastname"] . ', ' .$row["toc_firstname"] . '</td><td>' .
            $row["toc_title"] . '</td></tr>';
        $rowcolor++;
    }
    if ($rowcolor > 0)
        $data = '<h4>Hall of Fame Reception & Dinner - '.FOURTH.'</h4><table border="1" cellpadding="3" cellspacing="0">' . $thead . $data . '</table>';
    $r->close();
    $dbc->close();

    return $data;
}

# ###################################################################

function getReceptionInfo2($rid) {
	$dbc = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
	$qString = "SELECT hfirst, hlast, htitle FROM toc_hall inner join toc_register on regID=idtoc_register
inner join toc_level on toclevel = tlName where tlAmount <= 100000 and regID=" . $rid . " and hfirst <> '' order by hid";
	$r = $dbc->query($qString);
	$rowcolor = 0;
	$data = '';
	$thead = '<tr class="putbg"><td>Name</td><td>Title</td></tr>';
	while($row = $r->fetch_assoc())
	{
	  if ($rowcolor%2==0) $tbrows .= '<tr class="even">';
		else $tbrows.='<tr>';

		$data .= '<td>' . $row["hlast"] . ', ' .$row["hfirst"] . '</td><td>' .
					$row["htitle"] . '</td></tr>';
					$rowcolor++;
	}
	if ($rowcolor > 0)
		$data = '<h4>Sponsor Reception & Dinner - '.THIRD.'</h4><table border="1" cellpadding="3" cellspacing="0">' . $thead . $data . '</table>';
	$r->close();
	$dbc->close();
	
	return $data;
}

function getReceptionInfo22($rid) {
    $dbc = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    $qString = "SELECT toc_firstname, toc_lastname, toc_title FROM toc_events inner join toc_register on toc_regid=idtoc_register
inner join toc_level on toclevel = tlName where tlAmount <= 100000 and toc_regid=" . $rid . " and toc_firstname <> '' and toc_general=1 order by hid";
    $r = $dbc->query($qString);
    $rowcolor = 0;
    $data = '';
    $thead = '<tr class="putbg"><td>Name</td><td>Title</td></tr>';
    while($row = $r->fetch_assoc())
    {
        //broker
        $broker='';
        if (isset($row['toc_broker_company'])) {
            $broker = '<td>'.$row['toc_broker_company'].'</td>';
            $thead = '<tr class="putbg"><td>Company</td><td>Name</td><td>Title</td></tr>';
        }
        //

        if ($rowcolor%2==0) $tbrows .= '<tr class="even">';
        else $tbrows.='<tr>';

        $data .= $broker . '<td>' . $row["toc_lastname"] . ', ' .$row["toc_firstname"] . '</td><td>' .
            $row["toc_title"] . '</td></tr>';
        $rowcolor++;
    }
    if ($rowcolor > 0)
        $data = '<h4>Sponsor Reception & Dinner - '.FOURTH.'</h4><table border="1" cellpadding="3" cellspacing="0">' . $thead . $data . '</table>';
    $r->close();
    $dbc->close();

    return $data;
}

# ###################################################################

function getTableInfo($rid) {
	$dbc = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
	$qString = "select * from toc_table where regID =" . $rid . " order by htable";
	$r = $dbc->query($qString);
	$rowcolor = 0;
	$data = '';
	$thead = '<tr class="putbg"><td>Table</td><td>Choice 1</td><td>Choice 2</td></tr>';
	while($row = $r->fetch_assoc())
	{
	  if ($rowcolor%2==0) $tbrows .= '<tr class="even">';
		else $tbrows.='<tr>';

		$data .= '<td>' . $row["htable"] . '</td><td>' .
					$row["hchoice1"] . '</td><td>' .
					$row["hchoice2"] . '</td></tr>';
					$rowcolor++;
	}
	if ($rowcolor > 0)
		$data = '<h4>H-E-B Officer/Director/BDM Request for table</h4><table border="1" cellpadding="3" cellspacing="0">' . $thead . $data . '</table>';
	$r->close();
	$dbc->close();
	
	return $data;
}

# ###################################################################

function getGolfInfo($rid) {
	$dbc = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
	$qString = 'select * from toc_golf inner join toc_register on regID=idtoc_register where hfirst <> \'\' and regID =' . $rid . ' order by hseq';
	$r = $dbc->query($qString);
	$rowcolor = 0;
	$data = '';
	$golfdate = FOURTH;
	$thead = '<tr class="putbg"><td>Name</td><td>Title</td><td>H-E-B BDM</td><td>Flight</td></tr>';
	while($row = $r->fetch_assoc())
	{
	  if ($row["toclevel"] == 'Humanitarian' || $row["toclevel"] == 'Chairman' || $row["toclevel"] == 'Presidential') $golfdate = SECOND;
	  if ($rowcolor%2==0) $tbrows .= '<tr class="even">';
		else $tbrows.='<tr>';

		$data .= '<td>' . $row["hlast"] . ', ' .$row["hfirst"] . '</td><td>' .
					$row["htitle"] . '</td><td>' .
					$row["hbdm"] . '</td><td>' .
					$row["hflight"] . '</td></tr>';
					$rowcolor++;
	}
	if ($rowcolor > 0)
		$data = '<h4>TopGolf Tournament - '.$golfdate.'</h4><table border="1" cellpadding="3" cellspacing="0">' . $thead . $data . '</table>';
	$r->close();
	$dbc->close();
	
	return $data;
}

function getTopGolf($rid, $playDate) {
    $dbc = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    $qString = 'select * from toc_events inner join toc_register on toc_regid=idtoc_register 
where toc_firstname <> \'\' and toc_regid =' . $rid . ' and toc_topgolf=1 order by hid';
    $r = $dbc->query($qString);
    $rowcolor = 0;
    $data = '';
    $golfdate = $playDate;
    $thead = '<tr class="putbg"><td>Name</td><td>Title</td><td>H-E-B BDM</td><td>Loc</td></tr>';
    while($row = $r->fetch_assoc())
    {
        //broker
        $broker='';
        if (isset($row['toc_broker_company'])) {
            $broker = '<td>'.$row['toc_broker_company'].'</td>';
            $thead = '<tr class="putbg"><td>Company</td><td>Name</td><td>Title</td><td>H-E-B BDM</td><td>Loc</td></tr>';
        }

        if ($rowcolor%2==0) $tbrows .= '<tr class="even">';
        else $tbrows.='<tr>';

        $data .= $broker . '<td>' . $row["toc_lastname"] . ', ' .$row["toc_firstname"] . '</td><td>' .
            $row["toc_title"] . '</td><td>' .
            $row["toc_bdm"] . '</td><td>' .
            $row["toc_topgolfloc"] . '</td></tr>';
        $rowcolor++;
    }

    if ($row["toclevel"] == 'Humanitarian' || $row["toclevel"] == 'Chairman' || $row["toclevel"] == 'Presidential') {
        if ($golfdate == FIFTH) { $rowcolor = 0; $data = ''; }
    } else {
        if ($golfdate == THIRD) { $rowcolor = 0; $data = ''; }
    }
    if ($rowcolor > 0)
        $data = '<h4>TopGolf Tournament - '.$golfdate.'</h4><table border="1" cellpadding="3" cellspacing="0">' . $thead . $data . '</table>';
    $r->close();
    $dbc->close();

    return $data;
}

function getGolf($rid) {
    $dbc = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    $qString = 'select * from toc_events inner join toc_register on toc_regid=idtoc_register 
where toc_firstname <> \'\' and toc_regid =' . $rid . ' and toc_golf=1 order by hid';
    $r = $dbc->query($qString);
    $rowcolor = 0;
    $data = '';
    $golfdate = FIFTH;
    $thead = '<tr class="putbg"><td>Name</td><td>Title</td><td>H-E-B BDM</td><td>Loc</td></tr>';
    while($row = $r->fetch_assoc())
    {
        //broker
        $broker='';
        if (isset($row['toc_broker_company'])) {
            $broker = '<td>'.$row['toc_broker_company'].'</td>';
            $thead = '<tr class="putbg"><td>Company</td><td>Name</td><td>Title</td><td>H-E-B BDM</td><td>Loc</td></tr>';
        }
        //

        if ($row["toclevel"] == 'Humanitarian' || $row["toclevel"] == 'Chairman' || $row["toclevel"] == 'Presidential') $golfdate = THIRD;
        if ($rowcolor%2==0) $tbrows .= '<tr class="even">';
        else $tbrows.='<tr>';

        $data .= $broker . '<td>' . $row["toc_lastname"] . ', ' .$row["toc_firstname"] . '</td><td>' .
            $row["toc_title"] . '</td><td>' .
            $row["toc_bdm"] . '</td><td>' .
            $row["toc_topgolfloc"] . '</td></tr>';
        $rowcolor++;
    }
    if ($rowcolor > 0)
        $data = '<h4>Golf Tournament - '.$golfdate.'</h4><table border="1" cellpadding="3" cellspacing="0">' . $thead . $data . '</table>';
    $r->close();
    $dbc->close();

    return $data;
}

function getSpaInfo2($rid) {
    $dbc = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    $qString = 'select * from toc_events inner join toc_register on toc_regid=idtoc_register 
where toc_firstname <> \'\' and toc_regid =' . $rid . ' and toc_topgolf2=1 order by hid';
    $r = $dbc->query($qString);
    $rowcolor = 0;
    $data = '';
    $golfdate = '';
    $thead = '<tr class="putbg"><td>Name</td><td>Title</td></tr>';
    while($row = $r->fetch_assoc())
    {
        //broker
        $broker='';
        if (isset($row['toc_broker_company'])) {
            $broker = '<td>'.$row['toc_broker_company'].'</td>';
            $thead = '<tr class="putbg"><td>Company</td><td>Name</td><td>Title</td></tr>';
        }
        //

        if ($row["toclevel"] == 'Humanitarian' || $row["toclevel"] == 'Chairman' || $row["toclevel"] == 'Presidential') $golfdate = '';
        if ($rowcolor%2==0) $tbrows .= '<tr class="even">';
        else $tbrows.='<tr>';

        $data .= $broker . '<td>' . $row["toc_lastname"] . ', ' .$row["toc_firstname"] . '</td><td>' .
            $row["toc_title"] . '</td></tr>';
        $rowcolor++;
    }
    if ($rowcolor > 0)
        $data = '<h4>Spa in Lieu of Topgolf - '.$golfdate.'</h4><table border="1" cellpadding="3" cellspacing="0">' . $thead . $data . '</table>';
    $r->close();
    $dbc->close();

    return $data;
}

# ###################################################################

function sendPassword($email) {
	$dbc = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
	$qString = "select * from toc_register where email ='" . $email . "'";
	$r = $dbc->query($qString);
	while($row = $r->fetch_assoc())
	{
		$to  = $email;
		//$to .= ', '.'wez@example.com';
		$subject = 'H-E-B TOC Notification';
		
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		// message
		$message = '<h3>Email: ' . $email . '</h3><h3>Password: ' . $row["password"] . '</h3>
		
		<h4>DO NOT REPLY TO THE EMAIL ADDRESS ABOVE!<br>
		IT IS USED TO SEND OUT MAIL, AND WILL NOT RECEIVE INBOUND MAIL.</h4>
		
		<h4>Please email Kathy Ashwin at <a href="mailto:kashwin50@hotmail.com">kashwin50@hotmail.com</a> for any questions.</h4>
		';
		
		// To send HTML mail, the Content-type header must be set
		$headers .= 'From: H-E-B TOC <info@hebtoc.com>' . "\r\n";
		//$headers .= 'Cc: kashwin50@hotmail.com' . "\r\n";
		//$headers .= 'Cc: kashwin50@hotmail.com' . "\r\n";
		$headers .= 'Bcc: jay@thewoodagency.com' . "\r\n";
		mail($to, $subject, $message, $headers);
	  
	}
	$r->close();
	$dbc->close();
}

# ###################################################################

function getBenList() {
	//$dbc = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
	$dbc = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
	$qString = 'SELECT ben FROM toc_ben order by idtoc_ben';
	$r = $dbc->query($qString);
	$result = '';
	$li = 0;
	while ($row = $r->fetch_assoc())
	{
		if ($li == 0) $result .= '<li>';
	
		if ($li == 5) {
			$result .= substr($row["ben"], 0, 70) . '</li>';
			$li = 0;
		} else {
			$result .= substr($row["ben"], 0, 70) . '<br>';
			$li++;
		}
	}
	$r->close();
	$dbc->close();
	return str_replace('"', '', $result);
}

# ###################################################################

function getEmployees($companyName) {
    $dbc = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    $qString = sprintf('SELECT toc_charity.hfirst, toc_charity.hlast, hid FROM toc_register 
inner join toc_charity on idtoc_register = regID where company = "%s" and hfirst <> ""',
        $dbc->real_escape_string($companyName));

    $r = $dbc->query($qString);
    $employees = "<option>Select your name</option>";
    while($row = $r->fetch_assoc())
    {
        $employees .= "<option value='" . $row["hid"] . "'>" . trim($row["hfirst"]) . " " . trim($row["hlast"]) . "</option>";
    }
    $r->close();
    $dbc->close();

    return $employees;
}

# ###################################################################

function getEmployeesFromEvents($companyName) {
    $dbc = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    $qString = sprintf('SELECT toc_events.toc_firstname, toc_events.toc_lastname, toc_title, hid FROM toc_register
inner join toc_events on idtoc_register = toc_regid where toc_charity = 1 and company = "%s" and toc_firstname <> ""',
        $dbc->real_escape_string($companyName));

    $r = $dbc->query($qString);
    $employees = "<option>Select your name</option>";
    while($row = $r->fetch_assoc())
    {
        $employees .= "<option value='" . $row["hid"] . "'>" . trim($row["toc_firstname"]) . " " . trim($row["toc_lastname"]) . "</option>";
    }
    $r->close();
    $dbc->close();

    return $employees;
}

# ###################################################################

function getExtraRows($regID) {
    $dbc = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    $qString = sprintf('SELECT toc_add FROM toc_events where toc_regid = "%s" and toc_firstname <> ""',
        $dbc->real_escape_string($regID));
    $tocadd = 0;
    $r = $dbc->query($qString);
    if ($row = $r->fetch_assoc())
    {
        $tocadd = $row["toc_add"];
    }
    $r->close();
    $dbc->close();

    return $tocadd;
}

# ###################################################################

function getNumParticipants($tocid) {
    $dbc = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    $qString = sprintf('SELECT * FROM 976970_toc.toc_events where toc_regid = "%s"',
        $dbc->real_escape_string($tocid));

    $r = $dbc->query($qString) or die($dbc->error);
    $participant = $r->num_rows;
    $r->close();
    $dbc->close();

    return $participant;
}

# ###################################################################

function deleteAttendee($hid) {

    $dbc = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    $qString = sprintf('DELETE FROM 976970_toc.toc_events where hid = "%s"',
        $dbc->real_escape_string($hid));

    $dbc->query($qString);

    $dbc->close();
}
