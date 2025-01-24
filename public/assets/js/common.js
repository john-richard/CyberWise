document.addEventListener('DOMContentLoaded', function () {

    const token = localStorage.getItem('authToken');
  
    if (token) {
      const user = JSON.parse(localStorage.getItem('user'));
      if (user) {
        // Add Logout button logic
        document.querySelectorAll('.logoutBtn').forEach((button) => {
          button.addEventListener('click', async function (event) {
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
        });
      }
    }
  });
  