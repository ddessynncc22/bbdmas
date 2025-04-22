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
    <title>Search Results | Blood Bank Donor Management System</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/fontawesome-all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include('includes/header.php');?>

    <!-- Results Section -->
    <section class="results-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-primary text-white py-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="mb-0">Search Results</h3>
                                <a href="search-donor.php" class="btn btn-light btn-sm">
                                    <i class="fas fa-search me-2"></i>New Search
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <?php
                            if(isset($_POST['search'])) {
                                $status = 1;
                                $bloodgroup = $_POST['bloodgroup'];
                                $state = $_POST['state'];
                                $city = $_POST['city'];
                                $area = $_POST['area'];

                                $sql = "SELECT * FROM tblblooddonars WHERE status=:status AND BloodGroup=:bloodgroup AND State=:state AND City=:city AND Area=:area";
                                $query = $dbh->prepare($sql);
                                $query->bindParam(':status', $status, PDO::PARAM_STR);
                                $query->bindParam(':bloodgroup', $bloodgroup, PDO::PARAM_STR);
                                $query->bindParam(':state', $state, PDO::PARAM_STR);
                                $query->bindParam(':city', $city, PDO::PARAM_STR);
                                $query->bindParam(':area', $area, PDO::PARAM_STR);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);

                                if($query->rowCount() > 0) {
                                    foreach($results as $result) {
                            ?>
                            <div class="donor-card mb-4">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <div class="row">
                                            <div class="col-md-3 text-center">
                                                <img src="images/blood-donor.jpg" alt="Donor" class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                                                <h4 class="mb-2"><?php echo htmlentities($result->FullName);?></h4>
                                                <span class="badge bg-primary mb-3"><?php echo htmlentities($result->BloodGroup);?></span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fas fa-venus-mars text-primary me-2"></i>
                                                            <div>
                                                                <small class="text-muted">Gender</small>
                                                                <p class="mb-0"><?php echo htmlentities($result->Gender);?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fas fa-phone text-primary me-2"></i>
                                                            <div>
                                                                <small class="text-muted">Mobile</small>
                                                                <p class="mb-0"><?php echo htmlentities($result->MobileNumber);?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fas fa-envelope text-primary me-2"></i>
                                                            <div>
                                                                <small class="text-muted">Email</small>
                                                                <p class="mb-0"><?php echo htmlentities($result->EmailId);?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fas fa-birthday-cake text-primary me-2"></i>
                                                            <div>
                                                                <small class="text-muted">Age</small>
                                                                <p class="mb-0"><?php echo htmlentities($result->Age);?> years</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                                            <div>
                                                                <small class="text-muted">Address</small>
                                                                <p class="mb-0"><?php echo htmlentities($result->Address);?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php if($result->Message) { ?>
                                                    <div class="col-12 mb-3">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fas fa-comment text-primary me-2"></i>
                                                            <div>
                                                                <small class="text-muted">Message</small>
                                                                <p class="mb-0"><?php echo htmlentities($result->Message);?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="d-flex justify-content-end mt-3">
                                                    <a href="contact-blood.php?cid=<?php echo $result->id;?>" class="btn btn-primary">
                                                        <i class="fas fa-envelope me-2"></i>Contact Donor
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php 
                                    }
                                } else {
                            ?>
                            <div class="text-center py-5">
                                <i class="fas fa-search fa-4x text-muted mb-4"></i>
                                <h3 class="mb-3">No Donors Found</h3>
                                <p class="text-muted mb-4">We couldn't find any donors matching your search criteria.</p>
                                <a href="search-donor.php" class="btn btn-primary">
                                    <i class="fas fa-search me-2"></i>Try Another Search
                                </a>
                            </div>
                            <?php
                                }
                            } else {
                            ?>
                            <div class="text-center py-5">
                                <i class="fas fa-exclamation-circle fa-4x text-muted mb-4"></i>
                                <h3 class="mb-3">Invalid Search</h3>
                                <p class="text-muted mb-4">Please perform a search to view results.</p>
                                <a href="search-donor.php" class="btn btn-primary">
                                    <i class="fas fa-search me-2"></i>Search Donors
                                </a>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Emergency Section -->
    <section class="emergency-section py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <div class="emergency-card p-4 rounded shadow-sm">
                        <h3 class="mb-4">Need Blood Urgently?</h3>
                        <p class="lead mb-4">Call our 24/7 emergency helpline for immediate assistance</p>
                        <div class="d-flex justify-content-center gap-3">
                            <a href="tel:+1234567890" class="btn btn-danger btn-lg">
                                <i class="fas fa-phone-alt me-2"></i>Emergency Helpline
                            </a>
                            <a href="contact-us.php" class="btn btn-outline-danger btn-lg">
                                <i class="fas fa-envelope me-2"></i>Contact Us
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include('includes/footer.php');?>

    <!-- JavaScript -->
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/fixed-nav.js"></script>
    <script src="js/SmoothScroll.min.js"></script>
    <script src="js/move-top.js"></script>
    <script src="js/easing.js"></script>
</body>
</html> 