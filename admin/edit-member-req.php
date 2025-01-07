<?php
session_start();
//the isset function to check username is already loged in and stored on the session
if(!isset($_SESSION['user_id'])){
header('location:../index.php');	
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

<!--Header-part-->
<div id="header">
  <h1><a href="dashboard.html"></a></h1>
</div>
<!--close-Header-part--> 


<!--top-Header-menu-->
<?php include 'includes/topheader.php'?>
<!--close-top-Header-menu-->
<!--start-top-serch-->
<!-- <div id="search">
  <input type="hidden" placeholder="Search here..."/>
  <button type="submit" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
</div> -->
<!--close-top-serch-->

<!--sidebar-menu-->
<?php $page='members-update'; include 'includes/sidebar.php'?>
<!--sidebar-menu-->
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a> <a href="#" class="tip-bottom">Manamge Members</a> <a href="#" class="current">Add Members</a> </div>
  <h1>Update Member Details</h1>
</div>

<form role="form" action="" method="POST">
    <?php 
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "gymnsb";
        
        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

    

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['owner_name'])) {

            // Get and sanitize the user_id
            $id = isset($_GET['user_id']) ? (int)$_GET['user_id'] : 0; // Example from URL
            $id = mysqli_real_escape_string($conn, $id);
        
            // Sanitize inputs
            $mfvr_no = $conn->real_escape_string($_POST['mfvr_no']);
            $date_of_application = $conn->real_escape_string($_POST['date_of_application']);
            $registration_type = isset($_POST['registration_type']) && is_array($_POST['registration_type']) 
                ? implode(',', $_POST['registration_type']) 
                : '';
            $owner_name = $conn->real_escape_string($_POST['owner_name']);
            $homeport = $conn->real_escape_string($_POST['homeport']);
            $vessel_name = $conn->real_escape_string($_POST['vessel_name']);
            $vessel_type = isset($_POST['vessel_type']) && is_array($_POST['vessel_type']) ? implode(',', $_POST['vessel_type']) : '';
            $place_built = $conn->real_escape_string($_POST['place_built']);
            $year_built = filter_var($_POST['year_built'], FILTER_VALIDATE_INT);
            $material_used = isset($_POST['material_used']) && is_array($_POST['material_used']) ? implode(',', $_POST['material_used']) : '';
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
            $others = isset($_POST['others']) ? $conn->real_escape_string($_POST['others']) : '';
        
            // New fields for age and gender
            $age = isset($_POST['age']) ? filter_var($_POST['age'], FILTER_VALIDATE_INT) : null;
            $gender = isset($_POST['gender']) ? $conn->real_escape_string($_POST['gender']) : '';
        
            // For fields that may be arrays, handle them accordingly
            $hook_and_line = isset($_POST['hook_and_line']) && is_array($_POST['hook_and_line']) ? implode(',', $_POST['hook_and_line']) : '';
            $pots_and_traps = isset($_POST['pots_and_traps']) && is_array($_POST['pots_and_traps']) ? implode(',', $_POST['pots_and_traps']) : '';
            $scoop_nets = isset($_POST['scoop_nets']) && is_array($_POST['scoop_nets']) ? implode(',', $_POST['scoop_nets']) : '';
            $gill_nets = isset($_POST['gill_nets']) && is_array($_POST['gill_nets']) ? implode(',', $_POST['gill_nets']) : '';
            $lift_nets = isset($_POST['lift_nets']) && is_array($_POST['lift_nets']) ? implode(',', $_POST['lift_nets']) : '';
            $miscellaneous_fishing_gears = isset($_POST['miscellaneous_fishing_gears']) && is_array($_POST['miscellaneous_fishing_gears']) ? implode(',', $_POST['miscellaneous_fishing_gears']) : '';
            $seine_nets = isset($_POST['seine_nets']) && is_array($_POST['seine_nets']) ? implode(',', $_POST['seine_nets']) : '';
            $falling_gear = isset($_POST['falling_gear']) && is_array($_POST['falling_gear']) ? implode(',', $_POST['falling_gear']) : '';
        
            // Update query
            $qry = "UPDATE members SET owner_name='$owner_name', mfvr_no='$mfvr_no', date_of_application='$date_of_application', 
                    registration_type='$registration_type', homeport='$homeport', vessel_name='$vessel_name', 
                    vessel_type='$vessel_type', place_built='$place_built', year_built='$year_built', 
                    material_used='$material_used', reg_length='$reg_length', reg_breadth='$reg_breadth', 
                    reg_depth='$reg_depth', tonnage_length='$tonnage_length', tonnage_breadth='$tonnage_breadth', 
                    tonnage_depth='$tonnage_depth', gross_tonnage='$gross_tonnage', net_tonnage='$net_tonnage', 
                    engine_make='$engine_make', serial_number='$serial_number', horse_power='$horse_power', 
                    address='$address', hook_and_line='$hook_and_line', pots_and_traps='$pots_and_traps', 
                    scoop_nets='$scoop_nets', gill_nets='$gill_nets', lift_nets='$lift_nets', 
                    miscellaneous_fishing_gears='$miscellaneous_fishing_gears', seine_nets='$seine_nets', 
                    falling_gear='$falling_gear', others='$others', age='$age', gender='$gender' 
                    WHERE user_id='$id'";
        
            $result = mysqli_query($conn, $qry); // Execute query
        
        

            if(!$result){
                echo"<div class='container-fluid'>";
                    echo"<div class='row-fluid'>";
                    echo"<div class='span12'>";
                    echo"<div class='widget-box'>";
                    echo"<div class='widget-title'> <span class='icon'> <i class='fas fa-info'></i> </span>";
                        echo"<h5>Error Message</h5>";
                        echo"</div>";
                        echo"<div class='widget-content'>";
                            echo"<div class='error_ex'>";
                            echo"<h1 style='color:maroon;'>Error 404</h1>";
                            echo"<h3>Error occured while updating your details</h3>";
                            echo"<p>Please Try Again</p>";
                            echo"<a class='btn btn-warning btn-big'  href='edit-member.php'>Go Back</a> </div>";
                        echo"</div>";
                        echo"</div>";
                    echo"</div>";
                    echo"</div>";
                echo"</div>";
            }else {

                echo"<div class='container-fluid'>";
                    echo"<div class='row-fluid'>";
                    echo"<div class='span12'>";
                    echo"<div class='widget-box'>";
                    echo"<div class='widget-title'> <span class='icon'> <i class='fas fa-info'></i> </span>";
                        echo"<h5>Message</h5>";
                        echo"</div>";
                        echo"<div class='widget-content'>";
                            echo"<div class='error_ex'>";
                            echo"<h1>Success</h1>";
                            echo"<h3>Member details has been updated!</h3>";
                            echo"<p>The requested details are updated. Please click the button to go back.</p>";
                            echo"<a class='btn btn-inverse btn-big'  href='members.php'>Go Back</a> </div>";
                        echo"</div>";
                        echo"</div>";
                    echo"</div>";
                    echo"</div>";
                echo"</div>";

            }

            }else{
                echo"<h3>YOU ARE NOT AUTHORIZED TO REDIRECT THIS PAGE. GO BACK to <a href='index.php'> DASHBOARD </a></h3>";
            }
?>
                                                               
                
             </form>
         </div>
</div></div>
</div>

<!--end-main-container-part-->

<!--Footer-part-->

<div class="row-fluid">
  <div id="footer" class="span12"></div>
</div>

<style>
#footer {
  color: white;
}
</style>

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

<script type="text/javascript">
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {
      
          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
              resetMenu();            
          } 
          // else, send page to designated URL            
          else {  
            document.location.href = newURL;
          }
      }
  }

// resets the menu selection upon entry to this page:
function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
</script>
</body>
</html>
