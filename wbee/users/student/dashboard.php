<?php
	require '../../resources/config.php';
	if(empty($_SESSION['email']))
		header('Location: ../../login.php');
?>


<html>
<head><title>Organization Dashboard</title>
<!-- css links -->
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="tstyle.css">
</head>
	
<body style="background-color: orange;">
	<div>
		<?php include 'sheader.php'; ?>
	</div>
	<div class="container">
		<div class="row">
			 <div class="col">
				<div id="currentQuestion" style="float:left;">0</div>
				<div style="float:left">/</div>
				<div id="totalQuestion" style="float:left">0</div>
			 </div>
		</div>
             <!-- display questions -->
		<div class="row" style="margin-top: 20px">
			<div style="padding: 10px; min-height: 300px; background-color: white; width:100%; height: auto;" id="load_questions">
			</div>
			<!-- <div style="min-height: 300px; width=100%; background-color: white" id="load_questions"> </div> -->
		</div>

			 <!-- display previous and next button -->
		<div class="row" style="margin-top: 10px">
			<div class="col" style="min-height: 50px;">
				<div class="col text-center">
				 	<input type="button" class="btn btn-warning" value="Previous" onclick="load_previous();">&nbsp;
					<input type="button" class="btn btn-success" value="next" onclick="load_next();">
				</div>
			</div>
		</div>
					
	</div>


	<script>
		function load_total_question()
		{
			var xmlhttp = new XMLHttpRequest();
        	xmlhttp.onreadystatechange = function() {
        	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("totalQuestion").innerHTML = xmlhttp.responseText;
      		}

        };
        xmlhttp.open("GET","../../ajax/load_total_question.php",true);
        xmlhttp.send(null);
		}

		var questionNo = "1";
		load_questions(questionNo);

		function load_questions(questionNo)
		{
			document.getElementById("currentQuestion").innerHTML = questionNo;
			var xmlhttp = new XMLHttpRequest();
        	xmlhttp.onreadystatechange = function() {
        	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
				{
					if(xmlhttp.responseText == "over") 
					{
						window.location = "result.php";
					}
					else 
					{
						document.getElementById("load_questions").innerHTML = xmlhttp.responseText;
						load_total_question();
					}
				}

        };
        xmlhttp.open("GET","../../ajax/load_questions.php?questionNo="+ questionNo,true);
        xmlhttp.send(null);
		}

		function radioclick(radiovalue, questionNo)
		{
			var xmlhttp = new XMLHttpRequest();
        	xmlhttp.onreadystatechange = function() {
        	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            
      		}

        };
        xmlhttp.open("GET","../../ajax/save_answer.php?questionNo="+ questionNo +"&value1="+radiovalue,true);
        xmlhttp.send(null);
		}
		function load_previous()
		{
			if(questionNo == "1"){
				load_questions(questionNo);
			}
			else {
				questionNo= eval(questionNo) - 1;
				load_questions(questionNo); 
			}
		}

		function load_next()
		{
			questionNo= eval(questionNo) + 1;
			load_questions(questionNo);
		}

	</script>
	
	<div class="footer-section">
		<?php include '../../includes/footer.php'; ?>
	</div>
	<!-- JS script for bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>