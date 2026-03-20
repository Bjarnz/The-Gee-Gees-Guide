<?php

session_start();

if (isset($_SESSION['ID'])) {
$id = $_SESSION['ID'];
$sql = 'SELECT * FROM adm WHERE ID = $id';

$results = $mysqli->query($sql);
if (!results) { die("Query failed:". $mysqli->error); }

$results = mysqli_fetch_assoc($results);

$name = $results['first_name'];
echo 'hello, $name';
} else {
    header('location: login.php');
}

