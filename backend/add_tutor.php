<?php
// If someone opens this file directly, send them back to the tutors page.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: tutors.php');
    exit();
}

include 'db_connect.php';

// Read and clean the form values before saving them.
$name = trim($_POST['name'] ?? '');
$program = trim($_POST['program'] ?? '');
$subjects = trim($_POST['subjects'] ?? '');
$email = trim($_POST['email'] ?? '');

// If anything is missing, send the user back to the form with their input.
if ($name === '' || $program === '' || $subjects === '' || $email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $query = http_build_query([
        'status' => 'invalid',
        'name' => $name,
        'program' => $program,
        'subjects' => $subjects,
        'email' => $email,
    ]);

    $mysqli->close();
    header('Location: tutors.php?' . $query);
    exit();
}

// Use a prepared statement so the form values are inserted safely.
$stmt = $mysqli->prepare('INSERT INTO tutors (name, program, subjects, email) VALUES (?, ?, ?, ?)');

if (!$stmt) {
    $mysqli->close();
    header('Location: tutors.php?status=error');
    exit();
}

$stmt->bind_param('ssss', $name, $program, $subjects, $email);

// After saving, go back to the tutors page so the new card can be shown there.
if ($stmt->execute()) {
    $stmt->close();
    $mysqli->close();
    header('Location: tutors.php?status=success');
    exit();
}

$stmt->close();
$mysqli->close();
header('Location: tutors.php?status=error');
exit();
?>
