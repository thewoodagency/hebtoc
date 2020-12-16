<?php
ini_set('display_errors', 1);
error_reporting(~0);

require ('../../lib/config.php');
require('../../lib/functions.php');
session_start();
require_once('../../lib/session.php');
if (isset($_SESSION['admin']) && isset($_SESSION['token'])) {
    $email = validate_input2($_GET['email']);
    $rid = validate_input($_GET['rid']);
    $source = validate_input($_GET['source']);

    $_SESSION['email'] = $email;
    $_SESSION['regid'] = $rid;

    if ($source === "reg&lowbar;info") {
        $source = "reg_info.php";
    } else if ($source === "&lowbar;invoice") {
        $source = "_invoice.php";
    } else {
        $source = "index.php";
    }
    header('Location: ' . $source);
    die();
} else {
    header("Location: index.php");
    die();
}
