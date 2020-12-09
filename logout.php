<?php
session_start();
if(isset($_SESSION['email']))
  unset($_SESSION['email']);
if(isset($_SESSION['admin']))
  unset($_SESSION['admin']);
 if(isset($_SESSION['toclevel']))
  unset($_SESSION['toclevel']);
session_destroy();
header("Location: login_proc.php");
die();
?>