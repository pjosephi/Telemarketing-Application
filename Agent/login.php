<?php
include "../db_conn.php";

// Connect to server and select database.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

$user = stripslashes($_POST['user']);
$pass = stripslashes($_POST['pass']);
$encrypted_pass = md5($pass);

$sql=mysql_query("SELECT * FROM tbl_agents WHERE agt_user='$user' AND agt_fired='0'");
	while($row=mysql_fetch_array($sql)) {
		$agent_pass = $row['agt_pass'];
		$agent_name = $row['agt_name'];
		$agent_id = $row['agt_id'];
	}
	
	if($agent_pass==$encrypted_pass){
		setcookie("agent_name", $agent_name, time()+3600);  /* expire in 1 hour */
		setcookie("agent_id", $agent_id, time()+3600);  /* expire in 1 hour */
		header("Location: index.php");
	}
	else{
		header("Location: login_agent.php?error=Invalid%20Credentials");
	}

?>