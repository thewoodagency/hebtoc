<?php
include '../../lib/mysqlConnect.php';

$qString = "select * from toc_teetime order by teams, tlast";

$qResult = mysql_query ($qString);

$nRows = mysql_num_rows($qResult);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" >
<title>Tee Times - 2016 H-E-B Tournament of Champions</title>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript" language="javascript" src="media/js/jquery.dataTables2.js"></script>
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
<h3>Tee Times (Wednesday, June 7) - ARRIVE NO LATER THAN 6:30 A.M.</h3>

<table width="734" cellpadding="5px" cellspacing="0">
  <tr>
    <td colspan="2"><strong>Golf Course Legend</strong></td>
  </tr>
  <tr>
    <td width="50%"><strong>TPCC</strong> - TPC    AT&amp;T Canyons</td>
    <td width="50%"><strong>TPCO</strong> - TPC AT&amp;T Oaks</td>
  </tr>
</table>
<br /><br />
<div id="demo">
  <table border="1" cellpadding="2" cellspacing="0" class="display" id="example" width="100%">
<thead>
  <tr height="40">
    <td width="33%" height="60" bgcolor="#6666cc" class="textheader"><div align="center"><strong>Player's Name</strong></div></td>
    <!--<td width="33%" bgcolor="#6666cc" class="textheader"><div align="center"><strong>Course</strong></div></td>-->
    <td width="33%" bgcolor="#6666cc" class="textheader"><div align="center"><strong>Teams</strong></div></td>
    <td bgcolor="#6666cc" class="textheader"><div align="center"><strong>Tee Time</strong></div></td>
     <!--th width="187" bgcolor="#6666cc" class="textheader"><div align="center"><strong>Teams</strong></div></td>   
    </tr>-->
</thead>
   <?php
  for ($i=0; $i<$nRows; $i++){
	$row = mysql_fetch_array($qResult);
	if ($row['teams']!='' && $row['tlast']!='') { 
	  echo '<tr height="20">';
	  echo '<td class="text">'.str_replace("\"", "" , $row['tlast'].', '.$row['tfirst']).'</td>';
	  //echo '<td class="text">'.$row['tcourse'].'</td>';
	  echo '<td class="text">'.$row['teams'].'</td>';
	  echo '<td class="text">7:30 A.M.</td>';	
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
