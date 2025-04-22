<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0) {
    header('location:index.php');
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BBDMS - Admin | <?php echo $page_title; ?></title>
    <link href="../css/bootstrap.css" rel="stylesheet"/>
    <link href="../css/style.css" rel="stylesheet"/>
    <link href="../css/fontawesome-all.css" rel="stylesheet"/>
    <link href="../css/dataTables.bootstrap.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-light">
    <?php include('includes/header.php');?>

    <!-- Main Content -->
    <div class="container py-4">
        <!-- Page specific content goes here -->
    </div>

    <?php include('includes/footer.php');?>
</body>
</html>
<?php } ?>