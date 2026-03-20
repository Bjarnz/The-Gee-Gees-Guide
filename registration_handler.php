<?php

$db_host = '127.0.0.1';
$db_user = 'root';
$db_db = 'users'; // WAMPP, XAMPP
$db_password = 'root';
$db_port = '8889';
$mysqli = new mysqli($db_host, $db_user, $db_password, $db_db, $db_port);

if ($mysqli->connect_error) {
    echo 'Errno: ' . $mysqli->connect_errno;
    echo '<br>';
    echo 'Error: ' . $mysqli->connect_error;
    exit();
}

//echo 'Success: A proper connection to MySQL was made.';
//echo '<br>';
//echo 'Host information: ' . $mysqli->host_info;
//echo '<br>';
//echo 'Protocol version: ' . $mysqli->protocol_version;
#$mysqli->close();



$username = $_REQUEST['username'];
$sql = "SELECT * FROM account WHERE username LIKE '$username'";

$results = $mysqli->query($sql);
    if (!$results) { die("Query failed: " . $mysqli->error); }
        if ($results->num_rows > 0) {
// echo "BAD: already exists!";
            header("Location: registration.php?error=exists");
        } else {
            echo "GOOD: all good!";
            $password = $_REQUEST ['password'];
            $fname = $_REQUEST ['fname'];
            $lname = $_REQUEST ['lname'];
            $sql = "INSERT INTO account (username, password, first_name, last_name) VALUES ('$username', '$password', '$fname', '$lname')";
            $mysqli->query($sql);
            echo 'New user added!';
        }


?>

