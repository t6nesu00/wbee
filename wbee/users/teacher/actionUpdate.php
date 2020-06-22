<?php 
require '../../resources/config.php';
$id=$_GET["id"];

try {
    $status = $_POST['value'];
    	

    $stmt = $connect->prepare("UPDATE exam_category SET status=:value WHERE id='$id'");
    $stmt->execute(array(
        ':value' => $status,
        ));

    header('Location: texam.php');
    exit;
}
catch(PDOException $errMsg) {
    echo $errMsg->getMessage();
}

?>

<script>
    window.location="texam.php";
</script>