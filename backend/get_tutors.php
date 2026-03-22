<?php
include 'db_connect.php';

// Get every tutor so the page can show the full list.
$sql = 'SELECT * FROM tutors ORDER BY tutor_id DESC';
$result = $mysqli->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Print each tutor as one card so tutors.php can drop it into the page.
        echo '<article class="tutor-card">';
        echo '<h3>' . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . '</h3>';
        echo '<p>Program: ' . htmlspecialchars($row['program'], ENT_QUOTES, 'UTF-8') . '</p>';
        echo '<p>Subjects: ' . htmlspecialchars($row['subjects'], ENT_QUOTES, 'UTF-8') . '</p>';
        echo '<p>Email: ' . htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8') . '</p>';
        echo '</article>';
    }
} else {
    echo '<p class="empty-state">No tutors found.</p>';
}

if ($result) {
    $result->close();
}

$mysqli->close();
?>
