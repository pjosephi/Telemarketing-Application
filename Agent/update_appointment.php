<?php

include "../db_conn.php";
include "../check_login.php";

// Connect to server and select database.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");
	
	$appt_id = $_POST['update'];
	$appt_status = $_POST['status'];
	$appt_status_remarks = $_POST['status_remarks'];
			
		$sql="UPDATE tbl_appointments SET appt_status='$appt_status', appt_status_remarks='$appt_status_remarks' WHERE appt_id='$appt_id'";
		$result=mysql_query($sql);
	
		// if successfully update data into database, displays message "Success". 
		if($result){
		echo "<h1 align='center'>SUCCESS</h1><br>";
		}
	
		else {
		echo "<h1 align='center'>ERROR</h1><br>";
		}
 
// close connection 
mysql_close();
echo "<br>";
echo "<br>";
echo "<a href='index.php'>Go Back</a>";
?>