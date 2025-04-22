<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{


 ?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>BBDMS | Blood Requests</title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
	<style>
		body {
			font-family: 'Inter', sans-serif;
			background-color: #f8f9fa;
		}
		.errorWrap {
			padding: 1rem;
			margin: 0 0 1.5rem 0;
			background: #fff;
			border-left: 4px solid #dc3545;
			border-radius: 8px;
			box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
		}
		.succWrap {
			padding: 1rem;
			margin: 0 0 1.5rem 0;
			background: #fff;
			border-left: 4px solid #198754;
			border-radius: 8px;
			box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
		}
		.main-content {
			margin-left: 250px;
			padding: 2rem;
			min-height: calc(100vh - 60px);
		}
		.page-header {
			padding-bottom: 1.5rem;
			margin-bottom: 2rem;
			border-bottom: 1px solid #dee2e6;
		}
		.page-title {
			font-size: 1.75rem;
			font-weight: 700;
			color: #2c3e50;
			margin: 0;
		}
		.panel {
			background: #fff;
			border-radius: 15px;
			box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
			margin-bottom: 2rem;
		}
		.panel-heading {
			padding: 1.25rem 1.5rem;
			border-bottom: 1px solid #dee2e6;
			background: transparent;
			font-size: 1.25rem;
			font-weight: 600;
			color: #2c3e50;
		}
		.panel-body {
			padding: 1.5rem;
		}
		.table {
			width: 100%;
			margin-bottom: 1rem;
			background-color: transparent;
			border-collapse: separate;
			border-spacing: 0;
		}
		.table thead th {
			background-color: #f8f9fa;
			border-bottom: 2px solid #dee2e6;
			padding: 1rem;
			font-weight: 600;
			color: #495057;
			text-transform: uppercase;
			font-size: 0.875rem;
			letter-spacing: 0.5px;
		}
		.table tbody td {
			padding: 1rem;
			vertical-align: middle;
			border-bottom: 1px solid #dee2e6;
			color: #495057;
			font-size: 0.95rem;
		}
		.table tbody tr:hover {
			background-color: #f8f9fa;
		}
		@media (max-width: 768px) {
			.main-content {
				margin-left: 0;
				padding: 1rem;
			}
			.table-responsive {
				overflow-x: auto;
			}
		}
	</style>
</head>

<body>
	<?php include('includes/header.php');?>
	<?php include('includes/leftbar.php');?>

	<main class="main-content">
		<div class="page-header">
			<h1 class="page-title">Blood Requests</h1>
		</div>

		<div class="panel">
			<div class="panel-heading">Blood Requests Information</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>S.No</th>
								<th>Name of Donor</th>
								<th>Contact Number of Donor</th>
								<th>Blood Group</th>
								<th>Name of Requirer</th>
								<th>Mobile Number of Requirer</th>
								<th>Email of Requirer</th>
								<th>Blood Require For</th>
								<th>Message of Requirer</th>
								<th>Apply Date</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$sql="SELECT tblbloodrequirer.BloodDonarID,tblbloodrequirer.name,tblbloodrequirer.EmailId,tblbloodrequirer.ContactNumber,tblbloodrequirer.BloodRequirefor,tblbloodrequirer.Message,tblbloodrequirer.ApplyDate,tblblooddonars.id as donid,tblblooddonars.FullName,tblblooddonars.MobileNumber,tblblooddonars.BloodGroup  from  tblbloodrequirer join tblblooddonars on tblblooddonars.id=tblbloodrequirer.BloodDonarID where tblblooddonars.FullName like '%$sdata%' || tblblooddonars.MobileNumber like '%$sdata%'";
							$query = $dbh -> prepare($sql);
							$query->execute();
							$results=$query->fetchAll(PDO::FETCH_OBJ);
							$cnt=1;
							if($query->rowCount() > 0) {
								foreach($results as $row) { ?>
									<tr>
										<td><?php echo htmlentities($cnt);?></td>
										<td><?php echo htmlentities($row->FullName);?></td>
										<td><?php echo htmlentities($row->MobileNumber);?></td>
										<td><?php echo htmlentities($row->BloodGroup);?></td>
										<td><?php echo htmlentities($row->name);?></td>
										<td><?php echo htmlentities($row->ContactNumber);?></td>
										<td><?php echo htmlentities($row->EmailId);?></td>
										<td><?php echo htmlentities($row->BloodRequirefor);?></td>
										<td><?php echo htmlentities($row->Message);?></td>
										<td><?php echo htmlentities($row->ApplyDate);?></td>
									</tr>
								<?php $cnt=$cnt+1;}} else {?>
									<tr>
										<td colspan="10" style="color: #dc3545; text-align: center;">No Record found</td>
									</tr>
								<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</main>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
</body>
</html>
<?php } ?>
