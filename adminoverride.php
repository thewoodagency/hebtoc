<?php
ini_set('display_errors', 1);
error_reporting(~0);

require ('../../lib/config.php');
require('../../lib/functions.php');

session_start();
if (isset($_SESSION['admin']) && isset($_SESSION['token'])) {
    $session = session_read(true, $_SESSION['admin']);

    if (!hash_equals($_SESSION['token'], $session)) {
        session_destroy();
        header("Location: login_proc.php");
    }

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
