<?php 
require '../../resources/config.php';
    // Get data from FORM
    $id = $_GET["id"];  
    $status = $_POST['value'];
// inserting values in database
if(isset($_POST['action'])) {

        try {
            $stmt = $connect->prepare("UPDATE exam_category SET status=:status WHERE id='$id'");
            $stmt->execute(array(
                ':status' => $status,
                ));

        }
        catch(PDOException $errMsg) {
            echo $errMsg->getMessage();
        }
}

?>

<script>
    window.location="texam.php";
</script>