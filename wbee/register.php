<?php
	require './resources/config.php';

	if(isset($_POST['register'])) {
		$errMsg = '';

		// Get data from FORM
		$email = $_POST['email'];
    $password = $_POST['password'];
    $rpassword = $_POST['rpassword'];
		$role = $_POST['role'];

		if($email == '')
			$errMsg = 'Give your email address';
		if($password == '')
			$errMsg = 'Enter password';
		if($rpassword == '')
            $errMsg = 'Please confirm the password';
    if($password != $rpassword)
            $errMsg = 'Password did not match';
		if($role == '')
			$errMsg = 'Who you are, Student? or Teacher?';
		
        

		if($errMsg == ''){
			try {
				$stmt = $connect->prepare('INSERT INTO students (email, password, role) VALUES (:email, :password, :role)');
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
		$errMsg = '<p style="background-color: #f4f0e9; text-align: center;"> Registration successful. Now you can <a href="login.php">login</a></p>';
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body style="background-color: orange;">
    <header>
        <?php 
        include('./includes/header.php');
        ?>
    </header>

    <div class="container">
    <div class="row mx-auto">
      <div class="col-lg-6 mx-auto">
        <div class="card card-body mt-5" style = "background-color: #ffbf00;">
          <?php if(isset($errMsg)) echo "<font color='red'>" .$errMsg. "</font>"; ?>
          <h4>Register</h4>
          <div class="card-text">Fill all the forms to register.</div>
          <form method='post' action="register.php">
              <div class="form-group">
                <label for="emailForReg">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Enter email">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="exampleInputEmail1" name="password" placeholder="Password">
              </div>
              <div class="form-group">
                <label for="confirm-password">Confirm password</label>
                <input type="password" class="form-control" id="exampleInputEmail1" name="rpassword" placeholder="Confirm password">
              </div>
              <div class="form-group">
                <div class="form-check">
                <input class="form-check-input" type="radio" name="role" id="exampleRadios1" value="students" checked>
                <label class="form-check-label" for="student-radio">
                  Student
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="role" id="exampleRadios2" value="teachers">
                <label class="form-check-label" for="teacher-radio">
                    Teacher
                </label>
              </div>  
              </div>
              <button type="submit" name='register' value="Register" class="btn btn-success">Register</button>
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

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>