// Wait for the DOM to fully load
document.addEventListener("DOMContentLoaded", function () {
    // Add event listener to the search form
    const searchForm = document.getElementById('searchHub');
    if (searchForm) {
        searchForm.addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent default submission
            applySearchFilter();
        });
    }

    // Handle createKnowledgeForm submission
    const submitButton = document.getElementById("submitCreateKnowledgeForm");
    if (submitButton) {
        submitButton.addEventListener("click", function () {
            handleKnowledgeFormSubmission();
        });
    }

    document.querySelectorAll('[data-toggle="modal"][data-target="#addNewModal"]').forEach(button => {
        button.addEventListener('click', function () {
            const threadId = this.dataset.threadId;
            const title = this.dataset.title;
            const categoryId = this.dataset.categoryId;
            const metadata = this.dataset.metadata ? JSON.parse(this.dataset.metadata) : {};

            const choices = metadata.choices || {};
            const correctAnswer = metadata.answer || '';

            // Check if we're in edit mode
            const isEditMode = !!threadId;
            const form = document.getElementById('createKnowledgeForm');
            const choicesContainer = document.getElementById('choicesContainer');

            // Reset form and choices
            form.reset();
            choicesContainer.innerHTML = ''; // Clear previous choices

            if (isEditMode) {
                form.dataset.threadId = threadId;
                document.getElementById('knowledgeCategory').value = categoryId;
                document.getElementById('knowledgeTitle').value = title;

                // Populate choices dynamically
                Object.keys(choices).forEach((key, index) => {
                    addNewChoice(choices[key], correctAnswer === key, index);
                });

                // Update modal title & button
                document.getElementById('addNewModalLabel').textContent = 'Edit Entry';
                document.getElementById('submitCreateKnowledgeForm').textContent = 'Update';
            } else {
                // Reset for "Add New"
                form.removeAttribute('data-thread-id');
                addNewChoice(); // Ensure at least one choice field exists

                document.getElementById('addNewModalLabel').textContent = 'Create New Question';
                document.getElementById('submitCreateKnowledgeForm').textContent = 'Save';
            }
        });
    });

    // Open Delete Modal and set thread ID
    document.querySelectorAll('[data-toggle="modal"][data-target="#deleteModal"]').forEach(button => {
        button.addEventListener('click', function () {
            const threadId = this.dataset.threadId;
            document.getElementById('confirmDelete').dataset.threadId = threadId;
        });
    });

    // Handle Delete Request
    document.getElementById('confirmDelete')?.addEventListener('click', async function () {
        const threadId = this.dataset.threadId;

        if (!threadId) {
            alert('Thread ID is missing.');
            return;
        }

        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const response = await axios.delete(`/api/admin/knowledge/${threadId}`, {
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json',
                },
            });

            $('#deleteModal').modal('hide');
            window.location.reload(); 
        } catch (error) {
            console.error('Error deleting the entry:', error);
            alert('Failed to delete the entry. Please try again.');
        }
    });

    function addNewChoice(choiceText = '', isCorrect = false, index = null) {
        const choicesContainer = document.getElementById('choicesContainer');
        const choiceCount = index !== null ? index : choicesContainer.querySelectorAll('.choice-group').length;

        // Create the input group div
        const choiceGroup = document.createElement('div');
        choiceGroup.classList.add('input-group', 'mb-2', 'choice-group');

        // Create the text input
        const input = document.createElement('input');
        input.type = 'text';
        input.classList.add('form-control');
        input.name = 'knowledgeChoices[]';
        input.required = true;
        input.value = choiceText; // Prefill choice text

        // Create the checkbox wrapper
        const checkboxWrapper = document.createElement('div');
        checkboxWrapper.classList.add('input-group-text');

        // Create the single-selection checkbox (acts like a radio button)
        const checkbox = document.createElement('input');
        checkbox.type = 'radio'; // Changed from 'checkbox' to 'radio'
        checkbox.classList.add('correct-answer');
        checkbox.name = 'correctAnswers';
        checkbox.value = choiceCount;
        if (isCorrect) {
            checkbox.checked = true;
        }

        // Create the remove button
        const removeButton = document.createElement('button');
        removeButton.type = 'button';
        removeButton.classList.add('btn', 'btn-danger', 'ms-2');
        removeButton.textContent = 'Remove';
        removeButton.addEventListener('click', function () {
            choiceGroup.remove();
            updateRadioValues(); // Update indexes
        });

        // Append elements
        checkboxWrapper.appendChild(checkbox);
        choiceGroup.appendChild(input);
        choiceGroup.appendChild(checkboxWrapper);
        choiceGroup.appendChild(removeButton);
        choicesContainer.appendChild(choiceGroup);

        updateRadioValues();
    }

    // Update radio button values to match input indexes
    function updateRadioValues() {
        document.querySelectorAll('.choice-group').forEach((group, index) => {
            const radio = group.querySelector('.correct-answer');
            if (radio) {
                radio.value = index; // Ensure the value is correct
            }
        });
    }

    // Update checkbox values to match input indexes
    function updateCheckboxValues() {
        document.querySelectorAll('.choice-group').forEach((group, index) => {
            const checkbox = group.querySelector('.correct-answer');
            if (checkbox) {
                checkbox.value = index; // Ensure the value is correct
            }
        });
    }

    // Add new choice on button click
    document.getElementById('addChoice').addEventListener('click', () => {
        addNewChoice();
    });
    
});

async function applySearchFilter() {
    const searchFilterInput = document.getElementById('searchFilter');
    const searchButton = document.getElementById('searchButton');

    // Get the search filter value
    const filter = searchFilterInput.value.trim();

    // Prevent submission if the input is empty
    if (!filter) {
        return;
    }

    // Set button to loading state
    searchButton.disabled = true;
    searchButton.innerHTML = `
        <span class="spinner-border spinner-border-sm" role="status"></span>
        Loading...
    `;

    try {
        // Update the URL with the search filter and reload the page
        const url = new URL(window.location.href);
        url.searchParams.set('search', filter);
        window.location.href = url.toString();
    } catch (error) {
        console.error('Error applying search filter:', error);
    } finally {
        // Optionally, reset the button state if needed (e.g., on error)
        // searchButton.disabled = false;
        // searchButton.innerHTML = 'Search';
    }
}

// Event listener to handle search
document.getElementById('searchButton').addEventListener('click', applySearchFilter);

// Enable the button when the page is fully loaded
window.addEventListener('load', () => {
    const searchButton = document.getElementById('searchButton');
    searchButton.disabled = false;
    searchButton.innerHTML = 'Search';
});

/**
 * Function to handle form submission
 */
async function handleKnowledgeFormSubmission() {
    const createKnowledgeForm = document.getElementById("createKnowledgeForm");
    const errorMessage = document.getElementById("error-message");

    if (!createKnowledgeForm) {
        errorMessage.textContent = "Form not found.";
        errorMessage.style.display = "block";
        return;
    }

    if (createKnowledgeForm.checkValidity()) {
        const formData = {
            knowledgeCategory: document.getElementById("knowledgeCategory").value,
            knowledgeTitle: document.getElementById("knowledgeTitle").value.trim(),
            knowledgeChoices: Array.from(document.querySelectorAll('[name="knowledgeChoices[]"]')).map(input => input.value),
            correctAnswers: document.querySelector('[name="correctAnswers"]:checked')?.value || null,
        };

        const threadId = createKnowledgeForm.dataset.threadId;
        const isEditMode = !!threadId;

        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
            let response;

            if (isEditMode) {
                response = await axios.put(`/api/admin/knowledge/${threadId}`, formData, {
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                        "X-Requested-With": "XMLHttpRequest",
                        "Content-Type": "application/json",
                    },
                });
            } else {
                response = await axios.post("/api/admin/knowledge", formData, {
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                        "X-Requested-With": "XMLHttpRequest",
                        "Content-Type": "application/json",
                    },
                });
            }

            errorMessage.textContent = "";
            errorMessage.style.display = "none";
            window.location.href = response.data.redirect_url;
        } catch (error) {
            const errorData = error.response?.data || {};
            errorMessage.textContent = errorData.error || "An error occurred. Please try again.";
            errorMessage.style.display = "block";
        }
    } else {
        createKnowledgeForm.reportValidity();
        errorMessage.textContent = "Please fill out all required fields.";
        errorMessage.style.display = "block";
    }
}
