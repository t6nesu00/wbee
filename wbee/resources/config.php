<?php

//session_start();
// this helps to remove error message regarding session already started issue
if(session_status() !== PHP_SESSION_ACTIVE) {session_start();}

//define database
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "dbwbee";

// connecting to database
try {
	$connect = new PDO("mysql:host=$dbhost; dbname=$dbname", $dbuser, $dbpass);
	$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $error) {
	$message = $error->getMessage();
}

?>
