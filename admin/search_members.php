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

// Get the address from the GET request
$address = $_GET['address'] ?? '';

// SQL query to fetch the member data
$sql = "
   SELECT 
    COUNT(*) AS member_count,
    reg_length,
    reg_breadth,
    reg_depth,
    tonnage_length,
    tonnage_breadth,
    tonnage_depth,
    gross_tonnage,
    net_tonnage,
    address,
    age,
    gender,
    -- Hook and Line Counts
    SUM(hook_and_line = 'Simple Hand Line') AS simple_hand_line_count,
    SUM(hook_and_line = 'Multiple Hand Line') AS multiple_hand_line_count,
    SUM(hook_and_line = 'Bottom Set Long Line') AS bottom_set_long_line_count,
    SUM(hook_and_line = 'Drift Long Line') AS drift_long_line_count,
    SUM(hook_and_line = 'Troll Line') AS troll_line_count,
    SUM(hook_and_line = 'Jig') AS jig_count,
    -- Pots and Traps Counts
    SUM(pots_and_traps = 'Fish Pots') AS fish_pots_count,
    SUM(pots_and_traps = 'Crab Pots') AS crab_pots_count,
    SUM(pots_and_traps = 'Squid Pots') AS squid_pots_count,
    SUM(pots_and_traps = 'Fish Corrals (Baklad)') AS fish_corrals_count,
    SUM(pots_and_traps = 'Set Net (Lambaklad)') AS set_net_count,
    SUM(pots_and_traps = 'Barrier Net (Likus)') AS barrier_net_count,
    -- Scoop Nets Counts
    SUM(scoop_nets = 'Man Push Nets') AS man_push_nets_count,
    SUM(scoop_nets = 'Scoop Nets') AS scoop_nets_count,
    -- Gill Nets Counts
    SUM(gill_nets = 'Surface Set Gill Net') AS surface_set_gill_net_count,
    SUM(gill_nets = 'Drift Gill Net') AS drift_gill_net_count,
    SUM(gill_nets = 'Bottom Set Gill Net') AS bottom_set_gill_net_count,
    SUM(gill_nets = 'Trammel Net') AS trammel_net_count,
    SUM(gill_nets = 'Encircling Gill Net') AS encircling_gill_net_count,
    -- Lift Nets Counts
    SUM(lift_nets = 'Crab Lift Nets (Bintol)') AS crab_lift_nets_count,
    SUM(lift_nets = 'Fish Lift Nets (Basnig/Bagnet)') AS fish_lift_nets_count,
    SUM(lift_nets = 'New Look or Zapra') AS new_look_zapra_count,
    SUM(lift_nets = 'Shrimp Lift Nets') AS shrimp_lift_nets_count,
    SUM(lift_nets = 'Lever Net') AS lever_net_count,
    -- Seine Nets Counts
    SUM(seine_nets = 'Beach Seine') AS beach_seine_count,
    SUM(seine_nets = 'Fry Dozer or Gatherer') AS fry_dozer_count,
    -- Miscellaneous Fishing Gear Counts
    SUM(miscellaneous_fishing_gears = 'Spear') AS spear_count,
    SUM(miscellaneous_fishing_gears = 'Octopus/Squid Luring Devices') AS squid_luring_devices_count,
    SUM(miscellaneous_fishing_gears = 'Gaff Hook') AS gaff_hook_count,
    -- Falling Gear Counts
    SUM(falling_gear = 'Cast Net') AS cast_net_count
FROM members 
WHERE is_deleted = 0 
AND LOWER(address) LIKE LOWER(?) 
GROUP BY 
    reg_length, 
    reg_breadth, 
    reg_depth, 
    tonnage_length, 
    tonnage_breadth, 
    tonnage_depth, 
    gross_tonnage, 
    net_tonnage, 
    address, 
    age, 
    gender
";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo json_encode(['error' => 'SQL preparation failed: ' . $conn->error]);
    exit;
}

$searchTerm = "%" . $address . "%";
$stmt->bind_param("s", $searchTerm);

if ($stmt->execute()) {
    $result = $stmt->get_result();

    $members = [];
    while ($data = $result->fetch_assoc()) {
        $members[] = $data;
    }

    echo json_encode([
        'status' => 'success',
        'member_count' => count($members),
        'members' => $members
    ]);
} else {
    echo json_encode(['error' => 'SQL execution failed: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
