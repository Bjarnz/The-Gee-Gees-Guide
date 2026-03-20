<?php
session_start();
include 'backend/db_connect.php';

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
            // Automatically log them in
            $_SESSION['username'] = $username;
            $message = "Account created! You are now logged in.";
        } else {
            $message = "Error: " . $mysqli->error;
        }
    }
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - The Gee-Gees Guide</title>
</head>
<body>

<h1>Create Account</h1>

<form method="POST">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <input type="submit" value="Register">
</form>
   
<p><?php echo $message; ?></p>

</body>
</html>
