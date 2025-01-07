<?php
session_start();

// Regenerate session ID to prevent session fixation attacks
session_regenerate_id(true);

// Load Dotenv for environment variables
require_once '../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Get database credentials from .env
$servername = $_ENV['DB_HOST'];
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];
$dbname = $_ENV['DB_DATABASE'];

// Create MySQL connection using mysqli with error handling
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize attempts counter and lock time if not set
if (!isset($_SESSION['attempts'])) {
    $_SESSION['attempts'] = 0;
    $_SESSION['lock_time'] = 0;
}

// Lockout logic: Check if the admin is locked out
if (isset($_SESSION['lock_time']) && $_SESSION['lock_time'] > time()) {
    $remaining_time = $_SESSION['lock_time'] - time();
    $_SESSION['error_message'] = "Too many attempts. Please try again in " . ceil($remaining_time / 60) . " minutes.";
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Handle password change form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['change_password'])) {
    // Sanitize inputs to prevent XSS and other attacks
    $user = htmlspecialchars($_POST['user']);
    $old_pass = htmlspecialchars($_POST['old_pass']);
    $new_pass = htmlspecialchars($_POST['new_pass']);
    $confirm_pass = htmlspecialchars($_POST['confirm_pass']);

    // Define password validation pattern (at least 8 characters, must include letters, numbers, and symbols)
    $pattern = '/^(?=.*[!@#$%^&*(),.?":{}|<>])(?=.*[0-9])(?=.*[a-zA-Z]).{8,}$/';

    if ($new_pass !== $confirm_pass) {
        $_SESSION['error_message'] = "New password and confirm password do not match.";
        $_SESSION['attempts']++;
    } elseif (!preg_match($pattern, $new_pass)) {
        $_SESSION['error_message'] = "Password must be at least 8 characters long and include symbols, numbers, and letters.";
        $_SESSION['attempts']++;
    } else {
        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("SELECT password FROM admin WHERE username = ?");
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Verify old password or secret key
            if (password_verify($old_pass, $row['password']) || $old_pass === $_ENV['SECRET_KEY']) {
                $hashed_new_pass = password_hash($new_pass, PASSWORD_DEFAULT);

                // Prepare the update query to prevent SQL injection
                $update_stmt = $conn->prepare("UPDATE admin SET password = ? WHERE username = ?");
                $update_stmt->bind_param("ss", $hashed_new_pass, $user);

                if ($update_stmt->execute()) {
                    $_SESSION['success_message'] = "Password changed successfully.";
                    $_SESSION['attempts'] = 0; // Reset attempts after success
                } else {
                    $_SESSION['error_message'] = "Error updating password. Please try again.";
                    $_SESSION['attempts']++;
                }
            } else {
                // Custom error message based on attempt count
                $_SESSION['error_message'] = $_SESSION['attempts'] >= 3 ?
                    "Forgot your old password? Try using the secret key." :
                    "Incorrect old password.";
                $_SESSION['attempts']++;

                if ($_SESSION['attempts'] >= 6) {
                    // Lock the account for 30 minutes
                    $_SESSION['lock_time'] = time() + (30 * 60); // 30 minutes from now
                }
            }
        } else {
            $_SESSION['error_message'] = "User not found.";
            $_SESSION['attempts']++;
        }
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Clear messages after displaying them
$error_message = $_SESSION['error_message'] ?? '';
$success_message = $_SESSION['success_message'] ?? '';
unset($_SESSION['error_message'], $_SESSION['success_message']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Change Password</title>
    <link rel="icon" type="image/png" href="../img/Mabini-Logo.ico" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/matrix-login.css" />
    <link href="font-awesome/css/all.css" rel="stylesheet" />
    <style>
        /* Custom styles */
        body {
            background-image: url('../img/mabini-img.jpg');
            background-size: cover;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        #loginbox {
            background: rgba(230, 230, 230, 0.8);
            border-radius: 15px;
            padding: 20px;
            width: 300px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }
        #header {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 15px;
        }
        #header img {
            height: 60px;
            margin-bottom: 5px;
        }
        #header h4 {
            margin: 0;
            font-size: 2em;
            color: black;
            font-weight: bold;
            text-align: center;
        }
        .btn-info {
            background-color: #28a745;
            border-color: #28a745;
            width: 100%;
        }
        .btn-info:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
        .back-to-login {
            display: block;
            text-align: center;
            margin-top: 15px;
            padding: 10px 15px;
            background-color: white;
            color: black;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }
        .back-to-login:hover {
            background-color: #f0f0f0;
            border-color: #bbb;
            color: #333;
        }
        .toggle-password {
            cursor: pointer;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
        }
        .main_input_box {
            position: relative;
        }
        .main_input_box input {
            padding-right: 40px;
        }
        .show-password-checkbox {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }
        .form-actions {
            display: flex;
            justify-content: center;
        }
        .alert-danger {
        color: #ff0000; /* Red color for error message text */
        background-color: #f8d7da; /* Light red background */
        border: 1px solid #f5c6cb;
        padding: 10px;
        margin-top: 10px;
        border-radius: 5px;
    }

    .alert-success {
        color: #155724; /* Green color for success message text */
        background-color: #d4edda; /* Light green background */
        border: 1px solid #c3e6cb;
        padding: 10px;
        margin-top: 10px;
        border-radius: 5px;
    }
    </style>
</head>
<body>

<div id="loginbox">
    <div id="header">
        <img src="../img/Mabini-Logo.png" alt="Logo">
        <h4>Change Password</h4>
    </div>

    <form id="changePasswordForm" method="POST" action="#">
        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on bg_lg"><i class="fas fa-user-circle"></i></span>
                    <input type="text" name="user" placeholder="Username" required />
                </div>
            </div>
        </div>
        
        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on bg_ly"><i class="fas fa-lock"></i></span>
                    <input type="password" name="old_pass" id="old_pass" placeholder="Old Password" required />
                </div>
                <div class="show-password-checkbox">
                    <input type="checkbox" id="showOldPassword" onclick="toggleCheckboxVisibility('old_pass', 'showOldPassword')" />
                    <label for="showOldPassword">Show Password</label>
                </div>
            </div>
        </div>

        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on bg_ly"><i class="fas fa-lock"></i></span>
                    <input type="password" name="new_pass" id="new_pass" placeholder="New Password" required />
                </div>
                <div class="show-password-checkbox">
                    <input type="checkbox" id="showNewPassword" onclick="toggleCheckboxVisibility('new_pass', 'showNewPassword')" />
                    <label for="showNewPassword">Show Password</label>
                </div>
            </div>
        </div>

        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on bg_ly"><i class="fas fa-lock"></i></span>
                    <input type="password" name="confirm_pass" id="confirm_pass" placeholder="Confirm Password" required />
                </div>
                <div class="show-password-checkbox">
                    <input type="checkbox" id="showConfirmPassword" onclick="toggleCheckboxVisibility('confirm_pass', 'showConfirmPassword')" />
                    <label for="showConfirmPassword">Show Password</label>
                </div>
            </div>
        </div>

        <!-- Display error and success messages here -->
        <?php if ($error_message) : ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <?php if ($success_message) : ?>
            <div class="alert alert-success"><?php echo $success_message; ?></div>
        <?php endif; ?>

        <div class="form-actions">
            <button type="submit" name="change_password" class="btn btn-info">Change Password</button>
        </div>

        <a href="index.php" class="back-to-login">Back to Login</a>
    </form>
</div>
<script src="js/jquery.min.js"></script>  
<script src="js/matrix.login.js"></script> 

<script>
    function toggleCheckboxVisibility(passwordId, checkboxId) {
        var passwordField = document.getElementById(passwordId);
        var checkbox = document.getElementById(checkboxId);
        if (checkbox.checked) {
            passwordField.type = "text";
        } else {
            passwordField.type = "password";
        }
    }
</script>

</body>
</html>
