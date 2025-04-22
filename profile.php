<?php 
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['bbdmsdid']==0)) {
    header('location:logout.php');
} else {
    if(isset($_POST['update'])) {
        $uid = $_SESSION['bbdmsdid'];
        $name = $_POST['fullname'];
        $mno = $_POST['mobileno']; 
        $emailid = $_POST['emailid'];
        $age = $_POST['age']; 
        $gender = $_POST['gender'];
        $bloodgroup = $_POST['bloodgroup']; 
        $address = $_POST['address'];
        $message = $_POST['message']; 
        
        $sql = "UPDATE tblblooddonars SET FullName=:name, MobileNumber=:mno, Age=:age, 
                Gender=:gender, BloodGroup=:bloodgroup, Address=:address, Message=:message 
                WHERE id=:uid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':mno', $mno, PDO::PARAM_STR);
        $query->bindParam(':age', $age, PDO::PARAM_STR);
        $query->bindParam(':gender', $gender, PDO::PARAM_STR);
        $query->bindParam(':bloodgroup', $bloodgroup, PDO::PARAM_STR);
        $query->bindParam(':address', $address, PDO::PARAM_STR);
        $query->bindParam(':message', $message, PDO::PARAM_STR);
        $query->bindParam(':uid', $uid, PDO::PARAM_STR);
        $query->execute();
        echo '<script>alert("Profile has been updated")</script>';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Bank & Donor Management System | Donor Profile</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/fontawesome-all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
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
        .profile-container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
            padding: 2rem;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.5rem;
        }
        .form-control {
            border-radius: 5px;
            padding: 0.75rem 1rem;
            border: 1px solid #ced4da;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
        }
        .form-control:read-only {
            background-color: #e9ecef;
        }
        .btn-update {
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            border-radius: 5px;
            transition: all 0.2s ease-in-out;
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            border: none;
            color: white;
        }
        .btn-update:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
        }
        .readonly-note {
            font-size: 0.875rem;
            color: #dc3545;
        }
    </style>
</head>

<body>
    <?php include('includes/header.php');?>

    <div class="page-header">
        <div class="container">
            <h1 class="page-title">Donor Profile</h1>
            <p class="lead">Update your profile information</p>
        </div>
    </div>

    <div class="container">
        <div class="profile-container">
            <form method="post" class="needs-validation" novalidate>
                <?php
                $uid = $_SESSION['bbdmsdid'];
                $sql = "SELECT * FROM tblblooddonars WHERE id=:uid";
                $query = $dbh->prepare($sql);
                $query->bindParam(':uid', $uid, PDO::PARAM_STR);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                $cnt = 1;
                if($query->rowCount() > 0) {
                    foreach($results as $row) {
                ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="fullname" value="<?php echo htmlentities($row->FullName);?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Mobile Number</label>
                            <input type="text" class="form-control" name="mobileno" value="<?php echo htmlentities($row->MobileNumber);?>" required maxlength="10" pattern="[0-9]+">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Email ID <span class="readonly-note">(Can't be changed)</span></label>
                            <input type="email" class="form-control" name="emailid" value="<?php echo htmlentities($row->EmailId);?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Age</label>
                            <input type="text" class="form-control" name="age" value="<?php echo htmlentities($row->Age);?>" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Gender</label>
                            <select class="form-control" name="gender" required>
                                <option value="<?php echo htmlentities($row->Gender);?>"><?php echo htmlentities($row->Gender);?></option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Blood Group</label>
                            <select class="form-control" name="bloodgroup" required>
                                <option value="<?php echo htmlentities($row->BloodGroup);?>"><?php echo htmlentities($row->BloodGroup);?></option>
                                <?php 
                                $sql = "SELECT * FROM tblbloodgroup";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $bloodgroups = $query->fetchAll(PDO::FETCH_OBJ);
                                if($query->rowCount() > 0) {
                                    foreach($bloodgroups as $bg) {
                                ?>
                                <option value="<?php echo htmlentities($bg->BloodGroup);?>"><?php echo htmlentities($bg->BloodGroup);?></option>
                                <?php }} ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Address</label>
                    <input type="text" class="form-control" name="address" value="<?php echo htmlentities($row->Address);?>" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Message</label>
                    <textarea class="form-control" name="message" rows="3" required><?php echo htmlentities($row->Message);?></textarea>
                </div>

                <div class="text-center">
                    <button type="submit" name="update" class="btn btn-update">Update Profile</button>
                </div>
                <?php 
                    }
                } 
                ?>
            </form>
        </div>
    </div>

    <?php include('includes/footer.php');?>

    <script src="js/bootstrap.js"></script>
</body>
</html>
<?php } ?>
