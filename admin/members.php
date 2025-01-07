<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('location:../index.php');	
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

        #memberTable th {
            position: sticky;
            top: 0;
            background-color: white; /* or your preferred color */
            z-index: 10; /* Ensure the header is above other elements */
            font-weight: bold; /* Make header text bold */
            font-size: 1.1em; /* Increase font size for headers */
        }
        #footer {
            color: white;
        }
        .btn-success {
            background-color: #28a745; /* Green */
            color: white;
            margin: 10px 0; /* Add margin for spacing */
        }
    </style>
</head>
<body>

<!--Header-part-->
<div id="header">
    <h1><a href="dashboard.html"></a></h1>
</div>
<!--close-Header-part--> 

<!--top-Header-menu-->
<?php include 'includes/topheader.php'?>
<!--close-top-Header-menu-->

<!--sidebar-menu-->
<?php $page="members"; include 'includes/sidebar.php'?>
<!--sidebar-menu-->

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
                        <span class='icon'> <i class='fas fa-th'></i> </span>
                        <h5>Member table</h5>
                    </div>
                    <div class='widget-content nopadding'>
                        <input type="text" id="search" placeholder="Search by Name or Address" onkeyup="filterTable()">

                        <?php
                        $qry = "SELECT * FROM members WHERE is_deleted = 0";
                        $cnt = 1;
                        $result = mysqli_query($conn, $qry);

                        echo "<div style='overflow: auto; max-height: 500px;'>
                        <table class='table table-bordered table-hover' id='memberTable'>
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
                            </tr>
                          </thead>
                          <tbody>";

                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>
                                    <td>".$cnt."</td>
                                    <td>".$row['owner_name']."</td>
                                    <td>".$row['mfvr_no']."</td>
                                    <td>".$row['registration_type']."</td>
                                    <td>".$row['gender']."</td>
                                    <td>".$row['age']."</td>
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
                                  </tr>";
                            $cnt++;
                        }

                        echo "</tbody>
                              </table>
                            </div>";
                        ?>
                    </div>

                    <!-- Export Button -->
                    <div class="widget-content nopadding">
                        <button id="exportExcelButton" class="btn btn-success" onclick="exportToExcel()">Export to Excel</button>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<!--Footer-part-->
<div class="row-fluid">
    <div id="footer" class="span12">  </div>
</div>

<!--Scripts-->
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


<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<script type="text/javascript">
function filterTable() {
    const input = document.getElementById("search");
    const filter = input.value.toLowerCase();
    const table = document.getElementById("memberTable");
    const rows = table.getElementsByTagName("tr");

    for (let i = 1; i < rows.length; i++) { // Start from 1 to skip the header
        let match = false;
        const cells = rows[i].getElementsByTagName("td");
        for (let j = 1; j < cells.length; j++) { // Start from 1 to skip the index column
            if (cells[j].innerText.toLowerCase().includes(filter)) {
                match = true;
                break;
            }
        }
        rows[i].style.display = match ? "" : "none";
    }
}

function exportToExcel() {
    // Get the table element
    const table = document.getElementById("memberTable");

    // Convert the table to a SheetJS worksheet
    const worksheet = XLSX.utils.table_to_sheet(table);

    // Style the headers to be bold
    const range = XLSX.utils.decode_range(worksheet['!ref']);
    for (let C = range.s.c; C <= range.e.c; ++C) {
        const cellAddress = XLSX.utils.encode_cell({r: 0, c: C}); // Target the first row (header row)
        if (!worksheet[cellAddress]) continue;
        worksheet[cellAddress].s = { font: { bold: true } }; // Make header bold
    }

    // Auto-size the columns
    const colWidths = [];
    for (let C = range.s.c; C <= range.e.c; ++C) {
        let maxWidth = 10; // Set a minimum width
        for (let R = range.s.r; R <= range.e.r; ++R) {
            const cellAddress = XLSX.utils.encode_cell({r: R, c: C});
            const cellValue = worksheet[cellAddress] ? worksheet[cellAddress].v.toString() : '';
            maxWidth = Math.max(maxWidth, cellValue.length); // Adjust the width based on content
        }
        colWidths.push({ wch: maxWidth });
    }
    worksheet['!cols'] = colWidths; // Apply column widths

    // Create a new workbook
    const workbook = XLSX.utils.book_new();

    // Append the worksheet to the workbook
    XLSX.utils.book_append_sheet(workbook, worksheet, "Members");

    // Export the workbook to an Excel file
    XLSX.writeFile(workbook, "members.xlsx");
}

</script>

</body>
</html>
