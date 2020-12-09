<?php
require ('./includes/config.inc.php');
require ('./includes/functions.php');
session_start();

if(isset($_SESSION['admin']) && $_SESSION['admin'] == 'kashwin50@hotmail.com')
{
	$email = $_SESSION['email'];
	$today = date("m.d.Y");
	$filename = 'TOC-Partner-Registration-' . $today;  
	$qString = "SELECT fname as 'First_Name', lname as 'Last Name', title as 'Title', department as 'Department', email as 'Email', CONCAT('(', oarea, ') ', ophone) as 'Office', 
CONCAT('(', carea, ') ', cphone) as 'Cell', CONCAT(gfname,' ', glname, ' (Department: ', gdepartment, ', Shirt: ' ,gsize, ')') as 'Golf', gfirstdate as '6/3 Golf', gseconddate as '6/5 Golf', 
CONCAT(chfname,' ', chlname, ' (Department: ', chdepartment, ', Shirt: ' ,chsize, ')') as 'Chrity_Work', CONCAT(rfname, ' ', rlname, ' (', rdepartment, ')') as 'Reception' ,registerd_date as 'Registered' 
FROM toc_partnerregister";
	$Connect = mysql_connect("mysql51-039.wc1.ord1.stabletransit.com", "976970_tocuser", "tWa198920") or die("Couldn't connect to MySQL:<br>" . mysql_error() . "<br>" . mysql_errno());
	//select database   
	$Db = mysql_select_db('976970_toc', $Connect) or die("Couldn't select database:<br>" . mysql_error(). "<br>" . mysql_errno());   
	//execute query 
	$result = mysql_query($qString,$Connect) or die("Couldn't execute query:<br>" . mysql_error(). "<br>" . mysql_errno());    
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
	for ($i = 0; $i < mysql_num_fields($result); $i++) {
	echo mysql_field_name($result,$i) . "\t";
	}
	print("\n");    
	//end of printing column names  
	//start while loop to get data
	while($row = mysql_fetch_row($result))
	{
		$schema_insert = "";
		for($j=0; $j<mysql_num_fields($result);$j++)
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
	
	$record=NULL;
	$Db=NULL;   
} else {
	include 'logout.php';
	header("Location: login_proc.php");
	die();
}
?>
