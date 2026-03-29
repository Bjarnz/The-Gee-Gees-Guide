document.getElementById("loginForm").addEventListener("submit", function(e) {
    const usernameInput = document.getElementById("username");
    const passwordInput = document.getElementById("password");
    const errorMsg = document.getElementById("errorMsg");

    const username = usernameInput.value.trim();
    const password = passwordInput.value.trim();

    // Reset styles/messages
    errorMsg.textContent = "";
    errorMsg.style.color = "red";
    usernameInput.style.border = "";
    passwordInput.style.border = "";

    // Check if fields are empty
    if (username === "" || password === "") {
        e.preventDefault();
        errorMsg.textContent = "All fields are required.";

        if (username === "") {
            usernameInput.style.border = "2px solid red";
        }
        if (password === "") {
            passwordInput.style.border = "2px solid red";
        }
        return;
    }

    // Check password length
    if (password.length < 6) {
        e.preventDefault();
        errorMsg.textContent = "Password must be at least 6 characters.";
        passwordInput.style.border = "2px solid red";
        return;
    }

    // Success message
    errorMsg.style.color = "green";
    errorMsg.textContent = "Logging in...";
});
