<?php

include "../db_conn.php";
$tbl_name="tbl_appointments"; // Table name 

// Connect to server and select database.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");
	
	$id = $_POST['fulfill'];
	$agent = $_POST['agent'];
	
$sql="UPDATE tbl_appointments SET appt_fulfilled=1, appt_agent=$agent WHERE appt_id=$id";

$result=mysql_query($sql);

// if successfully update data into database, displays message "Successful". 
if($result){
echo "<h1 align='center'>SUCCESS</h1><br>";
}

else {
echo "<h1 align='center'>ERROR</h1><br>";
}
?> 

<?php 
// close connection 
mysql_close();
echo "<br>";
echo "<br>";
echo "<a href='admin.php'>Back to Database</a>";
?>