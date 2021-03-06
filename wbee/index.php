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
<?php include './includes/header.php';?>
    <!-- display error message -->

	<!-- container of the page -->
	<div class="container">
    <div class="row" style="margin-bottom: 0px;">
      <div class="col"><h1 style="font-family: Muli, sans-serif; font-weight: bold;">Welcome to Web Based Examination System</h1></div>
      <div class="col"></div>
    </div>
    <div class="row" style="margin-top: 0px;">
      <div class="col" style="background-color: rgba(220, 220, 220, 0.2); margin-top: 125px;">
        <p class="lead">Online examination system for Teachers</p> 
              <strong>How the system works?</strong>
              <ul>
                <li>Join system with simple registration or just login if you are registered alerady</li>
                <li>Set the exam</li>
                <li>Set the question paper</li>
                <li>Edit, delete or update exam</li>
                <li>Edit, delete or update questions</li>
                <li>Check students performance</li>
              </ul>

      </div>
      <div class="col-6" style="background-color: rgba(220, 220, 220, 0.2); margin-top: 125px;">
            <p class="lead">Online examination system for <strong>Students</strong></p> 
              <strong>How the system works?</strong>
              <ul>
                <li>Join system with simple registration or just login if you are registered alerady</li>
                <li>Check the available examination</li>
                <li>Start exam with just one click</li>
                <li>Calmly complete all the problems</li>
                <li>At last you will know your result instantly</li>
              </ul>
      </div>
    </div>
  </div>
	<!-- container of the page -->
  <div class="footer">
    <?php include './includes/footer.php'; ?>
  </div>
    
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
