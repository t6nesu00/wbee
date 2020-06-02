<?php
	include '../../resources/config.php';
	if(empty($_SESSION['email']))
		header('Location: ../../login.php');
?>

<html>
<head><title>Organization Dashboard</title>
<!-- css links -->
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="sstyle.css">
</head>
<div>
	<?php include "sheader.php"; ?>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <?php include 'ssidebar.php'; ?>
        </div>
        <div class="col-sm-9">
            <div class="container">
                <?php 
                $sql = "SELECT * FROM exam_category";
                $stmt = $connect->query($sql);
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <input type="button" class="btn btn-success form-control" value="<?php echo $row["category"]; ?>" style="margin-top: 10px;" onclick="set_exam_session(this.value);">
                    <?php
                } 
                ?>
            </div>
            <br><br>
            <div class="row">
                <div class="col-sm-12">
                <?php include 'instruction.php'; ?>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="footer">
	<?php include '../../includes/footer.php'; ?>
</div>



<script type="text/javascript">
    function set_exam_session(exam_category)
    {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            window.location = "dashboard.php";
      }

        };
        xmlhttp.open("GET","../../ajax/set_exam_session.php?exam_category="+ exam_category,true);
        xmlhttp.send(null);
    }
</script>

</html>
