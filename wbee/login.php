<?php
	
	require './resources/config.php';

	if(isset($_POST['login'])) {
		$errMsg = '';
		// Get data from FORM
		$email = $_POST['email'];
		$password = $_POST['password'];
		//user type selection
		$role = $_POST['role'];
		if($email == '')
			$errMsg = 'Enter email first';
		if($password == '')
			$errMsg = 'Give your password';
		// for user type
		if($role == '')
			$errMsg = 'Who are you? Student or Teache?';
		if($errMsg == '') {
			try {
				$stmt = $connect->prepare('SELECT * FROM students WHERE email = :email');
				$stmt->execute(array(
					':email' => $email
					));
				$data = $stmt->fetch(PDO::FETCH_ASSOC);
				if($data == false){
					$errMsg = "User $email not found.";
				}
				else {
					// password_verify(password_from_user, password_from_database)
					if(password_verify($password, $data['password']) && $role == $data['role']) {
						$_SESSION['email'] = $data['email'];
						$_SESSION['password'] = $data['password'];
						$_SESSION['role'] = $data['role'];

						if($data['role'] == 'students') {
							header('Location: users/student/students.php');
						}
						elseif($data['role'] == 'teachers'){
							header('Location: users/teacher/teachers.php');
						}
						exit;
					}
					else
						$errMsg = 'Something went wrong.';
				}
			}
			catch(PDOException $e) {
				$errMsg = $e->getMessage();
			}
		}
	}
?>

<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="./css/style.css">
	<!-- css link for boostrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body style="background-color: orange;">

    <?php
	    include './includes/header.php';
	?>

	<div class="container">
		<?php
			if(isset($errMsg)){
				echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';
			}
		?>
    	<div class="row mx-auto">
      		<div class="col-lg-6 mx-auto">
        		<div class="card card-body mt-5" style = "background-color: #ffbf00;">
          			<?php if(isset($errMsg)) echo "<font color='red'>" .$errMsg. "</font>"; ?>
          			<h4>Login</h4>
          			<div class="card-text">Fill in the form to Login.</div>
					<form action="" method="post" class="form-signin my-5">
						<div class="form-group">
							<label>Email</label><br>
							<input type="text" name="email" class="form-control" value="<?php if(isset($_POST['email'])) echo $_POST['email'] ?>" autocomplete="off" class="box"/>
						</div>
							
						<div class="form-group">
							<label>Password</label><br>
							<input type="password" name="password" class="form-control" value="<?php if(isset($_POST['password'])) echo $_POST['password'] ?>" autocomplete="off" class="box" />
						</div>
								
						<div class="form-group">
							<label for="role">I am: </label> &emsp;	
							<input type="radio" name="role" value="students" class="radio-custome" required> &nbsp;Student 
							<input type="radio" name="role" value="teachers" class="radio-custome" required> &nbsp;Teacher 
						</div>
								
						<div class="form-label-group">
							<input type="submit" name='login' value="Login" class="btn btn-lg btn-block btn-success"/>
						</div>
                        <br>
						<div class="back">
                            <a href="index.php">Back to home page</a>
                            <a href="#" style="float:right;">Forget Password!</a>
						</div>
						
					</form>
            	</div>
        	</div>
    	</div>
    </div>
    <footer>
        <?php 
            include('./includes/footer.php');
        ?>
    </footer>

	<!-- Javascript plugins for bootstrap 4 -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
