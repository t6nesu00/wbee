<?php 
 require '../../resources/config.php';
    $id = $_GET["id"];
    $id1 = $_GET["id1"];

    $sql = "DELETE FROM questionTable WHERE id=$id";
    $stmt = $connect->query($sql);

?>

<script type="text/javascript">
    window.location = "edit_questions.php?id=<?php echo $id1; ?>";
</script>