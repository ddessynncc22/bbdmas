<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
    exit;
} else {
    // Handle hide/public/delete actions
    if (isset($_REQUEST['hidden'])) {
        $eid    = intval($_GET['hidden']);
        $status = 0;
        $sql    = "UPDATE tblblooddonars SET Status=:status WHERE id=:eid";
        $query  = $dbh->prepare($sql);
        $query->bindParam(':status', $status, PDO::PARAM_INT);
        $query->bindParam(':eid',    $eid,    PDO::PARAM_INT);
        $query->execute();
        $msg = "Donor details hidden successfully";
    }
    if (isset($_REQUEST['public'])) {
        $aeid   = intval($_GET['public']);
        $status = 1;
        $sql    = "UPDATE tblblooddonars SET Status=:status WHERE id=:aeid";
        $query  = $dbh->prepare($sql);
        $query->bindParam(':status', $status, PDO::PARAM_INT);
        $query->bindParam(':aeid',   $aeid,   PDO::PARAM_INT);
        $query->execute();
        $msg = "Donor details made public";
    }
    if (isset($_REQUEST['del'])) {
        $did = intval($_GET['del']);
        $sql = "DELETE FROM tblblooddonars WHERE id=:did";
        $query = $dbh->prepare($sql);
        $query->bindParam(':did', $did, PDO::PARAM_INT);
        $query->execute();
        $msg = "Record deleted successfully";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>BBDMS | Donor List</title>

  <!-- Bootstrap CSS -->
  <link href="../css/bootstrap.css" rel="stylesheet">
  <!-- Custom Styles -->
  <link href="../css/style.css" rel="stylesheet" type="text/css">
  <!-- FontAwesome -->
  <link href="../css/fontawesome-all.css" rel="stylesheet">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    /* ─── Global & Layout ─── */
    body {
      font-family: 'Inter', sans-serif;
      margin: 0; padding: 0;
      padding-top: 100px;           /* space for fixed header */
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
      color: #fff !important;
      font-weight: 500;
    }
    nav.navbar .nav-link:hover {
      color: #e9ecef !important;
    }

    /* ─── Professional Sidebar ─── */
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

    /* ─── Main Content ─── */
    .main-content {
      margin-left: 240px;
      padding: 2rem;
      min-height: calc(100vh - 100px);
    }
    .page-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding-bottom: 1rem;
      margin-bottom: 2rem;
      border-bottom: 1px solid #dee2e6;
    }
    .page-title {
      font-size: 1.75rem;
      font-weight: 600;
      color: #343a40;
      margin: 0;
    }

    /* ─── Alerts & Table Container ─── */
    .succWrap, .errorWrap {
      padding: 1rem;
      margin-bottom: 1.5rem;
      background: #fff;
      border-left: 4px solid;
      border-radius: 4px;
      box-shadow: 0 .125rem .25rem rgba(0,0,0,0.075);
    }
    .succWrap { border-color: #198754; }
    .errorWrap{ border-color: #dc3545; }

    .table-container {
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 .125rem .25rem rgba(0,0,0,0.075);
      padding: 1.5rem;
    }
    .table thead th {
      background-color: #f8f9fa;
      font-weight: 600;
      color: #495057;
      border-top: none;
    }

    /* ─── Buttons ─── */
    .download-btn {
      background-color: #0d6efd;
      color: #fff;
      padding: .5rem 1rem;
      border-radius: .25rem;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: .5rem;
      transition: background-color .2s, transform .2s;
    }
    .download-btn:hover {
      background-color: #0b5ed7;
      transform: translateY(-2px);
    }
    .action-btn {
      display: inline-flex;
      align-items: center;
      gap: .5rem;
      padding: .375rem .75rem;
      font-size: .875rem;
      border-radius: .25rem;
      transition: transform .2s;
    }
    .action-btn:hover {
      transform: translateY(-1px);
    }

    @media (max-width: 768px) {
      .main-content { margin-left: 0; padding: 1rem; }
      aside.sidebar { display: none; }
      .page-header { flex-direction: column; align-items: flex-start; gap: 1rem; }
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
      <h1 class="page-title">Donor List</h1>
      <a href="download-records.php" class="download-btn">
        <i class="fas fa-download"></i> Download Donor List
      </a>
    </div>

    <div class="table-container">
      <?php if (!empty($error)) { ?>
        <div class="errorWrap">
          <strong>ERROR</strong>: <?php echo htmlentities($error); ?>
        </div>
      <?php } elseif (!empty($msg)) { ?>
        <div class="succWrap">
          <strong>SUCCESS</strong>: <?php echo htmlentities($msg); ?>
        </div>
      <?php } ?>

      <div class="table-responsive">
        <table class="table table-striped table-hover mb-0">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Mobile No</th>
              <th>Email</th>
              <th>Age</th>
              <th>Gender</th>
              <th>Blood Group</th>
              <th>Address</th>
              <th>Message</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql     = "SELECT * FROM tblblooddonars";
            $query   = $dbh->prepare($sql);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);
            $cnt     = 1;
            if ($query->rowCount() > 0) {
              foreach ($results as $result) {
            ?>
            <tr>
              <td><?php echo $cnt; ?></td>
              <td><?php echo htmlentities($result->FullName); ?></td>
              <td><?php echo htmlentities($result->MobileNumber); ?></td>
              <td><?php echo htmlentities($result->EmailId); ?></td>
              <td><?php echo htmlentities($result->Age); ?></td>
              <td><?php echo htmlentities($result->Gender); ?></td>
              <td><?php echo htmlentities($result->BloodGroup); ?></td>
              <td><?php echo htmlentities($result->Address); ?></td>
              <td><?php echo htmlentities($result->Message); ?></td>
              <td>
                <div class="d-flex flex-wrap gap-2">
                  <?php if ($result->Status == 1) { ?>
                    <a href="?hidden=<?php echo $result->id; ?>"
                       onclick="return confirm('Hide this detail?')"
                       class="action-btn btn btn-outline-primary">
                      <i class="fas fa-eye-slash"></i> Hide
                    </a>
                  <?php } else { ?>
                    <a href="?public=<?php echo $result->id; ?>"
                       onclick="return confirm('Make this detail public?')"
                       class="action-btn btn btn-outline-success">
                      <i class="fas fa-eye"></i> Show
                    </a>
                  <?php } ?>
                  <a href="?del=<?php echo $result->id; ?>"
                     onclick="return confirm('Delete this record?')"
                     class="action-btn btn btn-outline-danger">
                    <i class="fas fa-trash-alt"></i> Delete
                  </a>
                </div>
              </td>
            </tr>
            <?php
                $cnt++;
              }
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>

  <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
