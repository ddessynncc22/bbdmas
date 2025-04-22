<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blood Bank & Donor Management System</title>
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet" type="text/css">
  <link href="css/fontawesome-all.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body { 
      font-family: 'Inter', sans-serif;
      margin: 0;
      padding: 0;
    }
    .hero {
      padding: 4rem 1rem;
      background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
      color: #fff;
      text-align: center;
      margin: 0;
    }
    .section {
      padding: 3rem 1rem;
      margin: 0;
    }
    .container {
      max-width: 100%;
      padding: 0 1rem;
      margin: 0;
    }
    .carousel {
      margin: 0;
      padding: 0;
    }
    .carousel-inner {
      margin: 0;
      padding: 0;
    }
    .carousel-item img {
      width: 100%;
      height: auto;
    }
  </style>
</head>
<body class="bg-light text-dark">

<?php include('includes/header.php');?>

  <!-- Hero Section -->
  <header class="hero">
    <div class="container">
      <h1 class="display-4 fw-bold">Blood Bank & Donor Management System</h1>
      <p class="lead">Find donors and help save lives today.</p>
    </div>
  </header>

  <!-- Image Carousel -->
  <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="images/banner1.jpg" class="d-block w-100" alt="Banner 1">
    </div>
    <div class="carousel-item">
      <img src="images/banner2.jpg" class="d-block w-100" alt="Banner 2">
    </div>
    <div class="carousel-item">
      <img src="images/banner3.jpg" class="d-block w-100" alt="Banner 3">
    </div>
  </div>
</div>

  <!-- Info Sections -->
  <section class="section bg-white text-center">
    <div class="container">
      <h2 class="fw-bold mb-4">What We Do</h2>
      <p class="mb-4">BB-DMS helps connect blood donors with recipients, hospitals, and clinics to ensure timely and life-saving donations.</p>
    </div>
  </section>

  <section class="section bg-light text-center">
    <div class="container">
      <h2 class="fw-bold mb-4">Get Involved</h2>
      <p>Register as a donor, search for available donors, or contact the nearest blood bank with ease.</p>
    </div>
  </section>

  <?php include('includes/footer.php');?>

  <script src="js/bootstrap.js"></script>
</body>
</html>
