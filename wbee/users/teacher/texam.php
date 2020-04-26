<?php
	require '../../resources/config.php';
	if(empty($_SESSION['email']))
		header('Location: ../../login.php');
?>

<?php
	if(isset($_POST['submit'])) {
		$errMsg = '';

		// Get data from FORM
		$q1 = $_POST['questions'];
    	$q2 = $_POST['questions'];
    	$q3 = $_POST['questions'];
		$q4 = $_POST['questions'];
		$q5 = $_POST['questions'];

		if($q1 == '')
			$errMsg = 'Submit at least five questions';
		if($q2 == '')
			$errMsg = 'Submit at least five questions';
		if($q3 == '')
            $errMsg = 'Submit at least five questions';
		if($q4 == '')
			$errMsg = 'Submit at least five questions';
		if($q5 == '')
			$errMsg = 'Submit at least five questions';
		
        

		if($errMsg == ''){
			try {
				$stmt = $connect->prepare('INSERT INTO questionTable (questions, ans_id) VALUES (:q1, :q2, :q3, :q4, :q5)');
				$stmt->execute(array(
					':email' => $email,
          ':password' => $password,
					':role' => $role
					));
				header('Location: register.php?action=joined');
				exit;
			}
			catch(PDOException $e) {
				echo $e->getMessage();
			}
		}
	}

	if(isset($_GET['action']) && $_GET['action'] == 'joined') {
		$errMsg = '<p style="background-color: green"> Registration successful. Now you can <a href="login.php">login</a></p>';
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
				<h2>Examination section</h2>
				<form>
					<div class="form-group">
						<label for="q1">Subject</label>
						<input type="text" class="form-control" name="sub-name">
					</div>
					<div class="form-group">
						<label for="q1">Question 1</label>
						<input type="text" class="form-control" name="q1">
					</div>
					<div class="form-group">
						<label for="q1">Question 2</label>
						<input type="text" class="form-control" name="q2">
					</div>
					<div class="form-group">
						<label for="q1">Question 3</label>
						<input type="text" class="form-control" name="q3">
					</div>
					<div class="form-group">
						<label for="q1">Question 4</label>
						<input type="text" class="form-control" name="q4">
					</div>
					<div class="form-group">
						<label for="q1">Question 5</label>
						<input type="text" class="form-control" name="q5">
					</div>
					<button type="submit" class="btn btn-primary" name="submit">Submit</button>
				</form>
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
