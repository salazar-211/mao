<?php
session_start();
// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('location:../index.php');
    exit(); // Always use exit after header redirection
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
    <link rel="stylesheet" href="../css/matrix-style.css" />
    <link rel="stylesheet" href="../css/matrix-media.css" />
    <link href="../font-awesome/css/all.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>
<body>

<div id="header">
    <h1><a href="dashboard.html"></a></h1>
</div>

<?php include 'includes/topheader.php'; ?>
<?php $page='staff-management'; include 'includes/sidebar.php'; ?>

<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a>
            <a href="staffs.php">Staffs</a>
            <a href="staffs-entry.php" class="current">Staff Entry</a>
        </div>
        <h1 class="text-center">MAO's Staff <i class="fas fa-users"></i></h1>
    </div>
  
    <form role="form" action="staffs-entry.php" method="POST">
        <?php 
        if (isset($_POST['fullname'])) {
            // Sanitize user input
            $fullname = htmlspecialchars(trim($_POST["fullname"]));    
            $username = htmlspecialchars(trim($_POST["username"]));
            $password = md5(trim($_POST["password"])); // Consider using password_hash()
            $gender = htmlspecialchars(trim($_POST["gender"]));
            // If you have an address field, make sure to define it and sanitize it
            // $address = htmlspecialchars(trim($_POST["address"])); // Uncomment if you have an address input

            $servername = "localhost";
$username = "root";
$password = "";
$dbname = "gymnsb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['error' => 'Database connection failed: ' . $conn->connect_error]);
    exit;
}

            // Correct the SQL statement to match the number of values
            $qry = $conn->prepare("INSERT INTO staffs (fullname, username, password, gender) VALUES (?, ?, ?, ?)");
            $qry->bind_param("ssss", $fullname, $username, $password, $gender); // Bind only 4 parameters
            $result = $qry->execute(); // Execute the prepared statement

            if (!$result) {
                echo "<div class='container-fluid'>
                        <div class='row-fluid'>
                            <div class='span12'>
                                <div class='widget-box'>
                                    <div class='widget-title'> <span class='icon'> <i class='fas fa-info'></i> </span>
                                        <h5>Error Message</h5>
                                    </div>
                                    <div class='widget-content'>
                                        <div class='error_ex'>
                                            <h1 style='color:maroon;'>Error 404</h1>
                                            <h3>Error occurred while submitting your details</h3>
                                            <p>Please Try Again</p>
                                            <a class='btn btn-warning btn-big' href='edit-member.php'>Go Back</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>";
            } else {
                echo "<div class='container-fluid'>
                        <div class='row-fluid'>
                            <div class='span12'>
                                <div class='widget-box'>
                                    <div class='widget-title'> <span class='icon'> <i class='fas fa-info'></i> </span>
                                        <h5>Message</h5>
                                    </div>
                                    <div class='widget-content'>
                                        <div class='error_ex'>
                                            <h1>Success</h1>
                                            <h3>Staff details have been added!</h3>
                                            <p>The requested staff details are added to the database. Please click the button to go back.</p>
                                            <a class='btn btn-inverse btn-big' href='staffs.php'>Go Back</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>";
            }

            $qry->close(); // Close the prepared statement
        } else {
            echo "<h3>YOU ARE NOT AUTHORIZED TO REDIRECT THIS PAGE. GO BACK to <a href='index.php'> DASHBOARD </a></h3>";
        }
        ?>                                    
    </form>
</div>

<div class="row-fluid">
    <div id="footer" class="span12"> </div>
</div>

<style>
#footer {
    color: white;
}
</style>

<script src="../js/jquery.min.js"></script> 
<script src="../js/jquery.ui.custom.js"></script> 
<script src="../js/bootstrap.min.js"></script> 
<script src="../js/jquery.validate.js"></script> 
<script src="../js/jquery.wizard.js"></script> 
<script src="../js/matrix.js"></script> 
<script src="../js/matrix.wizard.js"></script>
</body>
</html>
