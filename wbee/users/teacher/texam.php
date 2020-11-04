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
		// combine selected batchs option into comma seperated string
		$string_batch = implode(', ', $_POST['batch']);
		// combine all selected names option into comma seperated string
		$string_name = implode(',', $_POST['student_name']);

		foreach($studentName as $value) 
		{
			$name = $value;
		}
	
    
		if($streamName == "") {
			$errMsg = 'Select one stream';
		}
		if($examname == "")
			$errMsg = 'Write the name of exam';
		if($examtime == "")
			$errMsg = 'Please give exam time in minutes';        

		if($errMsg == ""){
			try {
				$stmt = $connect->prepare('INSERT INTO exam_category (sCategory, category, exam_time_in_minutes, batch, student) VALUES (:streamName, :examname, :examtime, :string_batch, :string_name)');
				$stmt->execute(array(
					':examname' => $examname,
					  ':examtime' => $examtime,
					  ':streamName' => $streamName,
					  ':string_batch' => $string_batch,
					  ':string_name' => $string_name
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

<?php 
$count = 0;
$sql = "SELECT * FROM exam_category";
$data = $connect->query($sql);
$count = $data->rowCount();
?>

<html>
<head>
<title>WebBasedExam</title>
<!-- css links -->
    <link rel="stylesheet" href="../../css/style.css">
	<link rel="stylesheet" href="tstyle.css">
	
	<!-- sources for datatable -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
	<!-- sources for datatable -->

  	<!-- multiselect -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
	<!-- multiselect -->
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
				<!-- Form to add exam -->
				<div class="row">
						<div class="card" style = "background-color: #ffbf00;">
							<div class="card-header">
								Fill the form to create new exam
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
										<input type="text" class="form-control" name="examname" placeholder="Exam name">
									</div>
									<div class="form-group">
										<label for="exampleInputPassword1">Exam Time</label>
										<input type="text" class="form-control" name="examtime" placeholder="Exam Time In Minutes">
									</div>
									<div class="form-group">
									<!--Dropdown for stream name fetched from database table-->
										<label for="batchName">Batch</label><br>
										<select id="batch" name="batch[]" multiple="multiple">
											 <?php
											 $query = "SELECT * FROM batch ORDER BY batchNo ASC";
											 $statement = $connect->prepare($query);
											 $statement->execute();
											 $result = $statement->fetchAll();
											 foreach($result as $row){
												 echo '<option value="'.$row["batchNo"].'">'.$row["batchNo"].'</option>';
											 }
											 ?>
											 
										</select>
									</div>
									<div class="form-group">
									<!--Dropdown for stream name fetched from database table-->
										<label for="students">Students</label><br>
										<select id="students" name="student_name[]" multiple="multiple">
										 	
										</select>	
									</div>
									<input type="submit" name="submit1" value="Add Exam" class="btn btn-success">
								</form>
								
							</div>
						</div>
				</div>
				<br>
				<!-- Table list of Exam -->
				<div>
  					<h6 style="color:red;">Disabling exam is possible from Update button</h6>
					<div class="card" style = "background-color: #ffbf00; width: 100%">
						<div class="card-header">
							Exam List
						</div>
						<div class="card-body">
									
							<div class="table-responsive">  
								<table id="myTable" class="table table-striped table-bordered">  
									<thead style="background-color: #292a3e; color: white">  
										<tr>  
											<th>#</th>  
											<th>Stream</th> 
											<th>Subject</th> 
											<th>Time</th> 
											<th>Action</th>
											<th>For</th> 
											<th>Status</th>   
										</tr>  
									</thead>  
									<?php 
									$serialNum = 0;
									if($count == 0){
										echo 'No list yet';
									} else 
									{
										foreach($data as $row)  
									{  
										$serialNum = $serialNum+1;
										echo '  
										<tr>  
										<th scope="row">'.$serialNum.'</th>
										<td>'.$row["sCategory"].'</td>
										<td>'.$row["category"].'</td>
										<td>'.$row["exam_time_in_minutes"].'</td>
										<td><a href="edit_exam.php?id='.$row["id"].'">Update</a> |
										<a href="delete.php?id='.$row["id"].'">Delete</a></td>
										<td>'.$row["student"].'</td>
										<td id="actionStatus">'.$row["status"].'</td> 
										</tr>  
										';  
									}
									}
										
									?>  
								</table>  
							</div>
						</div>
					</div> 
					
				</div>
				<br><br><br><br>
			</div>	
		</div>
	</div>
	
	<div class="footer-section">
		<?php include '../../includes/footer.php'; ?>
	</div>
	
</body>

<script>  
 $(document).ready( function () {
    $('#myTable').DataTable(
		{
			
		}
	);
} );
 </script>
<!--initialize multiselect jquery box-->
 <script>
 $(document).ready(function(){
	$('#batch').multiselect({
		nonSelectedText: 'Select batch',
		onChange: function(option, checked) {
			var selected = this.$select.val();
			if(selected.length > 0) {
				$.ajax({
					url:"../../ajax/fetch_students.php",
					method: "POST",
					data: {selected:selected},
					success: function(data)
					{
						$('#students').html(data);
						$('#students').multiselect('rebuild');
					}
				})
			}
		}
		
	});
	$('#students').multiselect({
		includeSelectAllOption: true,
		nonSelectedText: 'Select Batch First'
	});
 });
 </script>
</html>

