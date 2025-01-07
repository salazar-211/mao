<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gymnsb";

// Corrected connection line
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection Failed");
}

// Count members that are not archived
$sql = "SELECT COUNT(*) AS total_members FROM members WHERE is_deleted = 0";
$query = $conn->query($sql);

if ($query) {
    $result = $query->fetch_assoc();
    echo $result['total_members'];
} else {
    echo "Error retrieving member count.";
}

?>
