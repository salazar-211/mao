<?php
session_start();
// Check if the user is logged in
if(!isset($_SESSION['user_id'])){
    header('location:../index.php');    
}

if(isset($_POST['fullname'])){
    $fullname = $_POST["fullname"];    
    $username = $_POST["username"];
    $gender = $_POST["gender"];
    $id = $_POST["id"];
    
    // Database credentials
    $servername = "localhost";
    $db_username = "root";
    $password = "";
    $dbname = "gymnsb";

    // Create connection
    $conn = new mysqli($servername, $db_username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        echo json_encode(['error' => 'Database connection failed: ' . $conn->connect_error]);
        exit;
    }

    // Update query
    $qry = "UPDATE staffs SET fullname='$fullname', username='$username', gender='$gender' WHERE user_id='$id'";

    // Execute query using the correct connection variable $conn
    $result = mysqli_query($conn, $qry); // use $conn instead of $con

    if(!$result){
        echo "ERROR!!";
    } else {
        header('Location: staffs.php'); // Redirect after successful update
    }
} else {
    echo "<h3>YOU ARE NOT AUTHORIZED TO REDIRECT THIS PAGE. GO BACK to <a href='index.php'>DASHBOARD</a></h3>";
}
?>
