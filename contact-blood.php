<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (isset($_POST['send'])) {
    $cid = $_GET['cid'];
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $contactno = $_POST['contactno'];
    $brf = $_POST['brf'];
    $message = $_POST['message'];

    $sql = "INSERT INTO tblbloodrequirer(BloodDonarID, name, EmailId, ContactNumber, BloodRequirefor, Message) 
            VALUES (:cid, :name, :email, :contactno, :brf, :message)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':cid', $cid, PDO::PARAM_STR);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':contactno', $contactno, PDO::PARAM_STR);
    $query->bindParam(':brf', $brf, PDO::PARAM_STR);
    $query->bindParam(':message', $message, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();

    if ($lastInsertId) {
        echo '<script>alert("Request has been sent. We will contact you shortly.")</script>';
    } else {
        echo "<script>alert('Something went wrong. Please try again.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Blood Request | Blood Bank Donor Management System</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Styles -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/fontawesome-all.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-light">
    <?php include('includes/header.php'); ?>

    <!-- Banner -->
    <div class="bg-danger text-white py-5">
        <div class="container">
            <h1 class="fw-bold">Request for Blood</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mt-2">
                    <li class="breadcrumb-item"><a href="index.php" class="text-white-50">Home</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">Blood Needed Person</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Form Section -->
    <section class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body p-4">
                        <h3 class="text-danger text-center mb-4">Fill the form to request blood</h3>
                        <form method="post">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="fullname" class="form-label">Your Name</label>
                                    <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Enter your name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="contactno" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" name="contactno" id="contactno" placeholder="Enter your phone number" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="brf" class="form-label">Blood Required For</label>
                                    <select name="brf" id="brf" class="form-select" required>
                                        <option value="">Select relationship</option>
                                        <option value="Father">Father</option>
                                        <option value="Mother">Mother</option>
                                        <option value="Brother">Brother</option>
                                        <option value="Sister">Sister</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea class="form-control" name="message" id="message" rows="5" placeholder="Enter your message here..." maxlength="999" required></textarea>
                                </div>
                                <div class="col-12 d-grid mt-3">
                                    <button type="submit" name="send" class="btn btn-danger">Send Request</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include('includes/footer.php'); ?>

    <!-- Scripts -->
    <script src="js/jquery-2.2.3.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>
