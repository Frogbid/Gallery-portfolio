<?php
$db_host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'portfolio';
$con = mysqli_connect($db_host, $db_user, $db_password, $db_name);
if ($con) {
	//echo 'Connection Successfull';
} else {
	//echo "Connection Error";
}
