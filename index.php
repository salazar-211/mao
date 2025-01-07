<?php 
session_start();
include('dbcon.php'); 

// Check for login post request
if (isset($_POST['login'])) {
    // Sanitize input
    $username = mysqli_real_escape_string($con, $_POST['user']);
    $password = $_POST['pass']; // Raw password from input

    // Perform the query
    $query = mysqli_query($con, "SELECT * FROM admin WHERE username='$username'");
    $row = mysqli_fetch_array($query);
    $num_row = mysqli_num_rows($query);

    // Check if a valid user is found
    if ($num_row > 0) {
        // Get the hashed password from the database
        $hashed_password = $row['password'];

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $row['user_id'];
            header('location:admin/index.php');
            exit();  // Stop script execution after redirect
        } else {
            $error_message = "Invalid Username and Password"; // Wrong password
        }
    } else {
        $error_message = "Invalid Username and Password"; // Username not found
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Login</title>
    <link rel="icon" type="image/png" href="img/Mabini-Logo.ico" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/matrix-login.css" />
    <link href="font-awesome/css/all.css" rel="stylesheet" />


    <style>
        body {
            background-image: url('img/mabini-img.jpg');
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
        }
        .btn-info:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
        .staff-login, .change-password {
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
        .staff-login:hover, .change-password:hover {
            background-color: #f0f0f0;
            border-color: #bbb;
            color: #333;
        }
        .input-container {
            display: flex;
            align-items: center;
            margin-top: 10px;
            margin-left: 10px;
            
        }
        .eye-icon {
            cursor: pointer;
            color: #888;
            margin-left: -25px;
            position: relative;
            top: 8px; /* Adjust this value to move the icon down */
        }
        
    </style>
</head>
<body>

<div id="loginbox">            
    <div id="header">
        <img src="img/mabini.png" alt="Logo">
        <h4>Municipal Agriculturist Office</h4>
    </div>

    <form id="loginform" method="POST" class="form-vertical" action="#">
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
                <div class="main_input_box ">
                    <span class="add-on bg_ly"><i class="fas fa-lock"></i></span>
                    <input type="password" id="password" name="pass" placeholder="Password" required />
                    <span class="eye-icon" id="togglePassword" onclick="togglePassword()">
                        <i class="fas fa-eye" id="eyeIcon"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="form-actions center">
            <button type="submit" class="btn btn-block btn-large btn-info" title="Log In" name="login" value="Admin Login">Admin Login</button>
        </div>
    </form>
    
    <?php if (isset($error_message)): ?>
        <div class='alert alert-danger alert-dismissible' role='alert'>
            <?php echo $error_message; ?>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>
    <?php endif; ?>
    
    <a href="staff/index.php" class="staff-login">Staff Login</a>
    <a href="admin/admin_change_password.php" class="change-password">Forgot Password</a>
</div>

<script src="js/jquery.min.js"></script>  
<script src="js/bootstrap.min.js"></script>
<script>
    function togglePassword() {
        var passwordInput = document.getElementById("password");
        var eyeIcon = document.getElementById("eyeIcon");
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
        } else {
            passwordInput.type = "password";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
        }
    }
</script>
</body>
</html>
