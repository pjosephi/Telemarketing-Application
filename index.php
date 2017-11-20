<?php

include "db_conn.php";

// Connect to server and select database.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Call Centre 4</title>
</head>

<body>
	<div align="center">
    	<h1>Appointment Submission Form</h1>
        <h3>Please ensure all information is correct before submission!</h3>
    </div>
    <hr />
    <div align="center">
    <form action="submit.php" method="post">
    	<table>
    	<tr><td>Prospect's Name: </td><td align="right"><input name="name" type="text" /></td></tr>
        <tr><td>Prospect's Phone Number: </td><td align="right"><input name="mobile" type="text" /></td></tr>
        <tr><td>Prospect's Age: </td><td align="right"><input name="age" type="text" /></td></tr>
        <tr><td><br /></td></tr>
        <tr><td>Appointment Address: </td><td align="right"><input name="address" type="text" /></td></tr>
        <tr><td>Appointment Date: </td><td align="right"><select name="date">
        	<option value="today">Today</option>
            <option value="tmr">Tomorrow</option>
            </select></td></tr>
        <tr><td>Appointment Time: </td><td align="right"><input name="time" type="time" /></td></tr>
        <tr><td>Spouse Upgrade? </td><td align="right"><input name="su" type="checkbox" /></td></tr>
<tr><td>Appointment Remarks: </td><td align="right"><input type="text" name="remarks"></td></tr>
        <tr><td><br /></td></tr>
        <tr><td>Telemarketer: </td><td align="right"><select name="telemarketer">
        <?php
			$sql=mysql_query("SELECT * FROM tbl_telemarketers WHERE fired=0");
			while($row=mysql_fetch_array($sql)) {
						$tele_id = $row['telemarketer_id'];
						$tele_name = $row['telemarketer_name'];
                        echo "<option value='".$tele_id."'>".$tele_name."</option>";
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
</body>
</html>