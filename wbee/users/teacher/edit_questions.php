<?php
	require '../../resources/config.php';
	if(empty($_SESSION['email']))
        header('Location: ../../login.php');
    
    // to display exam category name
    $id = $_GET["id"];
    $exam_category = '';
    $sql = "SELECT * FROM exam_category WHERE id=$id";
    $stmt= $connect->query($sql);
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
                            while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
                                $exam_category = $row["category"];
                            }
                                // Get data from FORM
                            $question = $_POST['question'];
                            $opt1 = $_POST['opt1'];
                            $opt2 = $_POST['opt2'];
                            $opt3 = $_POST['opt3'];
                            $opt4 = $_POST['opt4'];
                            $answer = $_POST['answer'];

                            $count = 0;
                                try {
                                    
                                    $stmt = $connect->prepare('INSERT INTO questionTable VALUES 
                                    (:count, :question, :opt1, :opt2, :opt3, :opt4, :answer, :exam_category)');
                                    $stmt->execute(array(
                                        ':id' => $id
                                        ));
                                    header('Location: questions.php');
                                    exit;
                                }
                                catch(PDOException $e) {
                                    echo $e->getMessage();
                                }
                        
                        }
                    
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