<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
    exit;
} else {
    // Code for adding blood group
    if (isset($_POST['submit'])) {
        $bloodgroup = $_POST['bloodgroup'];
        $sql = "INSERT INTO tblbloodgroup(BloodGroup) VALUES(:bloodgroup)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':bloodgroup', $bloodgroup, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $msg = "Blood Group Created successfully";
        } else {
            $error = "Something went wrong. Please try again";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>BBDMS | Add Blood Group</title>

  <!-- Bootstrap CSS -->
  <link href="../css/bootstrap.css" rel="stylesheet">
  <!-- FontAwesome -->
  <link href="../css/fontawesome-all.css" rel="stylesheet">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    /* Global & Layout */
    body {
      font-family: 'Inter', sans-serif;
      margin: 0; padding: 0;
      padding-top: 100px;            /* space for fixed header */
      background-color: #f8f9fa;
    }

    /* Fixed Header */
    nav.navbar {
      position: fixed; top: 0; left: 0; right: 0;
      height: 100px;
      background: linear-gradient(135deg,#dc3545 0%,#c82333 100%);
      z-index: 1100;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    nav.navbar .navbar-brand img {
      height: 80px;
    }
    nav.navbar .nav-link {
      color: #fff !important; font-weight: 500;
    }
    nav.navbar .nav-link:hover {
      color: #e9ecef !important;
    }

    /* Fixed Sidebar */
    aside.sidebar {
      position: fixed; top: 100px; bottom: 0; left: 0;
      width: 240px;
      background: #fff;
      border-right: 1px solid #e0e0e0;
      box-shadow: 2px 0 8px rgba(0,0,0,0.05);
      overflow-y: auto;
      z-index: 1050;
    }
    aside.sidebar .nav-link {
      display: block;
      color: #495057 !important; font-weight: 500;
      padding: .75rem 1.5rem;
      border-left: 4px solid transparent;
      transition: .2s;
    }
    aside.sidebar .nav-link:hover {
      background: #f1f3f5;
      border-left-color: #dc3545;
      color: #212529 !important;
    }
    aside.sidebar .nav-link.active {
      background: #e9ecef;
      border-left-color: #c82333;
      color: #212529 !important;
    }

    /* Main Content */
    .main-content {
      margin-left: 240px; padding: 2rem;
      min-height: calc(100vh - 100px);
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

    /* Alerts & Form */
    .errorWrap, .succWrap {
      padding: 1rem; margin-bottom: 1.5rem; background: #fff;
      border-left: 4px solid; border-radius: 8px;
      box-shadow: 0 .125rem .25rem rgba(0,0,0,0.075);
    }
    .errorWrap  { border-color: #dc3545; }
    .succWrap   { border-color: #198754; }

    .form-container {
      background: #fff; border-radius: 15px;
      box-shadow: 0 .125rem .25rem rgba(0,0,0,0.075);
      padding: 2.5rem;
    }
    .form-group { margin-bottom: 1.5rem; }
    .form-label {
      font-weight: 600; color: #495057;
      margin-bottom: .5rem; font-size: .95rem;
      display: block;
    }
    .form-select, .btn-primary {
      border-radius: 8px;
      transition: all .2s ease-in-out;
      font-size: 1rem;
    }
    .form-select {
      padding: .875rem 1rem;
      border: 1px solid #ced4da;
    }
    .form-select:focus {
      border-color: #80bdff;
      box-shadow: 0 0 0 .2rem rgba(0,123,255,0.25);
      outline: none;
    }
    .btn-primary {
      padding: .875rem 1.5rem;
      font-weight: 600;
      background: linear-gradient(135deg,#2c3e50 0%,#3498db 100%);
      border: none;
    }
    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 .5rem 1rem rgba(0,0,0,0.15);
    }

    @media (max-width: 768px) {
      .main-content { margin-left: 0; padding: 1rem; }
      aside.sidebar { display: none; }
      .form-container { padding: 1.5rem; }
    }
  </style>
</head>
<body>

  <!-- HEADER -->
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="dashboard.php">
        <img src="../images/logo.png" alt="BBDMS Logo">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
              data-bs-target="#navMenu" aria-controls="navMenu"
              aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navMenu">
        <ul class="navbar-nav align-items-center">
          <li class="nav-item"><a class="nav-link" href="profile.php"><i class="fas fa-user me-1"></i>Profile</a></li>
          <li class="nav-item"><a class="nav-link" href="change-password.php"><i class="fas fa-key me-1"></i>Change Password</a></li>
          <li class="nav-item"><a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt me-1"></i>Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- SIDEBAR -->
  <aside class="sidebar">
    <?php $cur = basename($_SERVER['PHP_SELF']); ?>
    <ul class="nav flex-column mt-3">
      <li class="nav-item">
        <a class="nav-link<?php if ($cur==='dashboard.php') echo ' active'; ?>" href="dashboard.php">
          <i class="fas fa-home me-2"></i>Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link<?php if ($cur==='manage-bloodgroup.php') echo ' active'; ?>" href="manage-bloodgroup.php">
          <i class="fas fa-tint me-2"></i>Blood Groups
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link<?php if ($cur==='donor-list.php') echo ' active'; ?>" href="donor-list.php">
          <i class="fas fa-users me-2"></i>Donor List
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link<?php if ($cur==='manage-conactusquery.php') echo ' active'; ?>" href="manage-conactusquery.php">
          <i class="fas fa-envelope me-2"></i>Manage Queries
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link<?php if ($cur==='manage-pages.php') echo ' active'; ?>" href="manage-pages.php">
          <i class="fas fa-file-alt me-2"></i>Manage Pages
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link<?php if ($cur==='update-contactinfo.php') echo ' active'; ?>" href="update-contactinfo.php">
          <i class="fas fa-address-book me-2"></i>Update Contact
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link<?php if ($cur==='requests-received.php') echo ' active'; ?>" href="requests-received.php">
          <i class="fas fa-hand-holding-medical me-2"></i>Blood Requests
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link<?php if ($cur==='search-requests.php') echo ' active'; ?>" href="search-requests.php">
          <i class="fas fa-search me-2"></i>Search Requests
        </a>
      </li>
    </ul>
  </aside>

  <!-- MAIN CONTENT -->
  <main class="main-content">
    <div class="page-header">
      <h1 class="page-title">Add Blood Group</h1>
    </div>

    <div class="form-container">
      <form method="post" class="needs-validation" novalidate>
        <?php if (!empty($error)) { ?>
          <div class="errorWrap">
            <strong>ERROR</strong>: <?= htmlentities($error) ?>
          </div>
        <?php } elseif (!empty($msg)) { ?>
          <div class="succWrap">
            <strong>SUCCESS</strong>: <?= htmlentities($msg) ?>
          </div>
        <?php } ?>

        <div class="form-group">
          <label for="bloodgroup" class="form-label">Blood Group</label>
          <select id="bloodgroup" name="bloodgroup" class="form-select" required>
            <option value="">Select Blood Group</option>
            <option value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
          </select>
          <div class="invalid-feedback">Please select a blood group.</div>
        </div>

        <button class="btn btn-primary" name="submit" type="submit">Submit</button>
      </form>
    </div>
  </main>

  <script src="../js/bootstrap.bundle.min.js"></script>
  <script>
    // Bootstrap form validation
    (function() {
      'use strict';
      document.querySelectorAll('.needs-validation').forEach(function(form) {
        form.addEventListener('submit', function(event) {
          if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        });
      });
    })();
  </script>
</body>
</html>
