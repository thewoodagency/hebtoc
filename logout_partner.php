<?php
session_start();
if(isset($_SESSION['email']))
  unset($_SESSION['email']);
if(isset($_SESSION['admin']))
  unset($_SESSION['admin']);
 if(isset($_SESSION['toclevel']))
  unset($_SESSION['toclevel']);
header("Location: login_partner_proc.php");
die();
?>