<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $program = $_POST['program'];
    $subjects = $_POST['subjects'];
    $email = $_POST['email'];

    $sql = "INSERT INTO tutors (name, program, subjects, email)
            VALUES ('$name','$program','$subjects','$email')";

    if ($mysqli->query($sql) === TRUE) {
        echo "Tutor added successfully!";
    } else {
        echo "Error: " . $mysqli->error;
    }
}

$mysqli->close();
?>
