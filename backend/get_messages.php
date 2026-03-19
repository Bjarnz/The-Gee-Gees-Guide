<?php

include 'db_connect.php';

$sql = "SELECT * FROM messages ORDER BY timestamp DESC";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "From User " . $row["sender_id"] . " → User " . $row["receiver_id"] . "<br>";
        echo "Message: " . $row["message_text"] . "<br>";
        echo "Time: " . $row["timestamp"] . "<br><br>";
    }
} else {
    echo "No messages found.";
}

$mysqli->close();

?>
