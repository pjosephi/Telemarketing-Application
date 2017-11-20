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
<title>Call Centre 4 - Admin</title>
</head>

<body>
	<div align="center">
    	<h1>Administration Dashboard</h1>
        <h3>Server time: <?php echo $today; ?></h3>
        <ul style="height:auto; padding:8px 0px; margin:0px;">
        <li style="display:inline; padding:20px;">Dashboard</li>
        	<li style="display:inline; padding:20px;"><a href="manage_telemarketer.php">Manage Telemarketers</a></li>
            <li style="display:inline; padding:20px;"><a href="manage_appointment.php">Manage Appointments</a></li>
            <li style="display:inline; padding:20px;"><a href="manage_agent.php">Manage Agents</a></li>
        </ul>
    </div>
    <hr />
<!--Today's Appointments-->
    <div align="center">
    <h3>Today's Appointments (click to <a href="admin.php">refresh</a>)</h3>
    <form action="fulfill_appointment.php" method="post">
    <table border="1px">
    <tr><th>Name</th><th>Mobile</th><th>Address</th><th>Remarks</th><th>Date</th><th>Time</th><th>SU</th><th>Age</th><th>Telemarketer</th><th>Assign to</th><th>Assigned</th></tr>
    	<?php
			$sql=mysql_query("SELECT * FROM tbl_appointments, tbl_agents, tbl_telemarketers WHERE DATE(appt_date) = DATE(now()) AND tbl_appointments.appt_agent=tbl_agents.agt_id AND tbl_appointments.appt_telemarketer=tbl_telemarketers.telemarketer_id");
			while($row=mysql_fetch_array($sql)) {
						$appt_id = $row['appt_id'];
						$appt_name = $row['appt_name'];
						$appt_mobile = $row['appt_mobile'];
						$appt_age = $row['appt_age'];
						$appt_address = $row['appt_address'];
						$appt_remarks = $row['appt_remarks'];
						$appt_datetime = $row['appt_date'];
						$appt_time = date("g:iA",strtotime($appt_datetime));
						$appt_date = date("d/n/Y",strtotime($appt_datetime));
						$appt_agent = $row['appt_agent'];
						if($row['appt_su']==1)
							$appt_su = "YES";
						else
							$appt_su = "NO";
						$appt_telemarketer = $row['telemarketer_name'];
						$appt_fulfilled = $row['appt_fulfilled'];
						
						echo "<tr><td><a href='formatting.php?id=$appt_id'>$appt_name </a></td><td>$appt_mobile </td><td>$appt_address </td><td>$appt_remarks</td><td>$appt_date</td><td>$appt_time </td><td>SU $appt_su </td><td>$appt_age years old </td><td align='center'>$appt_telemarketer</td><td><select id='mylist' name='agent'><option value=''>Select Agent</option>";
						
	$sql2=mysql_query("SELECT * FROM tbl_agents WHERE agt_fired=0");
			while($row2=mysql_fetch_array($sql2)) {
						$agt_id = $row2['agt_id'];
						$agt_name = $row2['agt_name'];
						if($appt_agent==$agt_id)
						echo "<option selected value=".$agt_id.">".$agt_name."</option>";
						else
						echo "<option value=".$agt_id.">".$agt_name."</option>";
						}
						
						echo "</td><td align='center'><input type='submit' name='fulfill' value='$appt_id' /></td></tr>";
			}
		?>
        </table>
        </form>
    </div>
<!--Tomorrow's Appointments-->
    <div align="center">
    <h3>Tomorrow's Appointments (click to <a href="admin.php">refresh</a>)</h3>
    <form action="fulfill_appointment.php" method="post">
    <table border="1px">
    <tr><th>Name</th><th>Mobile</th><th>Address</th><th>Remarks</th><th>Date</th><th>Time</th><th>SU</th><th>Age</th><th>Telemarketer</th><th>Assign to</th><th>Assigned</th></tr>
    	<?php
			$sql=mysql_query("SELECT * FROM tbl_appointments, tbl_agents, tbl_telemarketers WHERE DATE(appt_date) = DATE(now()+INTERVAL 1 DAY) AND tbl_appointments.appt_agent=tbl_agents.agt_id AND tbl_appointments.appt_telemarketer=tbl_telemarketers.telemarketer_id");
			while($row=mysql_fetch_array($sql)) {
						$appt_id = $row['appt_id'];
						$appt_name = $row['appt_name'];
						$appt_mobile = $row['appt_mobile'];
						$appt_age = $row['appt_age'];
						$appt_address = $row['appt_address'];
						$appt_remarks = $row['appt_remarks'];
						$appt_datetime = $row['appt_date'];
						$appt_time = date("g:iA",strtotime($appt_datetime));
						$appt_date = date("d/n/Y",strtotime($appt_datetime));
						$appt_agent = $row['appt_agent'];
						if($row['appt_su']==1)
							$appt_su = "YES";
						else
							$appt_su = "NO";
						$appt_telemarketer = $row['telemarketer_name'];
						$appt_fulfilled = $row['appt_fulfilled'];
						
						echo "<tr><td><a href='formatting.php?id=$appt_id'>$appt_name </a></td><td>$appt_mobile </td><td>$appt_address </td><td>$appt_remarks</td><td>$appt_date</td><td>$appt_time </td><td>SU $appt_su </td><td>$appt_age years old </td><td align='center'>$appt_telemarketer</td><td><select id='mylist' name='agent'><option value=''>Select Agent</option>";
						
	$sql2=mysql_query("SELECT * FROM tbl_agents WHERE agt_fired=0");
			while($row2=mysql_fetch_array($sql2)) {
						$agt_id = $row2['agt_id'];
						$agt_name = $row2['agt_name'];
						if($appt_agent==$agt_id)
						echo "<option selected value=".$agt_id.">".$agt_name."</option>";
						else
						echo "<option value=".$agt_id.">".$agt_name."</option>";
						}
						
						echo "</td><td align='center'><input type='submit' name='fulfill' value='$appt_id' /></td></tr>";
			}
		?>
        </table>
        </form>
    </div><hr />
</body>
</html>