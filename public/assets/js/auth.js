document.addEventListener('DOMContentLoaded', function () {
    // Add Axios interceptor to handle 419 errors globally
    axios.interceptors.response.use(
        response => response,
        error => {
            if (error.response?.status === 419) {
                alert('Session expired. Please log in again.');
                localStorage.removeItem('authToken');
                localStorage.removeItem('user');
                window.location.href = '/login';
            }
            return Promise.reject(error);
        }
    );

    const form = document.getElementById('loginForm');
    const errorMessage = document.getElementById('error-message');
    const greeting = document.getElementById('greeting');  // Element to show the username
    const joinCommunityBtn = document.getElementById('joinCommunityBtn'); // The element to be removed

    form.addEventListener('submit', async function (event) {
        event.preventDefault();

        const formData = new FormData(form);

        try {
            // Retrieve the CSRF cookie before making the login request
            await axios.get('/sanctum/csrf-cookie');

            // Make the login request
            const response = await axios.post('/api/login', {
                username: formData.get('username'),
                password: formData.get('password'),
            });

            // Clear the error message and hide it on successful login
            errorMessage.textContent = ''; // Clear error text
            errorMessage.style.display = 'none'; // Hide error message

            // Save the token to local storage
            localStorage.setItem('authToken', response.data.token);

            // Save the user info to local storage
            localStorage.setItem('user', JSON.stringify(response.data.user));

            // Update the greeting with the username (if it's available on the same page)
            if (greeting) {
                greeting.textContent = `Hi, ${response.data.user.username}`;  // Display user's username
            }

            // Remove the "Join our community" button
            if (joinCommunityBtn) {
                joinCommunityBtn.remove();  // Remove the element
            }

            // Redirect to the appropriate page
            window.location.href = response.data.redirect_url;
        } catch (error) {
            // Display a custom error message if credentials are invalid
            const errorText = error.response?.data?.error || 'Your username or password is invalid.';
            errorMessage.textContent = errorText;
            errorMessage.style.display = 'block'; // Show error message
        }
    });

    // Add event listener for password reset
    const resetButton = document.getElementById('sendResetLink');
    if (resetButton) {
        resetButton.addEventListener('click', function () {
            handleForgotPassword();
        });
    }
});

// Function to handle forgot password submission
async function handleForgotPassword() {
    const resetEmail = document.getElementById('resetEmail').value;
    const resetMessage = document.getElementById('resetMessage');
    const resetUrl = document.querySelector('meta[name="reset-password-url"]').getAttribute('content'); // ✅ Get URL from meta tag
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    if (!resetEmail) {
        resetMessage.innerHTML = '<div class="alert alert-danger">Please enter your email.</div>';
        resetMessage.style.display = 'block';
        return;
    }

    try {
        const response = await fetch(resetUrl, {  // ✅ Use dynamic URL
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
                "X-Requested-With": "XMLHttpRequest",
            },
            body: JSON.stringify({ email: resetEmail }),
        });

        const data = await response.json();

        if (response.ok) {
            resetMessage.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
        } else {
            resetMessage.innerHTML = `<div class="alert alert-danger">${data.message || 'Error sending email.'}</div>`;
        }
        resetMessage.style.display = 'block';

    } catch (error) {
        resetMessage.innerHTML = `<div class="alert alert-danger">An error occurred. Please try again.</div>`;
        resetMessage.style.display = 'block';
    }
}
