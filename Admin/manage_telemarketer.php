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
    	<h1>Manage Telemarketers</h1>
        <h3>Server time: <?php echo $today; ?></h3>
        <ul style="height:auto; padding:8px 0px; margin:0px;">
        	<li style="display:inline; padding:20px;"><a href="admin.php">Dashboard</a></li>

        	<li style="display:inline; padding:20px;">Manage Telemarketers</li>
            <li style="display:inline; padding:20px;"><a href="manage_appointment.php">Manage Appointments</a></li>
            <li style="display:inline; padding:20px;"><a href="manage_agent.php">Manage Agents</a></li>
        </ul>
    </div>
    <hr />
    <!--Add New Telemarketer-->
	<div align="center">
        	<h3>Add New Telemarketer</h3>
            <form action="add_telemarketer.php" method="post">
            <table>
                <tr><td>Name: </td><td><input type="text" name="tele_name" /></td></tr>	 				<tr><td>Mobile: </td><td><input type="text" name="tele_mobile" /></td><td><input type="submit" value="Add" /></td></tr>
            </table>
            </form>
    </div>
    <hr />
    <!--Appointment by Telemarketer-->
	<div align="center">
    	<h3>Appointments by Telemarketer (click to <a href="manage_telemarketer.php">refresh</a>)</h3>
        <table border="1px"><tr><th>Telemarketer</th><th>Today's Appts</th></tr>
		<?php		
		$sql1=mysql_query("SELECT *, COUNT(appt_telemarketer) FROM tbl_appointments, tbl_telemarketers WHERE DATE(appt_date) = DATE(now()) AND tbl_appointments.appt_telemarketer=tbl_telemarketers.telemarketer_id GROUP BY appt_telemarketer"); 
		
		// Print out result
		while($row1 = mysql_fetch_array($sql1)){
			$tele_name = $row1['telemarketer_name'];
			$tele_appt = $row1['COUNT(appt_telemarketer)'];
			echo "<tr><td>$tele_name</td><td align='center'>$tele_appt</td></tr>";
		}
		?>
        </table>
        <br />
        <table border="1px"><tr><th>Telemarketer</th><th>Today's & Tmr's Appts</th></tr>
		<?php		
		$sql2=mysql_query("SELECT *, COUNT(appt_telemarketer) FROM tbl_appointments, tbl_telemarketers WHERE (DATE(appt_date) = DATE(now()) OR DATE(appt_date) = DATE(now()+INTERVAL 1 DAY)) AND tbl_appointments.appt_telemarketer=tbl_telemarketers.telemarketer_id GROUP BY appt_telemarketer"); 
		
		// Print out result
		while($row2 = mysql_fetch_array($sql2)){
			$tele_name = $row2['telemarketer_name'];
			$tele_appt = $row2['COUNT(appt_telemarketer)'];
			echo "<tr><td>$tele_name</td><td align='center'>$tele_appt</td></tr>";
		}
		?>
        </table>
        </div>
    <hr />
    <!--Telemarketers-->
    <div align="center">
    <h3>Telemarketer List (click to <a href="manage_telemarketer.php">refresh</a>)</h3>
    <form action="fire_telemarketer.php" method="post">
    <table border="1px">
    <tr><th>Name</th><th>Mobile</th><th>Fire?</th></tr>
    	<?php
			$sql=mysql_query("SELECT * FROM tbl_telemarketers WHERE Fired=0");
			
			while($row=mysql_fetch_array($sql)) {
						$telemarketer_id = $row['telemarketer_id'];
						$telemarketer_name = $row['telemarketer_name'];
						$telemarketer_mobile = $row['tele_mobile'];
						
						echo "<tr><td>$telemarketer_name</td><td>$telemarketer_mobile</td><td align='center'><input type='submit' name='fire' value='$telemarketer_id' </td></tr>";
			}
		?>
        </table>
        </form>
    </div><hr />
    <div>
    </div>
</body>
</html>