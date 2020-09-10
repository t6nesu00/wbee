<?php
    include '../../resources/config.php';
    $date = date("Y-m-d H:i:s");
    $_SESSION["end_time"] = date("Y-m-d H:i:s", strtotime($date."+ $_SESSION[exam_time] minutes"))
?>

<html>
<head><title>Result</title>
<!-- css links -->
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="sstyle.css">
</head>


<body style="background-color: orange;">
    <div>
        <?php include "sheader.php"; ?> 
    </div>
    
    <div class="container-fluid">
		<div class="card text-center">
			<div class="card-header">
			    <h2>Your result</h2>
			</div>
			<!-- load questions -->
		    <div class="card-body">
		        <div class="row" style="margin-top: 10px">
                    <?php
                    $correct_answer = 0;
                    $wrong_answer = 0;
                    $unattemted = 0;

                    if(isset($_SESSION["answer"])) {
                        for($i = 0; $i <= sizeof($_SESSION["answer"]); $i++)
                        {
                            $answer = "";
                            $sql = "SELECT * FROM questionTable WHERE category = '$_SESSION[exam_category]' && question_no = $i";
                            $stmt = $connect->query($sql);
                            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                $answer = $row["answer"];
                            }
                            if(isset($_SESSION["answer"][$i])) {
                                if($answer == $_SESSION["answer"][$i]) {
                                    $correct_answer = $correct_answer + 1;
                                }
                                else {
                                    $wrong_answer = $wrong_answer + 1;
                                }

                        }
                        else {
                            $unattemted = $unattemted + 1;
                        }
                        }
                    }
                    $count = 0;
                    $stmt = $connect->query("SELECT * FROM questionTable WHERE category = '$_SESSION[exam_category]'");
                    $count = $stmt->rowCount();
                    $wrong_answer = $count - $correct_answer;
                    echo "<br>"; echo "<br>";
                    echo "Total question = ".$count;
                    echo "<br>";
                    echo "Correct Asnswers= ".$correct_answer; echo "<br>";
                    echo "Wrong answer = ".$wrong_answer; echo "<br>";
                    
                    ?>
		        </div>
            </div>
                <?php
                if(isset($_SESSION["exam_start"])) {
                    $name = " ";
                    $sql = "SELECT * FROM students WHERE email = '$_SESSION[email]'";
                    $stmt = $connect->query($sql);
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $name = $row["name"];
                    }
                    $date = date("Y-m-d");
                    $pdo = "INSERT INTO exam_result(name, email, exam_type, total_question, correct_answer, wrong_answer, exam_time) 
                                        VALUES ('$name', '$_SESSION[email]', '$_SESSION[exam_category]', '$count', '$correct_answer', '$wrong_answer', '$date')";
                                        $pdo_run = $connect->prepare($pdo);
                                        $pdo_exec = $pdo_run->execute(array(
                                            ':total_question' => $count, 
                                            
                                        ));
                }
                if(isset($_SESSION["exam_start"])) {
                    unset($_SESSION["exam_start"]);
                    ?>
                        <script>
                            window.location.href = window.location.href;
                        </script>
                    <?php
                }
                ?>
        </div>
	</div>
	
	<div class="footer">
		<?php include '../../includes/footer.php'; ?>
	</div>

	<!-- JS script for bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
