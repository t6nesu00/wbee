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


<body style="background-color: orange;">
<div>
	<?php include "sheader.php"; ?>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <?php include 'ssidebar.php'; ?>
        </div>
        <div class="col-sm-9">
            <div class="container d-flex align-content-aruond flex-wrap">
                <?php 

                $sql = "SELECT * FROM exam_category WHERE FIND_IN_SET('$_SESSION[name]', student)"; 

                // $sql = "SELECT * FROM exam_category WHERE status = 'Enable' OR status is NULL AND FIND_IN_SET('$_SESSION[name]', student)";
                $stmt = $connect->query($sql);
                $count = $stmt->rowCount();
                if($count == 0) {
                    echo "No exam available for you at the moment $_SESSION[name]";
                    
                }
                else{
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <div class="card" style="width: 250px; background-color: #ffbf00;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row["category"]?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?php echo $row["exam_time_in_minutes"]?> minutes</h6>
                            <p class="card-text">Try to finish examination on time.</p>
                            <!--<a href="#" class="card-link">Card link</a>-->
                            <button type="button" class="btn btn-success" value="<?php echo $row["category"]; ?>" style="margin-top: 10px;" onclick="set_exam_session(this.value);">Start Exam</button>
                        </div>
                        </div>
                        <!-- <input type="button" class="btn btn-success form-control" value="( category display here in php tag)" style="margin-top: 10px;" onclick="set_exam_session(this.value);">             -->
                        <?php
                    } 
                }
                
                ?>
            </div>
            <br><br>
            <div class="row">
                <div class="col-sm-12">
                    <div class="container">
                        <?php include 'instruction.php'; ?>
                    </div>
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

</body>
</html>
