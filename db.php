<?php
//dataBase.php
$db_location = "localhost";
$db_username = "cs4477210";
$db_password = "saibaba";
$db_database = "cs4477210";
$db_connection = mysql_connect("$db_location","$db_username","$db_password")
or die ("Error - Could not connect to MySQL Server");
$db = mysql_select_db($db_database,$db_connection)
 or die ("Error - Could not open database");
?>