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

// Archive the staff member (set is_deleted = 1)
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Update query to set is_deleted to 1 (archived)
    $qry = "UPDATE staffs SET is_deleted = 1 WHERE user_id = '$id'";

    if (mysqli_query($conn, $qry)) {
        // Redirect back to the staff list
        header('Location: staffs.php');
    } else {
        echo "Error archiving staff: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Mao System Admin - Archived Staff</title>
    <link rel="icon" type="image/png" href="../img/Mabini-Logo.ico" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="../css/matrix-style.css" />
    <link rel="stylesheet" href="../css/matrix-media.css" />
    <link href="../font-awesome/css/all.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to permanently delete this staff member? This action cannot be undone.');
        }
    </script>
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
<?php $page = 'archived-staffs'; include 'includes/sidebar.php'; ?>
<!--sidebar-menu-->

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> 
            <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a> 
            <a href="archived-staffs.php" class="current">Archived Staff</a> 
        </div>
        <h1 class="text-center">Archived Staff List <i class="fas fa-briefcase"></i></h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class='widget-box'>
                    <div class='widget-title'> 
                        <span class='icon'> <i class='fas fa-th'></i> </span>
                        <h5>Archived Staff Table</h5>
                    </div>
                    <div class='widget-content nopadding'>
                        <?php
                        // Query to get archived staff
                        $qry = "SELECT * FROM staffs WHERE is_deleted = 1";
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
                                                <a href='restore-staff.php?id=" . htmlspecialchars($row['user_id']) . "' style='color:#28b779;'><i class='fas fa-undo'></i> Restore |</a>
                                                 <!-- Permanent Delete Staff with confirmation -->
                                                <a href='permanent-delete-staff.php?id=" . htmlspecialchars($row['user_id']) . "' style='color:#F66;' onclick='return confirmDelete();'>
                                                    <i class='fas fa-trash-alt'></i> Permanent Delete
                                                </a>
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
