<?php
	include '../../resources/config.php';
?>

<html>
<head><title>Organization Dashboard</title>
<!-- css links -->
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="sstyle.css">
</head>

<body style="background-color: orange">
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
			<center>
			<h1>Your exam results</h1>

			</center>
			
				<?php 
				 $count = 0;
				 $sql = "SELECT * FROM exam_result WHERE email = '$_SESSION[email]' ORDER BY id DESC";
				 $stmt = $connect->query($sql);
				 $count = $stmt->rowCount();
				 if($count == 0) 
				 {
					 ?> 
					 <center>
						<h1>No results available</h1>
					</center>
					 <?php
				 }
				 else {
					 echo "<table class='table table-striped table-borderdered'>";
					 echo "<tr>";
					 echo "<th>"; echo "Exam"; echo "<th>";
					 echo "<th>"; echo "Total Questions"; echo "<th>";
					 echo "<th>"; echo "Correct Answers"; echo "<th>";
					 echo "<th>"; echo "Wrong Answers"; echo "<th>";
					 echo "<th>"; echo "Date"; echo "<th>";
					 echo "<tr>";
					 while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
						echo "<tr>";
					 	echo "<td>"; echo $row["exam_type"]; echo "<td>";
					 	echo "<td>"; echo $row["total_question"]; echo "<td>";
					 	echo "<td>"; echo $row["correct_answer"]; echo "<td>";
					 	echo "<td>"; echo $row["wrong_answer"]; echo "<td>";
					 	echo "<td>"; echo $row["exam_time"]; echo "<td>";
					 	echo "<tr>";
					 }
					 echo "</table>";
				 }
				?>
            </div>
            
        </div>
    </div>
</div>

<div class="footer">
	<?php include '../../includes/footer.php'; ?>
</div>
</body>
</html>
