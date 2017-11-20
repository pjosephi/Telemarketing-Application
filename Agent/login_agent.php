<?php

include "../db_conn.php";

// Connect to server and select database.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

$error = $_GET['error'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Call Centre 4 - Agent Login</title>
</head>

<body>
	<div align="center">
    	<h1>Agent Login</h1>
        <?php echo "<h3>$error</h3>"; ?>
    <form action="login.php" method="post">
    	<table>
    	<tr><td>Username: </td><td align="right"><input name="user" type="text" /></td></tr>
        <tr><td>Password: </td><td align="right"><input name="pass" type="password" /></td></tr>
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