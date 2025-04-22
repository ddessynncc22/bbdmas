<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BBDMS | Admin Dashboard</title>

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
      margin: 0;
      padding: 0;
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
    nav.navbar .nav-link { color: #fff !important; }
    nav.navbar .nav-link:hover { color: #e9ecef !important; }

    /* Sidebar */
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
      color: #495057 !important;
      font-weight: 500;
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
      margin-top: 100px;
      margin-left: 240px;
      padding: 2rem;
      min-height: calc(100vh - 100px);
    }
    .page-header {
      margin-bottom: 2rem;
      border-bottom: 1px solid #dee2e6;
      padding-bottom: 1rem;
    }
    .page-title {
      font-size: 1.75rem;
      font-weight: 600;
      color: #343a40;
      margin: 0;
    }

    /* Dashboard Cards */
    .dashboard-card {
      border: none;
      border-radius: 10px;
      box-shadow: 0 .125rem .25rem rgba(0,0,0,0.075);
      transition: transform .2s, box-shadow .2s;
      overflow: hidden;
    }
    .dashboard-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 .5rem 1rem rgba(0,0,0,0.15);
    }
    .stat-number {
      font-size: 2.5rem;
      font-weight: 700;
      line-height: 1.2;
    }
    .stat-title {
      font-size: 1rem;
      font-weight: 500;
      opacity: .8;
      margin-top: .5rem;
    }
    .card-icon {
      position: absolute;
      top: 1rem;
      right: 1rem;
      font-size: 2rem;
      opacity: .2;
    }
    .card-link {
      text-decoration: none;
      color: inherit;
    }
    .card-footer {
      border-top: 1px solid rgba(255,255,255,0.2);
      background-color: rgba(0,0,0,0.1);
      padding: .75rem 1.25rem;
      transition: background-color .2s;
    }
    .card-footer:hover {
      background-color: rgba(0,0,0,0.2);
    }

    @media (max-width: 768px) {
      .main-content {
        margin-left: 0;
        padding: 1rem;
      }
      aside.sidebar {
        display: none;
      }
      .stat-number {
        font-size: 2rem;
      }
    }
  </style>
</head>

<body>
  <?php include('includes/header.php'); ?>

  <!-- SIDEBAR -->
  <aside class="sidebar">
    <?php $cur = basename($_SERVER['PHP_SELF']); ?>
    <ul class="nav flex-column mt-3">
      <li class="nav-item">
        <a class="nav-link<?php if ($cur === 'dashboard.php') echo ' active'; ?>" href="dashboard.php">
          <i class="fas fa-home me-2"></i>Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link<?php if ($cur === 'manage-bloodgroup.php') echo ' active'; ?>" href="manage-bloodgroup.php">
          <i class="fas fa-tint me-2"></i>Blood Groups
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link<?php if ($cur === 'donor-list.php') echo ' active'; ?>" href="donor-list.php">
          <i class="fas fa-users me-2"></i>Donor List
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link<?php if ($cur === 'manage-conactusquery.php') echo ' active'; ?>" href="manage-conactusquery.php">
          <i class="fas fa-envelope me-2"></i>Manage Queries
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link<?php if ($cur === 'manage-pages.php') echo ' active'; ?>" href="manage-pages.php">
          <i class="fas fa-file-alt me-2"></i>Manage Pages
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link<?php if ($cur === 'update-contactinfo.php') echo ' active'; ?>" href="update-contactinfo.php">
          <i class="fas fa-address-book me-2"></i>Update Contact
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link<?php if ($cur === 'requests-received.php') echo ' active'; ?>" href="requests-received.php">
          <i class="fas fa-hand-holding-medical me-2"></i>Blood Requests
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link<?php if ($cur === 'search-requests.php') echo ' active'; ?>" href="search-requests.php">
          <i class="fas fa-search me-2"></i>Search Requests
        </a>
      </li>
    </ul>
  </aside>

  <!-- MAIN CONTENT -->
  <main class="main-content">
    <div class="page-header">
      <h1 class="page-title">Dashboard</h1>
    </div>

    <div class="row g-4">
      <!-- Blood Groups Card -->
      <div class="col-md-6 col-lg-3">
        <div class="card dashboard-card bg-danger text-white">
          <i class="fas fa-tint card-icon"></i>
          <div class="card-body">
            <?php 
              $sql = "SELECT id FROM tblbloodgroup";
              $query = $dbh->prepare($sql);
              $query->execute();
              $bg = $query->rowCount();
            ?>
            <div class="stat-number"><?php echo htmlentities($bg); ?></div>
            <div class="stat-title">Listed Blood Groups</div>
          </div>
          <a href="manage-bloodgroup.php" class="card-link">
            <div class="card-footer text-center">
              View Details <i class="fas fa-arrow-right ms-2"></i>
            </div>
          </a>
        </div>
      </div>

      <!-- Registered Donors Card -->
      <div class="col-md-6 col-lg-3">
        <div class="card dashboard-card bg-success text-white">
          <i class="fas fa-users card-icon"></i>
          <div class="card-body">
            <?php 
              $sql1 = "SELECT id FROM tblblooddonars";
              $query1 = $dbh->prepare($sql1);
              $query1->execute();
              $regbd = $query1->rowCount();
            ?>
            <div class="stat-number"><?php echo htmlentities($regbd); ?></div>
            <div class="stat-title">Registered Donors</div>
          </div>
          <a href="donor-list.php" class="card-link">
            <div class="card-footer text-center">
              View Details <i class="fas fa-arrow-right ms-2"></i>
            </div>
          </a>
        </div>
      </div>

      <!-- Total Queries Card -->
      <div class="col-md-6 col-lg-3">
        <div class="card dashboard-card bg-info text-white">
          <i class="fas fa-envelope card-icon"></i>
          <div class="card-body">
            <?php 
              $sql6 = "SELECT id FROM tblcontactusquery";
              $query6 = $dbh->prepare($sql6);
              $query6->execute();
              $query = $query6->rowCount();
            ?>
            <div class="stat-number"><?php echo htmlentities($query); ?></div>
            <div class="stat-title">Total Queries</div>
          </div>
          <a href="manage-conactusquery.php" class="card-link">
            <div class="card-footer text-center">
              View Details <i class="fas fa-arrow-right ms-2"></i>
            </div>
          </a>
        </div>
      </div>

      <!-- Blood Requests Card -->
      <div class="col-md-6 col-lg-3">
        <div class="card dashboard-card bg-warning text-white">
          <i class="fas fa-hand-holding-medical card-icon"></i>
          <div class="card-body">
            <?php 
              $sql7 = "SELECT ID FROM tblbloodrequirer";
              $query7 = $dbh->prepare($sql7);
              $query7->execute();
              $totalrequests = $query7->rowCount();
            ?>
            <div class="stat-number"><?php echo htmlentities($totalrequests); ?></div>
            <div class="stat-title">Blood Requests</div>
          </div>
          <a href="requests-received.php" class="card-link">
            <div class="card-footer text-center">
              View Details <i class="fas fa-arrow-right ms-2"></i>
            </div>
          </a>
        </div>
      </div>
    </div>
  </main>

  <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
