
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
			<li><a href="students.php"><i class="fas fa-home"></i>Dashboard</a></li>
			<li><a href="sexam.php"><i class="fas fa-diagnoses"></i>Exam</a></li>
			<li><a href="#"><i class="fas fa-star"></i>Scores</a></li>
        </ul>
    </div>
</div>