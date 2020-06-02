<?php 

include '../resources/config.php';

$total_question = 0;
$sql = "SELECT * FROM questionTable WHERE category='$_SESSION[exam_category]'";
$stmt = $connect->query($sql);
$total_question = $stmt->rowCount();
echo $total_question;
?>