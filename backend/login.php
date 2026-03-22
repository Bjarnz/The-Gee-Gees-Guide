<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $mysqli->query($sql);

if ($result->num_rows == 1) {
    $_SESSION['username'] = $username;
    // Removed the echo to allow the header to work
    header("Location: ../index.html");
    exit(); 
} else {
    echo "Invalid username or password.";
}

$mysqli->close();
?>
