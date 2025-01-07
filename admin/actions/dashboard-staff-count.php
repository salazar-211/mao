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

$sql = "SELECT * FROM staffs";
$query = $conn->query($sql);

if ($query) {
    echo $query->num_rows;
} else {
    echo "Error retrieving staff count.";
}

?>
