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
<title>Call Centre 4 - Manage Appointments</title>
    
</head>

<body>
<div align="center">
    	<h1>Manage Appointments</h1>
		<h3>Server time: <?php echo $today; ?></h3>
        <ul style="height:auto; padding:8px 0px; margin:0px;">
        	<li style="display:inline; padding:20px;"><a href="admin.php">Dashboard</a></li>

        	<li style="display:inline; padding:20px;"><a href="manage_telemarketer.php">Manage Telemarketers</a></li>
            <li style="display:inline; padding:20px;">Manage Appointments</li>
            <li style="display:inline; padding:20px;"><a href="manage_agent.php">Manage Agents</a></li>
        </ul>
    </div>
    <hr />
    <!--View all Appointments-->
	<div align="center">
    	<h3>Appointments (click to <a href="manage_appointment.php">refresh</a>)</h3>
       <table border="1px">
       <tr><th>ID</th><th>Name</th><th>Mobile</th><th>Address</th><th>Remarks</th><th>Date</th><th>Time</th><th>SU</th><th>Age</th><th>Telemarketer</th><th>Assigned to</th><th>Status</th><th>Status Remarks</th></tr>
		<?php				
		$sql=mysql_query("SELECT * FROM tbl_appointments, tbl_agents, tbl_telemarketers WHERE tbl_appointments.appt_agent=tbl_agents.agt_id AND tbl_appointments.appt_telemarketer=tbl_telemarketers.telemarketer_id ORDER BY appt_date DESC");
				
		// Print out result
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
						$appt_agent = $row['agt_name'];
						if($row['appt_su']==1)
							$appt_su = "YES";
						else
							$appt_su = "NO";
						$appt_telemarketer = $row['telemarketer_name'];
						$appt_status = $row['appt_status'];
						$appt_status_remarks = $row['appt_status_remarks'];
						echo "<tr><td>$appt_id</td><td><a href='formatting.php?id=$appt_id'>$appt_name </a></td><td>$appt_mobile </td><td>$appt_address </td><td>$appt_remarks</td><td>$appt_date</td><td>$appt_time </td><td>SU $appt_su </td><td>$appt_age years old </td><td align='center'>$appt_telemarketer</td><td align='center'>$appt_agent</td><td>$appt_status</td><td>$appt_status_remarks</td></tr>";
						}
						?>
        	</table>
        </div>
        <br />
</body>
</html>