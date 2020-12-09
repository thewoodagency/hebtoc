<script type="text/javascript" src="stmenu.js"></script>
<?php
session_start();
if(isset($_SESSION['email']))
{
echo '<script type="text/javascript">';
echo 'stm_bm(["menu0b0f",980,"","blank.gif",0,"","",1,0,250,0,1000,1,0,0,"","100%",201326655,0,1,2,"default","hand","",1,25],this);
stm_bp("p0",[0,4,0,0,0,0,0,0,100,"",-2,"",-2,50,0,0,"#999999","#FFFFF7","",3,1,1,"#CCCCCC"]);
stm_ai("p0i0",[0,"Home","","",-1,-1,0,"/","_parent","","","","",0,0,0,"","",0,0,0,1,1,"#FFFFF7",0,"#B5BED6",1,"","bg01.gif",3,3,0,0,"#CCCCCC","#CCCCCC","#3C1400","#3C1400","bold 9pt Arial","bold 9pt Arial",0,0,"","","","",0,0,0],50,30);
stm_ai("p0i1",[6,1,"#CCCCCC","",-1,-1,0]);
stm_aix("p0i2","p0i0",[0,"Registration","","",-1,-1,0,"reg_partnerinfo.php"],90,30);
stm_ep();
stm_em();';
echo '</script>';
}
?>


