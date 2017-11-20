<?php

include "../db_conn.php";

// Connect to server and select database.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");
	
	$name = $_POST['agent_name'];
	$mobile = $_POST['agent_mobile'];
	$user = stripslashes($_POST['agent_user']);
	$pass = stripslashes($_POST['agent_pass']);
	$encrypted_pass = md5($pass);
	
// Insert data into mysql 
$sql="INSERT INTO tbl_agents(agt_name, agt_user, agt_pass, agt_mobile, agt_fired)VALUES('$name', '$user', '$encrypted_pass', '$mobile', 0)";
$result=mysql_query($sql);

// if successfully insert data into database, displays message "Successful". 
if($result){
echo "<div align='center'>";
echo "<h3 align='center'>SUCCESSFUL</h3>";
echo "<BR>";
echo "<a href='manage_agent.php'>Back to form</a>";
echo "</div>";
}

else {
echo "<div align='center'>";
echo "<h3 align='center'>DATABASE ERROR</h3>";
echo "<h3 align='center'>PLESE CHECK THAT YOU HAVE FILLED IN THE FORM CORRECTLY</h3>";
echo "<BR>";
echo "<a href='manage_agent.php'>Back to form</a>";
echo "</div>";
}
?> 

<?php 
// close connection 
mysql_close();
?>