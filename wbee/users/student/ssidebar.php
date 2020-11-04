

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="sstyle.css">
</head>
<body>
    <?php
        include '../../resources/config.php'; 
    ?>
    <div class="wrapper">
        <div class="sidebar">
            <h5>
            <?php 
            if(isset($_SESSION['email'])){
            echo "<font color: white>".$_SESSION['email']."</font>";
        } ?>
        </h5>
            <ul>
                <a href="students.php"><li><i class="fas fa-home"></i>DASHBOARD</li></a>
                <a href="sexam.php"><li><i class="fas fa-diagnoses"></i>EXAM</li></a>
                <a href="scores.php"><li><i class="fas fa-star"></i>SCORES</li></a>
            </ul>
        </div>
    </div>  
</body>
</html>



