<?php
error_reporting(0);
include('includes/config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Blood Bank & Donor Management System | Blood Donor List</title>
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/fontawesome-all.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
	<style>
		body {
			font-family: 'Inter', sans-serif;
			background-color: #f8f9fa;
		}
		.donor-card {
			background: #fff;
			border-radius: 10px;
			box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
			margin-bottom: 2rem;
			overflow: hidden;
			transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
		}
		.donor-card:hover {
			transform: translateY(-5px);
			box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
		}
		.donor-image {
			width: 100%;
			height: 200px;
			object-fit: cover;
			border-bottom: 1px solid #eee;
		}
		.donor-name {
			padding: 1.5rem 1.5rem 0;
			font-size: 1.5rem;
			font-weight: 600;
			color: #2c3e50;
		}
		.donor-details {
			padding: 1.5rem;
		}
		.table {
			margin-bottom: 0;
		}
		.table th {
			font-weight: 600;
			color: #495057;
			background-color: #f8f9fa;
			border-top: none;
		}
		.table td {
			vertical-align: middle;
		}
		.btn-request {
			width: 100%;
			padding: 0.75rem;
			font-weight: 600;
			border-radius: 5px;
			transition: all 0.2s ease-in-out;
		}
		.btn-request:hover {
			transform: translateY(-2px);
			box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
		}
		.page-header {
			background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
			color: white;
			padding: 3rem 0;
			margin-bottom: 3rem;
		}
		.page-title {
			font-size: 2.5rem;
			font-weight: 700;
			margin-bottom: 1rem;
		}
		.page-description {
			font-size: 1.1rem;
			opacity: 0.9;
		}
	</style>
</head>

<body>
	<?php include('includes/header.php');?>

	<div class="page-header">
		<div class="container">
			<h1 class="page-title">Blood Donor List</h1>
			<p class="page-description">Find registered blood donors in your area and request blood when needed.</p>
		</div>
	</div>

	<div class="container py-5">
		<div class="row">
			<?php
			$status = 1;
			$sql = "SELECT * FROM tblblooddonars WHERE status=:status";
			$query = $dbh->prepare($sql);
			$query->bindParam(':status', $status, PDO::PARAM_STR);
			$query->execute();
			$results = $query->fetchAll(PDO::FETCH_OBJ);
			$cnt = 1;
			if($query->rowCount() > 0) {
				foreach($results as $result) { 
			?>
			<div class="col-md-4 mb-4">
				<div class="donor-card">
					<img src="images/blood-donor.jpg" alt="Blood Donor" class="donor-image">
					<h3 class="donor-name"><?php echo htmlentities($result->FullName);?></h3>
					<div class="donor-details">
						<table class="table">
							<tbody>
								<tr>
									<th>Gender</th>
									<td><?php echo htmlentities($result->Gender);?></td>
								</tr>
								<tr>
									<th>Blood Group</th>
									<td><?php echo htmlentities($result->BloodGroup);?></td>
								</tr>
								<tr>
									<th>Mobile No.</th>
									<td><?php echo htmlentities($result->MobileNumber);?></td>
								</tr>
								<tr>
									<th>Email ID</th>
									<td><?php echo htmlentities($result->EmailId);?></td>
								</tr>
								<tr>
									<th>Age</th>
									<td><?php echo htmlentities($result->Age);?></td>
								</tr>
								<tr>
									<th>Address</th>
									<td><?php echo htmlentities($result->Address);?></td>
								</tr>
								<tr>
									<th>Message</th>
									<td><?php echo htmlentities($result->Message);?></td>
								</tr>
							</tbody>
						</table>
						<a href="contact-blood.php?cid=<?php echo $result->id;?>" class="btn btn-primary btn-request">
							Request Blood
						</a>
					</div>
				</div>
			</div>
			<?php 
				}
			} 
			?>
		</div>
	</div>

	<?php include('includes/footer.php');?>

	<script src="js/bootstrap.js"></script>
</body>
</html>