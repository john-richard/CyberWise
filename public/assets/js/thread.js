document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('threadForm');
    const errorMessage = document.getElementById('error-message');

    if (form) {
        form.addEventListener('submit', async function (event) {
            event.preventDefault();

            // Use FormData to handle file uploads correctly
            const formData = new FormData(form);

            try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                const response = await axios.post('/api/thread', formData, {
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest',
                    },

                });
                
                // Clear the error message and hide it on successful registration
                errorMessage.textContent = ''; // Clear error text
                errorMessage.style.display = 'none'; // Hide error message

                // Redirect to the appropriate page
                window.location.href = response.data.redirect_url;
            } catch (error) {
                const errorData = error.response?.data || {};
                console.error('Error Response:', errorData);
            
                if (error.response?.status === 401) {
                    // Redirect to login page
                    window.location.href = '/login#user-login';
                } else {
                    errorMessage.textContent = errorData.error || 'An error occurred.';
                    errorMessage.style.display = 'block';
                }
            }
        });
    }

    // Function to fetch replies dynamically
    async function fetchReplies(threadId) {
        const repliesContainer = document.querySelector(`#replies-container-${threadId} .replies-list`);
        try {
            const response = await fetch(`/api/thread/${threadId}/post`);
            const replies = await response.json();

            // Display replies
            replies.forEach(reply => {
                const replyElement = document.createElement('p');
                replyElement.classList.add('reply');
                replyElement.innerHTML = `<strong>${reply.user.username}:</strong> ${reply.content}`;
                repliesContainer.appendChild(replyElement);
            });
        } catch (error) {
            console.error('Failed to fetch replies:', error);
        }
    }

    // Function to submit a reply
    async function submitReply(threadId) {
        try {
            const textarea = document.getElementById(`reply-textarea-${threadId}`);
            if (!textarea) {
                console.error(`Textarea for thread ID ${threadId} not found.`);
                return;
            }

            const replyContent = textarea.value.trim();
            if (!replyContent) {
                // alert('Reply content cannot be empty.');
                return;
            }

            const response = await fetch(`/api/thread/${threadId}/post`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${localStorage.getItem('authToken')}` // Use auth token if required
                },
                body: JSON.stringify({ content: replyContent })
            });

            if (response.ok) {
                const reply = await response.json();

                const repliesContainer = document.querySelector(`#commentsList`);
            
                if (repliesContainer) {
                    // Create the new comment element
                    const commentElement = document.createElement('div');
                    commentElement.id = `comment_${reply.id}`;
                    commentElement.className = 'list-group-item d-flex mb-3';
                    commentElement.style.border = 'var(--bs-list-group-border-width) solid var(--bs-list-group-border-color)';
            
                    // Create the avatar container
                    const avatarContainer = document.createElement('div');
                    avatarContainer.className = 'flex-shrink-0 me-3 align-self-start';
            
                    const avatarImage = document.createElement('img');
                    avatarImage.src = `/storage/${reply.avatar}`;
                    avatarImage.className = 'img-fluid rounded-circle';
                    avatarImage.width = 50;
                    avatarImage.alt = 'User';
            
                    avatarContainer.appendChild(avatarImage);
            
                    // Create the content container
                    const contentContainer = document.createElement('div');
                    const username = document.createElement('h5');
                    username.className = 'mb-1';
                    username.textContent = reply.username;
            
                    const content = document.createElement('p');
                    content.className = 'mb-1';
                    content.textContent = reply.content;
            
                    const timeAgo = document.createElement('small');
                    timeAgo.className = 'text-muted';
                    timeAgo.textContent = reply.time_ago;
            
                    contentContainer.appendChild(username);
                    contentContainer.appendChild(content);
                    contentContainer.appendChild(timeAgo);
            
                    // Append everything to the comment element
                    commentElement.appendChild(avatarContainer);
                    commentElement.appendChild(contentContainer);
            
                    // Append the comment element to the replies container
                    repliesContainer.prepend(commentElement);

                    // clear textarea
                    document.getElementById(`reply-textarea-${threadId}`).value = "";
                }
            } else {
                console.error('Failed to submit reply:', response.statusText);
            }
        } catch (error) {
            console.error('Error submitting reply:', error);
        }
    }

    // Attach click event listeners to all submit buttons
    document.querySelectorAll('.submit-reply').forEach(button => {
        button.addEventListener('click', function () {
            const threadId = this.getAttribute('data-thread-id');
            if (threadId) {
                submitReply(threadId);
            } else {
                console.error('Thread ID not found on button.');
            }
        });
    });

});
