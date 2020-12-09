<?php
ini_set('display_errors', 1);
error_reporting(~0);
//error_reporting(E_ALL);


//require ('./includes/config.inc.php');
require ('./includes/mysqli_connect.php');
require ('./includes/functions.php');

session_start();

if(isset($_SESSION['email']) && isset($_POST['formID']))
{
	$regEmail = $_SESSION['email'];
	$regID = $_SESSION['regid'];
	$toclevel = $_SESSION['toclevel'];
	$noofPeople = 50;
	
	$hid = '';
	
	for ($i=0; $i<$noofPeople; $i++)
	{
		//if (isset($_POST['first'.$i]) && $_POST['first'.$i]<>'')
		//
			$fname=$_POST['first'.$i];
			$lname=$_POST['last'.$i];
			$pemail=$_POST['pemail'.$i];
			$hid=$_POST['hid'.$i];
			$size=$_POST['size'.$i];
			$title=$_POST['title'.$i];
			$company=$_POST['company'.$i];
			$level=$_POST['level'.$i];
            $bdm=$_POST['bdm'.$i];
			$ctype=$_POST['ctype'.$i];

			$events = array(0=>0,0,0,0,0,0,0,0,0,0);
			//print_r($events);
			if (isset($_POST['events'.$i])) 
			{
				foreach ($_POST['events'.$i] as $event)
				{
					//print_r($_POST['events'.$i]);
					//echo $event . ' - ';
					$events[$event] = 1;
				}
			}
		
			$qString = sprintf('replace into toc_events (hid, toc_regid, toc_regEmail, 
toc_broker_company, 
toc_broker_level, toc_bdm, 
toc_broker_type, toc_firstname, toc_lastname, toc_email, toc_title, toc_tour, toc_pmeeting, toc_pdinner, toc_topgolf, toc_topgolf2, toc_summit, toc_welcome, toc_charity, toc_hall, toc_general, toc_charity_tee) 
                                values ("%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s")',
			$dbc->real_escape_string($hid),
			$dbc->real_escape_string($regID),
			$dbc->real_escape_string($regEmail),
			$dbc->real_escape_string($company),
            $dbc->real_escape_string($level),
            $dbc->real_escape_string($bdm),
			$dbc->real_escape_string($ctype),
			$dbc->real_escape_string($fname),
			$dbc->real_escape_string($lname),
			$dbc->real_escape_string($pemail),
			$dbc->real_escape_string($title),
			$dbc->real_escape_string($events[0]),
			$dbc->real_escape_string($events[1]),
			$dbc->real_escape_string($events[2]),
			$dbc->real_escape_string($events[3]),
			$dbc->real_escape_string($events[4]),
			$dbc->real_escape_string($events[5]),
			$dbc->real_escape_string($events[6]),
			$dbc->real_escape_string($events[7]),
			$dbc->real_escape_string($events[8]),
            $dbc->real_escape_string($events[9]),
			$dbc->real_escape_string($size));

        //echo $qString . '<br>';
		    if ($fname !== '' && $fname !== null) {
				$dbc->query($qString);
				//echo $qString . '<br>';
			}
			//echo $qString . '<br>';
		//}
	} //end for
	$dbc->close();
	//send_notice("hotel");
	header("Location: reg_newEvent_broker.php");
} else {
	header("Location: login_proc.php");
	die();
}