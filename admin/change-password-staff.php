<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gymnsb";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Clean input data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
    
    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Prepare the SQL query to prevent SQL injection
    $stmt = $conn->prepare("UPDATE staffs SET password=? WHERE username=?");
    $stmt->bind_param("ss", $hashed_password, $username);  // Bind parameters

    // Execute the query and check for success
    if ($stmt->execute()) {
        $message = "Password changed successfully!";
    } else {
        $message = "Error: Could not change password.";
    }

    // Close the statement and connection
    $stmt->close();
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Change Password - Mao System Admin</title>
    <link rel="icon" type="image/png" href="img/Mabini-Logo.ico" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="../css/uniform.css" />
    <link rel="stylesheet" href="../css/select2.css" />
    <link rel="stylesheet" href="../css/matrix-style.css" />
    <link rel="stylesheet" href="../css/matrix-media.css" />
    <link href="../font-awesome/css/fontawesome.css" rel="stylesheet" />
    <link href="../font-awesome/css/all.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    <style>
        .password-container {
            display: flex;
            align-items: center;
            width: 100%;
        }

        .password-container .toggle-password {
            margin-left: 5px;
            cursor: pointer;
            color: #6c757d;
            position: relative;
            top: -4px; /* Adjusts the eye icon slightly higher */
        }
    </style>
</head>
<body>

<div id="header">
    <h1><a href="dashboard.html"></a></h1>
</div>

<?php include 'includes/topheader.php'; ?>
<?php $page = 'change-password'; include 'includes/sidebar.php'; ?>

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> 
            <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a> 
            <a href="staffs.php">Staff Members</a> 
            <a href="#" class="current">Change Password</a>
        </div>
        <h1 class="text-center">Change Password</h1>
    </div>
    
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class='widget-box'>
                    <div class='widget-title'> 
                        <span class='icon'> <i class='fas fa-key'></i> </span>
                        <h5>Change Password Form</h5>
                    </div>
                    <div class='widget-content nopadding'>
                        <?php if (!empty($message)) echo "<div class='alert alert-info'>$message</div>"; ?>
                        <form method="POST" action="" onsubmit="return validatePassword()">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="new_password">New Password:</label>
                                <div class="password-container">
                                    <input type="password" id="new_password" name="new_password" class="form-control" required>
                                    <i class="fas fa-eye toggle-password" onclick="togglePasswordVisibility()" id="togglePasswordIcon"></i>
                                </div>
                                <small id="passwordHelp" class="form-text text-muted">
                                    Password must be at least 8 characters long, include a symbol, and a number.
                                </small>
                            </div>
                            <button type="submit" class="btn btn-primary">Change Password</button>
                            <a href="staffs.php" class="btn btn-success">Back to Staff List</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row-fluid">
    <div id="footer" class="span12"> 
        <?php echo date("Y"); ?> &copy; 
    </div>
</div>

<script src="../js/jquery.min.js"></script> 
<script src="../js/jquery.ui.custom.js"></script> 
<script src="../js/bootstrap.min.js"></script> 
<script src="../js/jquery.uniform.js"></script> 
<script src="../js/select2.min.js"></script> 
<script src="../js/jquery.dataTables.min.js"></script> 
<script src="../js/matrix.js"></script> 
<script src="../js/matrix.tables.js"></script>

<script>
    function validatePassword() {
        const password = document.getElementById("new_password").value;
        const passwordHelp = document.getElementById("passwordHelp");
        
        const regex = /^(?=.*[!@#$%^&*(),.?":{}|<>])(?=.*\d)[A-Za-z\d!@#$%^&*(),.?":{}|<>]{8,}$/;
        if (!regex.test(password)) {
            passwordHelp.style.color = "red";
            passwordHelp.textContent = "Invalid password. Must include a symbol, a number, and be 8 characters or more.";
            return false;
        }
        passwordHelp.style.color = "green";
        return true;
    }

    function togglePasswordVisibility() {
        const passwordField = document.getElementById("new_password");
        const passwordIcon = document.getElementById("togglePasswordIcon");

        if (passwordField.type === "password") {
            passwordField.type = "text";
            passwordIcon.classList.remove("fa-eye");
            passwordIcon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            passwordIcon.classList.remove("fa-eye-slash");
            passwordIcon.classList.add("fa-eye");
        }
    }
</script>

</body>
</html>
