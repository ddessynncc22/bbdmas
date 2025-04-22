<?php error_reporting(0);
include('includes/config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Blood Bank & Donor Management System | Search Blood Donor</title>
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet" type="text/css">
	<link href="css/fontawesome-all.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
	<style>
		body {
			font-family: 'Inter', sans-serif;
			background-color: #f8f9fa;
		}
		.page-header {
			background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
			color: white;
			padding: 3rem 0;
			margin-bottom: 3rem;
		}
		.page-title {
			font-size: 2.5rem;
			font-weight: 700;
			margin-bottom: 1rem;
		}
		.search-container {
			background: #fff;
			border-radius: 10px;
			box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
			padding: 2rem;
			margin-bottom: 3rem;
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
		.donor-info {
			padding: 1.5rem;
		}
		.donor-name {
			font-size: 1.5rem;
			font-weight: 600;
			color: #2c3e50;
			margin-bottom: 1rem;
		}
		.donor-details {
			margin-bottom: 1.5rem;
		}
		.donor-details p {
			margin-bottom: 0.5rem;
			color: #495057;
		}
		.donor-details b {
			color: #2c3e50;
		}
		.btn-request {
			width: 100%;
			padding: 0.75rem;
			font-weight: 600;
			border-radius: 5px;
			transition: all 0.2s ease-in-out;
			background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
			border: none;
			color: white;
		}
		.btn-request:hover {
			transform: translateY(-2px);
			box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
			color: white;
		}
		.no-records {
			text-align: center;
			padding: 2rem;
			color: #dc3545;
			font-weight: 600;
		}
		.form-control:focus {
			border-color: #dc3545;
			box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
		}
		.form-select:focus {
			border-color: #dc3545;
			box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
		}
	</style>
</head>

<body>
	<?php include('includes/header.php');?>

	<div class="page-header">
		<div class="container">
			<h1 class="page-title">Search Blood Donor</h1>
			<p class="lead">Find compatible blood donors in your area</p>
		</div>
	</div>

	<div class="container">
		<div class="search-container">
			<form name="donor" method="post" class="row g-3">
				<div class="col-md-4">
					<label class="form-label">Blood Group<span class="text-danger">*</span></label>
					<select name="bloodgroup" class="form-select" required>
						<?php 
						$sql = "SELECT * FROM tblbloodgroup";
						$query = $dbh->prepare($sql);
						$query->execute();
						$results = $query->fetchAll(PDO::FETCH_OBJ);
						if($query->rowCount() > 0) {
							foreach($results as $result) { ?>  
								<option value="<?php echo htmlentities($result->BloodGroup);?>">
									<?php echo htmlentities($result->BloodGroup);?>
								</option>
						<?php }} ?>
					</select>
				</div>
				<div class="col-md-4">
					<label class="form-label">Location</label>
					<input type="text" class="form-control" name="location" placeholder="Enter location">
				</div>
				<div class="col-md-4 d-flex align-items-end">
					<button type="submit" name="sub" class="btn btn-request w-100">
						<i class="fas fa-search me-2"></i>Search Donors
					</button>
				</div>
			</form>
		</div>

		<?php
		if(isset($_POST['sub'])) {
			$status = 1;
			$bloodgroup = $_POST['bloodgroup'];
			$location = $_POST['location']; 

			$sql = "SELECT * FROM tblblooddonars WHERE status=:status AND BloodGroup=:bloodgroup";
			if (!empty($location)) {
				$sql .= " AND Address LIKE :location";
			}
			$query = $dbh->prepare($sql);
			$query->bindParam(':status', $status, PDO::PARAM_STR);
			$query->bindParam(':bloodgroup', $bloodgroup, PDO::PARAM_STR);
			if (!empty($location)) {
				$locationParam = "%$location%";
				$query->bindParam(':location', $locationParam, PDO::PARAM_STR);
			}
			$query->execute();
			$results = $query->fetchAll(PDO::FETCH_OBJ);
			
			if($query->rowCount() > 0) { ?>
				<div class="row">
					<?php foreach($results as $result) { ?>
						<div class="col-md-4">
							<div class="donor-card">
								<img src="images/blood-donor.jpg" alt="Blood Donor" class="donor-image">
								<div class="donor-info">
									<h3 class="donor-name"><?php echo htmlentities($result->FullName);?></h3>
									<div class="donor-details">
										<p><b>Gender:</b> <?php echo htmlentities($result->Gender);?></p>
										<p><b>Blood Group:</b> <?php echo htmlentities($result->BloodGroup);?></p>
										<p><b>Mobile No:</b> <?php echo htmlentities($result->MobileNumber);?></p>
										<p><b>Email ID:</b> <?php echo htmlentities($result->EmailId);?></p>
										<p><b>Age:</b> <?php echo htmlentities($result->Age);?></p>
										<p><b>Address:</b> <?php echo htmlentities($result->Address);?></p>
										<p><b>Message:</b> <?php echo htmlentities($result->Message);?></p>
									</div>
									<a href="contact-blood.php?cid=<?php echo $result->id;?>" class="btn btn-request">
										<i class="fas fa-hand-holding-medical me-2"></i>Request Blood
									</a>
								</div>
							</div>
						</div>
					<?php }
				} else { ?>
					<div class="col-12">
						<div class="no-records">
							<i class="fas fa-exclamation-circle me-2"></i>No donors found matching your criteria.
						</div>
					</div>
				<?php }
			} ?>
		</div>
	</div>

	<?php include('includes/footer.php');?>

	<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>