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
<title>Call Centre 4 - Edit Appointment</title>
    
</head>

<div align="center">
<h3>Formatted Details</h3>
<?php
	$id = $_GET['id'];

$sql=mysql_query("SELECT * FROM tbl_appointments WHERE appt_id=$id");
			while($row=mysql_fetch_array($sql)) {
				$appt_name = $row['appt_name'];
				$appt_mobile = $row['appt_mobile'];
				$appt_address = $row['appt_address'];
				$appt_age = $row['appt_age'];
				$appt_remarks = $row['appt_remarks'];
				$appt_tele = $row['appt_telemarketer'];
				$appt_agent = $row['appt_agent'];
				$appt_datetime = $row['appt_date'];
						$appt_date = date("Y-n-d",strtotime($appt_datetime));
						$appt_time = date("H:i:s",strtotime($appt_datetime));
				if($row['appt_su']==1){
						$appt_su = "YES";
						$appt_su_cb = "checked";
				}
				else{
						$appt_su = "NO";
						$appt_su_cb = "";
				}
				echo "".$row['appt_name']."; ".$row['appt_mobile']."; ".$row['appt_address']."; ".$appt_time."; ".$row['appt_age']." years old; Spouse Upgrade: ".$appt_su."";
			}
?>
</div>
<hr />

<!--Edit Appointment-->
<div align="center">
<h3>Edit Appointment</h3>
<?php
echo "<form action='edit_appointment.php?id=$id' method='post'>";
?>
    	<table>
    	<tr><td>Prospect's Name: </td><td align="right"><input name="name" type="text" value="<?php echo $appt_name; ?>" /></td></tr>
        <tr><td>Prospect's Phone Number: </td><td align="right"><input name="mobile" type="text" value="<?php echo $appt_mobile; ?>" /></td></tr>
        <tr><td>Prospect's Age: </td><td align="right"><input name="age" type="text" value="<?php echo $appt_age; ?>" /></td></tr>
        <tr><td><br /></td></tr>
        <tr><td>Appointment Address: </td><td align="right"><input name="address" type="text" value="<?php echo $appt_address; ?>" /></td></tr>
        <tr><td>Appointment Date (YYYY-MM-DD): </td><td align="right"><input name="date" type="text" value="<?php echo $appt_date; ?>" /></td></tr>
        <tr><td>Appointment Time (HH:MM:SS): </td><td align="right"><input name="time" type="text" value="<?php echo $appt_time; ?>" /></td></tr>
        <tr><td>Spouse Upgrade? </td><td align="right"><input name="su" type="checkbox"<?php echo $appt_su_cb; ?> /></td></tr>
<tr><td>Appointment Remarks: </td><td align="right"><input type="text" name="remarks" value="<?php echo $appt_remarks ?>"></td></tr>
        <tr><td><br /></td></tr>
        <tr><td>Telemarketer: </td><td align="right"><select name="telemarketer">
        <?php
			$sql=mysql_query("SELECT * FROM tbl_telemarketers WHERE fired=0");
			while($row=mysql_fetch_array($sql)) {
						$tele_id = $row['telemarketer_id'];
						$tele_name = $row['telemarketer_name'];
						if($tele_id==$appt_tele)
                        echo "<option selected value=".$tele_id.">".$tele_name."</option>";
						else
						echo "<option value=".$tele_id.">".$tele_name."</option>";
			}
		?>
                                        </select></td></tr>
        <tr><td>Agent: </td><td align="right"><select name="agent">
        <?php
			$sql=mysql_query("SELECT * FROM tbl_agents WHERE agt_fired=0");
			while($row=mysql_fetch_array($sql)) {
						$agt_id = $row['agt_id'];
						$agt_name = $row['agt_name'];
						
						if($appt_agent==$agt_id)
                        echo "<option selected value=".$agt_id.">".$agt_name."</option>";
						else
						echo "<option value=".$agt_id.">".$agt_name."</option>";
			}
		?>
                                        </select></td></tr>
		<tr><td><br /><br /></td></tr>
        <tr><td>
        <FORM>
<INPUT TYPE="button" onClick="history.go(0)" VALUE="CLEAR">
</FORM>
</td><td align="right"><input type="submit" value="SUBMIT" /></td></tr>
        </table>
    </form>
</div>
<hr />

<?php 
// close connection 
mysql_close();
echo "<br>";
echo "<br>";
echo "<a href='manage_appointment.php'>Back to Database</a>";
?>