<?php
	include '../../resources/config.php';
?>
<?php

	$count = 0;
	$sql = "SELECT * FROM exam_result ORDER BY id DESC";
	$stmt = $connect->query($sql);
	$count = $stmt->rowCount();

?>

<html>
<head><title>Organization Dashboard</title>
	<!-- css links -->
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="sstyle.css">

	<!-- sources for datatable -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>

</head>

<body style="background-color: orange;">
<div>
	<?php include "theader.php"; ?>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <?php include 'tsidebar.php'; ?>
        </div>
        <div class="col-sm-9">
			<div class="card" style = "background-color: #ffbf00;">
                <div class="card-header">
                    Select the exam first
                </div>
                <div class="card-body">

				<div class="table-responsive">  
                     <table id="myTable" class="table table-striped table-bordered">  
                          <thead style="background-color: #292a3e; color: white">  
                               <tr>  
                                    <th>Student</th>  
                                    <th>Exam</th>  
									<th>Total Questions</th>  
									<th>Correct Answers</th>  
									<th>Wrong Answers</th>  
									<th>Date</th>  
                               </tr>  
                          </thead>  
						  <?php 
						  if($count == 0){
							echo 'No list yet';
						  } else 
						  {
							while($row = $stmt->fetch(PDO::FETCH_ASSOC))  
                          {  
                               echo '  
                               <tr>  
                                    <td>'.$row["name"].'</td>  
									<td>'.$row["exam_type"].'</td> 
									<td>'.$row["total_question"].'</td> 
									<td>'.$row["correct_answer"].'</td> 
									<td>'.$row["wrong_answer"].'</td> 
									<td>'.$row["exam_time"].'</td> 
                               </tr>  
                               ';  
                          }
						  }      
                          ?>  
                     </table>  
				</div>                
                </div>
            </div>
        </div>
    </div>
</div>

<div class="footer">
	<?php include '../../includes/footer.php'; ?>
</div>
</body>
</html>
<script>  
 $(document).ready( function () {
    $('#myTable').DataTable(
		{
			
		}
	);
} );
 </script>
