<?php

include "../db_conn.php";
include "../check_login.php";

// Connect to server and select database.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");
	
	$appt_id = $_POST['accept'];
		
	$sql_check=mysql_query("SELECT * FROM tbl_appointments WHERE appt_id=$appt_id");
	while($row=mysql_fetch_array($sql_check)) {
		$appt_agent = $row['appt_agent'];
	
		if($appt_agent=='-1'){		
			$sql="UPDATE tbl_appointments SET appt_agent=$agt_id WHERE appt_id=$appt_id";
			$result=mysql_query($sql);
	
			// if successfully update data into database, displays message "Success". 
			if($result){
			echo "<h1 align='center'>SUCCESS</h1><br>";
			}
	
			else {
			echo "<h1 align='center'>ERROR</h1><br>";
			}
		}
		else{
			header("Location: index.php?error=The%20appointment%20has%20been%20taken%20by%20another%20agent");
		}
	}
 
// close connection 
mysql_close();
echo "<br>";
echo "<br>";
echo "<a href='index.php'>Go Back</a>";
?>