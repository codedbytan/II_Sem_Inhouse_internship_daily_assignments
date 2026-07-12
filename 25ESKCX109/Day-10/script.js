// Day 10 - Client-side form validation with JavaScript

const form = document.getElementById("registrationForm");

// Helper: show an error message under a field and mark it red
function showError(fieldId, errorId, message) {
    document.getElementById(fieldId).classList.add("invalid");
    document.getElementById(errorId).textContent = message;
}

// Helper: clear a field's error state
function clearError(fieldId, errorId) {
    document.getElementById(fieldId).classList.remove("invalid");
    document.getElementById(errorId).textContent = "";
}

form.addEventListener("submit", function (event) {
    event.preventDefault(); // stop the page from reloading so we can validate first

    let isValid = true;

    // Read and trim all values
    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const roll = document.getElementById("roll").value.trim();
    const mobile = document.getElementById("mobile").value.trim();
    const branch = document.getElementById("branch").value;
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirmPassword").value;

    // Full Name: required, letters and spaces only
    if (name === "") {
        showError("name", "nameError", "Full name is required");
        isValid = false;
    } else if (!/^[A-Za-z ]+$/.test(name)) {
        showError("name", "nameError", "Name can contain letters and spaces only");
        isValid = false;
    } else {
        clearError("name", "nameError");
    }

    // Email: required and valid format
    if (email === "") {
        showError("email", "emailError", "Email is required");
        isValid = false;
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        showError("email", "emailError", "Enter a valid email address");
        isValid = false;
    } else {
        clearError("email", "emailError");
    }

    // Roll Number: required
    if (roll === "") {
        showError("roll", "rollError", "Roll number is required");
        isValid = false;
    } else {
        clearError("roll", "rollError");
    }

    // Mobile: exactly 10 digits
    if (!/^[0-9]{10}$/.test(mobile)) {
        showError("mobile", "mobileError", "Enter a valid 10-digit mobile number");
        isValid = false;
    } else {
        clearError("mobile", "mobileError");
    }

    // Branch: must be selected
    if (branch === "") {
        showError("branch", "branchError", "Please select a branch");
        isValid = false;
    } else {
        clearError("branch", "branchError");
    }

    // Password: at least 6 characters
    if (password.length < 6) {
        showError("password", "passwordError", "Password must be at least 6 characters");
        isValid = false;
    } else {
        clearError("password", "passwordError");
    }

    // Confirm Password: must match
    if (confirmPassword !== password || confirmPassword === "") {
        showError("confirmPassword", "confirmError", "Passwords do not match");
        isValid = false;
    } else {
        clearError("confirmPassword", "confirmError");
    }

    // Only if everything passed
    if (isValid) {
        document.getElementById("successMsg").textContent =
            "Registration successful, " + name + "!";
        form.reset();
    }
});
