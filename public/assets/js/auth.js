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
});
