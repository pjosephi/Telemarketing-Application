<?php
header('Refresh: 3; url=admin.php');

include "../db_conn.php";

// Connect to server and select database.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");
	
	$id = $_GET['id'];
	$name = $_POST['name'];
	$mobile = $_POST['mobile'];
	$age = $_POST['age'];
	$address = $_POST['address'];
	$datetime = $_POST['date']." ".$_POST['time'];
	$su = $_POST['su'];
	if($su=="on")
		$su_bool = 1;
	else
		$su_bool = 0;
	$remarks = $_POST['remarks'];
	$telemarketer = $_POST['telemarketer'];
	$agent = $_POST['agent'];
	
$sql="UPDATE tbl_appointments 
SET appt_name='$name', appt_mobile='$mobile', appt_age='$age', appt_address='$address', appt_su='$su_bool', appt_remarks='$remarks', appt_telemarketer='$telemarketer', appt_agent=$agent
WHERE appt_id='$id'";

$result=mysql_query($sql);

// if successfully update data into database, displays message "Successful". 
if($result){
echo "<h1 align='center'>SUCCESS</h1><br>";

$sql=mysql_query("SELECT * FROM tbl_appointments WHERE appt_id=$id");
			while($row=mysql_fetch_array($sql)) {
				$appt_name = $row['appt_name'];
				echo "<h3 align='center'>You have updated the appointment.<br><a href='manage_appointment.php'>Go Back</a></h3>";
				}
}

else {
echo "<h1 align='center'>ERROR</h1><br>";
echo "<h3 align='center'>Unable to update database.<br><a href='manage_appointment.php'>Go Back</a></h3>";
}
?> 

<?php 
// close connection 
mysql_close();
?>