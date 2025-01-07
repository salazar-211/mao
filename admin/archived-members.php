<?php
session_start();
// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('location:../index.php');
}
// Direct database connection
$conn = mysqli_connect("localhost", "root", "", "gymnsb");

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
    <link rel="stylesheet" href="../css/fullcalendar.css" />
    <link rel="stylesheet" href="../css/matrix-style.css" />
    <link rel="stylesheet" href="../css/matrix-media.css" />
    <link href="../font-awesome/css/fontawesome.css" rel="stylesheet" />
    <link href="../font-awesome/css/all.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/jquery.gritter.css" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>
<body>
<style>
    /* Sticky header */
#memberTable thead th {
    position: sticky;
    top: 0;
    background-color: #f1f1f1; /* Light background color for the header */
    z-index: 2;
    border-bottom: 1px solid #ddd;
}

/* CSS to make the "Remove" column sticky with background color only in the header */
#memberTable th:last-child {
    position: sticky;
    right: 0;
    background: #efefef; /* Background color for header */
    z-index: 2; /* Ensures header stays on top */
}

/* Sticky "Remove" column cells without background color */
#memberTable td:last-child {
    position: sticky;
    right: 0;
    background: #fff; /* Default white background for cells */
    z-index: 1;
}

#memberTable {
    border-collapse: collapse;
    width: 100%;
}

#memberTable th, #memberTable td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}
</style>

<!--Header-part-->
<div id="header">
    <h1><a href="dashboard.html"></a></h1>
</div>

<!--top-Header-menu-->
<?php include 'includes/topheader.php'?>

<!--sidebar-menu-->
<?php $page = 'members-archive'; include 'includes/sidebar.php' ?>

<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a>
            <a href="archived-member.php" class="current">Archived Members</a>
        </div>
        <h1 class="text-center">Archived Members <i class="fas fa-user-times"></i></h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class='widget-box'>
                    <div class='widget-title'>
                        <span class='icon'> <i class='fas fa-th'></i> </span>
                        <h5>Archived Member Table</h5>
                    </div>
                    <div class='widget-content nopadding'>
                        <!-- Search Input -->
                        <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search for archived members.." class="form-control" style="margin:10px; width:98%;">

                        <?php
                        
                        // Select members where 'is_deleted' is set to 1 (archived members)
                        $qry = "SELECT * FROM members WHERE is_deleted = 1";
                        $cnt = 1;
                        $result = mysqli_query($conn, $qry);

                        if (mysqli_num_rows($result) > 0) {
                            echo "<div style='overflow: auto; max-height: 500px;'>
                            <table class='table table-bordered table-hover' id='memberTable'>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Owner Name</th>
                                        <th>MFVR</th>
                                        <th>Registration Type</th>
                                        <th>D.O.R</th>
                                        <th>Address</th>
                                        <th>Homeport</th>
                                        <th>Vessel Name</th>
                                        <th>Vessel Type</th>
                                        <th>Place Built</th>
                                        <th>Year Built</th>
                                        <th>Material Used</th>
                                        <th>Reg. Length</th>
                                        <th>Reg. Breadth</th>
                                        <th>Reg. Depth</th>
                                        <th>Tonnage Length</th>
                                        <th>Tonnage Breadth</th>
                                        <th>Tonnage Depth</th>
                                        <th>Net Tonnage</th>
                                        <th>Gross Tonnage</th>
                                        <th>Engine Make</th>
                                        <th>Serial Number</th>
                                        <th>Horse Power</th>
                                        <th>Hook and Line</th>
                                        <th>Pots and Traps</th>
                                        <th>Scoop Nets</th>
                                        <th>Gill Nets</th>
                                        <th>Lift Nets</th>
                                        <th>Misc. Fishing Gears</th>
                                        <th>Seine Nets</th>
                                        <th>Falling Gear</th>
                                        <th>Others</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>";

                            while ($row = mysqli_fetch_array($result)) {
                                echo "<tr>
                                    <td>".$cnt."</td>
                                    <td>".$row['owner_name']."</td>
                                    <td>".$row['mfvr_no']."</td>
                                    <td>".$row['registration_type']."</td>
                                    <td>".$row['date_of_application']."</td>
                                    <td>".$row['address']."</td>
                                    <td>".$row['homeport']."</td>
                                    <td>".$row['vessel_name']."</td>
                                    <td>".$row['vessel_type']."</td>
                                    <td>".$row['place_built']."</td>
                                    <td>".$row['year_built']."</td>
                                    <td>".$row['material_used']."</td>
                                    <td>".$row['reg_length']."</td>
                                    <td>".$row['reg_breadth']."</td>
                                    <td>".$row['reg_depth']."</td>
                                    <td>".$row['tonnage_length']."</td>
                                    <td>".$row['tonnage_breadth']."</td>
                                    <td>".$row['tonnage_depth']."</td>
                                    <td>".$row['net_tonnage']."</td>
                                    <td>".$row['gross_tonnage']."</td>
                                    <td>".$row['engine_make']."</td>
                                    <td>".$row['serial_number']."</td>
                                    <td>".$row['horse_power']."</td>
                                    <td>".$row['hook_and_line']."</td>
                                    <td>".$row['pots_and_traps']."</td>
                                    <td>".$row['scoop_nets']."</td>
                                    <td>".$row['gill_nets']."</td>
                                    <td>".$row['lift_nets']."</td>
                                    <td>".$row['miscellaneous_fishing_gears']."</td>
                                    <td>".$row['seine_nets']."</td>
                                    <td>".$row['falling_gear']."</td>
                                    <td>".$row['others']."</td>
                                    <td><div class='text-center'><a href='restore-member.php?id=".$row['user_id']."' onclick='return confirm(\"Are you sure you want to restore this member?\");' style='color:#5BC0DE;'><i class='fas fa-undo'></i> Restore</a>
                                    <br>
                                    <a href='permanent-delete-member.php?id=".$row['user_id']."' onclick='return confirm(\"Are you sure you want to permanently delete this member?\");' style='color:red;'>
                                    <i class='fas fa-trash'></i> Permanent Delete
                                    </a>
                                    </div></td>

                                </tr>";
                                $cnt++;
                            }

                            echo "</tbody>
                            </table>
                            </div>";
                        } else {
                            echo "<div class='text-center' style='margin-top: 20px;'><h4>No archived members found.</h4></div>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Footer-part-->
<div class="row-fluid">
    <div id="footer" class="span12"> </div>
</div>

<style>
#footer {
    color: white;
}
</style>

<!-- JS Scripts -->
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

<!-- Search Table Function -->
<script type="text/javascript">
function searchTable() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("memberTable");
    tr = table.getElementsByTagName("tr");
    for (i = 1; i < tr.length; i++) {
        tr[i].style.display = "none";
        td = tr[i].getElementsByTagName("td");
        for (var j = 0; j < td.length; j++) {
            if (td[j]) {
                txtValue = td[j].textContent || td[j].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                    break;
                }
            }
        }
    }
}
</script>

</body>
</html>
