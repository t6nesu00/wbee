<?php
	require '../../resources/config.php';
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
	
<body>
	<div class="header-section">
		<?php include 'sheader.php'; ?>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-2">
				<div class="wrapper">
    				<div class="sidebar">
        				<h2>Sidebar</h2>
        				<ul>
							<li><a href="students.php"><i class="fas fa-home"></i>Dashboard</a></li>
							<li><a href="sexam.php"><i class="fas fa-diagnoses"></i>Exam</a></li>
							<li><a href="#"><i class="fas fa-star"></i>Scores</a></li>
        				</ul>
    				</div>
				</div>
			</div>
			<div class="col-sm-10">
				<div class="main-container">
					<h2>This is Dashboard for students</h2>
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
