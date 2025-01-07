<?php
session_start();
// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
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
    <link rel="stylesheet" href="../css/matrix-style.css" />
    <link rel="stylesheet" href="../css/matrix-media.css" />
    <link href="../font-awesome/css/all.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 100%;
            max-width: 900px;
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
        
        .homeport {
            width: 200px;
        }
        .vessel-name {
            width: 200px;
        }
        .vessel-type {
            width: 200px;
        }
       .address {
        width: 240px;
       }

    


        input[type="text"], input[type="date"] {
            width: 100%; /* Make input fields wider horizontally */
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
        input[type="number"], 
input.short-input {
    width: 60px; /* Adjust the width for compact inputs */
    text-align: center; /* Center-align for better readability */
    font-size: 12px; /* Optional: Adjust font size */
    padding: 3px; /* Reduce padding for a smaller box */
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
        top: -25px;
        left: -25px;
        width: 100%;
        max-width: 900px; /* Ensure container fits on letter-sized paper */
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    @page {
        size: letter; /* Letter-sized paper */
        margin: 1mm; /* Adjust margins if necessary */
    }
    .center.title {
        background-color: black !important;
    }
    .print-background {
        background-color: black !important;
        color: white !important;
    }
}

</style>

</head>
<body>

<!-- Header -->
<div id="header">
    <h1><a href="dashboard.html"></a></h1>
</div>

<!-- Top Header Menu -->
<?php include 'includes/topheader.php'?>

<!-- Sidebar Menu -->
<?php $page='members-update'; include 'includes/sidebar.php'?>

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


$id = $_GET['id'];
$qry = "SELECT * FROM members WHERE user_id='$id'";
$result = mysqli_query($conn, $qry);
while($row=mysqli_fetch_array($result)){
?>

<!-- Content -->
<div id="content">
    <div id="content-header" >
    <div id="breadcrumb">
            <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a>
            <a href="archived-member.php" class="current"> Update Members</a>
        </div>
        <h1>Update Member Details</h1>
    </div>

    <div class="container">
        <form action="edit-member-req.php?user_id=<?php echo $id; ?>" method="POST">
        <h2 style="text-align: center;">Standard Form for Boat Registration</h2>


            <table>
                <tr>
                    <td colspan="3" class="center title">Republic of the Philippines<br>Province of Batangas<br>MUNICIPALITY OF MABINI</td>
                </tr>
                <tr>
                    <td style="background-color: black; color: white; text-align: center; padding: 10px;">Municipal Fishing Vessel and Gear Registration Program</td>
                    <td>
                        <label for="mfvr_no">MFVR No.:</label>
                        <input type="text" name="mfvr_no" id="mfvr_no" value="<?php echo $row['mfvr_no']; ?>" required>
                    </td>
                    <td>
                        <label for="date_of_application">Date of Application:</label>
                        <input type="date" name="date_of_application" id="date_of_application" value="<?php echo $row['date_of_application']; ?>" required>
                    </td>
                </tr>

                <!-- Type of Registration -->
                <tr>
                <td colspan="1" for="registration_type" class="title">TYPE OF REGISTRATION</td> 
                <td> <label class="title">Gender:</label></td> <!-- Empty Box with "Gender" as the title -->
                <td> <label class="title">Age:</label></td> <!-- Empty Box with "Gender" as the title -->
                </tr>
                <tr>
                    <td colspan="1">
                        <label><input type="checkbox" name="registration_type[]" value="Initial Registration" <?php echo in_array('Initial Registration', explode(',', $row['registration_type'])) ? 'checked' : ''; ?>> Initial Registration</label>
                        <label><input type="checkbox" name="registration_type[]" value="Issuance of New Certificate of Number" <?php echo in_array('Issuance of New Certificate of Number', explode(',', $row['registration_type'])) ? 'checked' : ''; ?>> Issuance of New Certificate of Number</label>
                        <label><input type="checkbox" name="registration_type[]" value="Re-issuance of Certificate of Number" <?php echo in_array('Re-issuance of Certificate of Number', explode(',', $row['registration_type'])) ? 'checked' : ''; ?>> Re-issuance of Certificate of Number</label>
                    </td>
                    <!-- Gender Field -->
    <td>
        <label><input type="checkbox" name="gender" value="Male" <?php echo ($row['gender'] == 'Male') ? 'checked' : ''; ?>> Male</label>
        <label><input type="checkbox" name="gender" value="Female" <?php echo ($row['gender'] == 'Female') ? 'checked' : ''; ?>> Female</label>
    </td>

    <!-- Age Field -->
    <td colspan="3"  style="text-align: center; ">
        <input type="number" name="age" id="age" class="short-input" value="<?php echo $row['age']; ?>" required>
    </td>
                </tr>

                <!-- Owner Information -->
                <tr>
                    <td  colspan="2">
                        <label for="owner_name">Name of Owner/Operator (Surname, First Name, M.I):</label>
                        <input type="text" id="owner_name" name="owner_name" value="<?php echo $row['owner_name']; ?>" required>
                    </td>
                    <td class="address">
                        <label for="address">Address:</label>
                        <input type="text" id="address" name="address" value="<?php echo $row['address']; ?>" required>
                    </td>
                    <script>
    const addressInput = document.getElementById("address");

    addressInput.addEventListener("input", () => {
        // Normalize spacing: ensure single space after commas
        addressInput.value = addressInput.value
            .replace(/\s*,\s*/g, ", ") // Ensure one space after commas
            .replace(/\s+/g, " ");    // Replace multiple spaces with a single space
    });
</script>
                </tr>

                <!-- Vessel Information -->
                <tr>
                    <td class="homeport"><label for="homeport">Homeport:</label><input type="text" name="homeport" id="homeport" value="<?php echo $row['homeport']; ?>" required></td>
                    <td class="vessel-name"><label for="vessel_name">Name of Fishing Vessel:</label><input type="text" name="vessel_name" id="vessel_name" value="<?php echo $row['vessel_name']; ?>" required></td>
                    <td class="vessel-type">
                        <label for="vessel_type">Vessel Type:</label>
                        <div>
                            <label><input type="checkbox" name="vessel_type[]" value="Non-motorized" <?php echo in_array('Non-motorized', explode(',', $row['vessel_type'])) ? 'checked' : ''; ?>> Non-motorized</label>
                            <label><input type="checkbox" name="vessel_type[]" value="Motorized" <?php echo in_array('Motorized', explode(',', $row['vessel_type'])) ? 'checked' : ''; ?>> Motorized</label>
                            <label><input type="checkbox" name="vessel_type[]" value="Others" <?php echo in_array('Others', explode(',', $row['vessel_type'])) ? 'checked' : ''; ?>> Others</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><label for="place_built">Place Built:</label><input type="text" name="place_built" id="place_built" value="<?php echo $row['place_built']; ?>" required></td>
                    <td><label for="year_built">Year Built:</label><input type="text" name="year_built" id="year_built" value="<?php echo $row['year_built']; ?>" required></td>
                    <td>
                        <label for="material_used">Material Used:</label>
                        <div>
                            <label><input type="checkbox" name="material_used[]" value="Wood" <?php echo in_array('Wood', explode(',', $row['material_used'])) ? 'checked' : ''; ?>> Wood</label>
                            <label><input type="checkbox" name="material_used[]" value="Fiber Glass" <?php echo in_array('Fiber Glass', explode(',', $row['material_used'])) ? 'checked' : ''; ?>> Fiber Glass</label>
                            <label><input type="checkbox" name="material_used[]" value="Composite" <?php echo in_array('Composite', explode(',', $row['material_used'])) ? 'checked' : ''; ?>> Composite</label>
                        </div>
                    </td>
                </tr>

                <!-- Vessel Dimensions -->
                <tr>
                    <td colspan="3" class="title">FISHING VESSEL DIMENSIONS AND TONNAGES (METERS)</td>
                </tr>
                <tr>
                    <td><label for="reg_length">Registered Length:</label><input type="number" name="reg_length" id="reg_length" value="<?php echo $row['reg_length']; ?>" required></td>
                    <td><label for="reg_breadth">Registered Breadth:</label><input type="number" name="reg_breadth" id="reg_breadth" value="<?php echo $row['reg_breadth']; ?>" required></td>
                    <td><label for="reg_depth">Registered Depth:</label><input type="number" name="reg_depth" id="reg_depth" value="<?php echo $row['reg_depth']; ?>" required></td>
                </tr>
                <tr>
                    <td><label for="tonnage_length">Tonnage Length:</label><input type="number" name="tonnage_length" id="tonnage_length" value="<?php echo $row['tonnage_length']; ?>" required></td>
                    <td><label for="tonnage_breadth">Tonnage Breadth:</label><input type="number" name="tonnage_breadth" id="tonnage_breadth" value="<?php echo $row['tonnage_breadth']; ?>" required></td>
                    <td><label for="tonnage_depth">Tonnage Depth:</label><input type="number" name="tonnage_depth" id="tonnage_depth" value="<?php echo $row['tonnage_depth']; ?>" required></td>
                </tr>
                <tr>
            <td colspan="3" class="title">PARTICULARS OF PROPULSION SYSTEM</td>
        </tr>
        <tr>
            <td><label for="engine_make">Engine Make:</label><input type="text" name="engine_make" id="engine_make" value="<?php echo $row['engine_make']; ?>" required ></td>
            <td><label for="serial_number">Serial Number:</label><input type="text" name="serial_number" id="serial_number" value="<?php echo $row['serial_number']; ?>" required></td>
            <td><label for="horse_power">Horse Power:</label><input type="number" name="horse_power" id="horse_power" value="<?php echo $row['horse_power']; ?>" required></td>
        </tr>
        <tr>
            <td class="gross-tonn" colspan="2" style="text-align: center;">
            <label for="gross_tonnage">Gross Tonnage:</label><input type="number" name="gross_tonnage" id="gross_tonnage" class="short-input" value="<?php echo $row['gross_tonnage']; ?>"></td>
            <td style="text-align: center; ">
            <label for="net_tonnage">Net Tonnage:</label><input type="number" name="net_tonnage" id="net_tonnage" class="short-input" value="<?php echo $row['net_tonnage']; ?>">
        </td>
        </tr>
         <!-- Fishing Gear Classification -->
    
         <tr>
            <td colspan="3" class="title">CLASSIFICATION OF FISHING GEAR</td>
        </tr>
        <tr>
            <td>
                <div class="title">Hook and Line</div>
                <label><input type="checkbox" name="hook_and_line[]" value="Simple Hand Line" <?php echo in_array('Simple Hand Line', explode(',', $row['hook_and_line'])) ? 'checked' : ''; ?>> Simple Hand Line</label><br>
                <label><input type="checkbox" name="hook_and_line[]" value="Multiple Hand Line" <?php echo in_array('Multiple Hand Line', explode(',', $row['hook_and_line'])) ? 'checked' : ''; ?>> Multiple Hand Line</label><br>
                <label><input type="checkbox" name="hook_and_line[]" value="Bottom Set Long Line" <?php echo in_array('Bottom Set Long Line', explode(',', $row['hook_and_line'])) ? 'checked' : ''; ?>> Bottom Set Long Line</label><br>
                <label><input type="checkbox" name="hook_and_line[]" value="Drift Long Line" <?php echo in_array('Drift Long Line', explode(',', $row['hook_and_line'])) ? 'checked' : ''; ?>> Drift Long Line</label><br>
                <label><input type="checkbox" name="hook_and_line[]" value="Troll Line" <?php echo in_array('Troll Line', explode(',', $row['hook_and_line'])) ? 'checked' : ''; ?>> Troll Line</label><br>
                <label><input type="checkbox" name="hook_and_line[]" value="Jig" <?php echo in_array('Jig', explode(',', $row['hook_and_line'])) ? 'checked' : ''; ?>> Jig</label>
            </td>
            <td>
                <div class="title">Pots and Traps</div>
                <label><input type="checkbox" name="pots_and_traps[]" value="Fish Pots" <?php echo in_array('Fish Pots', explode(',', $row['pots_and_traps'])) ? 'checked' : ''; ?>> Fish Pots</label><br>
                <label><input type="checkbox" name="pots_and_traps[]" value="Crab Pots" <?php echo in_array('Crab Pots', explode(',', $row['pots_and_traps'])) ? 'checked' : ''; ?>> Crab Pots</label><br>
                <label><input type="checkbox" name="pots_and_traps[]" value="Squid Pots" <?php echo in_array('Squid Pots', explode(',', $row['pots_and_traps'])) ? 'checked' : ''; ?>> Squid Pots</label><br>
                <label><input type="checkbox" name="pots_and_traps[]" value="Fish Corrals (Baklad)" <?php echo in_array('Fish Corrals (Baklad)', explode(',', $row['pots_and_traps'])) ? 'checked' : ''; ?>> Fish Corrals (Baklad)</label><br>
                <label><input type="checkbox" name="pots_and_traps[]" value="Set Net (Lambaklad)" <?php echo in_array('Set Net (Lambaklad)', explode(',', $row['pots_and_traps'])) ? 'checked' : ''; ?>> Set Net (Lambaklad)</label><br>
                <label><input type="checkbox" name="pots_and_traps[]" value="Barrier Net (Likus)" <?php echo in_array('Barrier Net (Likus)', explode(',', $row['pots_and_traps'])) ? 'checked' : ''; ?>> Barrier Net (Likus)</label>
            </td>
            <td>
                <div class="title">Scoop Nets</div>
                <label><input type="checkbox" name="scoop_nets[]" value="Man Push Nets" <?php echo in_array('Man Push Nets', explode(',', $row['scoop_nets'])) ? 'checked' : ''; ?>> Man Push Nets</label><br>
                <label><input type="checkbox" name="scoop_nets" value="Scoop Nets" <?php echo in_array('Scoop Nets', explode(',', $row['scoop_nets'])) ? 'checked' : ''; ?>> Scoop Nets</label>
            </td>
            </tr>
<tr>
    <td>
        <div class="title">Gill Nets</div>
        <label><input type="checkbox" name="gill_nets[]" value="Surface Set Gill Net" <?php echo in_array('Surface Set Gill Net', explode(',', $row['gill_nets'])) ? 'checked' : ''; ?>> Surface Set Gill Net</label><br>
        <label><input type="checkbox" name="gill_nets[]" value="Drift Gill Net" <?php echo in_array('Drift Gill Net', explode(',', $row['gill_nets'])) ? 'checked' : ''; ?>> Drift Gill Net</label><br>
        <label><input type="checkbox" name="gill_nets[]" value="Bottom Set Gill Net" <?php echo in_array('Bottom Set Gill Net', explode(',', $row['gill_nets'])) ? 'checked' : ''; ?>> Bottom Set Gill Net</label><br>
        <label><input type="checkbox" name="gill_nets[]" value="Trammel Net" <?php echo in_array('Trammel Net', explode(',', $row['gill_nets'])) ? 'checked' : ''; ?>> Trammel Net</label><br>
        <label><input type="checkbox" name="gill_nets[]" value="Encircling Gill Net" <?php echo in_array('Encircling Gill Net', explode(',', $row['gill_nets'])) ? 'checked' : ''; ?>> Encircling Gill Net</label>
    </td>
    <td>
        <div class="title">Lift Nets</div>
        <label><input type="checkbox" name="lift_nets[]" value="Crab Lift Nets (Bintol)" <?php echo in_array('Crab Lift Nets (Bintol)', explode(',', $row['lift_nets'])) ? 'checked' : ''; ?>> Crab Lift Nets (Bintol)</label><br>
        <label><input type="checkbox" name="lift_nets[]" value="Fish Lift Nets (Basnig/Bagnet)" <?php echo in_array('Fish Lift Nets (Basnig/Bagnet)', explode(',', $row['lift_nets'])) ? 'checked' : ''; ?>> Fish Lift Nets (Basnig/Bagnet)</label><br>
        <label><input type="checkbox" name="lift_nets[]" value="New Look or Zapra" <?php echo in_array('New Look or Zapra', explode(',', $row['lift_nets'])) ? 'checked' : ''; ?>> New Look or Zapra</label><br>
        <label><input type="checkbox" name="lift_nets[]" value="Shrimp Lift Nets" <?php echo in_array('Shrimp Lift Nets', explode(',', $row['lift_nets'])) ? 'checked' : ''; ?>> Shrimp Lift Nets</label><br>
        <label><input type="checkbox" name="lift_nets[]" value="Lever Net" <?php echo in_array('Lever Net', explode(',', $row['lift_nets'])) ? 'checked' : ''; ?>> Lever Net</label>
    </td>
    <td>
        <div class="title">Miscellaneous Fishing Gears</div>
        <label><input type="checkbox" name="miscellaneous_fishing_gears[]" value="Spear" <?php echo in_array('Spear', explode(',', $row['miscellaneous_fishing_gears'])) ? 'checked' : ''; ?>> Spear</label><br>
        <label><input type="checkbox" name="miscellaneous_fishing_gears[]" value="Octopus/Squid Luring Devices" <?php echo in_array('Octopus/Squid Luring Devices', explode(',', $row['miscellaneous_fishing_gears'])) ? 'checked' : ''; ?>> Octopus/Squid Luring Devices</label><br>
        <label><input type="checkbox" name="miscellaneous_fishing_gears[]" value="Gaff Hook" <?php echo in_array('Gaff Hook', explode(',', $row['miscellaneous_fishing_gears'])) ? 'checked' : ''; ?>> Gaff Hook</label>
    </td>
</tr>

    <td>
        <div class="title">Seine Nets</div>
        <label><input type="checkbox" name="seine_nets[]" value="Beach Seine" <?php echo in_array('Beach Seine', explode(',', $row['seine_nets'])) ? 'checked' : ''; ?>> Beach Seine</label><br>
        <label><input type="checkbox" name="seine_nets[]" value="Fry Dozer or Gatherer" <?php echo in_array('Fry Dozer or Gatherer', explode(',', $row['seine_nets'])) ? 'checked' : ''; ?>> Fry Dozer or Gatherer</label>
    </td>
    <td>
        <div class="title">Falling Gear</div>
        <label><input type="checkbox" name="falling_gear[]" value="Cast Net" <?php echo in_array('Cast Net', explode(',', $row['falling_gear'])) ? 'checked' : ''; ?>> Cast Net</label>
    </td>


            <td style="text-align: center;">
                <div class="title">Others</div>
                <input type="text" name="others" id="others" value="<?php echo $row['others']; ?>" required ></td>
            </td>
        </tr>
        </tr>
   

                <!-- Signature Section -->
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

                <!-- Print Button -->
                <div class="center" style="margin-bottom: 20px;">
                <button type="button" onclick="window.print();" class="btn btn-primary">Print</button>
            </div>
            </table>
            <div style="text-align:center;">
            <input type="hidden" name="user_id" value="<?php echo $row['user_id'];?>">
            <button type="submit" class="btn btn-success">Update Member Details</button>
                <a href="members.php" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
</div>



<?php } ?>

<!--Footer-part-->
<div class="row-fluid">
    <div id="footer" class="span12"> </div>
</div>

<style>
#footer {
    color: white;
}
</style>



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
