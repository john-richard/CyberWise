document.addEventListener('DOMContentLoaded', function () {
  const greeting = document.getElementById('greeting');  // Element to show the username
  const joinCommunityBtn = document.getElementById('joinCommunityBtn');  // The element to be removed
  const navmenu = document.getElementById('navmenu');
  const logoutLink = document.createElement('a');

  // Check if there's a valid auth token in local storage
  const token = localStorage.getItem('authToken');
  
  if (token) {
    // Get the user data from localStorage
    const user = JSON.parse(localStorage.getItem('user'));

    if (user && greeting) {
        const logoutLinkHTML = `<a href="#logout" id="logoutBtn">Logout</a>`;
        greeting.innerHTML = `Hi, ${user.username} | ${logoutLinkHTML}`;
        greeting.style.display = 'block'; // Make sure greeting is displayed


        // Add event listener for Logout
        const logoutBtn = document.getElementById('logoutBtn');
        if (logoutBtn) {
            logoutBtn.addEventListener('click', async function (event) {
                event.preventDefault();

                try {
                    // Call the logout API (assuming a POST method)
                    const response = await axios.post('/api/logout', {}, {
                        headers: {
                            'Authorization': `Bearer ${localStorage.getItem('authToken')}`
                        }
                    });

                    // Clear local storage (remove the token and user)
                    localStorage.removeItem('authToken');
                    localStorage.removeItem('user');

                    // Redirect to home page after logout
                    window.location.href = '/';

                } catch (error) {
                    console.error('Logout failed:', error);
                }
            });
        }
    }

    // Remove the "Join our community" button if the user is logged in
    if (joinCommunityBtn) {
        joinCommunityBtn.remove();
    }
  } else {
    // If no token is found, show the "Join our community" button
    if (joinCommunityBtn) {
        joinCommunityBtn.style.display = 'block';
    }
  }
});
