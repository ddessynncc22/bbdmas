<?php error_reporting(0);
session_start(); ?>
<!-- header -->
<header>
    <!-- top-bar -->
    <div class="top-bar py-2 bg-danger">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 top-social-agile">
                    <div class="row">
                        <!-- social icons -->
                        <ul class="col-lg-4 col-6 top-right-info text-center">
                            <li>
                                <a href="#" class="text-white">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>
                            <li class="mx-3">
                                <a href="#" class="text-white">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-white">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </li>
                            <li class="ml-3">
                                <a href="#" class="text-white">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </li>
                        </ul>
                        <?php 
                        $pagetype="contactus";
                        $sql = "SELECT * from tblcontactusinfo";
                        $query = $dbh -> prepare($sql);
                        $query->execute();
                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                        $cnt=1;
                        if($query->rowCount() > 0)
                        {
                            foreach($results as $result)
                            { ?>
                                <!-- //social icons -->
                                <div class="col-6 header-top_w3layouts pl-3 text-lg-left text-center">
                                    <p class="text-white">
                                        <i class="fas fa-map-marker-alt mr-2"></i><?php echo $result->Address; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 top-social-agile text-lg-right text-center">
                            <div class="row">
                                <div class="col-lg-7 col-6 top-w3layouts">
                                    <p class="text-white">
                                        <i class="far fa-envelope-open mr-2"></i>
                                        <a href="mailto:<?php echo $result->EmailId; ?>" class="text-white"><?php echo $result->EmailId; ?></a>
                                    </p>
                                </div>
                                <div class="col-lg-5 col-6 header-w3layouts pl-4 text-lg-left">
                                    <p class="text-white">
                                        <i class="fas fa-phone mr-2"></i>+<?php echo $result->ContactNo; ?>
                                    </p>
                                </div>
                            </div>
                        <?php } } ?>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- //top-bar -->

    <!-- header 2 -->
    <div id="home">
        <!-- navigation -->
        <div class="main-top py-1">
            <nav class="navbar navbar-expand-lg navbar-light bg-danger fixed-top">
                <div class="container">
                    <!-- Logo -->
                    <a class="navbar-brand" href="index.php">
                        <img src="images/bbdms.png" alt="BBDMS Logo" height="50">
                    </a>

                    <!-- Mobile Toggle Button -->
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" 
                            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <!-- Navigation Links -->
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="about.php">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="contact.php">Contact Us</a>
                            </li>
                            
                            <?php if (strlen($_SESSION['bbdmsdid'])==0): ?>
                                <!-- Show when user is NOT logged in -->
                                <li class="nav-item">
                                    <a class="nav-link" href="login.php">Login</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="sign-up.php">Sign Up</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="admin/index.php">Admin</a>
                                </li>
                            <?php else: ?>
                                <!-- Show when user is logged in -->
                                <li class="nav-item">
                                    <a class="nav-link" href="profile.php">My Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="contact-blood.php">Contact Blood</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="request-received.php">Blood Requests</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="search-donor.php">Search Donor</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="logout.php">Logout</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <!-- //navigation -->
    </div>
    <!-- //header 2 -->
</header>

<!-- Add spacing after navbar -->
<div style="margin-top: 76px;"></div>