<?php
	require '../../resources/config.php';
	if(empty($_SESSION['email']))
		header('Location: ../../login.php');
?>
<?php
$count = 0;
$sql = "SELECT * FROM exam_category";
$data = $connect->query($sql);
$count = $data->rowCount();
?>

<html>
<head><title>Organization Dashboard</title>
	<!-- css links -->
	<link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="tstyle.css">

	<!-- sources for datatable -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">	
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>

</head>

<body style="background-color: orange;">
	<div>
		<?php include 'theader.php'; ?>
	</div>

	<div class="container-fluid">
		<div class="row">
			<div class="col-3">
				<div class="wrapper">
    				<div class="sidebar">
        				<?php include 'tsidebar.php'; ?>
    				</div>
				</div>
			</div>
			<div class="col-9">
			<div class="card" style = "background-color: #ffbf00;">
                <div class="card-header">
                    Select the exam first
                </div>
                <div class="card-body">
                
				
				<div class="table-responsive">  
                     <table id="myTable" class="table table-striped table-bordered">  
                          <thead style="background-color: #292a3e; color: white">  
                               <tr>  
									<th scope="col">#</th>
									<th scope="col">Exam Name</th>
									<th scope="col">Exam Time</th>
									<th scope="col">Select</th>  
                               </tr>  
                          </thead>  
						  <?php 
						  $serNum = 0;
						  if($count == 0){
							echo 'No list yet';
						  } else 
						  {
							while($row = $data->fetch(PDO::FETCH_ASSOC))  
                          {  
								$serNum = $serNum + 1;
                               echo '  
                               <tr>  
									<th scope="row">'.$serNum.'</th>
									<td>'.$row["category"].'</td>
									<td>'.$row["exam_time_in_minutes"].'</td>
									<td><a href="edit_questions.php?id='.$row["id"].'">Select</a></td> 
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
	<!-- footer section -->
	<div class="footer-section">
		<?php include '../../includes/footer.php'; ?>
	</div>
	<!-- JS script for bootstrap -->	

</body>
</html>
<script>  
 $(document).ready( function () {
    $('#myTable').DataTable();
} );
 </script>