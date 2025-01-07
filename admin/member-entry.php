<?php
session_start();
// Check if the user is logged in
if(!isset($_SESSION['user_id'])){
    header('location:../index.php');    
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
<?php $page='members-entry'; include 'includes/sidebar.php'?>
<!--sidebar-menu-->
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a> <a href="#" class="current">Add Members</a> </div>
  <h1>Member Entry Form</h1>
</div>
<title>Boat Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        
    

        .center {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        td, th {
            border: 1px solid #000;
            padding: 8px;
        }

        input[type="text"], input[type="date"] {
            width: 95%; /* Make input fields wider horizontally */
            padding: 8px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        input[type="checkbox"] {
            margin-right: 5px;
        }
        input[type="checkbox"] {
    display: inline-block !important;
    visibility: visible !important;
    opacity: 1 !important;
}


        .title {
            text-align: center;
            font-weight: bold;
        }

        .signature-line {
            border-bottom: 1px solid black;
            width: 290px; /* Adjusted width */
            display: inline-block;
            margin-top: 5px;
        }

        .thumbmark-box {
            border: 1px solid black;
            width: 100px;
            height: 100px;
            text-align: center;
            margin-left: auto;
            margin-right: 0;
        }

        /* Print-specific styles */
    @media print {
        body * {
            visibility: hidden;
        }
        .container, .container * {
            visibility: visible;
        }
        .container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            max-width: 1000px; /* Ensure container fits on letter-sized paper */
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        @page {
            size: letter; /* Letter-sized paper */
            margin: 20mm; /* Adjust margins if necessary */
        }
                /* Ensure the background color is black for the specific cell when printing */
        .center.title {
            background-color: black !important;
        }
        .print-background {
            background-color: black !important;
            color: white !important;
        }
    }
</style>

<div class="container">
  <form action="add-member-req.php" method="POST">
    <div class="center">
        <h2>Standard Form for BoatR</h2>
    </div>

    <!-- Top Information Table -->
    <table>
        <tr>
            <td colspan="3" class="center title">Republic of the Philippines<br>Province of Batangas<br>MUNICIPALITY OF MABINI</td>
        </tr>
        <tr>
            <td style="background-color: black; color: white; text-align: center; padding: 10px;">Municipal Fishing Vessel and Gear Registration Program</td>
            <td><label for="mfvr_no">MFVR No.:</label><input type="text" name="mfvr_no" id="mfvr_no"></td>
            <td><label for="date_of_application">Date of Application:</label><input type="date" name="date_of_application" id="date_of_application"></td>
            
        </tr>
    
        
    <!-- Type of Registration -->
    
        <tr>
            <td colspan="3"  for="registration_type" class="title">TYPE OF REGISTRATION</td>    
        </tr>
        <tr>
            <td colspan="3">
                <label><input type="checkbox" name="registration_type[]" value="Initial Registration"> Initial Registration</label>
                <label><input type="checkbox" name="registration_type[]" value="Issuance of New Certificate of Number"> Issuance of New Certificate of Number</label>
                <label><input type="checkbox" name="registration_type[]" value="Re-issuance of Certificate of Number"> Re-issuance of Certificate of Number</label>
            </td>
        </tr>
    

    <!-- Owner Information -->
    
            <tr>
                <td colspan="2">
                     <label for="owner_name">Name of Owner/Operator (Surname, First Name, M.I):</label>
                     <input type="text" id="owner_name" name="owner_name" style="width: 100%;">
                </td>
                <td>
                     <label for="address">Address (No. of Street, Barangay, Municipality/City, Province):</label>
                     <input type="text" id="address" name="address" style="width: 100%;">
                </td>
                </tr>

    

    <!-- Vessel Information -->
    
        <tr>
            <td><label for="homeport">Homeport:</label><input type="text" name="homeport" id="homeport"></td>
            <td><label for="vessel_name">Name of Fishing Vessel:</label><input type="text" name="vessel_name" id="vessel_name"></td>
            <td><label for="vessel_type">Vessel Type:</label>
                <div>
                <label><input type="checkbox" name="vessel_type[]" value="Non-motorized"> Non-motorized</label>
                <label><input type="checkbox" name="vessel_type[]" value="Motorized"> Motorized</label>
                <label><input type="text" name="vessel_type[]" > Others</label>
                </div>
            </td>
        </tr>
        <tr>
            <td><label for="place_built">Place Built:</label><input type="text" name="place_built" id="place_built"></td>
            <td><label for="year_built">Year Built:</label><input type="text" name="year_built" id="year_built"></td>
            <td>
                <label for="material_used">Material Used:</label>
                <div>
                  <label><input type="checkbox" name="material_used[]" value="Wood"> Wood</label>
                  <label><input type="checkbox" name="material_used[]" value="Fiber Glass"> Fiber Glass</label>
                  <label><input type="checkbox" name="material_used[]" value="Composite"> Composite</label>
                </div>
            </td>
        </tr>
    

    <!-- Vessel Dimensions -->
    
        <tr>
            <td colspan="3" class="title">FISHING VESSEL DIMENSIONS AND TONNAGES (METERS)</td>
        </tr>
        <tr>
            <td><label for="reg_length">Registered Length:</label><input type="number" name="reg_length" id="reg_length"></td>
            <td><label for="reg_breadth">Registered Breadth:</label><input type="number" name="reg_breadth" id="reg_breadth"></td>
            <td><label for="reg_depth">Registered Depth:</label><input type="number" name="reg_depth" id="reg_depth"></td>
        </tr>
        <tr>
            <td><label for="tonnage_length">Tonnage Length:</label><input type="number" name="tonnage_length" id="tonnage_length"></td>
            <td><label for="tonnage_breadth">Tonnage Breadth:</label><input type="number" name="tonnage_breadth" id="tonnage_breadth"></td>
            <td><label for="tonnage_depth">Tonnage Depth:</label><input type="number" name="tonnage_depth" id="tonnage_depth"></td>
        </tr>
        <tr>
        <tr>
            <td colspan="2" style="text-align: center;">
            <label for="gross_tonnage">Gross Tonnage:</label>
            <input type="number" name="gross_tonnage" id="gross_tonnage" style="width: 95%; margin: 0 auto;">
        </td>
            <td style="text-align: center;">
            <label for="net_tonnage">Net Tonnage:</label>
            <input type="number" name="net_tonnage" id="net_tonnage" style="width: 96%; margin: 0 auto;">
        </td>
        </tr>

           
              

    <!-- Propulsion System -->
    
        <tr>
            <td colspan="3" class="title">PARTICULARS OF PROPULSION SYSTEM</td>
        </tr>
        <tr>
            <td><label for="engine_make">Engine Make:</label><input type="text" name="engine_make" id="engine_make"></td>
            <td><label for="serial_number">Serial Number:</label><input type="number" name="serial_number" id="serial_number"></td>
            <td><label for="horse_power">Horse Power:</label><input type="number" name="horse_power" id="horse_power"></td>
        </tr>
    

    <!-- Fishing Gear Classification -->
    
        <tr>
            <td colspan="3" class="title">CLASSIFICATION OF FISHING GEAR</td>
        </tr>
        <tr>
            <td>
                <div class="title">Hook and Line</div>
                <label><input type="checkbox" name="hook_and_line[]" value="Simple Hand Line"> Simple Hand Line</label><br>
                <label><input type="checkbox" name="hook_and_line[]" value="Multiple Hand Line"> Multiple Hand Line</label><br>
                <label><input type="checkbox" name="hook_and_line[]" value="Bottom Set Long Line"> Bottom Set Long Line</label><br>
                <label><input type="checkbox" name="hook_and_line[]" value="Drift Long Line"> Drift Long Line</label><br>
                <label><input type="checkbox" name="hook_and_line[]" value="Troll Line"> Troll Line</label><br>
                <label><input type="checkbox" name="hook_and_line[]" value="Jig"> Jig</label>
            </td>
            <td>
                <div class="title">Pots and Traps</div>
                <label><input type="checkbox" name="pots_and_traps[]" value="Fish Pots"> Fish Pots</label><br>
                <label><input type="checkbox" name="pots_and_traps[]" value="Crab Pots"> Crab Pots</label><br>
                <label><input type="checkbox" name="pots_and_traps[]" value="Squid Pots"> Squid Pots</label><br>
                <label><input type="checkbox" name="pots_and_traps[]" value="Fish Corrals (Baklad)"> Fish Corrals (Baklad)</label><br>
                <label><input type="checkbox" name="pots_and_traps[]" value="Set Net (Lambaklad)"> Set Net (Lambaklad)</label><br>
                <label><input type="checkbox" name="pots_and_traps[]" value="Barrier Net (Likus)"> Barrier Net (Likus)</label>

            </td>
            <td>
                <div class="title">Scoop Nets</div>
                <label><input type="checkbox" name="scoop_nets[]" value="Man Push Nets"> Man Push Nets</label><br>
                <label><input type="checkbox" name="scoop_nets[]" value="Scoop Nets"> Scoop Nets</label>
            </td>
        </tr>
        <tr>
        <td>
                <div class="title">Gill Nets</div>
                <label><input type="checkbox" name="gill_nets[]" value="Surface Set Gill Net"> Surface Set Gill Net</label><br>
                <label><input type="checkbox" name="gill_nets[]" value="Drift Gill Net"> Drift Gill Net</label><br>
                <label><input type="checkbox" name="gill_nets[]" value="Bottom Set Gill Net"> Bottom Set Gill Net</label><br>
                <label><input type="checkbox" name="gill_nets[]" value="Trammel Net"> Trammel Net</label><br>
                <label><input type="checkbox" name="gill_nets[]" value="Encircling Gill Net"> Encircling Gill Net</label>
            </td>
            <td>
                <div class="title">Lift Nets</div>
                <label><input type="checkbox" name="lift_nets[]" value="Crab Lift Nets (Bintol)"> Crab Lift Nets (Bintol)</label><br>
                <label><input type="checkbox" name="lift_nets[]" value="Fish Lift Nets (Basnig/Bagnet)"> Fish Lift Nets (Basnig/Bagnet)</label><br>
                <label><input type="checkbox" name="lift_nets[]" value="New Look or Zapra">New Look or Zapra</label><br>
                <label><input type="checkbox" name="lift_nets[]" value="Shrimp Lift Nets"> Shrimp Lift Nets</label><br>
                <label><input type="checkbox" name="lift_nets[]" value="Lever Net"> Lever Net</label>
            </td>
            <td>
                <div class="title">Miscellaneous Fishing Gears</div>
                <label><input type="checkbox" name="miscellaneous_fishing_gears[]" value="Spear"> Spear</label><br>
                <label><input type="checkbox" name="miscellaneous_fishing_gears[]" value="Octopus/Squid Luring Devices"> Octopus/Squid Luring Devices</label><br>
                <label><input type="checkbox" name="miscellaneous_fishing_gears[]" value="Gaff Hook"> Gaff Hook</label>
            </td>
        </tr>
        <tr>
            <td>
                <div class="title">Seine Nets</div>
                <label><input type="checkbox" name="seine_nets[]" value="Beach Seine"> Beach Seine</label><br>
                <label><input type="checkbox" name="seine_nets[]" value="Fry Dozer or Gatherer"> Fry Dozer or Gatherer</label>

            </td>
            <td>
                <div class="title">Falling Gear</div>
                <label><input type="checkbox" name="falling_gear[]" value="Cast Net"> Cast Net</label>
            </td>
            <td>
                <div class="title">Others</div>
                <input type="text" name="others" id="others">
            </td>
        </tr>
        </tr>
   

    <!-- Declaration with Thumbmark Box and Signatures -->
   
        <tr>
            <td colspan="2">
                <p>I hereby certify that all information contained herein is true and correct.</p>
                <div class="signature-line"></div>
                <p>PRINTED NAME & SIGNATURE OF OWNER</p>
            </td>
            <td>
            <p>Thumbmark</p>
                <div class="thumbmark-box">
                </div>
            </td>
        </tr>
    

    <!-- Enumerator and Noted By Section -->
    <table>
        <tr>
            <td>
                <p>Enumerator:</p>
                <div class="signature-line"></div>
                <p>NAME/DESIGNATION AND SIGNATURE</p>
            </td>
            <td>
                <p>NOTED BY:</p>
                <div class="signature-line"></div>
                <p>MUNICIPAL/CITY AGRICULTURIST</p>
            </td>
        </tr>
    </table>
</div>

            
          
               <!-- Print Button -->
               <div class="center" style="margin-bottom: 20px;">
                <button type="button" onclick="window.print();" class="btn btn-primary">Print</button>
            </div>
            <div class="form-actions text-center">
              <button type="submit" class="btn btn-success">Submit Member Details</button>
            </div>
            </form>

          </div>



        </div>

        </div>
      </div>

	</div>
  </div>
  
  
</div></div>


<!--end-main-container-part-->

<!--Footer-part-->

<div class="row-fluid">
  <div id="footer" class="span12">  </div>
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
