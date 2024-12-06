document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('registerForm');
    const errorMessage = document.getElementById('error-message');
    const greeting = document.getElementById('greeting');  // Element to show the username
    const joinCommunityBtn = document.getElementById('joinCommunityBtn'); // The element to be removed

    form.addEventListener('submit', async function (event) {
        event.preventDefault();

        const formData = new FormData(form);

        try {
            const response = await axios.post('/api/register', {
                username: formData.get('username'),
                email: formData.get('email'),
                password: formData.get('password'),
            });

            // Clear the error message and hide it on successful registration
            errorMessage.textContent = ''; // Clear error text
            errorMessage.style.display = 'none'; // Hide error message

alert(response.data.token);

            // Save the token to local storage
            localStorage.setItem('authToken', response.data.token);

            alert(response.data.user.username);

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
            errorMessage.textContent = error.response?.data?.error || 'An error occurred.';
            errorMessage.style.display = 'block';
        }
    });
});
