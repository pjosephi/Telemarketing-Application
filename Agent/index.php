<?php

include "../db_conn.php";
include "../check_login.php";

// Connect to server and select database.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

$error = $_GET['error'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Call Centre 4 - Agent</title>
</head>

<body>
	<div align="center">
    	<h1>Agent Dashboard</h1>
        <h3>Server time: <?php echo $today; ?></h3>
                <?php echo "<h3>$error</h3>"; ?>
        <ul style="height:auto; padding:8px 0px; margin:0px;">
        <li style="display:inline; padding:20px;">Dashboard</li>
            <li style="display:inline; padding:20px;"><a href="manage_appointment.php">View Previous Appointments</a></li>
        </ul>
    </div>
    <hr />
<!--Your Appointments-->
    <div align="center">
    <h3>Your Appointments (click to <a href="index.php">refresh</a>)</h3>
    <form action="update_appointment.php" method="post">
    <table border="1px">
    <tr><th>Name</th><th>Mobile</th><th>Address</th><th>Remarks</th><th>Date</th><th>Time</th><th>SU</th><th>Age</th><th>Status</th><th>Status Remarks</th><th>Update</th></tr>
    	<?php
			$sql=mysql_query("SELECT * FROM tbl_appointments, tbl_agents WHERE (DATE(appt_date) = DATE(now()) OR DATE(appt_date) = DATE(now()+INTERVAL 1 DAY)) AND tbl_appointments.appt_agent=tbl_agents.agt_id AND tbl_appointments.appt_agent=$agt_id");
			while($row=mysql_fetch_array($sql)) {
				
						$closed = '';
						$failed = '';
						$pending = '';
				
						$appt_id = $row['appt_id'];
						$appt_name = $row['appt_name'];
						$appt_mobile = $row['appt_mobile'];
						$appt_age = $row['appt_age'];
						$appt_address = $row['appt_address'];
						$appt_remarks = $row['appt_remarks'];
						$appt_datetime = $row['appt_date'];
						$appt_time = date("g:iA",strtotime($appt_datetime));
						$appt_date = date("d/n/Y",strtotime($appt_datetime));
						if($row['appt_su']==1)
							$appt_su = "YES";
						else
							$appt_su = "NO";
						$appt_status = $row['appt_status'];
						$appt_status_remarks = $row['appt_status_remarks'];
						
						if($appt_status=='closed')
							$closed = 'selected';
						if($appt_status=='failed')
							$failed = 'selected';
						else
							$pending = 'selected';
						
						echo "<tr><td>$appt_name</td><td>$appt_mobile </td><td>$appt_address </td><td>$appt_remarks</td><td>$appt_date</td><td>$appt_time </td><td>SU $appt_su </td><td>$appt_age years old </td><td><select name='status'>
						<option $pending value='pending'>Pending</option>
						<option $closed value='closed'>Closed</option>
						<option $failed value='failed'>Failed</option>
						</select>
						</td><td><input type='text' name='status_remarks' value='$appt_status_remarks'></td><td align='center'><input type='submit' value='$appt_id' name='update'/></td></tr>";
			}
		?>
        </table>
        </form>
    </div>
<!--Available Appointments-->
    <div align="center">
    <h3>Available Appointments (click to <a href="index.php">refresh</a>)</h3>
    <form action="accept_appointment.php" method="post">
    <table border="1px">
    <tr><th>Name</th><th>Mobile</th><th>Address</th><th>Remarks</th><th>Date</th><th>Time</th><th>SU</th><th>Age</th><th>Accept?</th></tr>
    	<?php
			$sql=mysql_query("SELECT * FROM tbl_appointments, tbl_agents WHERE DATE(appt_date) = DATE(now()) AND tbl_appointments.appt_agent=tbl_agents.agt_id AND tbl_appointments.appt_agent='-1'");
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
						if($row['appt_su']==1)
							$appt_su = "YES";
						else
							$appt_su = "NO";
													
						echo "<tr><td>$appt_name</td><td>$appt_mobile </td><td>$appt_address </td><td>$appt_remarks</td><td>$appt_date</td><td>$appt_time </td><td>SU $appt_su </td><td>$appt_age years old </td><td align='center'><input type='submit' value='$appt_id' name='accept' /></td></tr>";
			}
		?>
        </table>
        </form>
    </div><hr />
</body>
</html>