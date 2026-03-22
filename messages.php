<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gee-Gees Guide - Messages</title>
    <link rel="stylesheet" href="shared-styles.css">
    <link rel="stylesheet" href="messages.css">
</head>
<body>

<!-- CSS Notes for teammate:
- Inbox can be a sidebar or column
- Chat window can be styled with speech bubbles or boxes
- Messages can have timestamps
-->

<header>
    <h1>The Gee-Gees Guide</h1>
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="backend/tutors.php">Tutors</a></li>
            <li><a href="reddit.html">Campus Discussions</a></li>
            <li><a href="messages.html">Messages</a></li>
        </ul>
    </nav>
</header>

<hr>

<main>

<section class="intro">
    <h2>Messages</h2>
    <p>Communicate with tutors and peers. For now, this page shows a static mockup of the messaging system.</p>
</section>

<section class="chat-window">
    <h2>Inbox</h2>
    <div id="messageList"></div>
</section>

<section class="chat-window">
    <h2>Send a Message</h2>

    <form id="messageForm">
        <input type="number" name="sender" placeholder="Sender ID" required><br><br>
        <input type="number" name="receiver" placeholder="Receiver ID" required><br><br>
        <textarea name="message" placeholder="Type your message..." required></textarea><br><br>
        <button type="submit">Send</button>
    </form>

    <p id="statusMessage"></p>
</section>

</main>

<hr>

<footer>
    <p>© 2026 The Gee-Gees Guide | Student Project</p>
</footer>

<script>
async function loadMessages() {
    const response = await fetch("backend/get_messages.php");
    const data = await response.json();

    const messageList = document.getElementById("messageList");
    messageList.innerHTML = "";

    data.forEach(msg => {
        const div = document.createElement("div");
        div.className = "chat-message";
        div.innerHTML = `
            <strong>User ${msg.sender_id}</strong> → User ${msg.receiver_id}<br>
            ${msg.message_text}<br>
            <small>${msg.timestamp}</small>
        `;
        messageList.appendChild(div);
    });
}

document.getElementById("messageForm").addEventListener("submit", async function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    const response = await fetch("backend/send_message.php", {
        method: "POST",
        body: formData
    });

    const result = await response.text();
    document.getElementById("statusMessage").innerText = result;

    this.reset();
    loadMessages();
});

loadMessages();
</script>

</body>
</html>
