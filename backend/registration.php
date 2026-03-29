<?php
session_start();
// This file is also inside backend/, so it should include the DB file from the same folder.
include 'db_connect.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if user already exists
    $check = "SELECT * FROM users WHERE username='$username'";
    $result = $mysqli->query($check);

    if ($result->num_rows > 0) {
        $message = "Username already exists.";
    } else {
        // Insert new user
        $sql = "INSERT INTO users (username, email, password)
                VALUES ('$username', '$email', '$password')";

        if ($mysqli->query($sql)) {
            // Automatically log them in after creating the account.
            $_SESSION['username'] = $username;
            header("Location: ../index.html");
            exit();
        } else {
            $message = "Error: " . $mysqli->error;
        }
    }
} else {
    // Direct visits to the PHP handler should go back to the registration form.
    header("Location: ../registration.html");
    exit();
}

$mysqli->close();

echo $message;
?>
