/* DARK MODE TOGGLE WITH PERSISTENCE */

// Get the toggle button
const toggle = document.getElementById("darkModeToggle");

// Function to enable dark mode
function enableDarkMode() {
    document.body.classList.add("dark-mode");
    localStorage.setItem("theme", "dark");
}

// Function to disable dark mode
function disableDarkMode() {
    document.body.classList.remove("dark-mode");
    localStorage.setItem("theme", "light");
}

// Load saved theme on page load
if (localStorage.getItem("theme") === "dark") {
    enableDarkMode();
}

// Add click listener to toggle button
toggle.addEventListener("click", function() {
    if (document.body.classList.contains("dark-mode")) {
        disableDarkMode();
    } else {
        enableDarkMode();
    }
});
