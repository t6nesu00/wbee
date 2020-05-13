<?php
	require '../../resources/config.php';
	
?>

<?php

$id = $_GET["id"];
// id for exam category
$id1 = $_GET["id1"];
$question = "";
$opt1 = "";
$opt2 = "";
$opt3 = "";
$opt4 = "";
$answer = "";

$sql = "SELECT * FROM questionTable WHERE id=$id";
$stmt = $connect->query($sql);
while($row=$stmt->fetch(PDO::FETCH_ASSOC)) 
{
    $question = $row["question"];
    $opt1 = $row["opt1"];
    $opt2 = $row["opt2"];
    $opt3 = $row["opt3"];
    $opt4 = $row["opt4"];
    $answer = $row["answer"];
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
                    Upadate question
                </div>
                <div class="card-body">
                <form name="form1" action="" method="post">
					<div class="form-group">
						<label for="exampleInputEmail1">Add Question</label>
						<input type="text" class="form-control" name="question" placeholder="Add Question" value="<?php echo $question; ?>">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Add First Option</label>
						<input type="text" class="form-control" name="opt1" placeholder="First option" value="<?php echo $opt1; ?>"> 
					</div>
                    <div class="form-group">
						<label for="exampleInputEmail1">Add Second Option</label>
						<input type="text" class="form-control" name="opt2" placeholder="Second option" value="<?php echo $opt2; ?>">
					</div>
                    <div class="form-group">
						<label for="exampleInputEmail1">Add Third Option</label>
						<input type="text" class="form-control" name="opt3" placeholder="Third option" value="<?php echo $opt3; ?>">
					</div>
                    <div class="form-group">
						<label for="exampleInputEmail1">Add Fourth Option</label>
						<input type="text" class="form-control" name="opt4" placeholder="Fourth option" value="<?php echo $opt4; ?>">
					</div>
                    <div class="form-group">
						<label for="exampleInputEmail1">Add Correct Answer</label>
						<input type="text" class="form-control" name="answer" placeholder="Correct Answer" value="<?php echo $answer; ?>">
					</div>
						<input type="submit" name="submit1" value="Update Question" class="btn btn-success">
				</form>
                </div>
            </div>
		</div>
	</div>
    <!-- Update query starts -->
    <?php 
    
    if(isset($_POST['submit1'])) 
    {
		$errMsg = '';

		// Get data from FORM
		$question = $_POST['question'];
        $opt1 = $_POST['opt1'];
        $opt21 = $_POST['opt2'];
        $opt3 = $_POST['opt3'];
        $opt4 = $_POST['opt4'];
        $answer = $_POST['answer'];
    

		try {
			$stmt = $connect->prepare("UPDATE questionTable SET question=:question, opt1=:opt1, opt2=:opt2, opt3=:opt3, opt4=:opt4, answer=:answer WHERE id='$id'");
			$stmt->execute(array(
				':question' => $question,
                ':opt1' => $opt1,
                ':opt2' => $opt2,
                ':opt3' => $opt3,
                ':opt4' => $opt4,
                ':answer' => $answer,
				));
                ?> 
                <script type="text/javascript">
                window.location = "edit_questions.php?id=<?php echo $id1 ?>"
                </script>
            <?php
				//header('Location: edit_questions.php');
				exit;
			}
			catch(PDOException $errMsg) {
				echo $errMsg->getMessage();
            }
            
	}
	

    ?>
    <!-- Update query ends -->
	<div class="footer-section">
		<?php include '../../includes/footer.php'; ?>
	</div>
	<!-- JS script for bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>