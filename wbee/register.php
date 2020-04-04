<?php
	require './resources/config.php';

	if(isset($_POST['register'])) {
		$errMsg = '';

		// Get data from FORM
		$email = $_POST['email'];
		$password= $_POST['password'];
    $password = $_POST['password'];
    $rpassword = $_POST['rpassword'];
		$userRole = $_POST['userRole'];

		if($email == '')
			$errMsg = 'Give your email address';
		if($password == '')
			$errMsg = 'Enter password';
		if($rpassword == '')
            $errMsg = 'Please confirm the password';
    if($password != $rpassword)
            $errMsg = 'Password did not match';
		if($userRole == '')
			$errMsg = 'Who you are, Student? or Teacher?';
		
        

		if($errMsg == ''){
			try {
				$stmt = $connect->prepare('INSERT INTO students (email, password, role) VALUES (:email, :password, :userRole)');
				$stmt->execute(array(
					':email' => $email,
					':password' => $password,
					':userRole' => $userRole
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>
    <header>
        <?php 
        include('./includes/header.php');
        ?>
    </header>

    <div class="container">
    <div class="row mx-auto">
      <div class="col-lg-6 mx-auto">
        <div class="card card-body mt-5">
          <?php if(isset($result)) echo $result; ?>
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
                <input class="form-check-input" type="radio" name="userRole" id="exampleRadios1" value="stuents" checked>
                <label class="form-check-label" for="student-radio">
                  Student
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="userRole" id="exampleRadios2" value="teachers">
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
</body>
</html>