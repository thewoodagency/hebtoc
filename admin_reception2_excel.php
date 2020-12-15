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
    $filename = 'TOC-SponsorReception' . $today;
    $qString = 'SELECT toclevel as Sponsorship, tlAmount as Amount, company as Company, hfirst as First_Name, hlast as Last_Name, htitle as Title
FROM toc_hall inner join toc_register on regID=idtoc_register inner join toc_level on toclevel = tlName where hlast <> \'\' and tlAmount <= 100000 order by tlAmount * 1 desc, company, hlast';

    $Connect = mysqli_connect("mysql51-039.wc1.ord1.stabletransit.com", "976970_tocuser", "tWa198920", "976970_toc");
    $result = mysqli_query($Connect, $qString);
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
    echo TOCYEAR. " H-E-B TOC Sponsor Reception (printed on " . date("m/d/Y") . ")" . "\t";

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
