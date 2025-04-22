<footer class="bg-danger text-white py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <h2 class="h4 mb-3">
                    <a href="index.php" class="text-white text-decoration-none">
                        <span class="fw-bold">Blood Bank & </span>Donor Management System
                        <i class="fas fa-syringe ms-2"></i>
                    </a>
                </h2>
                <p class="mb-0">Helping save lives through blood donation.</p>
            </div>
            <div class="col-lg-4">
                <h3 class="h4 mb-3">Contact Info</h3>
                <ul class="list-unstyled">
                    <?php 
                    $sql = "SELECT * from tblcontactusinfo";
                    $query = $dbh->prepare($sql);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    if($query->rowCount() > 0) {
                        foreach($results as $result) { ?>
                            <li class="mb-2">
                                <i class="fas fa-map-marker-alt me-2"></i>
                                <?php echo $result->Address; ?>
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-phone me-2"></i>
                                +<?php echo $result->ContactNo; ?>
                            </li>
                            <li>
                                <i class="far fa-envelope me-2"></i>
                                <a href="mailto:<?php echo $result->EmailId; ?>" class="text-white">
                                    <?php echo $result->EmailId; ?>
                                </a>
                            </li>
                    <?php }} ?>
                </ul>
            </div>
            <div class="col-lg-4">
                <h3 class="h4 mb-3">Quick Links</h3>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="index.php" class="text-white text-decoration-none">Home</a>
                    </li>
                    <li class="mb-2">
                        <a href="about.php" class="text-white text-decoration-none">About Us</a>
                    </li>
                    <li class="mb-2">
                        <a href="contact.php" class="text-white text-decoration-none">Contact Us</a>
                    </li>
                    <li class="mb-2">
                        <a href="donor-list.php" class="text-white text-decoration-none">Donor List</a>
                    </li>
                    <li>
                        <a href="search-donor.php" class="text-white text-decoration-none">Search Donor</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="border-top border-light mt-4 pt-4 text-center">
            <p class="mb-0">&copy; <?php echo date('Y'); ?> Blood Bank & Donor Management System</p>
        </div>
    </div>
</footer>