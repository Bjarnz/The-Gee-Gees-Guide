<?php
include 'db_connect.php';

$sql = "SELECT * FROM messages ORDER BY timestamp DESC";
$result = $mysqli->query($sql);

$messages = [];

while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

header('Content-Type: application/json');
echo json_encode($messages);

$mysqli->close();
?>