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

$username = $_REQUEST ["username"];
$password = $_REQUEST ["password"];

$sql = "SELECT * FROM account WHERE username LIKE '$username' AND password LIKE '$password'";

$results = $mysqli->query($sql);
if (!$results) { die("Query failed:". $mysqli->error); }

if ($results->num_rows > 0) {
# correct!
    echo "succesfully logged in!";
    session_start();
    $result = mysqli_fetch_assoc($results);
    # var_dump($results);
    $id = $result["ID"];
    $_SESSION['ID'] = $result['ID'];
} else {
# incorrect
    #echo "error while logging in";
    header("Location: login.php?error=wrong_cred");
}
?>


