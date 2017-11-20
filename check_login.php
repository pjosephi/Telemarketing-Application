<?php
if (isset($_COOKIE["agent_name"])){
  $agt_name = $_COOKIE['agent_name'];
  $agt_id = $_COOKIE['agent_id'];
}
else{
	header("Location: login_agent.php?error=Please%20Login");
	exit;
}
?>