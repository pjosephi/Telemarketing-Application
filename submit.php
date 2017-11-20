<?php

include "db_conn.php";
$tbl_name="tbl_appointments"; // Table name 

// Connect to server and select database.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");
	
	$name = stripslashes($_POST['name']);
	$address = stripslashes($_POST['address']);
	$mobile = stripslashes($_POST['mobile']);
	$age = stripslashes($_POST['age']);
	
	$today = date("Y-m-d", strtotime('now + 13 hours'));
	$tomorrow = date("Y-m-d", strtotime('tomorrow + 13 hours'));
	
	if($_POST['date']=="today")
		$datetime = $today." ".$_POST['time'].":00";
	if($_POST['date']=="tmr")
		$datetime = $tomorrow." ".$_POST['time'].":00";
		
	if($_POST['su']=="on")
	{
		$su = 1;
	}
	else
	{
		$su = 0;
	}
	$telemarketer = stripslashes($_POST['telemarketer']);
	$remarks = stripslashes($_POST['remarks']);
	if(($age>=40&&$age<=60)&&($mobile>=80000000&&$mobile<=98999999))
	{
// Insert data into mysql 
$sql="INSERT INTO $tbl_name(appt_name, appt_mobile, appt_age, appt_address, appt_date, appt_su, appt_telemarketer, appt_agent, appt_remarks)VALUES('$name', '$mobile', '$age', '$address', '$datetime', '$su', '$telemarketer', -1, '$remarks')";
$result=mysql_query($sql);

// if successfully insert data into database, displays message "Successful". 
if($result){
echo "<div align='center'>";
echo "<h3 align='center'>SUCCESSFUL</h3>";
echo "<BR>";
echo "<a href='index.php'>Back to form</a>";
echo "</div>";
}

else {
echo "<div align='center'>";
echo "<h3 align='center'>DATABASE ERROR</h3>";
echo "<h4 align='center'>ENSURE THERE ARE NO BLANK ENTRIES OR USE OF SYMBOLS</h4>";
echo "<BR>";
echo "<a href='index.php'>Back to form</a>";
echo "</div>";
}
?> 

<?php 
// close connection 
mysql_close();
}
else
{
echo "<div align='center'>";
echo "<h3 align='center'>ERROR</h3>";
echo "<h3 align='center'>INVALID AGE OR MOBILE NUMBER</h3>";
echo "<BR>";
echo "<a href='index.php'>Back to form</a>";
echo "</div>";
}
?>