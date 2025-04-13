<?php

$year = 2021;

for ($month = 1; $month <= 12; $month++) {
    for ($day = 1; $day <= 20; $day++) {
        $date = sprintf('%04d-%02d-%02d', $year, $month, $day);
        if (date('N', strtotime($date)) == 6) { 
            echo date('d.m.Y', strtotime($date)) . "<br>";
        }
    }
}

?>
