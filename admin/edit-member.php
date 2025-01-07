<?php
session_start();
// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('location:../index.php');
    exit;
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
// Function to validate input
function validate_input($data) {
    return preg_match('/^[A-Za-z0-9\s,.-]+$/', $data); // Allows letters, numbers, spaces, commas, dots, and dashes
  }
  
  
  
  // Process form submission
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize an array to store errors
    $errors = [];
  
    // Validate MFVR No.
    $mfvr_no = trim($_POST['mfvr_no']);
    if (!validate_input($mfvr_no)) {
        $errors[] = "Invalid MFVR No.";
    }
  
    // Validate Date of Application
    $date_of_application = trim($_POST['date_of_application']);
    if (empty($date_of_application)) {
        $errors[] = "Date of Application is required.";
    }
  
    // Validate Name
    $name = trim($_POST['name']);
    if (empty($name) || !validate_input($name)) {
        $errors[] = "Valid Name is required.";
    }
  
   
    // Add more validations for other fields as needed
  
    // If there are no errors, proceed to process the data
    if (empty($errors)) {
        // Example: insert_member($mfvr_no, $date_of_application, $name, $email, $phone_number);
        // Assuming you have a function to insert data into your database
        echo "Data submitted successfully.";
    } else {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Mao System Admin</title>
    <link rel="icon" type="image/png" href="../img/Mabini-Logo.ico" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <!-- CSS Stylesheets -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="../css/fullcalendar.css" />
    <link rel="stylesheet" href="../css/matrix-style.css" />
    <link rel="stylesheet" href="../css/matrix-media.css" />
    <link href="../font-awesome/css/fontawesome.css" rel="stylesheet" />
    <link href="../font-awesome/css/all.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/jquery.gritter.css" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    
    <style>
        /* Sticky header */
#memberTable thead th {
    position: sticky;
    top: 0;
    background-color: #f1f1f1; /* Light background color for the header */
    z-index: 2;
    border-bottom: 1px solid #ddd;
}

        #footer {
            color: white;
        }
        /* Make the "Actions" column header sticky */
        .table th:last-child {
            position: sticky;
            right: 0;
            background: #efefef;
            z-index: 2;
        }
        /* Keep Actions column sticky without background in cells */
        .table td:last-child {
            position: sticky;
            right: 0;
            background: #fff;
            z-index: 1;
        }
    </style>
    
    
</head>

<body>

    <!-- Header -->
    <div id="header">
        <h1><a href="dashboard.html"></a></h1>
    </div>

    <!-- Top Header Menu -->
    <?php include 'includes/topheader.php'; ?>

    <!-- Sidebar Menu -->
    <?php $page = 'members-update'; include 'includes/sidebar.php'; ?>

    <!-- Main Content -->
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb">
                <a href="#" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a>
                <a href="#" class="current">Registered Members</a>
            </div>
            <h1 class="text-center">Registered Members List <i class="fas fa-group"></i></h1>
        </div>

        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class='widget-box'>
                        <div class='widget-title'>
                            <span class='icon'><i class='fas fa-th'></i></span>
                            <h5>Member Table</h5>
                        </div>
                        <div class='widget-content nopadding'>
                            <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search for members.." class="form-control" style="margin:10px; width:98%;">

                            <?php
                           
                            $qry = "SELECT * FROM members WHERE is_deleted = 0";
                            $cnt = 1;
                            $result = mysqli_query($conn, $qry);

                            echo "<div style='overflow-x: auto;'>
                                  <table class='table table-bordered table-hover'>
                                  <thead>
                                  <tr>
                                  <th>#</th>
                                  <th>Owner Name</th>
                                  <th>MFVR</th>
                                  <th>Registration Type</th>
                                  <th>Gender</th>
                                  <th>Age</th>
                                  <th>D.O.R</th>
                                  <th>Address</th>
                                  <th>Homeport</th>
                                  <th>Vessel Name</th>
                                  <th>Vessel Type</th>
                                  <th>Place Built</th>
                                  <th>Year Built</th>
                                  <th>Material Used</th>
                                  <th>Registered Length</th>
                                  <th>Registered Breadth</th>
                                  <th>Registered Depth</th>
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
                                  <th>Miscellaneous Fishing Gears</th>
                                  <th>Seine Nets</th>
                                  <th>Falling Gear</th>
                                  <th>Others</th>
                                  <th>Actions</th>
                                  </tr>
                                  </thead>";

                            while ($row = mysqli_fetch_array($result)) {
                                echo "<tbody>
                                      <tr>
                                      <td><div class='text-center'>{$cnt}</div></td>
                                      <td><div class='text-center'>{$row['owner_name']}</div></td>
                                      <td><div class='text-center'>{$row['mfvr_no']}</div></td>
                                      <td><div class='text-center'>{$row['registration_type']}</div></td>
                                      <td><div class='text-center'>{$row['gender']}</div></td>
                                      <td><div class='text-center'>{$row['age']}</div></td>
                                      <td><div class='text-center'>{$row['date_of_application']}</div></td>
                                      <td><div class='text-center'>{$row['address']}</div></td>
                                      <td><div class='text-center'>{$row['homeport']}</div></td>
                                      <td><div class='text-center'>{$row['vessel_name']}</div></td>
                                      <td><div class='text-center'>{$row['vessel_type']}</div></td>
                                      <td><div class='text-center'>{$row['place_built']}</div></td>
                                      <td><div class='text-center'>{$row['year_built']}</div></td>
                                      <td><div class='text-center'>{$row['material_used']}</div></td>
                                      <td><div class='text-center'>{$row['reg_length']}</div></td>
                                      <td><div class='text-center'>{$row['reg_breadth']}</div></td>
                                      <td><div class='text-center'>{$row['reg_depth']}</div></td>
                                      <td><div class='text-center'>{$row['tonnage_length']}</div></td>
                                      <td><div class='text-center'>{$row['tonnage_breadth']}</div></td>
                                      <td><div class='text-center'>{$row['tonnage_depth']}</div></td>
                                      <td><div class='text-center'>{$row['net_tonnage']}</div></td>
                                      <td><div class='text-center'>{$row['gross_tonnage']}</div></td>
                                      <td><div class='text-center'>{$row['engine_make']}</div></td>
                                      <td><div class='text-center'>{$row['serial_number']}</div></td>
                                      <td><div class='text-center'>{$row['horse_power']}</div></td>
                                      <td><div class='text-center'>{$row['hook_and_line']}</div></td>
                                      <td><div class='text-center'>{$row['pots_and_traps']}</div></td>
                                      <td><div class='text-center'>{$row['scoop_nets']}</div></td>
                                      <td><div class='text-center'>{$row['gill_nets']}</div></td>
                                      <td><div class='text-center'>{$row['lift_nets']}</div></td>
                                      <td><div class='text-center'>{$row['miscellaneous_fishing_gears']}</div></td>
                                      <td><div class='text-center'>{$row['seine_nets']}</div></td>
                                      <td><div class='text-center'>{$row['falling_gear']}</div></td>
                                      <td><div class='text-center'>{$row['others']}</div></td>
                                      <td><div class='text-center'><a href='edit-memberform.php?id={$row['user_id']}'><i class='fas fa-edit'></i> Edit</a></div></td>
                                      </tr>
                                      </tbody>";
                                $cnt++;
                            }
                            echo "</table></div>"; // Close table div
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="row-fluid">
        <div id="footer" class="span12"></div>
    </div>

    <!-- JavaScript Files -->
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
    <script src="../js/matrix.popover.js"></script>

    <script>
        function searchTable() {
            let input = document.getElementById('searchInput');
            let filter = input.value.toLowerCase();
            let table = document.querySelector('.table');
            let trs = table.getElementsByTagName('tr');

            for (let i = 1; i < trs.length; i++) { // Start from 1 to skip the header row
                let tds = trs[i].getElementsByTagName('td');
                let match = false;

                for (let j = 1; j < tds.length; j++) { // Start from 1 to skip the first column (index)
                    if (tds[j].textContent.toLowerCase().includes(filter)) {
                        match = true;
                        break;
                    }
                }

                trs[i].style.display = match ? '' : 'none';
            }
        }
    </script>
</body>

</html>
