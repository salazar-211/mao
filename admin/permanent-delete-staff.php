<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('location:../index.php');
    exit();
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

// Permanently delete the staff member
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete query to remove the staff from the database
    $qry = "DELETE FROM staffs WHERE user_id = '$id'";

    if (mysqli_query($conn, $qry)) {
        // Redirect back to the archived staff list
        header('Location: archived-staff.php');
    } else {
        echo "Error deleting staff: " . mysqli_error($conn);
    }
}
?>
