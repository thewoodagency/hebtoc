<?php
ini_set('display_errors', 1);
error_reporting(~0);
require ('../../lib/config.inc.php');
require ('../../lib/functions.php');

session_start();

if(isset($_SESSION['admin']) && $_SESSION['admin'] == 'kashwin50@hotmail.com')
{
	$email = $_SESSION['email'];
	$today = date("m.d.Y");
	$filename = 'TOC-Partner-Registration-' . $today;  
	$qString = "SELECT fname as 'First Name', lname as 'Last Name', title as 'Title', department as 'Department', email as 'Email', CONCAT('(', oarea, ') ', ophone) as 'Office', 
CONCAT('(', carea, ') ', cphone) as 'Cell', gfirstdate as 'Wednesday Golf', gseconddate as 'Friday Golf', wattend as 'Welcome Dinner', chattend as 'Charity Work', chsize as 'Charity T-Shirt', chcompany as 'Sponsoring Company', rattend as 'Sponsor Dinner' ,registerd_date as 'Registered' 
FROM toc_partnerregister where tocflag='p'";
	//$Connect = mysqli_connect("mariadb-006.wc1.lan3.stabletransit.com", "976970_tocu2", "tWa198920", "976970_toc2");
	$Connect = mysqli_connect("mysql51-039.wc1.ord1.stabletransit.com", "976970_tocuser", "tWa198920", "976970_toc");
	//select database   
	//$Db = mysqli_select_db('976970_toc', $Connect); //or die("Couldn't select database:<br>" . mysql_error(). "<br>" . mysql_errno());
	//execute query 
	$result = mysqli_query($Connect, $qString);// or die("Couldn't execute query:<br>" . mysql_error(). "<br>" . mysql_errno());
	$file_ending = "xls";
	//header info for browser
	header("Content-Type: application/xls");    
	header("Content-Disposition: attachment; filename=$filename.xls");  
	header("Pragma: no-cache"); 
	header("Expires: 0");
	/*******Start of Formatting for Excel*******/   
	//define separator (defines columns in excel & tabs in word)
	$sep = "\t"; //tabbed character
	//start of printing column names as names of MySQL fields
	echo TOCYEAR. " Partner Registration (printed on " . date("m/d/Y") . ")" . "\t";

	print("\n\n");
	for ($i = 0; $i < mysqli_num_fields($result); $i++) {
		//echo mysqli_fetch_fields($result,$i)->name . "\t";
        echo mysqli_fetch_field_direct($result, $i)->name . "\t";
	}

	//echo mysqli_num_fields($result);
	//echo $result->fetch_fields_direct(1)->name;

	print("\n");
	//end of printing column names  
	//start while loop to get data
	while($row = mysqli_fetch_array($result))
	{
		$schema_insert = "";
		for($j=0; $j<mysqli_num_fields($result);$j++)
		{
			if(!isset($row[$j]))
				$schema_insert .= "NULL".$sep;
			elseif ($row[$j] != "")
				$schema_insert .= $row[$j].$sep;
			else
				$schema_insert .= "".$sep;
		}
		$schema_insert = str_replace($sep."$", "", $schema_insert);
		$schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
		$schema_insert .= "\t";
		print(trim($schema_insert));
		print "\n";
	}
	
	//$record=NULL;
	//$Db=NULL;
    //$mysqli->close();
} else {
	include 'logout.php';
	header("Location: login_proc.php");
	die();
}
?>
