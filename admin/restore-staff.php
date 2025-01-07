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

// Restore archived staff (set is_deleted = 0)
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Update query to set is_deleted to 0 (restore)
    $qry = "UPDATE staffs SET is_deleted = 0 WHERE user_id = '$id'";

    if (mysqli_query($conn, $qry)) {
        // Redirect back to the archived staff list
        header('Location: archived-staff.php');
    } else {
        echo "Error restoring staff: " . mysqli_error($conn);
    }
}
?>
