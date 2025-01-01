async function applySortFilter() {
  const filter = document.getElementById('sort-filter').value;
  const url = new URL(window.location.href);
  url.searchParams.set('sortBy', filter);
  window.location.href = url.toString();
};

document.addEventListener('DOMContentLoaded', function () {

    const paginationLinks = document.querySelectorAll('.pagination a');
    paginationLinks.forEach(link => {
        if (!link.href.includes('#posts')) {
            link.href += '#posts'; // Append #posts to each link
        }
    });

//   // Handle the comment icon click
//   document.querySelectorAll('.comment-btn').forEach(function (commentBtn) {
//       commentBtn.addEventListener('click', function () {
//           const threadId = this.getAttribute('data-thread-id');
//           const repliesContainer = document.getElementById(`replies-container-${threadId}`);

//           // Toggle visibility of the replies container
//           repliesContainer.classList.toggle('d-none');

//           // Fetch replies dynamically if not already loaded
//           if (!repliesContainer.dataset.loaded) {
//               fetchReplies(threadId);
//               repliesContainer.dataset.loaded = true; // Prevent reloading replies
//           }
//       });
//   });

//   // Handle reply submission
//   document.querySelectorAll('.submit-reply').forEach(function (submitBtn) {
//       submitBtn.addEventListener('click', function () {
//           const threadId = this.getAttribute('data-thread-id');
//           const textarea = document.getElementById(`reply-textarea-${threadId}`);
//           const replyContent = textarea.value.trim();

//           if (replyContent) {
//               submitReply(threadId, replyContent);
//               textarea.value = ''; // Clear the textarea
//           }
//       });
//   });

//   // Function to fetch replies dynamically
//   async function fetchReplies(threadId) {
//       const repliesContainer = document.querySelector(`#replies-container-${threadId} .replies-list`);
//       try {
//           const response = await fetch(`/api/threads/${threadId}/replies`);
//           const replies = await response.json();

//           // Display replies
//           replies.forEach(reply => {
//               const replyElement = document.createElement('p');
//               replyElement.classList.add('reply');
//               replyElement.innerHTML = `<strong>${reply.user.username}:</strong> ${reply.content}`;
//               repliesContainer.appendChild(replyElement);
//           });
//       } catch (error) {
//           console.error('Failed to fetch replies:', error);
//       }
//   }

//   // Function to submit a reply
//   async function submitReply(threadId, replyContent) {
//       try {
//           const response = await fetch(`/api/threads/${threadId}/replies`, {
//               method: 'POST',
//               headers: {
//                   'Content-Type': 'application/json',
//                   'Authorization': `Bearer ${localStorage.getItem('authToken')}` // Use auth token if required
//               },
//               body: JSON.stringify({ content: replyContent })
//           });

//           if (response.ok) {
//               const reply = await response.json();
//               const repliesContainer = document.querySelector(`#replies-container-${threadId} .replies-list`);
//               const replyElement = document.createElement('p');
//               replyElement.classList.add('reply');
//               replyElement.innerHTML = `<strong>${reply.user.username}:</strong> ${reply.content}`;
//               repliesContainer.appendChild(replyElement);
//           } else {
//               console.error('Failed to submit reply:', response.statusText);
//           }
//       } catch (error) {
//           console.error('Error submitting reply:', error);
//       }
//   }
});
