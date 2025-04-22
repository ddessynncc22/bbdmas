<?php 
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['bbdmsdid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['change'])) {
        $uid = $_SESSION['bbdmsdid'];
        $cpassword = md5($_POST['currentpassword']);
        $newpassword = md5($_POST['newpassword']);
        $sql = "SELECT ID FROM tblblooddonars WHERE id=:uid and Password=:cpassword";
        $query = $dbh->prepare($sql);
        $query->bindParam(':uid', $uid, PDO::PARAM_STR);
        $query->bindParam(':cpassword', $cpassword, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {
            $con = "UPDATE tblblooddonars SET Password=:newpassword WHERE id=:uid";
            $chngpwd1 = $dbh->prepare($con);
            $chngpwd1->bindParam(':uid', $uid, PDO::PARAM_STR);
            $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
            $chngpwd1->execute();
            echo '<script>alert("Your password has been changed successfully.")</script>';
        } else {
            echo '<script>alert("Your current password is incorrect.")</script>';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Change Password - Blood Bank Donor Management System</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Custom-Files -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/fontawesome-all.css">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <script>
        function checkpass() {
            if (document.changepassword.newpassword.value !== document.changepassword.confirmpassword.value) {
                alert('New Password and Confirm Password do not match.');
                document.changepassword.confirmpassword.focus();
                return false;
            }
            return true;
        }
    </script>
</head>
<body class="bg-light text-dark">
    <?php include('includes/header.php');?>

    <!-- Page Title -->
    <div class="bg-danger py-5 mb-4">
        <div class="container">
            <h1 class="text-white fw-bold">Change Password</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0">
                    <li class="breadcrumb-item"><a href="index.php" class="text-white-50">Home</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">Change Password</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Change Password Form -->
    <section class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-sm rounded-3 border-0">
                    <div class="card-body p-4">
                        <h3 class="mb-4 text-center text-danger">Reset Your Password</h3>
                        <form method="post" name="changepassword" onsubmit="return checkpass();">
                            <div class="mb-3">
                                <label for="currentpassword" class="form-label">Current Password</label>
                                <input type="password" class="form-control" name="currentpassword" id="currentpassword" required>
                            </div>
                            <div class="mb-3">
                                <label for="newpassword" class="form-label">New Password</label>
                                <input type="password" class="form-control" name="newpassword" id="newpassword" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirmpassword" class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" name="change" class="btn btn-danger">Update Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include('includes/footer.php');?>

    <!-- Scripts -->
    <script src="js/jquery-2.2.3.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>
<?php } ?>
