<?php
session_start();
// Check kung naka-login na ang user
if (!isset($_SESSION['user_id'])) {
    header('location:../index.php');
    exit();  // Always exit after header redirects
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

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

    // Soft delete - I-update ang is_deleted column sa halip na i-delete ang record
    $qry = "UPDATE members SET is_deleted = 1 WHERE user_id = ?";
    $stmt = $conn->prepare($qry);

    if ($stmt) {
        $stmt->bind_param("i", $id);  // Bind the ID parameter as an integer
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // Record successfully updated
            $_SESSION['message'] = "Member marked as deleted.";
            header('Location: ../remove-member.php');
            exit();
        } else {
            // Record update failed
            echo "Error: Could not update record.";
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    $conn->close();
} else {
    echo "No ID provided.";
}
?>
