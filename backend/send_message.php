<?php

include 'db_connect.php';

$sender = $_POST['sender'];
$receiver = $_POST['receiver'];
$message = $_POST['message'];

$sql = "INSERT INTO messages (sender_id, receiver_id, message_text)
VALUES ('$sender', '$receiver', '$message')";

if ($mysqli->query($sql) === TRUE) {
    echo "Message sent successfully!";
} else {
    echo "Error: " . $mysqli->error;
}

$mysqli->close();

?>
