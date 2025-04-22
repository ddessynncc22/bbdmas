<?php 
session_start();
error_reporting(0);
include('includes/config.php');

if (isset($_POST['submit'])) {
    $fullname   = $_POST['fullname'];
    $mobile     = $_POST['mobileno'];
    $email      = $_POST['emailid'];
    $age        = $_POST['age'];
    $gender     = $_POST['gender'];
    $blodgroup  = $_POST['bloodgroup'];
    $address    = $_POST['address'];
    $message    = $_POST['message'];
    $status     = 1;
    $password   = md5($_POST['password']);

    $ret   = "SELECT EmailId FROM tblblooddonars WHERE EmailId = :email";
    $query = $dbh->prepare($ret);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();

    if ($query->rowCount() == 0) {
        $sql = "INSERT INTO tblblooddonars
                  (FullName, MobileNumber, EmailId, Age, Gender, BloodGroup, Address, Message, status, Password)
                VALUES
                  (:fullname, :mobile, :email, :age, :gender, :blodgroup, :address, :message, :status, :password)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':fullname',  $fullname,  PDO::PARAM_STR);
        $query->bindParam(':mobile',    $mobile,    PDO::PARAM_STR);
        $query->bindParam(':email',     $email,     PDO::PARAM_STR);
        $query->bindParam(':age',       $age,       PDO::PARAM_STR);
        $query->bindParam(':gender',    $gender,    PDO::PARAM_STR);
        $query->bindParam(':blodgroup', $blodgroup, PDO::PARAM_STR);
        $query->bindParam(':address',   $address,   PDO::PARAM_STR);
        $query->bindParam(':message',   $message,   PDO::PARAM_STR);
        $query->bindParam(':status',    $status,    PDO::PARAM_INT);
        $query->bindParam(':password',  $password,  PDO::PARAM_STR);
        $query->execute();

        if ($dbh->lastInsertId()) {
            echo "<script>alert('You have signed up successfully');</script>";
        } else {
            echo "<script>alert('Something went wrong. Please try again');</script>";
        }
    } else {
        echo "<script>alert('Email-id already exists. Please try again');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sign Up | BB-DMS</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
    .signup-container {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem;
    }
    .card {
      padding: 2rem;
      border-radius: 1rem;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 600px;
    }
  </style>
</head>
<body>
<?php include('includes/header.php'); ?>
<div class="signup-container">
  <div class="card">
    <h3 class="text-center text-danger mb-4">Register Now</h3>
    <form action="#" method="post" name="signup">
      <div class="row">
        <div class="col-md-6 mb-3">
          <label>Full Name</label>
          <input type="text" name="fullname" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
          <label>Mobile Number</label>
          <input type="text" name="mobileno" maxlength="10" pattern="\d{10}" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
          <label>Email Id</label>
          <input type="email" name="emailid" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
          <label>Age</label>
          <input type="number" name="age" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
          <label>Gender</label>
          <select name="gender" class="form-control" required>
            <option value="">Select</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select>
        </div>
        <div class="col-md-6 mb-3">
          <label>Blood Group</label>
          <select name="bloodgroup" class="form-control" required>
            <option value="">Select</option>
            <?php 
              $sql = "SELECT * FROM tblbloodgroup";
              $q   = $dbh->prepare($sql);
              $q->execute();
              $groups = $q->fetchAll(PDO::FETCH_OBJ);
              foreach ($groups as $g) {
                echo '<option>' . htmlentities($g->BloodGroup) . '</option>';
              }
            ?>
          </select>
        </div>
        <div class="col-md-12 mb-3">
          <label>Address</label>
          <input type="text" name="address" class="form-control" required>
        </div>
        <div class="col-md-12 mb-3">
          <label>Message</label>
          <textarea name="message" class="form-control" required></textarea>
        </div>
        <div class="col-md-12 mb-3">
          <label>Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>
      </div>
      <button type="submit" name="submit" class="btn btn-danger w-100">Register</button>
      <div class="text-center mt-3">
        Already Registered? <a href="login.php">Signin now</a>
      </div>
    </form>
  </div>
</div>
<?php include('includes/footer.php'); ?>
<script src="js/bootstrap.js"></script>
</body>
</html>
