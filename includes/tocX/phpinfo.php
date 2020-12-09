<?php
$dbc = new mysqli("mysql51-039.wc1.ord1.stabletransit.com", "976970_tocuser", "tWa198920", "976970_toc");
//$dbc = mysqli_connect("mysql51-039.wc1.ord1.stabletransit.com", "976970_tocuser", "tWa198920", "976970_toc");

if (!$dbc) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
echo "Host information: " . mysqli_get_host_info($dbc) . PHP_EOL;




$qString = 'SELECT ben FROM toc_ben order by idtoc_ben';
	$r = $dbc->query($qString);
	$result = '';
	$li = 0;
	while ($row = $r->fetch_assoc())
	{
		if ($li == 0) $result .= '<li><a>';
	
		if ($li == 6) {
			$result .= $row["ben"] . '</a></li>';
			$li = 0;
		} else {
			$result .= $row["ben"] . '<br>';
			$li++;
		}
	}
	$r->close();
	$dbc->close();
	echo str_replace('"', '', $result);
?>