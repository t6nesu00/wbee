
<?php
    include '../../resources/config.php';
    
?>
<div class="wrapper">
    <div class="sidebar">
    <h5><?php if(isset($_SESSION['email'])){
        echo "<font color: white>".$_SESSION['email']."</font>";
    } ?></h5>
        <ul>
			<li><a href="teachers.php"><i class="fas fa-home"></i>Dashboard</a></li>
			<li><a href="texam.php"><i class="fas fa-diagnoses"></i>Exam</a></li>
			<li><a href="questions.php"><i class="fas fa-file-alt"></i></i>Questions</a></li>
            <li><a href="studentList.php"><i class="fas fa-users"></i>Students</a></li>
        </ul>
    </div>
</div>