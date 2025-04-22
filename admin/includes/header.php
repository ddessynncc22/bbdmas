<?php
// header.php

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Blood Bank & Donor Management System | Admin</title>

  <!-- Bootstrap CSS -->
  <link href="../css/bootstrap.css" rel="stylesheet">
  <!-- Custom Styles -->
  <link href="../css/style.css" rel="stylesheet" type="text/css">
  <!-- FontAwesome -->
  <link href="../css/fontawesome-all.css" rel="stylesheet">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f8f9fa;
    }
    .navbar {
      background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .navbar-brand img {
      height: 100px; /* enlarged logo */
    }
    .nav-link {
      color: #fff !important;
      font-weight: 500;
    }
    .nav-link:hover {
      color: #e9ecef !important;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container-fluid">
      <!-- Left: Logo only -->
      <a class="navbar-brand" href="dashboard.php">
        <img src="../images/logo.png" alt="BBDMS Logo">
      </a>

      <!-- Mobile toggler -->
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Right‑aligned links -->
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav align-items-center">
          <li class="nav-item">
            <a class="nav-link" href="profile.php">
              <i class="fas fa-user me-1"></i>Profile
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="change-password.php">
              <i class="fas fa-key me-1"></i>Change Password
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">
              <i class="fas fa-sign-out-alt me-1"></i>Logout
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- PAGE CONTENT STARTS HERE -->

  <!-- Bootstrap Bundle (with Popper) -->
  <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
