<?php
	include '../../resources/config.php';
	if(empty($_SESSION['email']))
		header('Location: ../../login.php');
?>

<html>
<head><title>Organization Dashboard</title>
<!-- css links -->
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="sstyle.css">
</head>
	<div>
		<?php include "sheader.php"; ?>
	</div>

	<div class="container">
		<div class="card text-center">
			<div class="card-header">
			<div class="col-lg-2 col-lg-push-10" style="float: right;">
				<div id="active_question" style="float:left">0</div>
				<div style="float:left">/</div>  
				<div id="total_question" style="float:left">0</div>
			</div>
			</div>
			<!-- load questions -->
		<div class="card-body">
		<div class="row" style="margin-top: 10px">
			<div class="row">
				<div class="col-lg-10 col-lg-push-1" style="min-height: 200px; background-color: white" id="load_questions"></div>
			</div>
		</div>
		</div>
		<div class="card-footer">
		<div class="col-lg-6">
				<div class="col-lg-12">
					<input type="button" class="btn btn-warning" value="Previous" onclick="load_previous();"> &nbsp; 
					<input type="button" class="btn btn-success" value="Next" onclick="load_next();">
				</div>
			</div>
		</div>
		</div>
	</div>

	<script>
		function load_total_question(exam_category)
			{
				var xmlhttp=new XMLHttpRequest();
				xmlhttp.onreadystatechange=function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						document.getElementById("total_question").innerHTML = xmlhttp.responseText;
					}
				};
				xmlhttp.open("GET","../../ajax/load_total_question.php",true);
				xmlhttp.send(null);
			}

			var questionNo = "1";
			load_questions(questionNo);

			function load_questions(questionNo)
			 {
				document.getElementById("active_question").innerHTML = questionNo;
				var xmlhttp=new XMLHttpRequest();
				xmlhttp.onreadystatechange=function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						if(xmlhttp.responseText=="over"){
							window.location = "result.php";
						}	
						else {
							document.getElementById("load_questions").innerHTML = xmlhttp.responseText;
							load_total_question();
						}
					}
				};
				xmlhttp.open("GET","../../ajax/load_questions.php?questionNo=" + questionNo, true);
				xmlhttp.send(null); 
			 }

			//function to collect checked answer
			 function radioclick(radiovalue, questionNo) 
			 {
				var xmlhttp=new XMLHttpRequest();
				xmlhttp.onreadystatechange=function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						
					}
				};
				xmlhttp.open("GET","../../ajax/save_answer.php?questionNo=" + questionNo + "&value1="+radiovalue, true);
				xmlhttp.send(null);

			 }

			 
			 // funtion to display next and previous questions
			 function load_previous()
			 {
				if(questionNo == "1") 
				{
					load_questions(questionNo);
				}
				else {
					questionNo=eval(questionNo)-1;
					load_questions(questionNo);
				}
			 }

			 function load_next()
			 {
				questionNo=eval(questionNo)+1;
				load_questions(questionNo);
			 }
	</script>

	
</html>
