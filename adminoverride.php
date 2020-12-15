<?php
ini_set('display_errors', 1);
error_reporting(~0);

require('../../lib/functions.php');
session_start();
if (isset($_SESSION['admin']) && isset($_SESSION['token'])) {
    $email = validate_input2($_GET['email']);
    $rid = validate_input($_GET['rid']);
    $source = 'reg_info.php';
    $_SESSION['email'] = $email;
    $_SESSION['regid'] = $rid;
    header('Location: ' . $source);
    die();
} else {
    header("Location: index.php");
    die();
}
