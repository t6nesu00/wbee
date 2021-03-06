<?php
    require './resources/config.php';

    if (isset($_POST['register'])) {
        $errMsg = '';

        // Get data from FORM
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $rpassword = $_POST['rpassword'];
        $streamName = $_POST['sName'];
        $batch = $_POST['batch'];
        $role = $_POST['role'];
    

        if ($email == '') {
            $errMsg = 'Give your email address';
        }
        if ($password == '') {
            $errMsg = 'Enter password';
        }
        if ($rpassword == '') {
            $errMsg = 'Please confirm the password';
        }
        if ($password != $rpassword) {
            $errMsg = 'Password did not match';
        } 
        // else {
        //     $hash_pass = password_hash($password, PASSWORD_DEFAULT);
        // }
            
        if ($role == '') {
            $errMsg = 'Who you are, Student? or Teacher?';
        }
        
        

        if ($errMsg == '') {
            try {
              $hash_pass = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $connect->prepare('INSERT INTO students (name, email, password, stream, batch, role) VALUES (:name, :email, :password, :streamName, :batch, :role)');
                $stmt->execute(array(
                    ':name' => $name,
                    ':email' => $email,
                    ':password' => $hash_pass,
                    ':streamName' => $streamName,
                    ':batch' => $batch,
                    ':role' => $role
                    ));
                header('Location: register.php?action=joined');
                exit;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

    if (isset($_GET['action']) && $_GET['action'] == 'joined') {
        $errMsg = '<p style="background-color: #f4f0e9; text-align: center;"> Registration successful. Now you can <a href="login.php">login</a></p>';
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
            <div class="col-lg-6 mx-auto my-5">
                <div class="card card-body" style="background-color: #ffbf00;">
                    <?php if (isset($errMsg)) {
            echo "<font color='red'>" .$errMsg. "</font>";
        } ?>
                    <div class="card-text">Fill all the fields to register.</div>
                    <hr />
                    <form method='post' action="register.php">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label for="emailForReg">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                                placeholder="example@email.com">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="exampleInputEmail1" name="password">
                        </div>
                        <div class="form-group">
                            <label for="confirm-password">Confirm password</label>
                            <input type="password" class="form-control" id="exampleInputEmail1" name="rpassword">
                        </div>
                        <div class="form-group">
									<!--Dropdown for stream name fetched from database table-->
									<label for="facultyName">Stream/Faculty</label><br>
									<select name="sName">
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
                            <label for="batch">Batch</label>
                            <input type="text" class="form-control" id="exampleInputBatch" name="batch" placeholder="e.g 2020">
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="role" id="student-radio"
                                    value="students" checked>
                                <label class="form-check-label" for="student-radio">
                                    Student
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="role" id="teacher-radio"
                                    value="teachers">
                                <label class="form-check-label" for="teacher-radio">
                                    Teacher
                                </label>
                            </div>
                            
                        </div>
                        <button type="submit" name='register' value="Register"
                            class="btn btn-success btn-block">Register</button>
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

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>