document.addEventListener('DOMContentLoaded', () => {
    // Sign-Up Form Validation
    const signUpForm = document.getElementById('sign-up-form');

    signUpForm.addEventListener('submit', (e) => {
        e.preventDefault(); // Prevent the default form submission

        const fnameInput = document.getElementById('firstName-input-sign-up').value.trim();
        const lnameInput = document.getElementById('lastName-input-sign-up').value.trim();
        const emailInput = document.getElementById('email-input-sign-up').value.trim();
        const passwordInput = document.getElementById('password-input-sign-up').value.trim();

        const fnameError = document.getElementById('fname-error');
        const lnameError = document.getElementById('lname-error');
        const emailError = document.getElementById('email-error');
        const passwordError = document.getElementById('password-error');

        const nameRegex = /^[a-zA-Z]+(?:[' -][a-zA-Z]+)*$/;
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

        let isValid = true;

        // Reset error messages
        fnameError.textContent = '';
        lnameError.textContent = '';
        emailError.textContent = '';
        passwordError.textContent = '';

        // Validate First Name
        if (!nameRegex.test(fnameInput)) {
            fnameError.textContent = "Please enter a valid first name.";
            isValid = false;
        }

        // Validate Last Name
        if (!nameRegex.test(lnameInput)) {
            lnameError.textContent = "Please enter a valid last name.";
            isValid = false;
        }

        // Validate Email
        if (!emailRegex.test(emailInput)) {
            emailError.textContent = "Please enter a valid email address.";
            isValid = false;
        }

        // Validate Password
        if (!passwordRegex.test(passwordInput)) {
            passwordError.textContent = "Password must be at least 8 characters long, including an uppercase letter, a lowercase letter, a number, and a special character.";
            isValid = false;
        }

        // If all inputs are valid, submit the form
        if (isValid) {
            signUpForm.submit();
        }
    });

    // Login Form Validation
    const loginForm = document.getElementById('login-form');

    loginForm.addEventListener('submit', (e) => {
        e.preventDefault(); // Prevent the default form submission

        const emailInput = document.getElementById('email-input-login').value.trim();
        const passwordInput = document.getElementById('password-input-login').value.trim();

        const emailError = document.getElementById('email_error');
        const passwordError = document.getElementById('password_error');

        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

        let isValid = true;

        // Reset error messages
        emailError.textContent = '';
        passwordError.textContent = '';

        // Validate Email
        if (!emailRegex.test(emailInput)) {
            emailError.textContent = "Please enter a valid email address.";
            isValid = false;
        }

        // Validate Password
        if (!passwordRegex.test(passwordInput)) {
            passwordError.textContent = "Password must be at least 8 characters long, including an uppercase letter, a lowercase letter, a number, and a special character.";
            isValid = false;
        }

        // If all inputs are valid, submit the form
        if (isValid) {
            loginForm.submit();
        }
    });
});
 
 
function togglePasswordVisibility(inputId, icon) {
    const passwordInput = document.getElementById(inputId);
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);

    // Toggle the icon class between fa-eye and fa-eye-slash
    const iconElement = icon.querySelector('i');
    if (type === 'password') {
        iconElement.classList.remove('fa-eye-slash');
        iconElement.classList.add('fa-eye');
    } else {
        iconElement.classList.remove('fa-eye');
        iconElement.classList.add('fa-eye-slash');
    }
}
