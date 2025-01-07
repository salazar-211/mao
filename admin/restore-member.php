<?php
include 'dbcon.php'; // Siguraduhing tama ang path dito

// Test the database connection
if ($con) {
    echo "Connected to the database successfully!";
} else {
    die("Failed to connect to the database: " . mysqli_connect_error());
}

// Rest of your code to restore the member
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Restore the member
    $qry = "UPDATE members SET is_deleted = 0 WHERE user_id = '$id'";
    
    if (mysqli_query($con, $qry)) {
        echo "<script>alert('Member restored successfully!'); window.location.href = '/Mao-Management-System/admin/archived-members.php';
</script>";
    } else {
        echo "<script>alert('Error restoring member.'); window.location.href = '/Mao-Management-System/admin/archived-members.php';
</script>";
    }
}
?>
