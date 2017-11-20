<?php
header('Refresh: 3; url=manage_telemarketer.php');

include "../db_conn.php";
$tbl_name="tbl_appointments"; // Table name 

// Connect to server and select database.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");
	
	$id = $_POST['fire'];
	
$sql="UPDATE tbl_telemarketers SET Fired=1 WHERE telemarketer_id=$id";

$result=mysql_query($sql);

// if successfully update data into database, displays message "Successful". 
if($result){
echo "<h1 align='center'>SUCCESS</h1><br>";

$sql=mysql_query("SELECT * FROM tbl_telemarketers WHERE telemarketer_id=$id");
			while($row=mysql_fetch_array($sql)) {
				$tele_name = $row['telemarketer_name'];
				echo "<h3 align='center'>You have fired $tele_name.</h3>";
			}
}

else {
echo "<h1 align='center'>ERROR</h1><br>";
}

?> 

<?php 
// close connection 
mysql_close();
?>