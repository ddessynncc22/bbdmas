<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (isset($_POST['send'])) {
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $contactno = $_POST['contactno'];
    $message = $_POST['message'];
    $sql = "INSERT INTO tblcontactusquery(name, EmailId, ContactNumber, Message) VALUES(:name, :email, :contactno, :message)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':contactno', $contactno, PDO::PARAM_STR);
    $query->bindParam(':message', $message, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if ($lastInsertId) {
        echo '<script>alert("Query Sent. We will contact you shortly.")</script>';
    } else {
        echo "<script>alert('Something went wrong. Please try again.');</script>";  
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact Us | Blood Bank Donor Management System</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <link rel="stylesheet" href="css/fontawesome-all.css">
</head>
<body>
    <?php include('includes/header.php'); ?>

    <!-- Hero -->
    <section class="inner-banner-w3ls py-5 text-white text-center">
        <div class="container">
            <h1 class="display-5">Contact Us</h1>
        </div>
    </section>

    <!-- Breadcrumb -->
    <div class="breadcrumb-agile py-2">
        <div class="container">
            <ol class="breadcrumb bg-transparent p-0 mb-0">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
            </ol>
        </div>
    </div>

    <!-- Contact Section -->
    <section class="contact-section py-5">
        <div class="container py-lg-4">
            <div class="text-center mb-5">
                <h2 class="mb-2">Get in Touch</h2>
                <p class="text-muted">We’d love to hear from you. Fill in the form below to reach us.</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <form method="post" class="bg-light p-4 rounded shadow-sm">
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Full Name</label>
                            <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Enter your name" required>
                        </div>
                        <div class="mb-3">
                            <label for="contactno" class="form-label">Phone Number</label>
                            <input type="tel" name="contactno" id="contactno" class="form-control" placeholder="Enter your contact number" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea name="message" id="message" class="form-control" rows="5" placeholder="Type your message here..." required></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" name="send" class="btn btn-primary px-4">Send Message</button>
                        </div>
                    </form>
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
