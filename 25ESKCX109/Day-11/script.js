// Day 11 - Registration Confirmation System
// Flow: fill form -> validate -> review details -> confirm -> success

const form = document.getElementById("registrationForm");
const confirmPanel = document.getElementById("confirmPanel");
const finalMsg = document.getElementById("finalMsg");

function showError(fieldId, errorId, message) {
    document.getElementById(fieldId).classList.add("invalid");
    document.getElementById(errorId).textContent = message;
}

function clearError(fieldId, errorId) {
    document.getElementById(fieldId).classList.remove("invalid");
    document.getElementById(errorId).textContent = "";
}

// Validate the form; return the collected data object if valid, otherwise null
function validateForm() {
    let isValid = true;

    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const roll = document.getElementById("roll").value.trim();
    const mobile = document.getElementById("mobile").value.trim();
    const branch = document.getElementById("branch").value;

    if (name === "" || !/^[A-Za-z ]+$/.test(name)) {
        showError("name", "nameError", "Enter a valid name (letters only)");
        isValid = false;
    } else {
        clearError("name", "nameError");
    }

    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        showError("email", "emailError", "Enter a valid email address");
        isValid = false;
    } else {
        clearError("email", "emailError");
    }

    if (roll === "") {
        showError("roll", "rollError", "Roll number is required");
        isValid = false;
    } else {
        clearError("roll", "rollError");
    }

    if (!/^[0-9]{10}$/.test(mobile)) {
        showError("mobile", "mobileError", "Enter a valid 10-digit mobile number");
        isValid = false;
    } else {
        clearError("mobile", "mobileError");
    }

    if (branch === "") {
        showError("branch", "branchError", "Please select a branch");
        isValid = false;
    } else {
        clearError("branch", "branchError");
    }

    if (!isValid) {
        return null;
    }

    return { name, email, roll, mobile, branch };
}

// STEP 1 -> STEP 2 : validate then show the confirmation panel
form.addEventListener("submit", function (event) {
    event.preventDefault();

    const data = validateForm();
    if (data === null) {
        return; // stay on the form until it is valid
    }

    // Fill the confirmation table
    document.getElementById("c_name").textContent = data.name;
    document.getElementById("c_email").textContent = data.email;
    document.getElementById("c_roll").textContent = data.roll;
    document.getElementById("c_mobile").textContent = data.mobile;
    document.getElementById("c_branch").textContent = data.branch;

    // Swap views
    form.classList.add("hidden");
    confirmPanel.classList.remove("hidden");
});

// STEP 2 -> back to STEP 1 : Edit button
document.getElementById("editBtn").addEventListener("click", function () {
    confirmPanel.classList.add("hidden");
    form.classList.remove("hidden");
});

// STEP 2 -> STEP 3 : Confirm button
document.getElementById("confirmBtn").addEventListener("click", function () {
    const name = document.getElementById("c_name").textContent;

    confirmPanel.classList.add("hidden");
    finalMsg.classList.remove("hidden");
    document.getElementById("finalText").textContent =
        "Thank you " + name + ", your registration has been recorded successfully.";
});
