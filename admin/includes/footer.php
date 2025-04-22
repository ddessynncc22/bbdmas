    <footer class="bg-danger text-white py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h2 class="h4 mb-3">
                        <a href="dashboard.php" class="text-white text-decoration-none">
                            <span class="fw-bold">BB</span>DMS Admin
                            <i class="fas fa-syringe ms-2"></i>
                        </a>
                    </h2>
                    <p class="mb-0">Administrative dashboard for blood bank management.</p>
                </div>
                <div class="col-lg-4">
                    <h3 class="h4 mb-3">Admin Tools</h3>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fas fa-users me-2"></i>
                            <a href="donor-list.php" class="text-white text-decoration-none">Manage Donors</a>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-tint me-2"></i>
                            <a href="manage-bloodgroup.php" class="text-white text-decoration-none">Blood Groups</a>
                        </li>
                        <li>
                            <i class="fas fa-envelope me-2"></i>
                            <a href="manage-conactusquery.php" class="text-white text-decoration-none">Contact Queries</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h3 class="h4 mb-3">Quick Links</h3>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="dashboard.php" class="text-white text-decoration-none">Dashboard</a>
                        </li>
                        <li class="mb-2">
                            <a href="profile.php" class="text-white text-decoration-none">Profile</a>
                        </li>
                        <li class="mb-2">
                            <a href="change-password.php" class="text-white text-decoration-none">Change Password</a>
                        </li>
                        <li>
                            <a href="logout.php" class="text-white text-decoration-none">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-top border-light mt-4 pt-4 text-center">
                <p class="mb-0">&copy; <?php echo date('Y'); ?> Blood Bank & Donor Management System - Admin Panel</p>
            </div>
        </div>
    </footer>

    <script src="../js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

        // Initialize popovers
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>
</body>
</html> 