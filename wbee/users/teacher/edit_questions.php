<?php
	require '../../resources/config.php';
	if(empty($_SESSION['email']))
        header('Location: ../../login.php');
    
    // to display exam category name
	$id = $_GET["id"];
    $exam_category = '';
    $sql = "SELECT * FROM exam_category WHERE id=$id";
    $stmt = $connect->query($sql);
    while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
        $exam_category = $row["category"];
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
        				<?php include 'tsidebar.php'; ?>
    				</div>
				</div>
			</div>
			<div class="col-9">
            <div class="card">
                <div class="card-header">
                    Add question inside <?php echo "<font color='red'>" .$exam_category. "</font>"; ?>                                                                                                                                             
                </div>
                <div class="card-body">
                <div class="col-12">
						<div class="card">
							<div class="card-header">
								<strong>Add New Questions</strong>
							</div>
							<div class="card-body">
								<form name="form1" action="" method="post">
									<div class="form-group">
										<label for="exampleInputEmail1">Add Question</label>
										<input type="text" class="form-control" name="question" placeholder="Add Question">
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">Add First Option</label>
										<input type="text" class="form-control" name="opt1" placeholder="First option">
									</div>
                                    <div class="form-group">
										<label for="exampleInputEmail1">Add Second Option</label>
										<input type="text" class="form-control" name="opt2" placeholder="Second option">
									</div>
                                    <div class="form-group">
										<label for="exampleInputEmail1">Add Third Option</label>
										<input type="text" class="form-control" name="opt3" placeholder="Third option">
									</div>
                                    <div class="form-group">
										<label for="exampleInputEmail1">Add Fourth Option</label>
										<input type="text" class="form-control" name="opt4" placeholder="Fourth option">
									</div>
                                    <div class="form-group">
										<label for="exampleInputEmail1">Add Correct Answer</label>
										<input type="text" class="form-control" name="answer" placeholder="Correct Answer">
									</div>
									<input type="submit" name="submit1" value="Add Question" class="btn btn-success">
								</form>
							</div>
						</div>
					</div>
                    <?php 
    
                        if(isset($_POST['submit1']))
                        {
                            
                            // Get data from FORM
                            $question = $_POST['question'];
                            $opt1 = $_POST['opt1'];
                            $opt2 = $_POST['opt2'];
                            $opt3 = $_POST['opt3'];
                            $opt4 = $_POST['opt4'];
                            $answer = $_POST['answer'];

							 $loop = 0;
								 $count = 0;
								 
								 $sql = "SELECT * FROM questionTable WHERE category='$exam_category' ORDER BY id ASC";
								 $stmt = $connect->query($sql);
								 $count = $stmt->rowCount();

								 if($count = 0)
								 {

								 }
								 else {
									 while($row = $stmt->fetch())
									 {
										 $loop = $loop + 1;
										 $connect->query("UPDATE questionTable SET question_no='$loop' WHERE id=$row[id]");
									 }
								 }

								 $loop = $loop + 1;
								 $pdoQuery = "INSERT INTO questionTable(question_no, question, opt1, opt2, opt3, opt4, answer, category) 
								 VALUES ('$loop', :question, :opt1, :opt2, :opt3, :opt4, :answer, '$exam_category')";
								 $pdo_run = $connect->prepare($pdoQuery);
								 $pdo_exec = $pdo_run->execute(array(
									':question' => $question, 
									':opt1' => $opt1,
									 ':opt2' => $opt2,
									 ':opt3' => $opt3,
									 ':opt4' => $opt4,
									 ':answer' => $answer
								 ));

								 if($pdo_run) {
										echo "Question added successfully.";
								 } else {
									 echo "Something wrong, try again.";
								 }
								                         
                        }
                    
                    ?>
	
                </div>
			
			<div class="card">
				<div class="card-body">
				<table class="table table-bordered">
						<tr>
							<th>No</th>
							<th>Question</th>
							<th>Option 1</th>
							<th>Option 2</th>
							<th>Option 3</th>
							<th>Option 4</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
				
				
				<?php 

					$sql = "SELECT * FROM questionTable WHERE category='$exam_category' ORDER BY question_no ASC";
					$sql_run = $connect->query($sql);
					while($row=$sql_run->fetch(PDO::FETCH_ASSOC)) 
					{
						echo "<tr>";
						echo "<td>"; echo $row["question_no"]; echo "</td>";
						echo "<td>"; echo $row["question"]; echo "</td>";
						echo "<td>"; echo $row["opt1"]; echo "</td>";
						echo "<td>"; echo $row["opt2"]; echo "</td>";
						echo "<td>"; echo $row["opt3"]; echo "</td>";
						echo "<td>"; echo $row["opt4"]; echo "</td>";
						// Edit option starts
						echo "<td>"; 	
							?>
							<a href="edit_option.php?id=<?php echo $row["id"]; ?>&id1=<?php echo $id; ?>">Edit</a>
							<?php
						echo "</td>";
						// Edit option starts

						// delete option starts
						echo "<td>"; 
							?>
							<a href="delete_option.php?id=<?php echo $row["id"]; ?>&id1=<?php echo $id; ?>">Delete</a>
							<?php	
						echo "</td>";
						// delete option starts
						echo "</tr>";
					}
				?>
				</table>
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