<?php
include "../resources/config.php";
$exam_category=$_GET["exam_category"];
$_SESSION["exam_category"]=$exam_category;

$sql = "SELECT * FROM exam_category WHERE category = '$exam_category'";
$stmt = $connect->query($sql);
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $_SESSION["exam_time"] = $row["exam_time_in_minutes"];
}

date_default_timezone_set('Europe/Helsinki');
$date = date("Y-m-d H:i:s");
$_SESSION["end_time"]=date("Y-m-d H:i:s", strtotime($date . "+$_SESSION[exam_time] minutes"));
$_SESSION["exam_start"]="yes";
?>


