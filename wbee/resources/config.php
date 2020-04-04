<?php

session_start();

//define database
define('dbhost','localhost');
define('dbuser','root');
define('dbpass',''); // mysql for Ampps
define('dbname','dbwbee');

// connecting to database
try {
	$connect = new PDO("mysql:host=".dbhost."; dbname=".dbname, dbuser, dbpass);
	$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
	echo $e->getMessage();
}

?>
