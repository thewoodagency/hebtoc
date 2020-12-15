<?php
ini_set('display_errors', 1);
error_reporting(~0);
//error_reporting(E_ALL);


//require ('./includes/config.inc.php');
require ('../../lib/mysqli_connect.php');
require ('../../lib/functions.php');

session_start();

if(isset($_SESSION['email']) && isset($_POST['formID']))
{
    $regEmail = validate_input2($_SESSION['email']);
    $regID = validate_input($_SESSION['regid']);
    $toclevel = validate_input($_SESSION['toclevel']);
    $noofPeople = validate_input($_POST['noofPeople']);
    $tocadd = validate_input($_POST['tocadd']);
    $tocinfo = getLevelInfo($_SESSION['toclevel']);

    $hid = '';
    //get current attendees
    $e0=$e1=$e2=$e3=$e4=$e5=$e6=$e7=$e8=$e9=$e10=0;
    $isValid = 1;
    $error0=$error1=$error2=$errorGolf=$error5=$error6=$error7=$error8=$error9=0;
    $golf = 0;
    for ($i=0; $i<$noofPeople; $i++) {
        $events = array(0 => 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

        if (isset($_POST['events' . $i])) {
            foreach ($_POST['events' . $i] as $event) {
                //print_r($_POST['events'.$i]);
                //echo $event . ' - ';
                if ($event == 0) $e0++;
                if ($event == 1) $e1++;
                if ($event == 2) $e2++;
                if ($event == 3) $e3++;
                if ($event == 4) $e4++;
                if ($event == 5) $e5++;
                if ($event == 6) $e6++;
                if ($event == 7) $e7++;
                if ($event == 8) $e8++;
                if ($event == 9) $e9++;
                if ($event == 10) $e10++;
                $golf = $e3 + $e4 + $e10;
            }
        }
    }

    //get current attendees

    for ($i=0; $i<$noofPeople; $i++)
    {
        //if (isset($_POST['first'.$i]) && $_POST['first'.$i]<>'')
        //
        $fname=validate_input($_POST['first'.$i]);
        $lname=validate_input($_POST['last'.$i]);
        $pemail=validate_input2($_POST['pemail'.$i]);
        $hid=validate_input($_POST['hid'.$i]);
        $size=validate_input($_POST['size'.$i]);
        $title=validate_input($_POST['title'.$i]);
        $bdm=validate_input($_POST['bdm'.$i]);
        $waiver=validate_input($_POST['waiver'.$i]);
        $signed=validate_input($_POST['signed'.$i]);

        $events = array(0=>0,0,0,0,0,0,0,0,0,0,0);

        if (isset($_POST['events'.$i]))
        {
            foreach ($_POST['events'.$i] as $event)
            {
                //print_r($_POST['events'.$i]);
                //echo $event . ' - ';
                $events[$event] = 1;
                //echo $events[$event] .'-';
            }
        }
        //reserved attendees
        /* echo $e0.'/'.$tocinfo['tour'].'(tour)-'
             .$e1.'/'.$tocinfo['private'].'(pmeeting)-'
             .$e2.'/'.$tocinfo['pdinner'].'(pdinner)-'
             .$golf.'/'.$tocinfo['golf'].'(topgolf)-'
             .$golf.'/'.$tocinfo['golf'].'(topgolf2)-'
             .$e5.'/'.$tocinfo['summit'].'(summit)-'
             .$e6.'/'.$tocinfo['welcome'].'(welcome)-'
             .$e7.'/'.$tocinfo['charity'].'(charity)-'
             .$e8.'/'.$tocinfo['hall'].'(hall)-'
             .$e9.'/'.$tocinfo['hall'].'(general)-'
             .$golf.'/'.$tocinfo['golf'].'(regular golf)<br>'; */

        //$events[3] topgolf
        //$events[10] regular golf
        if ($events[3]==1 && $events[10]==1) {
            $isValid=0;
            $errorGolf=1;
            break;
        }

        //check current participants
        if (intval($e0) > intval($tocinfo['tour'])) $error0=1;
        if (intval($e1) > intval($tocinfo['private'])) $error1=1;
        if (intval($e2) > intval($tocinfo['pdinner'])) $error2=1;
        if (intval($golf) > intval($tocinfo['golf'])) $errorGolf=1;
        if (intval($e5) > intval($tocinfo['summit'])) $error5=1;
        if (intval($e6) > intval($tocinfo['welcome'])) $error6=1;
        if (intval($e7) > intval($tocinfo['charity'])) $error7=1;
        if (intval($e8) > intval($tocinfo['hall'])) $error8=1;
        if (intval($e9) > intval($tocinfo['hall'])) $error9=1;

        if (intval($e0) > intval($tocinfo['tour']) || intval($e1) > intval($tocinfo['private']) || intval($e2) > intval($tocinfo['pdinner']) || intval($golf) > intval($tocinfo['golf']) ||
            intval($e5) > intval($tocinfo['summit']) || intval($e6) > intval($tocinfo['welcome']) || intval($e7) > intval($tocinfo['charity']) || intval($e8) > intval($tocinfo['hall']) ||
            intval($e9) > intval($tocinfo['hall'])) {
            $isValid = 0;
            break;
        }
        //check current participants

        //echo 'valid-'. $isValid;

        $qString = sprintf('replace into toc_events (hid, toc_regid, toc_regEmail, toc_firstname, toc_lastname, 
toc_email, toc_title, toc_tour, toc_pmeeting, toc_pdinner, toc_topgolf, toc_golf, toc_topgolf2, toc_summit, toc_welcome, toc_charity, 
toc_hall, toc_general, toc_charity_tee, toc_charity_waiver, toc_charity_waiver_signed, toc_bdm, toc_add) values 
("%s", "%s","%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s")',
            $dbc->real_escape_string($hid),
            $dbc->real_escape_string($regID),
            $dbc->real_escape_string($regEmail),
            $dbc->real_escape_string($fname),
            $dbc->real_escape_string($lname),
            $dbc->real_escape_string($pemail),
            $dbc->real_escape_string($title),
            $dbc->real_escape_string($events[0]), //aca tour
            $dbc->real_escape_string($events[1]), //pmeeting
            $dbc->real_escape_string($events[2]), //pdinner
            $dbc->real_escape_string($events[3]), //topgolf
            $dbc->real_escape_string($events[10]), //regular golf
            $dbc->real_escape_string($events[4]), //topgolf2 == spa
            $dbc->real_escape_string($events[5]), //summit
            $dbc->real_escape_string($events[6]), //welcome
            $dbc->real_escape_string($events[7]), //charity
            $dbc->real_escape_string($events[8]), //hall
            $dbc->real_escape_string($events[9]), //general
            $dbc->real_escape_string($size),
            $dbc->real_escape_string($waiver),
            $dbc->real_escape_string($signed),
            $dbc->real_escape_string($bdm),
            $dbc->real_escape_string($tocadd));

        if ($fname == 'DELETE' && $lname == 'DELETE') {
            deleteAttendee($hid);
        } else if ($fname !== '') {
            if ($isValid == 1) {
                $dbc->query($qString);
            }
            //echo '1 ' .$qString . '<br>';
        }
        //echo '2 ' .$qString . '<br>';
        //}
    } //end for
    $dbc->close();
    //send_notice("hotel");
    header("Location: reg_newEvent.php?e0=".$error0."&e1=".$error1."&e2=".$error2."&golf=".$errorGolf."&e5=".$error5."&e6=".$error6."&e7=".$error7."&e8=".$error8."&e9=".$error9);
    exit();
} else {
    header("Location: login_proc.php");
    die();
}
