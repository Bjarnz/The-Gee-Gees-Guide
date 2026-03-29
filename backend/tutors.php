<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../login.html");
    exit();
}
// Read the page message and search text from the URL.
$status = $_GET['status'] ?? '';
$search = trim($_GET['q'] ?? '');

// If the form submission had an error, keep what the user typed.
$form_values = [
    'name' => trim($_GET['name'] ?? ''),
    'program' => trim($_GET['program'] ?? ''),
    'subjects' => trim($_GET['subjects'] ?? ''),
    'email' => trim($_GET['email'] ?? ''),
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gee-Gees Guide - Tutors</title>
    <link rel="stylesheet" href="../shared-styles.css">
    <link rel="stylesheet" href="../tutors.css">
</head>
<body>

<header>
    <h1>The Gee-Gees Guide</h1>
    <nav>
        <ul>
            <li><a href="../index.html">Home</a></li>
            <li><a href="tutors.php">Tutors</a></li>
            <li><a href="../messages.php">Messages</a></li>
        </ul>
    </nav>
    <button id="darkModeToggle">Dark Mode</button>
</header>

<hr>

<main>

<section class="intro">
    <h2>Find or Become a Tutor</h2>
    <p>Browse registered tutors or add your own tutor profile for other students to find.</p>
</section>

<section class="tutor-search">
    <h2>Search Tutors</h2>
    <!-- This form reloads the page and sends the search word in the URL. -->
    <form id="tutor-search-form" method="GET" action="tutors.php">
        <label for="q">Search by name, program, or subject:</label><br>
        <input type="text" id="q" name="q" value="<?php echo htmlspecialchars($search, ENT_QUOTES, 'UTF-8'); ?>"><br><br>
        <input type="submit" value="Search">
        <a class="clear-link" href="tutors.php">Clear</a>
    </form>
    <p id="search-help" class="helper-text">You can filter the current tutor cards as you type, or use Search to reload the page results.</p>
</section>

<section class="tutor-profiles">
    <h2>Available Tutors</h2>
    <p id="tutor-count" class="helper-text">Showing available tutors.</p>
    <div id="client-empty-state" class="empty-state hidden">No tutor cards match what you typed.</div>

<?php
// If the user typed a search, show matching tutors. Otherwise show the full list.
if ($search !== '') {
    include __DIR__ . '/search_tutors.php';
} else {
    include __DIR__ . '/get_tutors.php';
}
?>
</section>

<section class="register-tutor">
    <h2>Register as a Tutor</h2>

<?php // Show a message after the form sends the user back to this page. ?>
<?php if ($status === 'success'): ?>
    <p class="status-message">Tutor added successfully.</p>
<?php elseif ($status === 'invalid'): ?>
    <div class="error-message">
        <p>Please complete all fields with a valid email address.</p>
    </div>
<?php elseif ($status === 'error'): ?>
    <div class="error-message">
        <p>There was a problem saving the tutor. Please try again.</p>
    </div>
    <?php endif; ?>

    <!-- This form sends the tutor data to the backend PHP file for saving. -->
    <form id="register-tutor-form" method="POST" action="add_tutor.php" novalidate>
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($form_values['name'], ENT_QUOTES, 'UTF-8'); ?>" required><br><br>
        <p id="name-feedback" class="field-feedback" aria-live="polite"></p>

        <label for="program">Program:</label><br>
        <input type="text" id="program" name="program" value="<?php echo htmlspecialchars($form_values['program'], ENT_QUOTES, 'UTF-8'); ?>" required><br><br>
        <p id="program-feedback" class="field-feedback" aria-live="polite"></p>

        <label for="subjects">Subjects:</label><br>
        <input type="text" id="subjects" name="subjects" value="<?php echo htmlspecialchars($form_values['subjects'], ENT_QUOTES, 'UTF-8'); ?>" required><br><br>
        <p id="subjects-feedback" class="field-feedback" aria-live="polite"></p>
        <p id="subjects-count" class="helper-text">0 characters typed.</p>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($form_values['email'], ENT_QUOTES, 'UTF-8'); ?>" required><br><br>
        <p id="email-feedback" class="field-feedback" aria-live="polite"></p>

        <input type="submit" id="register-submit" value="Register">
    </form>
</section>

</main>

<hr>

<footer>
    <p>© 2026 The Gee-Gees Guide | Student Project</p>
</footer>

<script src="../tutors.js"></script>
<script src="../darkmode.js"></script>
</body>
</html>
