<?php
//include 'includes/mysqlConnect.php';

$qString = "select * from toc_teetime order by tcourse, CAST(teams AS DECIMAL), tlast";
$Connect = mysqli_connect("mysql51-039.wc1.ord1.stabletransit.com", "976970_tocuser", "tWa198920", "976970_toc");

//$qResult = mysql_query ($qString);
$qResult = mysqli_query($Connect, $qString);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" >
<title>Tee Times - H-E-B Tournament of Champions</title>
<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript" language="javascript" src="media/js/jquery.dataTables.js"></script>
<style type="text/css" title="currentStyle">
			@import "media/css/demo_page.css";
			@import "media/css/demo_table.css";
</style>
<style type="text/css">
.text {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: normal;
	color: #000000;
}

.textheader {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: normal;
	color: #FFFFFF;
}
.style1 {

	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: normal;
	color: #000000;
}

table { border: #666 solid 1px;}

td{

	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: normal;
	color: #000000;
}
	input {
		width: 200px;
		height: 30px;
		font-size: 18px;
	}
	input[type=text]:focus {
  width: 300px;
}
</style>
</head>
<body>
<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable( {
					"bPaginate": false,
					"iDisplayLength": 200,
					"bSort": false
				});
			} );
</script>
<h3>Tee Times (Friday, June 7) - 2019 H-E-B Tournament of Champions</h3>
<table width="734" cellpadding="5px" cellspacing="0">
  <tr>
    <td colspan="2"><strong>Golf Course Legend</strong></td>
  </tr>
  <tr>
    <td width="200"><strong>CS</strong> - Canyon Springs</td>
    <td width="268"><strong>RC</strong> - River Crossing</td>
  </tr>
  <tr>
    <td width="200"><strong>TPCC</strong> - TPC    AT&amp;T Canyons</td>
    <td width="268"><strong>TPCO</strong></strong> - TPC AT&amp;T Oaks</td>
  </tr>
</table>
<br /><br />
<div id="demo">
  <table border="1" cellpadding="2" cellspacing="0" class="display" id="example" width="100%">
<thead>
  <tr height="40">
    <td width="33%" height="60" bgcolor="#6666cc" class="textheader"><div align="center"><strong>Player's Name</strong></div></td>
    <td width="33%" bgcolor="#6666cc" class="textheader"><div align="center"><strong>Course</strong></div></td>
    <!--td width="33%" bgcolor="#6666cc" class="textheader"><div align="center"><strong>Tee Time</strong></div></td>-->
    <td width="187" bgcolor="#6666cc" class="textheader"><div align="center"><strong>Team #</strong></div></td>   
    </tr>
</thead>
   <?php 
	  
	  //$nRows = mysql_num_rows($qResult);
	
  while ($row = mysqli_fetch_array($qResult)){
	//$row = mysql_fetch_array($qResult);
	$teetime = '6:30 A.M.';
  	if (strpos($row['teams'], 'L')!== false) { $teetime = '7:00 A.M.'; }
	if ($row['teams']!='' && $row['tlast']!='') { 
	  echo '<tr height="20">';
	  echo '<td class="text">'.str_replace("\"", "" , $row['tlast'].', '.$row['tfirst']).'</td>';
	  //echo '<td class="text">'.$row['tcourse'].'</td>';
	  echo '<td class="text">'.$row['tcourse'].'</td>';
	  echo '<td class="text">#'.$row['teams'].'</td>';
	  echo '</tr>';
	}
  }
  ?>
</table>
</div>
<script>
$( 'tr:odd' ).css( "background-color", "#D8D8D8" );
$('tr:has(td:contains("1:30"))').css("background-color", "#bbbbff");
$('input').focus(function(){
    // Select input field contents
    this.select();
});</script>
</body></html>
