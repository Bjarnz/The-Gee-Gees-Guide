<?php
include 'db_connect.php';

// Read the search word and use it in the name, program, and subject columns.
$search = trim($_GET['q'] ?? '');
$like_search = '%' . $search . '%';

$stmt = $mysqli->prepare(
    'SELECT tutor_id, name, program, subjects, email
     FROM tutors
     WHERE name LIKE ? OR program LIKE ? OR subjects LIKE ?
     ORDER BY tutor_id DESC'
);

// If the query is ready, connect the search word to all three LIKE checks.
if ($stmt) {
    $stmt->bind_param('sss', $like_search, $like_search, $like_search);
    $stmt->execute();
    $stmt->bind_result($tutor_id, $name, $program, $subjects, $email);
    $has_results = false;
} else {
    $has_results = false;
}

if ($stmt) {
    while ($stmt->fetch()) {
        $has_results = true;
        // Print only the tutors that match the search word.
        echo '<article class="tutor-card">';
        echo '<h3>' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . '</h3>';
        echo '<p>Program: ' . htmlspecialchars($program, ENT_QUOTES, 'UTF-8') . '</p>';
        echo '<p>Subjects: ' . htmlspecialchars($subjects, ENT_QUOTES, 'UTF-8') . '</p>';
        echo '<p>Email: ' . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . '</p>';
        echo '</article>';
    }
}

if (!$has_results) {
    echo '<p class="empty-state">No tutors found for "' . htmlspecialchars($search, ENT_QUOTES, 'UTF-8') . '".</p>';
}

if ($stmt) {
    $stmt->close();
}

$mysqli->close();
?>
