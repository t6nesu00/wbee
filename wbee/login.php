<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>
    <header>
        <?php 
        include('./includes/header.php');
        ?>
    </header>
    <div class="container">
    <div class="row login-form">
        <div class="col-md-5 well">
            <h4>Login</h4>
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
                <div class="form-group">
                    <input type="submit" name="btnLogin" class="btn btn-primary" value="Login"/>
                </div>
            </form>
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