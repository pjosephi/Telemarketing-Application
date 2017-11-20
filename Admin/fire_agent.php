<?php
header('Refresh: 3; url=manage_agent.php');

include "../db_conn.php";

// Connect to server and select database.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");
	
	$id = $_POST['fire'];
	
$sql="UPDATE tbl_agents SET agt_fired=1 WHERE agt_id=$id";

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
?>