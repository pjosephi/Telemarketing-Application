<?php

include "../db_conn.php";

// Connect to server and select database.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Call Centre 4 - Manage Telemarketers</title>
    
</head>

<body>
<div align="center">
    	<h1>Manage Agents</h1>
        <h3>Server time: <?php echo $today; ?></h3>
        <ul style="height:auto; padding:8px 0px; margin:0px;">
        	<li style="display:inline; padding:20px;"><a href="admin.php">Dashboard</a></li>

        	<li style="display:inline; padding:20px;"><a href="manage_telemarketer.php">Manage Telemarketers</a></li>
            <li style="display:inline; padding:20px;"><a href="manage_appointment.php">Manage Appointments</a></li>
            <li style="display:inline; padding:20px;">Manage Agents</li>
        </ul>
    </div>
    <hr />
    <!--Add New Agent-->
	<div align="center">
        	<h3>Add New Agent</h3>
            <form action="add_agent.php" method="post">
            <table>
                <tr><td>Name: </td><td><input type="text" name="agent_name" /></td></tr>
                <tr><td>Mobile: </td><td><input type="text" name="agent_mobile" /></td><td><tr><td>Username: </td><td><input type="text" name="agent_user" /></td></tr>
                <tr><td>Password: </td><td><input type="password" name="agent_pass" /></td><td><input type="submit" value="Add" /></td></tr>
            </table>
            </form>
    </div>
    <hr />
    <!--Appointment by Telemarketer-->
	<div align="center">
    	<h3>Appointments by Agents (click to <a href="manage_agent.php">refresh</a>)</h3>
        <table border="1px"><tr><th>Agent</th><th>Today's Appts</th></tr>
		<?php		
		$sql1=mysql_query("SELECT *, COUNT(appt_agent) FROM tbl_appointments, tbl_agents WHERE DATE(appt_date) = DATE(now()) AND tbl_agents.agt_id = tbl_appointments.appt_agent GROUP BY appt_agent"); 
		
		// Print out result
		while($row1 = mysql_fetch_array($sql1)){
			$agent_name = $row1['agt_name'];
			$agent_appt = $row1['COUNT(appt_agent)'];
			echo "<tr><td>$agent_name</td><td align='center'>$agent_appt</td></tr>";
		}
		?>
        </table>
        <br />
        <table border="1px"><tr><th>Agent</th><th>Today's & Tmr's Appts</th></tr>
		<?php		
		$sql2=mysql_query("SELECT *, COUNT(appt_agent) FROM tbl_appointments, tbl_agents WHERE (DATE(appt_date)=DATE(now()) OR DATE(appt_date)=DATE(now()+INTERVAL 1 DAY)) AND tbl_appointments.appt_agent=tbl_agents.agt_id GROUP BY appt_agent"); 
		
		// Print out result
		while($row2 = mysql_fetch_array($sql2)){
			$agent_name = $row2['agt_name'];
			$agent_appt = $row2['COUNT(appt_agent)'];
			echo "<tr><td>$agent_name</td><td align='center'>$agent_appt</td></tr>";
		}
		?>
        </table>
        </div>
    <hr />
    <!--Telemarketers-->
    <div align="center">
    <h3>Agent List (click to <a href="manage_agent.php">refresh</a>)</h3>
    <form action="fire_agent.php" method="post">
    <table border="1px">
    <tr><th>Name</th><th>Mobile</th><th>Fire?</th></tr>
    	<?php
			$sql=mysql_query("SELECT * FROM tbl_agents WHERE agt_fired=0");
			
			while($row=mysql_fetch_array($sql)) {
						$agent_id = $row['agt_id'];
						$agent_name = $row['agt_name'];
						$agent_mobile = $row['agt_mobile'];
						
						echo "<tr><td>$agent_name </td><td>$agent_mobile</td><td align='center'><input type='submit' name='fire' value='$agent_id' </td></tr>";
			}
		?>
        </table>
        </form>
    </div><hr />
    <div>
    </div>
</body>
</html>