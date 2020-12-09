<?
define("TOCYEAR", "2017");
define("FIRST", "6/6");
define("SECOND", "6/7");
define("THIRD", "6/8");
define("FOURTH", "6/9");

# ###################################################################

function getTocLevel($sp) {
	$dbc = new mysqli("mysql51-039.wc1.ord1.stabletransit.com", "976970_tocuser", "tWa198920", "976970_toc");
	$qString = "select * from toc_level order by tlid";
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
	$dbc = new mysqli("mysql51-039.wc1.ord1.stabletransit.com", "976970_tocuser", "tWa198920", "976970_toc");
	$qString = "select * from toc_level where tlName='". $toclevel . "'";
	$r = $dbc->query($qString);
	$levleInfo = array();
	while($row = $r->fetch_assoc())
	{
		$levelInfo = array('hotel' => $row['tlHotel'], 
		'golf' => $row['tlGolf'],
		'tennis' => $row['tlTennis'],
		'private' => $row['tlPrivateMeeting'],
		'summit' => $row['tlSummit'],
		'welcome' => $row['tlWelcome'],
		'charity' => $row['tlCharity'],
		'hall' => $row['tlHall'],
		'table' => $row['tlTable'],
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
		'amount' => $row['tlAmount']);

	}
	$r->close();
	$dbc->close();
	
	return $levelInfo;
}

# ###################################################################

function hasAccount($email) {
	$dbc = new mysqli("mysql51-039.wc1.ord1.stabletransit.com", "976970_tocuser", "tWa198920", "976970_toc");
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

function login_process($email, $password) {
	$dbc = new mysqli("mysql51-039.wc1.ord1.stabletransit.com", "976970_tocuser", "tWa198920", "976970_toc");
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
	else {
	$qString = sprintf('select * from toc_register where email="%s" and password="%s"', $dbc->real_escape_string($email), $dbc->real_escape_string($password));
	
	if ($r = $dbc->query($qString)) 
	{
		$row_cnt = $r->num_rows;
		if ($row_cnt > 0) {
			$success = true;
		}
		$r->close();
	}
	$dbc->close();
	}
	return $success;
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
<h3>Please login to your account to print your invoice and complete the sponsorship forms.  <br>
http://www.hebtoc.com/login_proc.php</h3>

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
	$dbc = new mysqli("mysql51-039.wc1.ord1.stabletransit.com", "976970_tocuser", "tWa198920", "976970_toc");
	$qString = "select * from toc_register where idtoc_register =" . $rid;
	$r = $dbc->query($qString);
	$data = '<table>';
	while($row = $r->fetch_assoc())
	{
	  $data .= '<tr><td colspan=2><h3>'. TOCYEAR . ' ' . $row['toclevel'] . ' Sponsorship</h3></td></tr>';
	  $data .= '<tr><td class="title">Company Name</td><td>' . $row['company'] . '</td></tr>';
	  $data .= '<tr><td class="title">Person to receive information</td><td>' . $row['fname'] . ' ' . $row['lname'] . '</td></tr>';
	  $data .= '<tr><td class="title">Address</td><td>' . $row['addr1'] . ' ' . $row['addr2'] . '</td></tr>';
	  $data .= '<tr><td class="title">City, State, Zip</td><td>' . $row['city'] . ' ' . $row['state'] . ', ' . $row['zip'] . '</td></tr>';
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
	$dbc = new mysqli("mysql51-039.wc1.ord1.stabletransit.com", "976970_tocuser", "tWa198920", "976970_toc");
	$qString = "select * from toc_hotel where regID =" . $rid;
	$r = $dbc->query($qString);
	$rowcolor = 0;
	$data = '';
	$thead = '<tr><td>Name</td><td>'.FIRST.'</td><td>'.SECOND.'</td><td>'.THIRD.'</td><td>'.FOURTH.'</td><td>'.FIFTH.'</td><td>'.SIXTH.'</td></tr>';
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
					$check4 . '</td><td align="center">' .
					$check5 . '</td><td align="center">' .
					$check6 . '</td></tr>';
					$rowcolor++;
	}
	if ($rowcolor > 0)
		$data = '<p><strong>Hotel Information</strong></p><table border="1" cellpadding="2" cellspacing="0">' . $thead . $data . '</table>';
	$r->close();
	$dbc->close();
	
	return $data;
}

# ###################################################################

function sendPassword($email) {
	$dbc = new mysqli("mysql51-039.wc1.ord1.stabletransit.com", "976970_tocuser", "tWa198920", "976970_toc");
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

?>