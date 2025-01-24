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
            handleLearningHubFormSubmission();
        });
    }

    // Add event listener to open the modal and prefill data for editing
    document.querySelectorAll('[data-toggle="modal"][data-target="#addNewModal"]').forEach(button => {
        button.addEventListener('click', function () {
            const threadId = this.dataset.threadId; // Extract thread ID (if available)
            const title = this.dataset.title;
            const content = this.dataset.content;
            const link = this.dataset.link;
            const categoryId = this.dataset.categoryId;
    
            // Check if we're editing (threadId exists)
            const isEditMode = !!threadId;
            
            // Clear the form fields
            document.getElementById('hubCategory').value = '';
            document.getElementById('hubTitle').value = '';
            document.getElementById('hubLink').value = '';
            document.getElementById('hubContent').value = '';
    
            // If it's an edit operation, populate the form with existing data
            if (isEditMode) {
                // If editing, set the thread ID on the form
                createHubForm.dataset.threadId = threadId;

                document.getElementById('hubCategory').value = categoryId || '';
                document.getElementById('hubTitle').value = title || '';
                document.getElementById('hubLink').value = link || '';
                document.getElementById('hubContent').value = content || '';
                
                // Change modal title for edit mode
                document.getElementById('addNewModalLabel').textContent = 'Edit Entry';
                document.getElementById('submitCreateHubForm').textContent = 'Update'; // Change button text to "Update"
            } else {
                // If adding a new hub, clear the thread ID and reset form fields
                createHubForm.removeAttribute('data-thread-id');
                createHubForm.reset(); // Clear all form fields

                // It's the "Add New" mode
                document.getElementById('addNewModalLabel').textContent = 'Create New Entry';
                document.getElementById('submitCreateHubForm').textContent = 'Save'; // Set to "Save" for new entry
            }
        });
    });
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
async function handleLearningHubFormSubmission() {
    const createHubForm = document.getElementById('createHubForm');
    const errorMessage = document.getElementById('error-message'); // Handle error messages

    // Check if the form exists
    if (!createHubForm) {
        errorMessage.textContent = 'Form not found.';
        errorMessage.style.display = 'block';
        return;
    }

    // Check if the form is valid
    if (createHubForm.checkValidity()) {
        // Get form data
        const formData = {
            hubCategory: document.getElementById('hubCategory').value,
            hubTitle: document.getElementById('hubTitle').value.trim(),
            hubLink: document.getElementById('hubLink').value.trim(),
            hubContent: document.getElementById('hubContent').value.trim(),
        };

        // Determine if it's an "edit" or "add new" operation
        const threadId = document.getElementById('createHubForm').dataset.threadId; // Use `data-thread-id` to check if editing
        const isEditMode = !!threadId;

        try {
            const csrfToken = document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute('content');

            let response;

            if (isEditMode) {
                // Send PUT request for editing
                response = await axios.put(`/api/admin/learning-hub/${threadId}`, formData, {
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/json',
                    },
                });
            } else {
                // Send POST request for adding new entry
                response = await axios.post('/api/admin/learning-hub', formData, {
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/json',
                    },
                });
            }

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


// async function populateEditModal(threadId) {
//     try {
//         // Iterate over all modal trigger buttons
//         document.querySelectorAll('[data-toggle="modal"][data-target="#editModal"]').forEach(button => {
//             button.addEventListener('click', function () {
//                 // Retrieve data-* attributes
//                 const threadId = this.dataset.threadId;
//                 const title = this.dataset.title;
//                 const content = this.dataset.content;
//                 const link = this.dataset.link;
//                 const categoryId = this.dataset.categoryId;

//                 // Log to check the values
//                 console.log('Thread ID:', threadId);
//                 console.log('Title:', title);
//                 console.log('Content:', content);
//                 console.log('Link:', link);
//                 console.log('Category ID:', categoryId);

//                 // Populate the modal fields with these values
//                 document.getElementById('hubCategory').value = categoryId || '';
//                 document.getElementById('hubTitle').value = title || '';
//                 document.getElementById('hubLink').value = link || '';
//                 document.getElementById('hubContent').value = content || '';

//                 // Update modal title and action
//                 document.getElementById('addNewModalLabel').textContent = 'Edit Entry';
//             });
//         });
//     } catch (error) {
//         console.error('Error populating modal:', error);
//     }
// }

