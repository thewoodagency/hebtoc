<?php
require ('./includes/config.inc.php');
require ('./includes/mysqli_connect.php');
require ('./includes/functions.php');

$qString = 'SELECT ben FROM toc_ben order by idtoc_ben';
$r = $dbc->query($qString);
$result = '';
$li = 0;
while ($row = $r->fetch_assoc())
{
	if ($li == 0) $result .= '<li><a href="organizations.html">';
	
	if ($li == 5) {
		$result .= $row["ben"] . '</a></li>';
		$li = 0;
	} else {
		$result .= $row["ben"] . '<br>';
		$li++;
	}
}
echo str_replace('"', '', $result);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>