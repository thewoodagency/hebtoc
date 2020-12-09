<?php

require ('includes/config.inc.php');
require ('includes/mysqli_connect.php');
require ('includes/functions.php');

$qString = "select idtoc_register, toclevel from toc_register where toclevel <> 'Donation Only' order by idtoc_register, toclevel";
$r = $dbc->query($qString);

while ($row = $r->fetch_assoc())
{
    $rid = $row['idtoc_register'];
    $info = "";
    if ($row["toclevel"] != 'Donation Only')
    {
    $info = getHotelInfo($rid);
    $info .= getTennisInfo($rid);
    $info .= getPrivateInfo($rid);
    $info .= getSummitInfo($rid);
    $info .= getDinnerBuffetInfo($rid);
    $info .= getCharityWorkInfo($rid);
    $info .= getReceptionInfo1($rid);
    $info .= getReceptionInfo2($rid);
    $info .= getTableInfo($rid);
    $info .= getGolfInfo($rid);
    }

    if ($info =="")
    {   echo getRegistration($rid);
        echo "<hr>";
    }
}

?>