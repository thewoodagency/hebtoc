<?php
define('USER', '976970_tocuser');
define('PASSWORD', 'tWa198920');
define('HOST', 'mysql51-039.wc1.ord1.stabletransit.com');
define('DATABASE', '976970_toc');

try {
	$connection = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER, PASSWORD);
} catch (PDOException $e) {
	exit("Error: " . $e->getMessage());
}
?>