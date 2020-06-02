<?php 
session_start();
$questionNo = $_GET["questionNo"];
$value1 = $_GET["value1"];
$_SESSION["answer"][$questionNo] = $value1;
?>