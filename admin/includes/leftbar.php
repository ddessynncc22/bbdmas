<div class="sidebar bg-light">
	<style>
		.sidebar {
			position: fixed;
			top: 0;
			bottom: 0;
			left: 0;
			z-index: 100;
			padding: 48px 0 0;
			box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
			width: 250px;
		}
		.sidebar-sticky {
			position: relative;
			top: 0;
			height: calc(100vh - 48px);
			padding-top: .5rem;
			overflow-x: hidden;
			overflow-y: auto;
		}
		.nav-link {
			font-weight: 500;
			color: #333;
			padding: 0.75rem 1rem;
			transition: all 0.2s ease-in-out;
		}
		.nav-link:hover {
			color: #dc3545;
			background-color: rgba(220, 53, 69, 0.1);
		}
		.nav-link.active {
			color: #dc3545;
			background-color: rgba(220, 53, 69, 0.1);
		}
		.nav-link i {
			width: 20px;
			text-align: center;
		}
		.collapse {
			background-color: rgba(0, 0, 0, 0.02);
		}
		.nav-item .nav-link {
			padding-left: 2rem;
		}
	</style>
	<div class="sidebar-sticky">
		<ul class="nav flex-column">
			<li class="nav-item">
				<a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>" href="dashboard.php">
					<i class="fas fa-tachometer-alt me-2"></i> Dashboard
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link <?php echo in_array(basename($_SERVER['PHP_SELF']), ['add-bloodgroup.php', 'manage-bloodgroup.php']) ? 'active' : ''; ?>" data-bs-toggle="collapse" href="#bloodGroupMenu">
					<i class="fas fa-tint me-2"></i> Blood Group
					<i class="fas fa-chevron-down float-end"></i>
				</a>
				<div class="collapse <?php echo in_array(basename($_SERVER['PHP_SELF']), ['add-bloodgroup.php', 'manage-bloodgroup.php']) ? 'show' : ''; ?>" id="bloodGroupMenu">
					<ul class="nav flex-column ps-3">
						<li class="nav-item">
							<a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'add-bloodgroup.php' ? 'active' : ''; ?>" href="add-bloodgroup.php">Add Blood Group</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'manage-bloodgroup.php' ? 'active' : ''; ?>" href="manage-bloodgroup.php">Manage Blood Group</a>
						</li>
					</ul>
				</div>
			</li>
			<li class="nav-item">
				<a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'donor-list.php' ? 'active' : ''; ?>" href="donor-list.php">
					<i class="fas fa-users me-2"></i> Donor List
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'manage-conactusquery.php' ? 'active' : ''; ?>" href="manage-conactusquery.php">
					<i class="fas fa-envelope me-2"></i> Manage Contact Queries
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'manage-pages.php' ? 'active' : ''; ?>" href="manage-pages.php">
					<i class="fas fa-file-alt me-2"></i> Manage Pages
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'update-contactinfo.php' ? 'active' : ''; ?>" href="update-contactinfo.php">
					<i class="fas fa-address-card me-2"></i> Update Contact Info
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'blood-requests.php' ? 'active' : ''; ?>" href="blood-requests.php">
					<i class="fas fa-hand-holding-medical me-2"></i> Blood Requests
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'request-received-bydonar.php' ? 'active' : ''; ?>" href="request-received-bydonar.php">
					<i class="fas fa-search me-2"></i> Search Blood Request
				</a>
			</li>
		</ul>
	</div>
</div>