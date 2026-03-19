<?php

include 'db_connect.php';

$sql = "SELECT * FROM tutors";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<strong>" . $row["name"] . "</strong><br>";
        echo "Program: " . $row["program"] . "<br>";
        echo "Subjects: " . $row["subjects"] . "<br>";
        echo "Email: " . $row["email"] . "<br><br>";
    }
} else {
    echo "No tutors found.";
}

$mysqli->close();

?>
