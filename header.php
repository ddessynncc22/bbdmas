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
        body { font-family: 'Inter', sans-serif; }
        .top-bar {
            background: #dc3545;
            color: #fff;
        }
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
        }
        .nav-link {
            font-weight: 500;
        }
        .dropdown-menu {
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
        }
        .dropdown-item {
            font-weight: 500;
        }
        .login-button {
            background: #fff;
            color: #dc3545;
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .login-button:hover {
            background: #f8f9fa;
            color: #c82333;
            text-decoration: none;
        }
    </style>
</head>
<body class="bg-light text-dark">
    <!-- Top Bar -->
    <div class="top-bar py-2">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="d-flex align-items-center">
                        <?php 
                        $sql = "SELECT * from tblcontactusinfo";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                        if($query->rowCount() > 0) {
                            foreach($results as $result) { ?>
                                <div class="me-4">
                                    <i class="fas fa-map-marker-alt me-2"></i>
                                    <?php echo $result->Address; ?>
                                </div>
                                <div class="me-4">
                                    <i class="far fa-envelope-open me-2"></i>
                                    <a href="mailto:<?php echo $result->EmailId; ?>" class="text-white text-decoration-none"><?php echo $result->EmailId; ?></a>
                                </div>
                                <div>
                                    <i class="fas fa-phone me-2"></i>
                                    +<?php echo $result->ContactNo; ?>
                                </div>
                        <?php }} ?>
                    </div>
                </div>
                <div class="col-md-4 text-end">
                    <div class="social-icons">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-google-plus-g"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-pinterest-p"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <span class="fw-bold">BB</span>DMS
                <i class="fas fa-syringe ms-2"></i>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="donor-list.php">Donor List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="search-donor.php">Search Donor</a>
                    </li>
                    <?php if (isset($_SESSION['bbdmsdid']) && $_SESSION['bbdmsdid'] != '') { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="profile.php" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle me-2"></i>
                            <?php echo $_SESSION['login']; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="profile.php">
                                <i class="fas fa-user me-2"></i>Profile
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="change-password.php">
                                <i class="fas fa-key me-2"></i>Change Password
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="request-received.php">
                                <i class="fas fa-inbox me-2"></i>Request Received
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="logout.php">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </a></li>
                        </ul>
                    </li>
                    <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="admin/index.php">Admin</a>
                    </li>
                    <li class="nav-item ms-3">
                        <a href="login.php" class="login-button">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Register Modal -->
    <?php if (!isset($_SESSION['bbdmsdid']) || $_SESSION['bbdmsdid'] == '') { ?>
    <div class="modal fade" id="registerModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Register Now</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="post" name="signup" onsubmit="return checkpass();">
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Full Name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mobile Number</label>
                            <input type="text" class="form-control" name="mobileno" id="mobileno" required placeholder="Mobile Number" maxlength="10" pattern="[0-9]+">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email Id</label>
                            <input type="email" name="emailid" class="form-control" placeholder="Email Id">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Age</label>
                            <input type="text" class="form-control" name="age" id="age" placeholder="Age" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-select" required>
                                <option value="">Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Blood Group</label>
                            <select name="bloodgroup" class="form-select" required>
                                <?php 
                                $sql = "SELECT * from tblbloodgroup";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results=$query->fetchAll(PDO::FETCH_OBJ);
                                if($query->rowCount() > 0) {
                                    foreach($results as $result) { ?>  
                                        <option value="<?php echo htmlentities($result->BloodGroup);?>">
                                            <?php echo htmlentities($result->BloodGroup);?>
                                        </option>
                                <?php }} ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" id="address" required placeholder="Address">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea class="form-control" name="message" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>
                        <button type="submit" class="btn btn-danger w-100" name="submit">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</body>
</html>