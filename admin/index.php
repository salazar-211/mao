<?php
session_start();
//the isset function to check username is already loged in and stored on the session
if(!isset($_SESSION['user_id'])){
header('location:../index.php');	
}
include "dbcon.php";
// Query to count members per 'registration_type'
$qry_registration_type = "SELECT registration_type, COUNT(*) as number FROM members GROUP BY registration_type";
$result_registration_type = mysqli_query($con, $qry_registration_type);

// Query to count members per 'homeport'
$qry_homeport = "SELECT homeport, COUNT(*) as number FROM members GROUP BY homeport";
$result_homeport = mysqli_query($con, $qry_homeport);

// Query to count members per 'vessel_name'
$qry_vessel_name = "SELECT vessel_name, COUNT(*) as number FROM members GROUP BY vessel_name";
$result_vessel_name = mysqli_query($con, $qry_vessel_name);

// Query to count members per 'vessel_type'
$qry_vessel_type = "SELECT vessel_type, COUNT(*) as number FROM members GROUP BY vessel_type";
$result_vessel_type = mysqli_query($con, $qry_vessel_type);

// Query to count members per 'place_built'
$qry_place_built = "SELECT place_built, COUNT(*) as number FROM members GROUP BY place_built";
$result_place_built = mysqli_query($con, $qry_place_built);

// Query to count members per 'year_built'
$qry_year_built = "SELECT year_built, COUNT(*) as number FROM members GROUP BY year_built";
$result_year_built = mysqli_query($con, $qry_year_built);

// Query to count members per 'material_used'
$qry_material_used = "SELECT material_used, COUNT(*) as number FROM members GROUP BY material_used";
$result_material_used = mysqli_query($con, $qry_material_used);

// Query to count members per 'reg_length'
$qry_reg_length = "SELECT reg_length, COUNT(*) as number FROM members GROUP BY reg_length";
$result_reg_length = mysqli_query($con, $qry_reg_length);

// Query to count members per 'reg_breadth'
$qry_reg_breadth = "SELECT reg_breadth, COUNT(*) as number FROM members GROUP BY reg_breadth";
$result_reg_breadth = mysqli_query($con, $qry_reg_breadth);

// Query to count members per 'reg_depth'
$qry_reg_depth = "SELECT reg_depth, COUNT(*) as number FROM members GROUP BY reg_depth";
$result_reg_depth = mysqli_query($con, $qry_reg_depth);

// Query to count members per 'tonnage_length'
$qry_tonnage_length = "SELECT tonnage_length, COUNT(*) as number FROM members GROUP BY tonnage_length";
$result_tonnage_length = mysqli_query($con, $qry_tonnage_length);

// Query to count members per 'tonnage_breadth'
$qry_tonnage_breadth = "SELECT tonnage_breadth, COUNT(*) as number FROM members GROUP BY tonnage_breadth";
$result_tonnage_breadth = mysqli_query($con, $qry_tonnage_breadth);

// Query to count members per 'tonnage_depth'
$qry_tonnage_depth = "SELECT tonnage_depth, COUNT(*) as number FROM members GROUP BY tonnage_depth";
$result_tonnage_depth = mysqli_query($con, $qry_tonnage_depth);

// Query to count members per 'gross_tonnage'
$qry_gross_tonnage = "SELECT gross_tonnage, COUNT(*) as number FROM members GROUP BY gross_tonnage";
$result_gross_tonnage = mysqli_query($con, $qry_gross_tonnage);

// Query to count members per 'net_tonnage'
$qry_net_tonnage = "SELECT net_tonnage, COUNT(*) as number FROM members GROUP BY net_tonnage";
$result_net_tonnage = mysqli_query($con, $qry_net_tonnage);

// Query to count members per 'engine_make'
$qry_engine_make = "SELECT engine_make, COUNT(*) as number FROM members GROUP BY engine_make";
$result_engine_make = mysqli_query($con, $qry_engine_make);

// Query to count members per 'serial_number'
$qry_serial_number = "SELECT serial_number, COUNT(*) as number FROM members GROUP BY serial_number";
$result_serial_number = mysqli_query($con, $qry_serial_number);

// Query to count members per 'horse_power'
$qry_horse_power = "SELECT horse_power, COUNT(*) as number FROM members GROUP BY horse_power";
$result_horse_power = mysqli_query($con, $qry_horse_power);

// Query to count members per 'address'
$qry_address = "SELECT address, COUNT(*) as number FROM members GROUP BY address";
$result_address = mysqli_query($con, $qry_address);

// Query to count members per 'hook_and_line'
$qry_hook_and_line = "SELECT hook_and_line, COUNT(*) as number FROM members GROUP BY hook_and_line";
$result_hook_and_line = mysqli_query($con, $qry_hook_and_line);

// Query to count members per 'pots_and_traps'
$qry_pots_and_traps = "SELECT pots_and_traps, COUNT(*) as number FROM members GROUP BY pots_and_traps";
$result_pots_and_traps = mysqli_query($con, $qry_pots_and_traps);

// Query to count members per 'scoop_nets'
$qry_scoop_nets = "SELECT scoop_nets, COUNT(*) as number FROM members GROUP BY scoop_nets";
$result_scoop_nets = mysqli_query($con, $qry_scoop_nets);

// Query to count members per 'gill_nets'
$qry_gill_nets = "SELECT gill_nets, COUNT(*) as number FROM members GROUP BY gill_nets";
$result_gill_nets = mysqli_query($con, $qry_gill_nets);

// Query to count members per 'lift_nets'
$qry_lift_nets = "SELECT lift_nets, COUNT(*) as number FROM members GROUP BY lift_nets";
$result_lift_nets = mysqli_query($con, $qry_lift_nets);

// Query to count members per 'miscellaneous_fishing_gears'
$qry_miscellaneous_fishing_gears = "SELECT miscellaneous_fishing_gears, COUNT(*) as number FROM members GROUP BY miscellaneous_fishing_gears";
$result_miscellaneous_fishing_gears = mysqli_query($con, $qry_miscellaneous_fishing_gears);

// Query to count members per 'seine_nets'
$qry_seine_nets = "SELECT seine_nets, COUNT(*) as number FROM members GROUP BY seine_nets";
$result_seine_nets = mysqli_query($con, $qry_seine_nets);

// Query to count members per 'falling_gear'
$qry_falling_gear = "SELECT falling_gear, COUNT(*) as number FROM members GROUP BY falling_gear";
$result_falling_gear = mysqli_query($con, $qry_falling_gear);

// Query to count members per 'others'
$qry_others = "SELECT others, COUNT(*) as number FROM members GROUP BY others";
$result_others = mysqli_query($con, $qry_others);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Mao System Admin</title>
    <link rel="icon" type="image/png" href="../img/Mabini-Logo.png" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="../css/fullcalendar.css" />
    <link rel="stylesheet" href="../css/matrix-style.css" />
    <link rel="stylesheet" href="../css/matrix-media.css" />
    <link href="../font-awesome/css/all.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/jquery.gritter.css" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css' />


    <style>
/* General Styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f7fc;
}

.dashboard-header {
    background-color: #2a3d66;
    color: white;
    padding: 20px;
    text-align: center;
}

.dashboard-header h1 {
    margin: 0;
    font-size: 24px;
}

/* Dashboard Main Section */
.dashboard-main {
    display: flex;
    flex-direction: column;
    padding: 20px;
}

/* Statistics and Charts Section */
.stats-and-charts {
    display: flex;
    justify-content: space-between;
    gap: 20px;
    flex-wrap: wrap;
}

/* Statistics Section */
.chart-container {
    width: 30%; /* Limit to 30% width */
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.site-stats {
    display: flex;
    flex-direction: column;
    gap: 15px;
    list-style-type: none;
    padding: 0;
    margin: 0;
    width: 600px;
    text-align: center;
    
    
}

.stat-item {
    display: flex;
    align-items: center;
    background-color: #f9f9f9;
    padding: 15px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    height: 205px; /* Adjust the height as needed */
    /* Or you can use min-height to make sure it does not shrink smaller than a certain height */
    min-height: 150px;
    text-align: center;
    top: 15px; /* Move downward */
}

.stat-item i {
    font-size: 30px;
    color: #030303FF;
    margin-right: -5px;
    text-align: center;
    margin-bottom: 30px;
}
.fas.fa-user-tie {
    font-size: 60px; /* Adjust the size */
}
.fas.fa-users {
    font-size: 60px; /* Adjust the size */
}
.stat-value {
    font-size: 50px;
    font-weight: bold;
    text-align: center;
    color: #000000FF;
}

.stat-label {
    font-size: 30px;
    color: black;
    text-align: center;
    display: block; /* This ensures that the label is placed below the value */
    margin-top: 10px; /* Adds space between the value and the label */
}


/* Charts Section */
.charts-grid {
    width: 200%; /* Limit to 65% width */
    display: flex;
    justify-content: space-between;
    gap: 20px;
    flex-wrap: wrap;
}

/* Chart Boxes */
.chart-box {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 20px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    width: 50%; /* Chart width */
    
}
/* Registration Chart Specific Styling */
.registration-chart {
    background-color: #FFFFFFFF; /* Light blue */
    width: 35%; /* Specific width for this chart */
    height: 200px; /* Control height independently */
    margin-top: -496px; /* Align this chart to the top */
    margin-left: 270px;
}
.chart-box.materials-chart{
    margin-top: -515px; /* Align this chart to the top */
    margin-left: 770px;
    width: 35%;
    height: 200px; /* Control height independently */
}
.chart-box.vessel-chart {
    margin-top: -284px; /* Align this chart to the top */
    margin-left: 270px;
    width: 74.7%;
    height: 200px; /* Control height independently */
    background-color: #FFFFFFFF; 
}
/* Materials Used Chart Specific Styling */
.materials-chart {
    background-color: #FFFFFFFF; /* Beige */
    width: 35%; /* Specific width for this chart */
    height: 280px; /* Control height independently */
}

/* Vessel Type Analysis Chart Specific Styling */
.vessel-chart {
    background-color: #ffe4e1; /* Light pink */
    width: 45%; /* Specific width for this chart */
    height: 320px; /* Control height independently */
}
/* Footer Section */
.dashboard-footer {
    background-color: #2a3d66;
    color: white;
    text-align: center;
    padding: 10px;
    margin-top: 20px;
}

.dashboard-footer p {
    margin: 0;
}

/* Media Query for Responsiveness */
@media screen and (max-width: 768px) {
    .stats-and-charts {
        flex-direction: column;
        gap: 20px;
    }

    .chart-container {
        width: 100%;
    }

    .charts-grid {
        width: 100%;
    }

    .chart-box {
        width: 100%;
    }
}

</style>

    <!-- Ensure to include the Leaflet and Leaflet Control Search libraries -->
<!-- Ensure to include the Leaflet and Leaflet Control Search libraries -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawCharts);

    function drawCharts() {
        drawRegistrationChart();
        drawVesselTypeAnalysisChart();
        drawMaterialsUsedChart();
        drawHorsePowerAnalysisChart();
        drawEngineMakeComparisonChart();
        drawHomeportChart();
        drawYearBuiltChart();
        drawGrossTonnageChart();
        drawVesselNameChart();
    }


    // 1
    function drawRegistrationChart() {
    var registrationData = google.visualization.arrayToDataTable([
        ['Registration Type', 'Total Numbers'],
        <?php
        $qry_registration_type = "SELECT registration_type, COUNT(*) as number FROM members GROUP BY registration_type";
        $result_registration_type = mysqli_query($con, $qry_registration_type);
        while ($row = mysqli_fetch_array($result_registration_type)) {
            echo "['" . $row['registration_type'] . "', " . $row['number'] . "],";
        }
        ?>
    ]);

    var registrationOptions = {
        title: 'Members by Registration Type',
        pieHole: 0, // Full Pie Chart
        legend: { position: 'right' },
        colors: ['#66bb6a', '#388e3c', '#1b5e20'],
        animation: { duration: 1000, easing: 'out', startup: true }
    };

    var registrationChart = new google.visualization.PieChart(document.getElementById('registration_chart_div'));
    registrationChart.draw(registrationData, registrationOptions);
}
registrationChart.draw(registrationData, registrationOptions);

    // 2
    function drawVesselTypeAnalysisChart() {
    var vesselTypeData = google.visualization.arrayToDataTable([
        ['Vessel Type', 'Count'],
        <?php
        $qry_vessel_type = "SELECT vessel_type, COUNT(*) as count FROM members GROUP BY vessel_type";
        $result_vessel_type = mysqli_query($con, $qry_vessel_type);
        while ($row = mysqli_fetch_array($result_vessel_type)) {
            echo "['" . $row['vessel_type'] . "', " . $row['count'] . "],";
        }
        ?>
    ]);

    var vesselTypeOptions = {
        title: 'Vessel Type Analysis',
        isStacked: true,
        hAxis: { title: 'Count' },
        vAxis: { title: 'Vessel Type' },
        colors: ['#28b779', '#28b779'],
        animation: { duration: 1000, easing: 'out', startup: true }
    };

    var vesselTypeChart = new google.visualization.BarChart(document.getElementById('vessel_type_analysis_chart_div'));
    vesselTypeChart.draw(vesselTypeData, vesselTypeOptions);
}


    // 3
    function drawMaterialsUsedChart() {
        console.log("Materials chart function called.");
        var materialsData = google.visualization.arrayToDataTable([
            ['Material Used', 'Percentage'],
            <?php
            $qry_materials_used = "SELECT material_used, COUNT(*) * 100 / (SELECT COUNT(*) FROM members) as percentage FROM members GROUP BY material_used";
            $result_materials_used = mysqli_query($con, $qry_materials_used);
            while ($row = mysqli_fetch_array($result_materials_used)) {
                echo "['" . $row['material_used'] . "', " . $row['percentage'] . "],";
            }
            ?>
        ]);

        console.log(materialsData);

        var materialsOptions = {
            title: 'Materials Used Distribution',
            pieHole: 0.4,
            legend: { position: 'right' },
            colors: ['#66bb6a', '#388e3c', '#1b5e20'], // Different shades of green
            animation: { duration: 1000, easing: 'out', startup: true } // Animation
        };

        var materialsChart = new google.visualization.PieChart(document.getElementById('materials_used_chart_div'));
        materialsChart.draw(materialsData, materialsOptions);
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
    <?php include 'includes/topheader.php'?>
    <!--close-top-Header-menu-->

    <!--sidebar-menu-->
    <?php $page='dashboard'; include 'includes/sidebar.php'?>
    <!--sidebar-menu-->

    <!--main-container-part-->
    <div id="content">
        <!--breadcrumbs-->
        <div id="content-header">
            <div id="breadcrumb">
                <a href="index.php" title="You're right here" class="tip-bottom">
                    <i class="fa fa-home"></i> Home
                </a>
            </div>
        </div>
        <!--End-breadcrumbs-->
<!-- Header Section -->
<header class="dashboard-header">
    <div class="logo-section">
        <h1>Fisherfolk Management System</h1>
    </div>
</header>

<!-- Main Dashboard Section -->
<div class="dashboard-main">
    <!-- Statistics and Charts Section -->
    <div class="stats-and-charts">
        <!-- Statistics Section -->
            <ul class="site-stats">
                <!-- Fisherfolks Count -->
                <li class="stat-item">
                    <i class="fas fa-users"></i>
                    <div>
                        <span class="stat-value"><?php include 'dashboard-usercount.php'; ?></span>
                        <span class="stat-label">Total Fisherfolks</span>
                    </div>
                </li>

                <!-- Staff Count -->
                <li class="stat-item">
                    <i class="fas fa-user-tie"></i>
                    <div>
                        <span class="stat-value"><?php include 'actions/dashboard-staff-count.php'; ?></span>
                        <span class="stat-label">Staff Users</span>
                    </div>
                </li>
            </ul>
       
<!-- Charts Section -->
<div class="charts-grid">
    <div class="chart-box registration-chart">
        <div id="registration_chart_div"></div>
    </div>
    <div class="chart-box materials-chart">
        <div id="materials_used_chart_div"></div>
    </div>
    <div class="chart-box vessel-chart">
        <div id="vessel_type_analysis_chart_div"></div>
    </div>
</div>

    </div>
</div>

<!-- Footer Section -->
<footer class="dashboard-footer">
    <p>&copy; 2025 Fisherfolk Management System. All rights reserved.</p>
</footer>



    <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery.ui.custom.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.flot.min.js"></script>
    <script src="../js/jquery.flot.resize.min.js"></script>
    <script src="../js/jquery.gritter.min.js"></script>
    <script src="../js/matrix.js"></script>

  
    <script src="../js/jquery.dataTables.min.js"></script>

</body>
</html>

