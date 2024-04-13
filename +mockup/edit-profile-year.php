<?php
$currentYear = date("Y");
$years = array();

for ($i = 0; $i < 10; $i++) {
    $year = $currentYear - $i;
    $years[] = $year;
}

echo json_encode($years);
?>
