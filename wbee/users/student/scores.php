<?php
	include '../../resources/config.php';
?>
<?php
$count = 0;
$sql = "SELECT * FROM exam_result WHERE total_question = correct_answer AND correct_answer > 1 ORDER BY id DESC";
$stmt = $connect->query($sql);
$count = $stmt->rowCount();
?>

<html>
<head><title>Onine Examination System</title>
	<!-- css links -->
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="sstyle.css">

	<!-- sources for datatable -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">	
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>

</head>

<body style="background-color: orange">
<div>
	<?php include "sheader.php"; ?>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <?php include 'ssidebar.php'; ?>
        </div>
        <div class="col-sm-9">
            
			
		<div class="card" style = "background-color: #ffbf00;">
                <div class="card-header">
                    Top Scorer
                </div>
                <div class="card-body">
								
				<div class="table-responsive">  
                     <table id="myTable" class="table table-striped table-bordered">  
                          <thead style="background-color: #292a3e; color: white">  
                               <tr>  
                                    <th>Name of Student</th>
                                    <th>Email</th>
                                    <th>Exam Name</th>  
                                    <th>Total Questions</th> 
                                    <th>Correct Answers</th>    
                                    <th>Date</th>  
                               </tr>  
                          </thead>  
						  <?php 
						  if($count == 0){
							echo 'No results yet';
						  } else 
						  {
							while($row = $stmt->fetch(PDO::FETCH_ASSOC))  
                          {  
                               echo '  
                               <tr>  
                                    <td>'.$row["name"].'</td>
                                    <td>'.$row["email"].'</td>  
                                    <td>'.$row["exam_type"].'</td>  
									<td>'.$row["total_question"].'</td>  
									<td>'.$row["correct_answer"].'</td>    
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
    $('#myTable').DataTable();
} );
 </script>
