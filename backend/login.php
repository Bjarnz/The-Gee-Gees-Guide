<?php
session_start();
// This file already lives in backend/, so the DB include stays local to this folder.
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $mysqli->query($sql);

    if ($result && $result->num_rows == 1) {
        $_SESSION['username'] = $username;
        header("Location: ../index.html");
        exit();
    } else {
        echo "Invalid username or password.";
    }
} else {
    // If someone browses directly to the PHP handler, send them back to the form page.
    header("Location: ../login.html");
    exit();
}

$mysqli->close();
?>
