<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('location:../index.php');
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gymnsb";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Mao System Admin</title>
    <link rel="icon" type="image/png" href="../img/Mabini-Logo.ico" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="../css/uniform.css" />
    <link rel="stylesheet" href="../css/select2.css" />
    <link rel="stylesheet" href="../css/matrix-style.css" />
    <link rel="stylesheet" href="../css/matrix-media.css" />
    <link href="../font-awesome/css/fontawesome.css" rel="stylesheet" />
    <link href="../font-awesome/css/all.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>
<body>

<!--Header-part-->
<div id="header">
    <h1><a href="dashboard.html"></a></h1>
</div>
<!--close-Header-part--> 

<!--top-Header-menu-->
<?php include 'includes/topheader.php'; ?>
<!--close-top-Header-menu-->

<!--sidebar-menu-->
<?php $page = 'staff-management'; include 'includes/sidebar.php'; ?>
<!--sidebar-menu-->

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> 
            <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a> 
            <a href="staffs.php" class="current">Staff Members</a> 
        </div>
        <h1 class="text-center">MAO Staff List <i class="fas fa-briefcase"></i></h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <a href="staffs-entry.php"><button class="btn btn-primary">Add Staff Members</button></a>
                <div class='widget-box'>
                    <div class='widget-title'> 
                        <span class='icon'> <i class='fas fa-th'></i> </span>
                        <h5>Staff Table</h5>
                    </div>
                    <div class='widget-content nopadding'>
                        <?php
                        $qry = "SELECT * FROM staffs WHERE is_deleted = 0"; // Only active staff
                        $cnt = 1;
                        $result = mysqli_query($conn, $qry);

                        echo "<table class='table table-bordered table-hover'>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Fullname</th>
                                        <th>Username</th>
                                        <th>Gender</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>";

                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tbody> 
                                    <tr>
                                        <td><div class='text-center'>" . $cnt . "</div></td>
                                        <td><div class='text-center'>" . htmlspecialchars($row['fullname']) . "</div></td>
                                        <td><div class='text-center'>" . htmlspecialchars($row['username']) . "</div></td>
                                        <td><div class='text-center'>" . htmlspecialchars($row['gender']) . "</div></td>
                                        <td>
                                            <div class='text-center'>
                                                <a href='edit-staff-form.php?id=" . htmlspecialchars($row['user_id']) . "'><i class='fas fa-edit' style='color:#28b779'></i> Edit |</a> 
                                                
                                                <!-- Archive Staff Member by setting is_deleted = 1 -->
                                                <a href='archived-staff.php?id=" . htmlspecialchars($row['user_id']) . "' style='color:#F66;'>
                                                    <i class='fas fa-trash'></i> Archive
                                                </a> 

                                                <a href='change-password-staff.php?id=" . htmlspecialchars($row['user_id']) . "' style='color:#3498db;'>
                                                    <i class='fas fa-key'></i> Change Password
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                  </tbody>";
                            $cnt++;
                        }
                        ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--end-main-container-part-->

<!--Footer-part-->
<div class="row-fluid">
    <div id="footer" class="span12"> 
        <?php echo date("Y"); ?> &copy; 
    </div>
</div>

<style>
#footer {
    color: white;
}
</style>

<!--end-Footer-part-->
<script src="../js/jquery.min.js"></script> 
<script src="../js/jquery.ui.custom.js"></script> 
<script src="../js/bootstrap.min.js"></script> 
<script src="../js/jquery.uniform.js"></script> 
<script src="../js/select2.min.js"></script> 
<script src="../js/jquery.dataTables.min.js"></script> 
<script src="../js/matrix.js"></script> 
<script src="../js/matrix.tables.js"></script>
</body>
</html>
