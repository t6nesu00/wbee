<?php
	require '../../resources/config.php';
	if(empty($_SESSION['email']))
		header('Location: ../../login.php');
?>

<?php 
 // inserting values in database
	if(isset($_POST['submit1'])) {
		$errMsg = '';

		// Get data from FORM
		$streamName = $_POST['streamName'];
		$examname = $_POST['examname'];
    	$examtime = $_POST['examtime'];
    
		if($streamName == "") {
			$errMsg = 'Select one stream';
		}
		if($examname == "")
			$errMsg = 'Write the name of exam';
		if($examtime == "")
			$errMsg = 'Please give exam time in minutes';        

		if($errMsg == ""){
			try {
				$stmt = $connect->prepare('INSERT INTO exam_category (sCategory, category, exam_time_in_minutes) VALUES (:streamName, :examname, :examtime)');
				$stmt->execute(array(
					':examname' => $examname,
					  ':examtime' => $examtime,
					  ':streamName' => $streamName,
					));

				header('Location: texam.php?action=joined');
				exit;
			}
			catch(PDOException $e) {
				echo $e->getMessage();
			}
		}
	}
?>

<html>
<head>
<title>Organization Dashboard</title>
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
        				<?php include 'tsidebar.php'; ?>
    				</div>
				</div>
			</div>
			<div class="col-9">
				<h2>Examination section</h2>
				<!-- Form to add exam -->
				<div class="row">
						<div class="card" style = "background-color: #ffbf00;">
							<div class="card-header">
								<h4>Add new exam</h4>
							</div>
							<div class="card-body">
								<form name="form1" action="" method="post">
									<div class="form-group">
									<!--Dropdown for stream name fetched from database table-->
										<label for="facultyName">Stream/Faculty</label><br>
										<select name="streamName">
										 	<option>Select</option>
											 <?php 
											 $sql = "SELECT * FROM streams order by streamName ASC";
											 $sdata = $connect->query($sql);
												while($row = $sdata->fetch(PDO::FETCH_ASSOC)) {
													?>
													<option value="<?php echo $row["streamName"]; ?>"><?php echo $row["streamName"]; ?></option>
													<?php
												}
											 ?>
										</select>
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">Exam Name</label>
										<input type="text" class="form-control" name="examname" placeholder="Add Exam Category">
									</div>
									<div class="form-group">
										<label for="exampleInputPassword1">Exam Time</label>
										<input type="text" class="form-control" name="examtime" placeholder="Exam Time In Minutes">
									</div>
									<input type="submit" name="submit1" value="Add Exam" class="btn btn-success">
								</form>
							</div>
						</div>
				</div>
				<br>
				<!-- Table list of Exam -->
				<div>
  					<h6>Disabling exam is possible with update option in table!</h6>
				</div>
				<div class="row">
						<?php
						$count = 0;
						$sql = "SELECT * FROM exam_category";
						$data = $connect->query($sql);
						echo '<table class="table table-bordered">
						<thead>
							<tr>
							<th scope="col">#</th>
							<th scope="col">Stream</th>
							<th scope="col">Exam Name</th>
							<th scope="col">Exam Time</th>
							<th scope="col">Update</th>
							<th scope="col">Delete</th>
							<th scope="col">Status</th>
							</tr>
						</thead>';
						
						foreach($data as $row)
								{
									$count=$count+1;
									echo ' 
									<tr>
										<th scope="row">'.$count.'</th>
										<td>'.$row["sCategory"].'</td>
										<td>'.$row["category"].'</td>
										<td>'.$row["exam_time_in_minutes"].'</td>
										<td><a href="edit_exam.php?id='.$row["id"].'">Update</a></td>
										<td><a href="delete.php?id='.$row["id"].'">Delete</a></td>
										<td id="actionStatus">'.$row["status"].'</td>
									</tr>';
								}
								echo '</table>';
						?>
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