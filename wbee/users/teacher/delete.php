<?php 
require '../../resources/config.php';
$id=$_GET["id"];
$sql = "DELETE FROM exam_category WHERE id=$id";
$del = $connect->query($sql);

?>

<script>
    window.location="texam.php";
</script>