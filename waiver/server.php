<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require ('../includes/config.inc.php');
require ('../includes/mysqli_connect.php');
require ('../includes/functions.php');

	$keyword = strval($_POST['query']);
	$search_param = "{$keyword}%";

	$sql = sprintf('SELECT company, idtoc_register FROM toc_register WHERE idtoc_register > 8722 and company LIKE "%s"',
					$dbc->real_escape_string($search_param));
	$r = $dbc->query($sql);

while($row = $r->fetch_assoc()) {
    $countryResult[] = $row["company"];
	//$company->name = $row['company'];
	//$company->cid = $row['idtoc_register'];
	//$countryResult[] = $company;
}
echo json_encode($countryResult);

$r->close();
$dbc->close();

?>

