<?php
// Database connection setup
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gymnsb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $user_id = mysqli_real_escape_string($conn, $_GET['id']); // Sanitize the input

    // SQL to delete the member permanently
    $query = "DELETE FROM members WHERE user_id = '$user_id'";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Member permanently deleted.'); window.location.href = 'archived-members.php';</script>";
    } else {
        echo "<script>alert('Error deleting member: " . mysqli_error($conn) . "'); window.location.href = 'archived-members.php';</script>";
    }
} else {
    echo "<script>alert('No member ID provided.'); window.location.href = 'archived-member.php';</script>";
}

// Close the connection
$conn->close();
?>
