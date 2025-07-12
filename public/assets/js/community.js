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

    const clearBtn = document.getElementById('clearSearch');
    const searchInput = document.getElementById('searchFilter');

    // Show or hide clear button on page load
    if (searchInput && searchInput.value.trim() !== '') {
        clearBtn.style.display = 'inline';
    }

    // Handle click on clear button
    clearBtn.addEventListener('click', function (e) {
        e.preventDefault();

        const url = new URL(window.location.href);
        url.searchParams.delete('search'); // remove ?search
        url.hash = 'posts'; // add #posts

        // Optional: visually clear input
        searchInput.value = '';

        // Redirect to updated URL
        window.location.href = url.toString();
    });    

});

let searchTimeout;

document.getElementById('searchFilter').addEventListener('input', function () {
    clearTimeout(searchTimeout);

    searchTimeout = setTimeout(() => {
        const filter = this.value.trim();
        if (!filter) return;

        try {
            const url = new URL(window.location.href);

            // Remove any existing hash to avoid double #posts
            url.hash = '';

            const currentSearch = url.searchParams.get('search');
            if (currentSearch === filter) {
                // Reload only if the search term hasn't changed
                window.location.reload();
            } else {
                url.searchParams.set('search', filter);
                url.hash = 'posts'; // Add only one #posts
                window.location.href = url.toString();
            }
        } catch (error) {
            console.error('Error applying search filter:', error);
        }
    }, 1000); // 1 second debounce
});


