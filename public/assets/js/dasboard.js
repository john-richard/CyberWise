document.addEventListener('DOMContentLoaded', function () {
    const greeting = document.getElementById('greeting');
    const joinCommunityBtn = document.getElementById('joinCommunityBtn');
    const token = localStorage.getItem('authToken');
  
    if (token) {
      const user = JSON.parse(localStorage.getItem('user'));
      if (user && greeting) {
        const logoutLinkHTML = `<a href="#logout" id="logoutBtn">Logout</a>`;
        greeting.innerHTML = `Hi, ${user.username} | ${logoutLinkHTML}`;
        greeting.style.display = 'block';
  
        // Add Logout button logic
        document.getElementById('logoutBtn')?.addEventListener('click', async function (event) {
          event.preventDefault();
          try {
            const response = await axios.post('/api/logout', {}, {
              headers: { 'Authorization': `Bearer ${localStorage.getItem('authToken')}` }
            });
  
            localStorage.removeItem('authToken');
            localStorage.removeItem('user');
            window.location.href = '/';
          } catch (error) {
            if (error.response?.status === 401) {
              alert('Session expired. Please log in again.');
              localStorage.removeItem('authToken');
              localStorage.removeItem('user');
              window.location.href = '/login';
            } else {
              console.error('Logout failed:', error);
              alert('Logout failed. Please try again.');
            }
          }
        });
      }
  
      // Hide the login button if token exists
      if (joinCommunityBtn) {
        joinCommunityBtn.style.display = 'none';
      }
    } else {
      // No token: Show the login button and hide the greeting
      if (joinCommunityBtn) {
        joinCommunityBtn.style.display = 'block';
      }
      if (greeting) {
        greeting.style.display = 'none';
      }
    }
  });
  