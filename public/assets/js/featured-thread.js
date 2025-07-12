// Wait for the DOM to fully load
document.addEventListener('DOMContentLoaded', function () {

    // Add event listener to the submit button for the createfeaturedForm
    const submitButton = document.getElementById('submitCreatefeaturedForm');
    if (submitButton) {
        submitButton.addEventListener('click', function () {
            handleFeaturedFormSubmission();
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
    
            const createFeaturedForm = document.getElementById('createFeaturedForm');
    
            // Ensure form exists
            if (!createFeaturedForm) {
                console.error('Form not found');
                return;
            }
    
            // Check if editing (threadId exists)
            const isEditMode = !!threadId;
    
            if (isEditMode) {
                // Assign thread ID to dataset
                createFeaturedForm.dataset.threadId = threadId;
    
                // Populate form fields with existing data
                document.getElementById('featuredCategory').value = categoryId || '';
                document.getElementById('featuredTitle').value = title || '';
                document.getElementById('featuredLink').value = link || '';
                document.getElementById('featuredContent').value = content || '';
    
                // Change modal UI to indicate edit mode
                document.getElementById('addNewModalLabel').textContent = 'Edit Entry';
                document.getElementById('submitCreatefeaturedForm').textContent = 'Update';
            } else {
                // If adding a new entry, reset the form and remove thread ID
                createFeaturedForm.removeAttribute('data-thread-id');
                createFeaturedForm.reset();
                // Update modal UI for new entry
                document.getElementById('addNewModalLabel').textContent = 'Create New Entry';
                document.getElementById('submitCreatefeaturedForm').textContent = 'Save';
            }

            // Set default category if available
            const categorySelect = document.getElementById('featuredCategory');
            if (categorySelect && categorySelect.options.length > 0) {
                categorySelect.selectedIndex = 0;
            }

        });
    });
    
    
    

    // Open Delete Modal and set thread ID
    document.querySelectorAll('[data-toggle="modal"][data-target="#deleteModal"]').forEach(button => {
        button.addEventListener('click', function () {
            // Extract thread ID from the clicked button
            const threadId = this.dataset.threadId;
    
            // Get the delete button inside the modal
            const deleteButton = document.getElementById('confirmDelete');
    
            if (deleteButton) {
                deleteButton.dataset.threadId = threadId; // Set the thread ID
            } else {
                console.error("Delete button (#confirmDelete) not found.");
            }
        });
    });

    // Handle Delete Request
    const deleteButton = document.getElementById('confirmDelete');
    
    if (deleteButton) {
        deleteButton.addEventListener('click', async function () {
            const threadId = this.dataset.threadId; // Retrieve thread ID from button

            if (!threadId) {
                alert('Thread ID is missing.');
                return;
            }

            try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                // Send DELETE request
                const response = await axios.delete(`/api/admin/featured-thread/${threadId}`, {
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/json',
                    },
                });

                // Close the modal and reload the page or update the UI
                $('#deleteModal').modal('hide');
                window.location.reload(); // Optionally reload the page
            } catch (error) {
                console.error('Error deleting the entry:', error);
                alert('Failed to delete the entry. Please try again.');
            }
        });
    } else {
        console.error("Delete button (#confirmDelete) not found at the time of script execution.");
    }
});

// Function to handle form submission for createfeaturedForm
async function handleFeaturedFormSubmission() {
    const createFeaturedForm = document.getElementById('createFeaturedForm');
    const errorMessage = document.getElementById('error-message');

    if (!createFeaturedForm) {
        errorMessage.textContent = 'Form not found.';
        errorMessage.style.display = 'block';
        return;
    }

    if (createFeaturedForm.checkValidity()) {
        // Get form data
        const formData = {
            featuredCategory: document.getElementById('featuredCategory').value,
            featuredTitle: document.getElementById('featuredTitle').value.trim(),
            featuredLink: document.getElementById('featuredLink').value.trim(),
            featuredContent: document.getElementById('featuredContent').value.trim(),
        };

        // Get `threadId` from dataset (checking for edits)
        const threadId = createFeaturedForm.dataset.threadId || null;
        const isEditMode = !!threadId;

        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            let response;

            if (isEditMode) {
                response = await axios.put(`/api/admin/featured-thread/${threadId}`, formData, {
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/json',
                    },
                });
            } else {
                response = await axios.post('/api/admin/featured-thread', formData, {
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/json',
                    },
                });
            }

            // Hide error message on success
            if (errorMessage) {
                errorMessage.textContent = '';
                errorMessage.style.display = 'none';
            }

            // Redirect on success
            window.location.href = response.data.redirect_url;
        } catch (error) {
            const errorData = error.response?.data || {};
            if (errorMessage) {
                if (error.response?.status === 401) {
                    window.location.href = '/login#user-login';
                } else {
                    errorMessage.textContent = errorData.error || 'An error occurred. Please try again.';
                    errorMessage.style.display = 'block';
                }
            }
        }
    } else {
        createFeaturedForm.reportValidity();
        errorMessage.textContent = 'Please fill out all required fields.';
        errorMessage.style.display = 'block';
    }
}



