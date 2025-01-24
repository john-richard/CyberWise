// Wait for the DOM to fully load
document.addEventListener('DOMContentLoaded', function () {
    // Add event listener to the search form
    const searchForm = document.getElementById('searchHub');
    if (searchForm) {
      searchForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent default submission
        applySearchFilter();
      });
    }
  
    // Add event listener to the submit button for the createHubForm
    const submitButton = document.getElementById('submitCreateHubForm');
    if (submitButton) {
      submitButton.addEventListener('click', function () {
        addLearningHub();
      });
    }
  });
  
  // Function to apply search filter
  async function applySearchFilter() {
    const filter = document.getElementById('searchFilter').value.trim();
  
    // Prevent submission if the input is empty
    if (!filter) {
      return;
    }
  
    const url = new URL(window.location.href);
    url.searchParams.set('search', filter);
    window.location.href = url.toString();
  }
  
  // Function to handle form submission for createHubForm
  async function addLearningHub() {
    const createHubForm = document.getElementById('createHubForm');
  
    // Check if the form exists
    if (!createHubForm) {
      errorMessage.textContent = 'Form not found.';
      errorMessage.style.display = 'block';
      return;
    }
    
    // Check if the form is valid
    if (createHubForm.checkValidity()) {
        
      const formData = {
        hubCategory: document.getElementById('hubCategory').value,
        hubTitle: document.getElementById('hubTitle').value.trim(),
        hubLink: document.getElementById('hubLink').value.trim(),
        hubContent: document.getElementById('hubContent').value.trim(),
      };

      const errorMessage = document.getElementById('error-message'); // Handle error messages
  
      try {
        const csrfToken = document
          .querySelector('meta[name="csrf-token"]')
          .getAttribute('content');

        // Submit form data via axios
        const response = await axios.post('/api/admin/learning-hub', formData, {
          headers: {
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest',
            'Content-Type': 'application/json'
          },
        });
  
        // Clear error message on success
        if (errorMessage) {
          errorMessage.textContent = ''; // Clear error text
          errorMessage.style.display = 'none'; // Hide error element
        }
        
        // Redirect to the success URL
        window.location.href = response.data.redirect_url;
      } catch (error) {
        const errorData = error.response?.data || {};

        // Handle errors
        if (errorMessage) {
          if (error.response?.status === 401) {
            // Redirect to login page for unauthorized access
            window.location.href = '/login#user-login';
          } else {
            errorMessage.textContent =
              errorData.error || 'An error occurred. Please try again.';
            errorMessage.style.display = 'block';
          }
        }
      }
    } else {
        
      // If the form is invalid, show validation errors
      createHubForm.reportValidity();
      errorMessage.textContent = 'Please fill out all required fields.';
      errorMessage.style.display = 'block';
    }
  }
  