<?php
session_start();
// Check if the user is logged in, if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Mao System Admin</title>
    <link rel="icon" type="image/png" href="img/Mabini-Logo.ico" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="../css/fullcalendar.css" />
    <link rel="stylesheet" href="../css/matrix-style.css" />
    <link rel="stylesheet" href="../css/matrix-media.css" />
    <link href="../font-awesome/css/fontawesome.css" rel="stylesheet" />
    <link href="../font-awesome/css/all.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/jquery.gritter.css" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>
<body>

<!--Header-part-->
<div id="header">
    <h1><a href="dashboard.html"></a></h1>
</div>
<!--close-Header-part--> 

<!--top-Header-menu-->
<?php include 'includes/topheader.php' ?>
<!--close-top-Header-menu-->

<!--sidebar-menu-->
<?php $page = 'members-entry'; include 'includes/sidebar.php' ?>
<!--sidebar-menu-->

<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="index.html" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a>
            <a href="#" class="tip-bottom">Manage Members</a>
            <a href="#" class="current">Add Members</a>
        </div>
        <h1>Member Entry Form</h1>
    </div>

    <!-- Form to submit member details -->
    <form role="form" action="" method="POST">
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['owner_name'])) {
            include 'dbcon.php';

            // Sanitize inputs
            $mfvr_no = $conn->real_escape_string($_POST['mfvr_no']);
            $date_of_application = $conn->real_escape_string($_POST['date_of_application']);
            $registration_type = isset($_POST['registration_type']) ? implode(',', $_POST['registration_type']) : '';
            $owner_name = $conn->real_escape_string($_POST['owner_name']);
            $homeport = $conn->real_escape_string($_POST['homeport']);
            $vessel_name = $conn->real_escape_string($_POST['vessel_name']);
           
            $place_built = $conn->real_escape_string($_POST['place_built']);
            $year_built = filter_var($_POST['year_built'], FILTER_VALIDATE_INT);
            $material_used = isset($_POST['material_used']) ? implode(',', $_POST['material_used']) : '';
            $reg_length = isset($_POST['reg_length']) ? (float)$_POST['reg_length'] : 0.0;
            $reg_breadth = isset($_POST['reg_breadth']) ? (float)$_POST['reg_breadth'] : 0.0;
            $reg_depth = isset($_POST['reg_depth']) ? (float)$_POST['reg_depth'] : 0.0;
            $tonnage_length = isset($_POST['tonnage_length']) ? (float)$_POST['tonnage_length'] : 0.0;
            $tonnage_breadth = isset($_POST['tonnage_breadth']) ? (float)$_POST['tonnage_breadth'] : 0.0;
            $tonnage_depth = isset($_POST['tonnage_depth']) ? (float)$_POST['tonnage_depth'] : 0.0;
            $gross_tonnage = isset($_POST['gross_tonnage']) ? (float)$_POST['gross_tonnage'] : 0.0;
            $net_tonnage = isset($_POST['net_tonnage']) ? (float)$_POST['net_tonnage'] : 0.0;
            $engine_make = $conn->real_escape_string($_POST['engine_make']);
            $serial_number = $conn->real_escape_string($_POST['serial_number']);
            $horse_power = isset($_POST['horse_power']) ? filter_var($_POST['horse_power'], FILTER_VALIDATE_INT) : 0;
            $address = $conn->real_escape_string($_POST['address']);
            // For fields that may be arrays, handle them accordingly
$hook_and_line = isset($_POST['hook_and_line']) ? implode(',', $_POST['hook_and_line']) : '';
$pots_and_traps = isset($_POST['pots_and_traps']) ? implode(',', $_POST['pots_and_traps']) : '';
$scoop_nets = isset($_POST['scoop_nets']) ? implode(',', $_POST['scoop_nets']) : '';
$gill_nets = isset($_POST['gill_nets']) ? implode(',', $_POST['gill_nets']) : '';
$lift_nets = isset($_POST['lift_nets']) ? implode(',', $_POST['lift_nets']) : '';
$miscellaneous_fishing_gears = isset($_POST['miscellaneous_fishing_gears']) ? implode(',', $_POST['miscellaneous_fishing_gears']) : '';
$seine_nets = isset($_POST['seine_nets']) ? implode(',', $_POST['seine_nets']) : '';
$falling_gear = isset($_POST['falling_gear']) ? implode(',', $_POST['falling_gear']) : '';
$others = isset($_POST['others']) ? $conn->real_escape_string($_POST['others']) : '';

            

            // Query
            $qry = "INSERT INTO members (owner_name, mfvr_no, date_of_application, registration_type, homeport, vessel_name, vessel_type, place_built, year_built, material_used, reg_length, reg_breadth, reg_depth, tonnage_length, tonnage_breadth, tonnage_depth, gross_tonnage, net_tonnage, engine_make, serial_number, horse_power, address, hook_and_line, pots_and_traps, scoop_nets, gill_nets, lift_nets, miscellaneous_fishing_gears, seine_nets, falling_gear, others) 
            VALUES ('$owner_name', '$mfvr_no', '$date_of_application', '$registration_type', '$homeport', '$vessel_name', '$vessel_type', '$place_built', '$year_built', '$material_used', '$reg_length', '$reg_breadth', '$reg_depth', '$tonnage_length', '$tonnage_breadth', '$tonnage_depth', '$gross_tonnage', '$net_tonnage', '$engine_make', '$serial_number', '$horse_power', '$address', '$hook_and_line', '$pots_and_traps', '$scoop_nets', '$gill_nets', '$lift_nets', '$miscellaneous_fishing_gears', '$seine_nets', '$falling_gear', '$others')";
            
            $result = $conn->query($qry);

            if (!$result) {
                echo "
                <div class='container-fluid'>
                    <div class='row-fluid'>
                        <div class='span12'>
                            <div class='widget-box'>
                                <div class='widget-title'>
                                    <span class='icon'><i class='fas fa-info'></i></span>
                                    <h5>Error Message</h5>
                                </div>
                                <div class='widget-content'>
                                    <div class='error_ex'>
                                        <h1 style='color:maroon;'>Error 404</h1>
                                        <h3>Error occurred while entering your details</h3>
                                        <p>Please Try Again</p>
                                        <a class='btn btn-warning btn-big' href='edit-member.php'>Go Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>";
            } else {
                echo "
                <div class='container-fluid'>
                    <div class='row-fluid'>
                        <div class='span12'>
                            <div class='widget-box'>
                                <div class='widget-title'>
                                    <span class='icon'><i class='fas fa-info'></i></span>
                                    <h5>Message</h5>
                                </div>
                                <div class='widget-content'>
                                    <div class='error_ex'>
                                        <h1>Success</h1>
                                        <h3>Member details have been added!</h3>
                                        <p>The requested details are added. Please click the button to go back.</p>
                                        <a class='btn btn-inverse btn-big' href='members.php'>Go Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>";
            }
        } else {
            echo "<h3>YOU ARE NOT AUTHORIZED TO REDIRECT THIS PAGE. GO BACK to <a href='index.php'>DASHBOARD</a></h3>";
        }
        ?>
    </form>
</div>
</div>

<!--end-main-container-part-->

<!--Footer-part-->
<div class="row-fluid">
    <div id="footer" class="span12">
        2024 &copy; Brought to you by Dennis Matira <a href="http://thematira.tech">Dennis Matira</a>
    </div>
</div>
<!--end-Footer-part-->

<script src="../js/excanvas.min.js"></script> 
<script src="../js/jquery.min.js"></script> 
<script src="../js/jquery.ui.custom.js"></script> 
<script src="../js/bootstrap.min.js"></script> 
<script src="../js/jquery.flot.min.js"></script> 
<script src="../js/jquery.flot.resize.min.js"></script> 
<script src="../js/jquery.peity.min.js"></script> 
<script src="../js/fullcalendar.min.js"></script> 
<script src="../js/matrix.js"></script> 
<script src="../js/jquery.gritter.min.js"></script> 
<script src="../js/matrix.chat.js"></script> 
<script src="../js/jquery.validate.js"></script> 
<script src="../js/matrix.form_validation.js"></script> 
<script src="../js/jquery.wizard.js"></script> 
<script src="../js/jquery.uniform.js"></script> 
<script src="../js/select2.min.js"></script> 
<script src="../js/matrix.popover.js"></script> 
<script src="../js/jquery.dataTables.min.js"></script> 
<script src="../js/matrix.tables.js"></script> 

</body>
</html>
