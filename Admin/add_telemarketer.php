<?php

include "../db_conn.php";

// Connect to server and select database.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");
	
	$name = $_POST['tele_name'];
	$mobile = $_POST['tele_mobile'];

// Insert data into mysql 
$sql="INSERT INTO tbl_telemarketers(telemarketer_name, tele_mobile, fired)VALUES('$name', '$mobile', 0)";
$result=mysql_query($sql);

// if successfully insert data into database, displays message "Successful". 
if($result){
echo "<div align='center'>";
echo "<h3 align='center'>SUCCESSFUL</h3>";
echo "<BR>";
echo "<a href='manage_telemarketer.php'>Back to form</a>";
echo "</div>";
}

else {
echo "<div align='center'>";
echo "<h3 align='center'>DATABASE ERROR</h3>";
echo "<h3 align='center'>PLESE CHECK THAT YOU HAVE FILLED IN THE FORM CORRECTLY</h3>";
echo "<BR>";
echo "<a href='manage_telemarketer.php'>Back to form</a>";
echo "</div>";
}
?> 

<?php 
// close connection 
mysql_close();
?>