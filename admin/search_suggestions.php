<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gymnsb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['error' => 'Database connection failed: ' . $conn->connect_error]);
    exit;
}

// Get the query string from the GET request
$query = $_GET['q'] ?? '';

// SQL query to fetch address suggestions
$sql = "
    SELECT DISTINCT address 
    FROM members 
    WHERE is_deleted = 0 
    AND LOWER(address) LIKE LOWER(?) 
    LIMIT 10
";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo json_encode(['error' => 'SQL preparation failed: ' . $conn->error]);
    exit;
}

$searchTerm = "%" . $query . "%";
$stmt->bind_param("s", $searchTerm);

if ($stmt->execute()) {
    $result = $stmt->get_result();

    $suggestions = [];
    while ($data = $result->fetch_assoc()) {
        $suggestions[] = $data['address'];
    }

    echo json_encode($suggestions);
} else {
    echo json_encode(['error' => 'SQL execution failed: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
