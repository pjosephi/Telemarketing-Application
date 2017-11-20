<?php
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password="root"; // Mysql password 
$db_name="db_telemarketer"; // Database name 

$today = date("Y-m-d G:iA", strtotime('now'));

$now = strtotime('now');
echo date("Y-m-d G:iA", $now)."<br><br>";
$corrected_now = strtotime('+13 hours');
echo date("Y-m-d G:iA", $corrected_now)."<br><br>";
$tmr = strtotime('tomorrow');
echo date("Y-m-d G:iA", $tmr)."<br><br>";
$corrected_tmr = strtotime('+37 hours');
echo date("Y-m-d G:iA", $corrected_tmr)."<br><br>";
?>