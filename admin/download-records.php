<?php
session_start();
session_regenerate_id(true);
include('includes/config.php');

function exportToExcel(PDO $dbh, string $sql, string $filenamePrefix) {
    try {
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "<script>
                alert('Nothing here to download.');
                window.location.href = window.location.href;
              </script>";
        exit();
    }
    if (count($rows) === 0) {
        echo "<script>
                alert('Nothing here to download.');
                window.location.href = window.location.href;
              </script>";
        exit();
    }
    header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
    header('Content-Disposition: attachment; filename="'. $filenamePrefix .'_'. date('Y-m-d') .'.xls"');
    header('Pragma: no-cache');
    header('Expires: 0');
    echo '<table border="1"><tr>';
    foreach (array_keys($rows[0]) as $col) {
        echo '<th>'.htmlentities($col).'</th>';
    }
    echo '</tr>';
    foreach ($rows as $row) {
        echo '<tr>';
        foreach ($row as $cell) {
            echo '<td>'.htmlentities($cell).'</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
    exit();
}

if (isset($_POST['download_donors'])) {
    exportToExcel($dbh, "SELECT * FROM tblblooddonars", "donor_list");
}
if (isset($_POST['download_requests'])) {
    exportToExcel($dbh, "SELECT * FROM tblbloodrequests", "request_list");
}
if (isset($_POST['download_messages'])) {
    exportToExcel($dbh, "SELECT * FROM tblcontactus", "contact_messages");
}

if (empty($_SESSION['alogin'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>BBDMS | Download Records</title>

  <!-- Bootstrap CSS -->
  <link href="../css/bootstrap.css" rel="stylesheet">
  <!-- FontAwesome -->
  <link href="../css/fontawesome-all.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="../css/style.css" rel="stylesheet">
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Inter', sans-serif;
      margin: 0; padding: 0;
      padding-top: 100px;
      background-color: #f8f9fa;
    }
    /* Header */
    nav.navbar {
      position: fixed; top: 0; left: 0; right: 0;
      height: 100px;
      background: linear-gradient(135deg,#dc3545,#c82333);
      z-index: 1100;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    nav.navbar .navbar-brand img { height: 80px; }
    nav.navbar .nav-link { color: #fff !important; font-weight: 500; }
    nav.navbar .nav-link:hover { color: #e9ecef !important; }

    /* Sidebar */
    aside.sidebar {
      position: fixed; top: 100px; bottom: 0; left: 0;
      width: 240px; background: #fff;
      border-right: 1px solid #e0e0e0;
      box-shadow: 2px 0 8px rgba(0,0,0,0.05);
      overflow-y: auto; z-index: 1050;
    }
    aside.sidebar .nav-link {
      display: block; color: #495057 !important; font-weight: 500;
      padding: .75rem 1.5rem; border-left: 4px solid transparent;
      transition: .2s;
    }
    aside.sidebar .nav-link:hover {
      background: #f1f3f5; border-left-color: #dc3545; color: #212529 !important;
    }
    aside.sidebar .nav-link.active {
      background: #e9ecef; border-left-color: #c82333; color: #212529 !important;
    }

    /* Main Content */
    .main-content {
      margin-left: 240px; padding: 2rem;
      min-height: calc(100vh - 100px);
    }
    .page-header {
      padding-bottom: 1rem; margin-bottom: 2rem;
      border-bottom: 1px solid #dee2e6;
    }
    .page-title {
      font-size: 1.75rem; font-weight: 600; color: #343a40; margin: 0;
    }
    .download-options {
      background: #fff; border-radius: 10px;
      box-shadow: 0 .125rem .25rem rgba(0,0,0,.075);
      padding: 2rem;
    }
    .download-card {
      background: #f8f9fa; border-radius: 8px;
      padding: 1.5rem; margin-bottom: 1.5rem;
      transition: transform .3s, box-shadow .3s;
    }
    .download-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 .25rem .5rem rgba(0,0,0,.1);
    }
    .download-card h3 {
      font-size: 1.25rem; font-weight: 600; color: #343a40;
    }
    .download-card p {
      color: #6c757d;
    }
    .download-btn {
      background: #0d6efd; color: #fff; border: none;
      padding: .75rem 1.5rem; border-radius: .25rem;
      display: inline-flex; align-items: center; gap: .5rem;
      transition: transform .2s, background .2s;
    }
    .download-btn:hover {
      background: #0b5ed7; transform: translateY(-1px);
    }
    @media (max-width: 768px) {
      .main-content { margin-left: 0; padding: 1rem; }
      aside.sidebar { display: none; }
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
        <ul class="navbar-nav">
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
      <h1 class="page-title">Download Records</h1>
    </div>
    <div class="download-options">
      <div class="download-card">
        <h3>Download Donor Records</h3>
        <p>Get all registered donors as Excel.</p>
        <form method="post">
          <button name="download_donors" class="download-btn">
            <i class="fas fa-file-excel"></i> Download Donor List
          </button>
        </form>
      </div>
      <div class="download-card">
        <h3>Download Blood Request Records</h3>
        <p>Get all blood requests as Excel.</p>
        <form method="post">
          <button name="download_requests" class="download-btn">
            <i class="fas fa-file-excel"></i> Download Request List
          </button>
        </form>
      </div>
      <div class="download-card">
        <h3>Download Contact Messages</h3>
        <p>Get all contact‑form messages as Excel.</p>
        <form method="post">
          <button name="download_messages" class="download-btn">
            <i class="fas fa-file-excel"></i> Download Messages
          </button>
        </form>
      </div>
    </div>
  </main>
</body>
</html>
