<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{ 

if(isset($_POST['submit']))
  {
$fullname=$_POST['fullname'];
$mobile=$_POST['mobileno'];
$email=$_POST['emailid'];
$age=$_POST['age'];
$gender=$_POST['gender'];
$blodgroup=$_POST['bloodgroup'];
$address=$_POST['address'];
$message=$_POST['message'];
$status=1;
$sql="INSERT INTO  tblblooddonars(FullName,MobileNumber,EmailId,Age,Gender,BloodGroup,Address,Message,status) VALUES(:fullname,:mobile,:email,:age,:gender,:blodgroup,:address,:message,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':fullname',$fullname,PDO::PARAM_STR);
$query->bindParam(':mobile',$mobile,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':age',$age,PDO::PARAM_STR);
$query->bindParam(':gender',$gender,PDO::PARAM_STR);
$query->bindParam(':blodgroup',$blodgroup,PDO::PARAM_STR);
$query->bindParam(':address',$address,PDO::PARAM_STR);
$query->bindParam(':message',$message,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Your info submitted successfully";
}
else 
{
$error="Something went wrong. Please try again";
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>BBDMS | Add Donor</title>
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/fontawesome-all.css" rel="stylesheet">
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
		.form-container {
			background: #fff;
			border-radius: 15px;
			box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
			padding: 2.5rem;
		}
		.form-group {
			margin-bottom: 1.5rem;
		}
		.form-control {
			border-radius: 8px;
			padding: 0.875rem 1rem;
			border: 1px solid #ced4da;
			transition: all 0.2s ease-in-out;
			font-size: 0.95rem;
		}
		.form-control:focus {
			border-color: #80bdff;
			box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
		}
		.btn-primary {
			padding: 0.875rem 1.5rem;
			font-weight: 600;
			border-radius: 8px;
			transition: all 0.2s ease-in-out;
			background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
			border: none;
			font-size: 1rem;
		}
		.btn-secondary {
			padding: 0.875rem 1.5rem;
			font-weight: 600;
			border-radius: 8px;
			transition: all 0.2s ease-in-out;
			background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
			border: none;
			font-size: 1rem;
		}
		.btn-primary:hover, .btn-secondary:hover {
			transform: translateY(-2px);
			box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
		}
		.form-label {
			font-weight: 600;
			color: #495057;
			margin-bottom: 0.5rem;
			font-size: 0.95rem;
		}
		.required::after {
			content: "*";
			color: #dc3545;
			margin-left: 4px;
		}
		textarea.form-control {
			min-height: 100px;
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
		select.form-control {
			appearance: none;
			background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
			background-repeat: no-repeat;
			background-position: right 0.75rem center;
			background-size: 16px 12px;
			padding-right: 2.5rem;
		}
		@media (max-width: 768px) {
			.main-content {
				margin-left: 0;
				padding: 1rem;
			}
			.form-container {
				padding: 1.5rem;
			}
		}
	</style>
	<script>
		function isNumberKey(evt) {
			var charCode = (evt.which) ? evt.which : event.keyCode;
			if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode!=46)
				return false;
			return true;
		}
	</script>
</head>

<body>
	<?php include('includes/header.php');?>
	<?php include('includes/leftbar.php');?>

	<main class="main-content">
		<div class="page-header">
			<h1 class="page-title">Add Donor</h1>
		</div>

		<div class="form-container">
			<?php if($error){?>
				<div class="errorWrap">
					<strong>ERROR</strong>: <?php echo htmlentities($error); ?>
				</div>
			<?php } else if($msg){?>
				<div class="succWrap">
					<strong>SUCCESS</strong>: <?php echo htmlentities($msg); ?>
				</div>
			<?php }?>

			<form method="post" class="needs-validation" novalidate>
				<div class="row mb-4">
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-label required">Full Name</label>
							<input type="text" name="fullname" class="form-control" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-label required">Mobile No</label>
							<input type="text" name="mobileno" onKeyPress="return isNumberKey(event)" maxlength="10" class="form-control" required>
						</div>
					</div>
				</div>

				<div class="row mb-4">
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-label">Email id</label>
							<input type="email" name="emailid" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-label required">Age</label>
							<input type="text" name="age" class="form-control" required>
						</div>
					</div>
				</div>

				<div class="row mb-4">
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-label required">Gender</label>
							<select name="gender" class="form-control" required>
								<option value="">Select</option>
								<option value="Male">Male</option>
								<option value="Female">Female</option>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-label required">Blood Group</label>
							<select name="bloodgroup" class="form-control" required>
								<option value="">Select</option>
								<?php 
								$sql = "SELECT * from tblbloodgroup";
								$query = $dbh->prepare($sql);
								$query->execute();
								$results=$query->fetchAll(PDO::FETCH_OBJ);
								if($query->rowCount() > 0) {
									foreach($results as $result) { ?>
										<option value="<?php echo htmlentities($result->BloodGroup);?>">
											<?php echo htmlentities($result->BloodGroup);?>
										</option>
								<?php }} ?>
							</select>
						</div>
					</div>
				</div>

				<div class="row mb-4">
					<div class="col-12">
						<div class="form-group">
							<label class="form-label">Address</label>
							<textarea class="form-control" name="address"></textarea>
						</div>
					</div>
				</div>

				<div class="row mb-4">
					<div class="col-12">
						<div class="form-group">
							<label class="form-label required">Message</label>
							<textarea class="form-control" name="message" required></textarea>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-12 text-end">
						<button class="btn btn-secondary me-2" type="reset">Cancel</button>
						<button class="btn btn-primary" name="submit" type="submit">Save changes</button>
					</div>
				</div>
			</form>
		</div>
	</main>

	<script src="js/bootstrap.js"></script>
</body>
</html>
<?php } ?>