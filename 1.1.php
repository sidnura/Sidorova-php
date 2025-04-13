<?php

mb_internal_encoding("UTF-8");

$LastName = "сидорова";
$FirstName = "анна";
$MiddleName = "витальевна";

echo "'$LastName', '$FirstName', '$MiddleName'<br>";

$LastName = mb_convert_case($LastName, MB_CASE_TITLE, "UTF-8");

$FirstNameInitial = mb_strtoupper(mb_substr($FirstName, 0, 1, "UTF-8"));
$MiddleNameInitial = mb_strtoupper(mb_substr($MiddleName, 0, 1, "UTF-8"));

echo "$LastName $FirstNameInitial.$MiddleNameInitial.";

?>
