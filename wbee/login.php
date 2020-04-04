<?php
require './resources/config.php';

if(isset($_POST['login'])) {
    $errMsg = '';
    // Get data from FORM
    $email = $_POST['email'];
    $password = $_POST['password'];
    //user type selection
    $userRole = $_POST['userRole'];
    if($email == '')
        $errMsg = 'Enter username';
    if($password == '')
        $errMsg = 'Enter password';
    // for user type
    if($userRole == '')
        $errMsg = 'Who are you, students or teacher?';
    if($errMsg == '') {
        try {
            $stmt = $connect->prepare('SELECT id, email, password, role FROM students WHERE email = :email');
            $stmt->execute(array(
                ':email' => $email
                ));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if($data == false){
                $errMsg = "User $username not found.";
            }
            else {
                if($password == $data['password'] && $userRole == $data['role']) {
                    $_SESSION['email'] = $data['email'];
                    $_SESSION['password'] = $data['password'];
                    $_SESSION['userRole'] = $data['role'];

                    if($data['userRole'] == 'students') {
                        header('Location: users/students/students.php');
                    }
                    elseif($data['userRole'] == 'teachers'){
                        header('Location: users/teacher/teacher.php');
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
            <h4>Login</h4>
            <div class="card-text">Fill all the forms to register.</div>
            <?php
            if ($login_error_message != "") {
                echo '<div class="alert alert-danger"><strong>Error: </strong> ' . $login_error_message . '</div>';
            }
            ?>
            <form action="index.php" method="post">
                <div class="form-group">
                    <label for="">Username/Email</label>
                    <input type="text" name="username" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control"/>
                </div>

                <div class="form-label-group">
						<label for="usertype">I am: </label>&nbsp;&nbsp;&nbsp;
						<input type="radio" name="userRole" value="students" class="radio-custome" required> &nbsp;Student |
						<input type="radio" name="userRole" value="teachers" class="radio-custome" required> &nbsp;Teacher |
					</div>
					
					<div class="form-label-group">
						<input type="submit" name='login' value="Login" class="btn btn-lg btn-block btn-primary"/>
					</div>
					<br>
					<div class="forget">
					 <a href="#">Forget Password!</a>
                </div>
                <div class="form-row">
                    <div class="col">
                        <a href="./register.php">Not account yet? Register</a>    
                    </div>
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


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>