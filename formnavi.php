<script type="text/javascript" src="stmenu.js"></script>
<?php
if (isset($_SESSION['email']) && $_SESSION['broker'] == 1 && $_SESSION['broker100'] == 0 && $_SESSION['regid'] > 8722) {
    $sp = trim($_SESSION['toclevel']);
    echo '<script type="text/javascript">';
    if ($sp == "Humanitarian" || $sp == "Chairman" || $sp == "Presidential" || $sp == "Centurion") {
        echo '
stm_bm(["menu0b0f",980,"","blank.gif",0,"","",0,0,250,0,1000,1,0,0,"","",201326655,0,1,2,"default","hand","",1,25],this);
stm_bp("p0",[0,4,0,0,0,0,0,0,100,"",-2,"",-2,50,0,0,"#999999","#FFFFF7","",3,1,1,"#CCCCCC"]);
stm_ai("p0i0",[0,"Logout","","",-1,-1,0,"logout.php","_parent","","","","",0,0,0,"","",0,0,0,1,1,"#FFFFF7",0,"#B5BED6",1,"","bg01.gif",3,3,0,0,"#CCCCCC","#CCCCCC","#3C1400","#3C1400","bold 9pt Arial","bold 9pt Arial",0,0,"","","","",0,0,0],50,30);
stm_ai("p0i1",[6,1,"#CCCCCC","",-1,-1,0]);
stm_aix("p0i2","p0i0",[0,"Home","","",-1,-1,0,"/"],50,30);
stm_aix("p0i3","p0i1",[]);
stm_aix("p0i4","p0i0",[0,"Registration","","",-1,-1,0,"reg_info.php"],90,30);
stm_aix("p0i5","p0i1",[]);
stm_aix("p0i6","p0i0",[0,"Events","","",-1,-1,0,"reg_newEvent_broker.php"],50,30);
stm_aix("p0i7","p0i1",[]);
stm_aix("p0i8","p0i0",[0,"Request for table","","",-1,-1,0,"reg_table.php","_self"],120,30);
stm_ep();
stm_em();
';
    } else {
        echo '
stm_bm(["menu0b0f",980,"","blank.gif",0,"","",0,0,250,0,1000,1,0,0,"","",201326655,0,1,2,"default","hand","",1,25],this);
stm_bp("p0",[0,4,0,0,0,0,0,0,100,"",-2,"",-2,50,0,0,"#999999","#FFFFF7","",3,1,1,"#CCCCCC"]);
stm_ai("p0i0",[0,"Logout","","",-1,-1,0,"logout.php","_parent","","","","",0,0,0,"","",0,0,0,1,1,"#FFFFF7",0,"#B5BED6",1,"","bg01.gif",3,3,0,0,"#CCCCCC","#CCCCCC","#3C1400","#3C1400","bold 9pt Arial","bold 9pt Arial",0,0,"","","","",0,0,0],50,30);
stm_ai("p0i1",[6,1,"#CCCCCC","",-1,-1,0]);
stm_aix("p0i2","p0i0",[0,"Home","","",-1,-1,0,"/"],50,30);
stm_aix("p0i3","p0i1",[]);
stm_aix("p0i4","p0i0",[0,"Registration","","",-1,-1,0,"reg_info.php"],90,30);
stm_aix("p0i5","p0i1",[]);
stm_aix("p0i6","p0i0",[0,"Events","","",-1,-1,0,"reg_newEvent_broker.php"],50,30);
stm_ep();
stm_em();
';
    }
    echo '</script>';
    return;
}

if (isset($_SESSION['email']) && $_SESSION['broker'] == 1 && $_SESSION['broker100'] == 1 && $_SESSION['regid'] > 8722) {
    $sp = trim($_SESSION['toclevel']);
    echo '<script type="text/javascript">';
    echo '
stm_bm(["menu0b0f",980,"","blank.gif",0,"","",0,0,250,0,1000,1,0,0,"","",201326655,0,1,2,"default","hand","",1,25],this);
stm_bp("p0",[0,4,0,0,0,0,0,0,100,"",-2,"",-2,50,0,0,"#999999","#FFFFF7","",3,1,1,"#CCCCCC"]);
stm_ai("p0i0",[0,"Logout","","",-1,-1,0,"logout.php","_parent","","","","",0,0,0,"","",0,0,0,1,1,"#FFFFF7",0,"#B5BED6",1,"","bg01.gif",3,3,0,0,"#CCCCCC","#CCCCCC","#3C1400","#3C1400","bold 9pt Arial","bold 9pt Arial",0,0,"","","","",0,0,0],50,30);
stm_ai("p0i1",[6,1,"#CCCCCC","",-1,-1,0]);
stm_aix("p0i2","p0i0",[0,"Home","","",-1,-1,0,"/"],50,30);
stm_aix("p0i3","p0i1",[]);
stm_aix("p0i4","p0i0",[0,"Registration","","",-1,-1,0,"reg_info.php"],90,30);
stm_aix("p0i5","p0i1",[]);
stm_aix("p0i6","p0i0",[0,"Events","","",-1,-1,0,"reg_newEvent_broker_100.php"],50,30);
stm_ep();
stm_em();
';
    echo '</script>';
    return;
}

if (isset($_SESSION['email']) && $_SESSION['broker'] == 0 && $_SESSION['regid'] > 8722) {
    $sp = trim($_SESSION['toclevel']);
    echo '<script type="text/javascript">';
    if ($sp == "Humanitarian" || $sp == "Chairman" || $sp == "Presidential" || $sp == "Centurion") {
        echo '
stm_bm(["menu0b0f",980,"","blank.gif",0,"","",0,0,250,0,1000,1,0,0,"","",201326655,0,1,2,"default","hand","",1,25],this);
stm_bp("p0",[0,4,0,0,0,0,0,0,100,"",-2,"",-2,50,0,0,"#999999","#FFFFF7","",3,1,1,"#CCCCCC"]);
stm_ai("p0i0",[0,"Logout","","",-1,-1,0,"logout.php","_parent","","","","",0,0,0,"","",0,0,0,1,1,"#FFFFF7",0,"#B5BED6",1,"","bg01.gif",3,3,0,0,"#CCCCCC","#CCCCCC","#3C1400","#3C1400","bold 9pt Arial","bold 9pt Arial",0,0,"","","","",0,0,0],50,30);
stm_ai("p0i1",[6,1,"#CCCCCC","",-1,-1,0]);
stm_aix("p0i2","p0i0",[0,"Home","","",-1,-1,0,"/"],50,30);
stm_aix("p0i3","p0i1",[]);
stm_aix("p0i4","p0i0",[0,"Registration","","",-1,-1,0,"reg_info.php"],90,30);
stm_aix("p0i5","p0i1",[]);
stm_aix("p0i6","p0i0",[0,"Events","","",-1,-1,0,"reg_newEvent.php"],50,30);
stm_aix("p0i7","p0i1",[]);
stm_aix("p0i8","p0i0",[0,"Request for table","","",-1,-1,0,"reg_table.php","_self"],120,30);
stm_ep();
stm_em();
';
    } else {
        echo '
stm_bm(["menu0b0f",980,"","blank.gif",0,"","",0,0,250,0,1000,1,0,0,"","",201326655,0,1,2,"default","hand","",1,25],this);
stm_bp("p0",[0,4,0,0,0,0,0,0,100,"",-2,"",-2,50,0,0,"#999999","#FFFFF7","",3,1,1,"#CCCCCC"]);
stm_ai("p0i0",[0,"Logout","","",-1,-1,0,"logout.php","_parent","","","","",0,0,0,"","",0,0,0,1,1,"#FFFFF7",0,"#B5BED6",1,"","bg01.gif",3,3,0,0,"#CCCCCC","#CCCCCC","#3C1400","#3C1400","bold 9pt Arial","bold 9pt Arial",0,0,"","","","",0,0,0],50,30);
stm_ai("p0i1",[6,1,"#CCCCCC","",-1,-1,0]);
stm_aix("p0i2","p0i0",[0,"Home","","",-1,-1,0,"/"],50,30);
stm_aix("p0i3","p0i1",[]);
stm_aix("p0i4","p0i0",[0,"Registration","","",-1,-1,0,"reg_info.php"],90,30);
stm_aix("p0i5","p0i1",[]);
stm_aix("p0i6","p0i0",[0,"Events","","",-1,-1,0,"reg_newEvent.php"],50,30);
stm_ep();
stm_em();
';
    }
    echo '</script>';
    return;
}

if (isset($_SESSION['email'])) {
    $sp = trim($_SESSION['toclevel']);
    echo '<script type="text/javascript">';
    if ($sp == "Humanitarian") {//tocforms_1
        echo 'stm_bm(["menu0b0f",980,"","blank.gif",0,"","",1,0,250,0,1000,1,0,0,"","100%",201326655,0,1,2,"default","hand","",1,25],this);
stm_bp("p0",[0,4,0,0,0,0,0,0,100,"",-2,"",-2,50,0,0,"#999999","#FFFFF7","",3,1,1,"#CCCCCC"]);
stm_ai("p0i0",[0,"Logout","","",-1,-1,0,"logout.php","_parent","","","","",0,0,0,"","",0,0,0,1,1,"#FFFFF7",0,"#B5BED6",1,"","bg01.gif",3,3,0,0,"#CCCCCC","#CCCCCC","#3C1400","#3C1400","bold 9pt Arial","bold 9pt Arial",0,0,"","","","",0,0,0],50,30);
stm_ai("p0i1",[6,1,"#CCCCCC","",-1,-1,0]);
stm_aix("p0i2","p0i0",[0,"Home","","",-1,-1,0,"/"],50,30);
stm_aix("p0i3","p0i1",[]);
stm_aix("p0i4","p0i0",[0,"Registration","","",-1,-1,0,"reg_info.php"],90,30);
stm_aix("p0i5","p0i1",[]);
stm_aix("p0i6","p0i0",[0,"Hotel","","",-1,-1,0,"reg_hotel.php"],50,30);
stm_aix("p0i7","p0i1",[]);
stm_aix("p0i8","p0i0",[0,"Private Meeting","","",-1,-1,0,"reg_private.php"],100,30);
stm_aix("p0i9","p0i1",[]);
stm_aix("p0i10","p0i0",[0,"Private Dinner","","",-1,-1,0,"reg_pdinner.php"],90,30);
stm_aix("p0i11","p0i1",[]);
stm_aix("p0i12","p0i0",[0,"Golf","","",-1,-1,0,"reg_golf.php","_parent","","","","",0,0,0,"","",0,0,0,1,1,"#FFFFF7",0,"#B5BED6",1,"","bg01.gif",3,3,0,0,"#FFFFF7","#000000"],40,30);
stm_aix("p0i13","p0i1",[]);
stm_aix("p0i14","p0i12",[0,"Sponsor Summit","","",-1,-1,0,"reg_sponsor.php"],110,30);
stm_aix("p0i15","p0i1",[]);
stm_aix("p0i16","p0i12",[0,"Welcome Dinner & Social","","",-1,-1,0,"reg_social.php"],155,30);
stm_aix("p0i17","p0i1",[]);
stm_aix("p0i18","p0i12",[0,"Charity Work Project","","",-1,-1,0,"reg_charity.php"],130,30);
stm_aix("p0i19","p0i1",[]);
stm_aix("p0i20","p0i12",[0,"Reception & Sponsor Dinner","","",-1,-1,0,"reg_halloffame.php"],175,30);
stm_aix("p0i21","p0i1",[]);
stm_aix("p0i22","p0i12",[0,"Request for table","","",-1,-1,0,"reg_table.php"],110,30);
stm_ep();
stm_em();
';
    } else if ($sp == "Chairman" || $sp == "Presidential") {//tocforms_2
        echo 'stm_bm(["menu0b0f",980,"","blank.gif",0,"","",1,0,250,0,1000,1,0,0,"","100%",201326655,0,1,2,"default","hand","",1,25],this);
stm_bp("p0",[0,4,0,0,0,0,0,0,100,"",-2,"",-2,50,0,0,"#999999","#FFFFF7","",3,1,1,"#CCCCCC"]);
stm_ai("p0i0",[0,"Logout","","",-1,-1,0,"logout.php","_parent","","","","",0,0,0,"","",0,0,0,1,1,"#FFFFF7",0,"#B5BED6",1,"","bg01.gif",3,3,0,0,"#CCCCCC","#CCCCCC","#3C1400","#3C1400","bold 9pt Arial","bold 9pt Arial",0,0,"","","","",0,0,0],50,30);
stm_ai("p0i1",[6,1,"#CCCCCC","",-1,-1,0]);
stm_aix("p0i2","p0i0",[0,"Home","","",-1,-1,0,"/"],50,30);
stm_aix("p0i3","p0i1",[]);
stm_aix("p0i4","p0i0",[0,"Registration","","",-1,-1,0,"reg_info.php"],90,30);
stm_aix("p0i5","p0i1",[]);
stm_aix("p0i6","p0i0",[0,"Hotel","","",-1,-1,0,"reg_hotel.php"],50,30);
stm_aix("p0i7","p0i1",[]);
stm_aix("p0i8","p0i0",[0,"Golf","","",-1,-1,0,"reg_golf.php","_parent","","","","",0,0,0,"","",0,0,0,1,1,"#FFFFF7",0,"#B5BED6",1,"","bg01.gif",3,3,0,0,"#FFFFF7","#000000"],40,30);
stm_aix("p0i9","p0i1",[]);
stm_aix("p0i10","p0i8",[0,"Sponsor Summit","","",-1,-1,0,"reg_sponsor.php"],110,30);
stm_aix("p0i11","p0i1",[]);
stm_aix("p0i12","p0i8",[0,"Welcome Dinner & Social","","",-1,-1,0,"reg_social.php"],155,30);
stm_aix("p0i13","p0i1",[]);
stm_aix("p0i14","p0i8",[0,"Charity Work Project","","",-1,-1,0,"reg_charity.php"],130,30);
stm_aix("p0i15","p0i1",[]);
stm_aix("p0i16","p0i8",[0,"Reception & Sponsor Dinner","","",-1,-1,0,"reg_halloffame.php"],175,30);
stm_aix("p0i17","p0i1",[]);
stm_aix("p0i18","p0i8",[0,"Request for table","","",-1,-1,0,"reg_table.php"],110,30);
stm_ep();
stm_em();
';
    } else if ($sp == "Centurion") {//tocforms_2_2
        echo 'stm_bm(["menu0b0f",980,"","blank.gif",0,"","",1,0,250,0,1000,1,0,0,"","100%",201326655,0,1,2,"default","hand","",1,25],this);
stm_bp("p0",[0,4,0,0,0,0,0,0,100,"",-2,"",-2,50,0,0,"#999999","#FFFFF7","",3,1,1,"#CCCCCC"]);
stm_ai("p0i0",[0,"Logout","","",-1,-1,0,"logout.php","_parent","","","","",0,0,0,"","",0,0,0,1,1,"#FFFFF7",0,"#B5BED6",1,"","bg01.gif",3,3,0,0,"#CCCCCC","#CCCCCC","#3C1400","#3C1400","bold 9pt Arial","bold 9pt Arial",0,0,"","","","",0,0,0],50,30);
stm_ai("p0i1",[6,1,"#CCCCCC","",-1,-1,0]);
stm_aix("p0i2","p0i0",[0,"Home","","",-1,-1,0,"/"],50,30);
stm_aix("p0i3","p0i1",[]);
stm_aix("p0i4","p0i0",[0,"Registration","","",-1,-1,0,"reg_info.php"],90,30);
stm_aix("p0i5","p0i1",[]);
stm_aix("p0i6","p0i0",[0,"Hotel","","",-1,-1,0,"reg_hotel.php"],50,30);
stm_aix("p0i7","p0i1",[]);
stm_aix("p0i8","p0i0",[0,"Sponsor Summit","","",-1,-1,0,"reg_sponsor.php","_parent","","","","",0,0,0,"","",0,0,0,1,1,"#FFFFF7",0,"#B5BED6",1,"","bg01.gif",3,3,0,0,"#FFFFF7","#000000"],110,30);
stm_aix("p0i9","p0i1",[]);
stm_aix("p0i10","p0i8",[0,"Welcome Dinner & Social","","",-1,-1,0,"reg_social.php"],155,30);
stm_aix("p0i11","p0i1",[]);
stm_aix("p0i12","p0i8",[0,"Charity Work Project","","",-1,-1,0,"reg_charity.php"],130,30);
stm_aix("p0i13","p0i1",[]);
stm_aix("p0i14","p0i8",[0,"Reception & Sponsor Dinner","","",-1,-1,0,"reg_halloffame.php"],175,30);
stm_aix("p0i15","p0i1",[]);
stm_aix("p0i16","p0i8",[0,"Request for table","","",-1,-1,0,"reg_table.php"],110,30);
stm_aix("p0i17","p0i1",[]);
stm_aix("p0i18","p0i8",[0,"Golf","","",-1,-1,0,"reg_golf.php"],40,30);
stm_ep();
stm_em();
';
    } else if ($sp == "Diamond" || $sp == "Most Valuable Player") {//tocforms_3
        echo 'stm_bm(["menu0b0f",980,"","blank.gif",0,"","",1,0,250,0,1000,1,0,0,"","100%",201326655,0,1,2,"default","hand","",1,25],this);
stm_bp("p0",[0,4,0,0,0,0,0,0,100,"",-2,"",-2,50,0,0,"#999999","#FFFFF7","",3,1,1,"#CCCCCC"]);
stm_ai("p0i0",[0,"Logout","","",-1,-1,0,"logout.php","_parent","","","","",0,0,0,"","",0,0,0,1,1,"#FFFFF7",0,"#B5BED6",1,"","bg01.gif",3,3,0,0,"#CCCCCC","#CCCCCC","#3C1400","#3C1400","bold 9pt Arial","bold 9pt Arial",0,0,"","","","",0,0,0],50,30);
stm_ai("p0i1",[6,1,"#CCCCCC","",-1,-1,0]);
stm_aix("p0i2","p0i0",[0,"Home","","",-1,-1,0,"/"],50,30);
stm_aix("p0i3","p0i1",[]);
stm_aix("p0i4","p0i0",[0,"Registration","","",-1,-1,0,"reg_info.php"],90,30);
stm_aix("p0i5","p0i1",[]);
stm_aix("p0i6","p0i0",[0,"Hotel","","",-1,-1,0,"reg_hotel.php"],50,30);
stm_aix("p0i7","p0i1",[]);
stm_aix("p0i8","p0i0",[0,"Sponsor Summit","","",-1,-1,0,"reg_sponsor.php","_parent","","","","",0,0,0,"","",0,0,0,1,1,"#FFFFF7",0,"#B5BED6",1,"","bg01.gif",3,3,0,0,"#FFFFF7","#000000"],110,30);
stm_aix("p0i9","p0i1",[]);
stm_aix("p0i10","p0i8",[0,"Welcome Dinner & Social","","",-1,-1,0,"reg_social.php"],155,30);
stm_aix("p0i11","p0i1",[]);
stm_aix("p0i12","p0i8",[0,"Charity Work Project","","",-1,-1,0,"reg_charity.php"],130,30);
stm_aix("p0i13","p0i1",[]);
stm_aix("p0i14","p0i8",[0,"Reception & Sponsor Dinner","","",-1,-1,0,"reg_halloffame.php"],175,30);
stm_aix("p0i15","p0i1",[]);
stm_aix("p0i16","p0i8",[0,"Golf","","",-1,-1,0,"reg_golf.php"],40,30);
stm_ep();
stm_em();
';
    } else if ($sp == "Torchbearer") {//tocforms_4
        echo 'stm_bm(["menu0b0f",980,"","blank.gif",0,"","",1,0,250,0,1000,1,0,0,"","100%",201326655,0,1,2,"default","hand","",1,25],this);
stm_bp("p0",[0,4,0,0,0,0,0,0,100,"",-2,"",-2,50,0,0,"#999999","#FFFFF7","",3,1,1,"#CCCCCC"]);
stm_ai("p0i0",[0,"Logout","","",-1,-1,0,"logout.php","_parent","","","","",0,0,0,"","",0,0,0,1,1,"#FFFFF7",0,"#B5BED6",1,"","bg01.gif",3,3,0,0,"#CCCCCC","#CCCCCC","#3C1400","#3C1400","bold 9pt Arial","bold 9pt Arial",0,0,"","","","",0,0,0],50,30);
stm_ai("p0i1",[6,1,"#CCCCCC","",-1,-1,0]);
stm_aix("p0i2","p0i0",[0,"Home","","",-1,-1,0,"/"],50,30);
stm_aix("p0i3","p0i1",[]);
stm_aix("p0i4","p0i0",[0,"Registration","","",-1,-1,0,"reg_info.php"],90,30);
stm_aix("p0i5","p0i1",[]);
stm_aix("p0i6","p0i0",[0,"Hotel","","",-1,-1,0,"reg_hotel.php"],50,30);
stm_aix("p0i7","p0i1",[]);
stm_aix("p0i8","p0i0",[0,"Sponsor Summit","","",-1,-1,0,"reg_sponsor.php","_parent","","","","",0,0,0,"","",0,0,0,1,1,"#FFFFF7",0,"#B5BED6",1,"","bg01.gif",3,3,0,0,"#FFFFF7","#000000"],110,30);
stm_aix("p0i9","p0i1",[]);
stm_aix("p0i10","p0i8",[0,"Welcome Dinner & Social","","",-1,-1,0,"reg_social.php"],155,30);
stm_aix("p0i11","p0i1",[]);
stm_aix("p0i12","p0i8",[0,"Charity Work Project","","",-1,-1,0,"reg_charity.php"],130,30);
stm_aix("p0i13","p0i1",[]);
stm_aix("p0i14","p0i8",[0,"Reception & Sponsor Dinner","","",-1,-1,0,"reg_halloffame.php"],175,30);
stm_aix("p0i15","p0i1",[]);
stm_aix("p0i16","p0i8",[0,"Golf","","",-1,-1,0,"reg_golf.php"],40,30);
stm_ep();
stm_em();';
    } else if ($sp == "Platinum" || $sp == "Gold" || $sp == "Silver" || $sp == "Bronze") {//tocforms_5
        echo 'stm_bm(["menu0b0f",980,"","blank.gif",0,"","",1,0,250,0,1000,1,0,0,"","100%",201326655,0,1,2,"default","hand","",1,25],this);
stm_bp("p0",[0,4,0,0,0,0,0,0,100,"",-2,"",-2,50,0,0,"#999999","#FFFFF7","",3,1,1,"#CCCCCC"]);
stm_ai("p0i0",[0,"Logout","","",-1,-1,0,"logout.php","_parent","","","","",0,0,0,"","",0,0,0,1,1,"#FFFFF7",0,"#B5BED6",1,"","bg01.gif",3,3,0,0,"#CCCCCC","#CCCCCC","#3C1400","#3C1400","bold 9pt Arial","bold 9pt Arial",0,0,"","","","",0,0,0],50,30);
stm_ai("p0i1",[6,1,"#CCCCCC","",-1,-1,0]);
stm_aix("p0i2","p0i0",[0,"Home","","",-1,-1,0,"/"],50,30);
stm_aix("p0i3","p0i1",[]);
stm_aix("p0i4","p0i0",[0,"Registration","","",-1,-1,0,"reg_info.php"],90,30);
stm_aix("p0i5","p0i1",[]);
stm_aix("p0i6","p0i0",[0,"Hotel","","",-1,-1,0,"reg_hotel.php"],50,30);
stm_aix("p0i7","p0i1",[]);
stm_aix("p0i8","p0i0",[0,"Welcome Dinner & Social","","",-1,-1,0,"reg_social.php","_parent","","","","",0,0,0,"","",0,0,0,1,1,"#FFFFF7",0,"#B5BED6",1,"","bg01.gif",3,3,0,0,"#FFFFF7","#000000"],155,30);
stm_aix("p0i9","p0i1",[]);
stm_aix("p0i10","p0i8",[0,"Charity Work Project","","",-1,-1,0,"reg_charity.php"],130,30);
stm_aix("p0i11","p0i1",[]);
stm_aix("p0i12","p0i8",[0,"Reception & Sponsor Dinner","","",-1,-1,0,"reg_halloffame.php"],175,30);
stm_aix("p0i13","p0i1",[]);
stm_aix("p0i14","p0i8",[0,"Golf","","",-1,-1,0,"reg_golf.php"],40,30);
stm_ep();
stm_em();';
    } else if ($sp == "partner") {//tocforms_5 - partner
        echo 'stm_bm(["menu0b0f",980,"","blank.gif",0,"","",1,0,250,0,1000,1,0,0,"","100%",201326655,0,1,2,"default","hand","",1,25],this);
stm_bp("p0",[0,4,0,0,0,0,0,0,100,"",-2,"",-2,50,0,0,"#999999","#FFFFF7","",3,1,1,"#CCCCCC"]);
stm_ai("p0i0",[0,"Home","","",-1,-1,0,"/","_parent","","","","",0,0,0,"","",0,0,0,1,1,"#FFFFF7",0,"#B5BED6",1,"","bg01.gif",3,3,0,0,"#CCCCCC","#CCCCCC","#3C1400","#3C1400","bold 9pt Arial","bold 9pt Arial",0,0,"","","","",0,0,0],50,30);
stm_ai("p0i1",[6,1,"#CCCCCC","",-1,-1,0]);
stm_aix("p0i2","p0i0",[0,"Registration","","",-1,-1,0,"reg_partnerinfo.php"],90,30);
stm_ep();
stm_em();';
    } else {
        //tocforms_6
        echo 'stm_bm(["menu0b0f",980,"","blank.gif",0,"","",1,0,250,0,1000,1,0,0,"","100%",201326655,0,1,2,"default","hand","",1,25],this);
stm_bp("p0",[0,4,0,0,0,0,0,0,100,"",-2,"",-2,50,0,0,"#999999","#FFFFF7","",3,1,1,"#CCCCCC"]);
stm_ai("p0i0",[0,"Logout","","",-1,-1,0,"logout.php","_parent","","","","",0,0,0,"","",0,0,0,1,1,"#FFFFF7",0,"#B5BED6",1,"","bg01.gif",3,3,0,0,"#CCCCCC","#CCCCCC","#3C1400","#3C1400","bold 9pt Arial","bold 9pt Arial",0,0,"","","","",0,0,0],50,30);
stm_ai("p0i1",[6,1,"#CCCCCC","",-1,-1,0]);
stm_aix("p0i2","p0i0",[0,"Home","","",-1,-1,0,"/"],50,30);
stm_aix("p0i3","p0i1",[]);
stm_aix("p0i4","p0i0",[0,"Registration","","",-1,-1,0,"reg_info.php"],90,30);
stm_ep();
stm_em();';
    }

    echo '</script>';
}
?>


