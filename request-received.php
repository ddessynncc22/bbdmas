<?php 
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['bbdmsdid']==0)) {
    header('location:logout.php');
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Bank & Donor Management System | Request Received</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/fontawesome-all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }
        .page-header {
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            color: white;
            padding: 3rem 0;
            margin-bottom: 3rem;
        }
        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        .table-container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
            padding: 2rem;
        }
        .table {
            margin-bottom: 0;
        }
        .table thead th {
            border-top: none;
            font-weight: 600;
            color: #495057;
            background-color: #f8f9fa;
        }
        .table td {
            vertical-align: middle;
        }
        .message-cell {
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .message-cell:hover {
            white-space: normal;
            overflow: visible;
            position: relative;
            z-index: 1;
            background: white;
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
        }
        .no-records {
            text-align: center;
            padding: 2rem;
            color: #dc3545;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <?php include('includes/header.php');?>

    <div class="page-header">
        <div class="container">
            <h1 class="page-title">Request Received</h1>
            <p class="lead">View all blood requests you have received</p>
        </div>
    </div>

    <div class="container">
        <div class="table-container">
            <h5 class="mb-4">Blood Requester Details</h5>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Mobile Number</th>
                            <th>Email</th>
                            <th>Blood Required For</th>
                            <th>Message</th>
                            <th>Apply Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $uid = $_SESSION['bbdmsdid'];
                        $sql = "SELECT tblbloodrequirer.BloodDonarID, tblbloodrequirer.name, tblbloodrequirer.EmailId, 
                               tblbloodrequirer.ContactNumber, tblbloodrequirer.BloodRequirefor, 
                               tblbloodrequirer.Message, tblbloodrequirer.ApplyDate, 
                               tblblooddonars.id as donid 
                               FROM tblbloodrequirer 
                               JOIN tblblooddonars ON tblblooddonars.id=tblbloodrequirer.BloodDonarID 
                               WHERE tblbloodrequirer.BloodDonarID=:uid";
                        $query = $dbh->prepare($sql);
                        $query->bindParam(':uid', $uid, PDO::PARAM_STR);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if($query->rowCount() > 0) {
                            foreach($results as $row) {
                        ?>
                        <tr>
                            <td><?php echo htmlentities($cnt);?></td>
                            <td><?php echo htmlentities($row->name);?></td>
                            <td><?php echo htmlentities($row->ContactNumber);?></td>
                            <td><?php echo htmlentities($row->EmailId);?></td>
                            <td><?php echo htmlentities($row->BloodRequirefor);?></td>
                            <td class="message-cell"><?php echo htmlentities($row->Message);?></td>
                            <td><?php echo htmlentities($row->ApplyDate);?></td>
                        </tr>
                        <?php 
                            $cnt++;
                            }
                        } else {
                        ?>
                        <tr>
                            <td colspan="7" class="no-records">No records found</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include('includes/footer.php');?>

    <script src="js/bootstrap.js"></script>
</body>
</html>
<?php } ?>