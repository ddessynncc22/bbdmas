<?php
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>About Us - Blood Bank Donor Management System</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Custom-Files -->
    <link href="css/bootstrap.css" rel="stylesheet"/>
    <link href="css/style.css" media="all" rel="stylesheet" type="text/css">
    <link href="css/fontawesome-all.css" rel="stylesheet"/>
    <!-- Web-Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-light text-dark">
    <?php include('includes/header.php');?>

    <!-- Dark Mode Toggle -->
    <button class="dark-mode-toggle" onclick="toggleDarkMode()" style="position:fixed; top:1rem; right:1rem; z-index:1050;">
        <i class="fas fa-moon"></i>
    </button>

    <!-- Page Header -->
    <div class="bg-danger py-5 mb-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="display-4 text-white font-weight-bold mb-3">About Us</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent p-0">
                            <li class="breadcrumb-item"><a href="index.php" class="text-white-50">Home</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page">About Us</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- About Section -->
    <section class="about-section py-5">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="images/aboutlogo.png" alt="Lions Club Logo" class="img-fluid rounded shadow-sm">
                </div>
                <div class="col-lg-6">
                    <h2 class="h1 text-danger mb-4">Lions Club of Biratchowk</h2>
                    <p class="lead mb-4">Lions Club of Biratchowk is proud to present the Blood Donation Donor Management System, a digital initiative dedicated to saving lives through efficient and timely blood donation efforts.</p>
                    <p class="mb-4">As part of Lions Clubs International, the world's largest service organization, we are committed to serving our community with compassion, integrity, and innovation. This platform has been developed to streamline the process of connecting blood donors with those in urgent need, ensuring no life is lost due to blood unavailability.</p>
                </div>
            </div>

            <!-- Vision & Mission -->
            <div class="row mb-5">
                <div class="col-md-6 mb-4 mb-md-0">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-4">
                                <i class="fas fa-eye text-danger fa-2x me-3"></i>
                                <h3 class="h2 mb-0">Our Vision</h3>
                            </div>
                            <p class="mb-0">To create a responsive and reliable network of voluntary blood donors and make safe blood accessible to everyone, anytime.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-4">
                                <i class="fas fa-bullseye text-danger fa-2x me-3"></i>
                                <h3 class="h2 mb-0">Our Mission</h3>
                            </div>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-3 d-flex">
                                    <i class="fas fa-check text-danger me-3 mt-1"></i>
                                    <span>Maintain a well-organized database of voluntary donors</span>
                                </li>
                                <li class="mb-3 d-flex">
                                    <i class="fas fa-check text-danger me-3 mt-1"></i>
                                    <span>Enable faster response times during emergencies</span>
                                </li>
                                <li class="mb-3 d-flex">
                                    <i class="fas fa-check text-danger me-3 mt-1"></i>
                                    <span>Promote awareness and encourage more people to become regular blood donors</span>
                                </li>
                                <li class="d-flex">
                                    <i class="fas fa-check text-danger me-3 mt-1"></i>
                                    <span>Support hospitals, patients, and families through organized donation drives and campaigns</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="text-center py-5">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <p class="lead mb-4">This system is built with the community in mind—designed to empower every individual to be a part of the life-saving process. With your help, we believe we can build a healthier, more compassionate future.</p>
                        <h3 class="h2 text-danger mb-4">Join hands with Lions Club of Biratchowk—Give blood, give life.</h3>
                        <a href="sign-up.php" class="btn btn-danger btn-lg px-5 py-3">Become a Donor Today</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include('includes/footer.php');?>

    <!-- Scripts -->
    <script src="js/jquery-2.2.3.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script>
        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
            const icon = document.querySelector('.dark-mode-toggle i');
            if (document.body.classList.contains('dark-mode')) {
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
                localStorage.setItem('darkMode', 'enabled');
            } else {
                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon');
                localStorage.setItem('darkMode', 'disabled');
            }
        }

        if (localStorage.getItem('darkMode') === 'enabled') {
            document.body.classList.add('dark-mode');
            const icon = document.querySelector('.dark-mode-toggle i');
            icon.classList.remove('fa-moon');
            icon.classList.add('fa-sun');
        }
    </script>
</body>
</html>
