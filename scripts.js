// Assuming the existing login functionality is already handled in this file

// Add event listener to the registration form
document.querySelector("form").addEventListener("submit", function (event) {
    // Check if the current page is the register page by checking form action
    const formAction = event.target.action;

    if (formAction.includes('register-process.php')) {
        // Get form fields for registration
        const username = document.getElementById("username").value.trim();
        const password = document.getElementById("password").value.trim();
        const confirmPassword = document.getElementById("confirm-password").value.trim();

        // Basic validation: check if all fields are filled
        if (!username || !password || !confirmPassword) {
            alert("Please fill out all fields.");
            event.preventDefault(); // Prevent form submission
        }

        // Passwords must match
        if (password !== confirmPassword) {
            alert("Passwords do not match.");
            event.preventDefault(); // Prevent form submission
        }
    }
});
