<?php
$password = 'oFi0g46#';
$database_name   = '1323_scouting';
$username = 'scoutingUser';

$server = 'localhost';
mysql_connect($server, $username, $password);
mysql_select_db($database_name);


mysql_query("delete from ChampData where matchNumber = 0 and teamNumber = 0");
echo "done"; 
?>