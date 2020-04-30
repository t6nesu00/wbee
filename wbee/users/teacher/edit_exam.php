<?php
	require '../../resources/config.php';
	if(empty($_SESSION['email']))
        header('Location: ../../login.php');
    
    $id = $_GET["id"];
    $sql = "SELECT * FROM exam_category WHERE id=$id";
    $edit = $connect->query($sql);
    while($row=$edit->fetch(PDO::FETCH_BOTH)){
        $exam_category =$row["category"];
        $exam_time = $row["exam_time_in_minutes"];
    }
?>

<?php 
 // inserting values in database
	if(isset($_POST['submit1'])) {
		$errMsg = '';

		// Get data from FORM
		$examname = $_POST['examname'];
    	$examtime = $_POST['examtime'];
    

		if($examname == "")
			$errMsg = 'Write the name of exam';
		if($examtime == "")
			$errMsg = 'Please give exam time in minutes';        

		if($errMsg == ""){
			try {
				$stmt = $connect->prepare("UPDATE exam_category SET category=:examname, exam_time_in_minutes=:examtime WHERE id='$id'");
				$stmt->execute(array(
					':examname' => $examname,
                      ':examtime' => $examtime,
					));

				header('Location: texam.php');
				exit;
			}
			catch(PDOException $errMsg) {
				echo $errMsg->getMessage();
			}
		}
	}
?>

<html>
<head><title>Organization Dashboard</title>
<!-- css links -->
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="tstyle.css">
</head>
	
<body style="background-color: orange;">
	<div>
		<?php include 'theader.php'; ?>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-3">
				<div class="wrapper">
    				<div class="sidebar">
        				<h2>Sidebar</h2>
        				<ul>
							<li><a href="teachers.php"><i class="fas fa-home"></i>Dashboard</a></li>
							<li><a href="texam.php"><i class="fas fa-diagnoses"></i>Exam</a></li>
							<li><a href="#"><i class="fas fa-star"></i>Scores</a></li>
        				</ul>
    				</div>
				</div>
			</div>
			<div class="col-9">
				<h3>Examination section</h3>
				<div class="row">
					<div class="col-6">
						<div class="card">
							<div class="card-header">
								<strong>Edit exam</strong>
							</div>
							<div class="card-body">
								<form name="form1" action="" method="post">
									<div class="form-group">
										<label for="exampleInputEmail1">New Exam Category</label>
										<input type="text" class="form-control" name="examname" placeholder="Add Exam Category" value="<?php echo $exam_category; ?>">
									</div>
									<div class="form-group">
										<label for="exampleInputPassword1">Exam Time</label>
										<input type="text" class="form-control" name="examtime" placeholder="Exam Time In Minutes" value = "<?php echo $exam_time; ?>">
									</div>
									<input type="submit" name="submit1" value="Update Exam" class="btn btn-success">
								</form>
							</div>
						</div>
					</div>
				</div>	
		</div>
	</div>
	<div class="footer-section">
		<?php include '../../includes/footer.php'; ?>
	</div>
	<!-- JS script for bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>