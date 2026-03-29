document.getElementById("registerForm").addEventListener("submit", function(e) {
    const usernameInput = document.getElementById("username");
    const emailInput = document.getElementById("email");
    const passwordInput = document.getElementById("password");
    const errorMsg = document.getElementById("errorMsg");

    const username = usernameInput.value.trim();
    const email = emailInput.value.trim();
    const password = passwordInput.value.trim();

    // Reset styles/messages
    errorMsg.textContent = "";
    errorMsg.style.color = "red";
    usernameInput.style.border = "";
    emailInput.style.border = "";
    passwordInput.style.border = "";

    // Empty check
    if (username === "" || email === "" || password === "") {
        e.preventDefault();
        errorMsg.textContent = "All fields are required.";

        if (username === "") usernameInput.style.border = "2px solid red";
        if (email === "") emailInput.style.border = "2px solid red";
        if (password === "") passwordInput.style.border = "2px solid red";
        return;
    }

    // Email validation
    if (!email.includes("@") || !email.includes(".")) {
        e.preventDefault();
        errorMsg.textContent = "Please enter a valid email address.";
        emailInput.style.border = "2px solid red";
        return;
    }

    // Password length
    if (password.length < 6) {
        e.preventDefault();
        errorMsg.textContent = "Password must be at least 6 characters.";
        passwordInput.style.border = "2px solid red";
        return;
    }

    // Success
    errorMsg.style.color = "green";
    errorMsg.textContent = "Account created successfully!";
});
