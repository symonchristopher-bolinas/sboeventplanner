<?php
// DB Connection
$conn = new mysqli("localhost", "root", "", "eventplanner");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Make sure these column names match your actual database
$query = "SELECT id, orgranizer, email, status, venue FROM venue_db";
$result = $conn->query($query);

$users = [];

while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

header('Content-Type: application/json');
echo json_encode($users);
?>
