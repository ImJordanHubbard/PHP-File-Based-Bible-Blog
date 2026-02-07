// ===== Blog Filtering (Category + Book) =====
document.addEventListener('DOMContentLoaded', () => {
  const categorySelect = document.getElementById('category-filter'); // may be null
  const bookSelect = document.getElementById('book-filter');         // may be null
  const blogContainer = document.querySelector('.blog-container');
  const blogCards = document.querySelectorAll('.blog-card');

  if (!blogContainer || blogCards.length === 0) return;

  blogContainer.setAttribute('aria-live', 'polite');

  const normalise = (v) => (v || '').trim().toLowerCase();

  const filterBlogs = () => {
    const categoryTerm = categorySelect ? normalise(categorySelect.value) : 'all';
    const bookTerm = bookSelect ? normalise(bookSelect.value) : 'all';

    let anyVisible = false;

    blogCards.forEach(card => {
      const cardCategory = normalise(card.dataset.category);
      const cardBook = normalise(card.dataset.book);

      // Wildcard behaviour: if a filter is 'all', it does not constrain results
      const matchesCategory = (categoryTerm === 'all') || (cardCategory === categoryTerm);
      const matchesBook = (bookTerm === 'all') || (cardBook === bookTerm);

      const isVisible = matchesCategory && matchesBook;

      card.style.display = isVisible ? 'flex' : 'none';
      if (isVisible) anyVisible = true;
    });

    const msg = blogContainer.querySelector('.no-results');
    if (!anyVisible) {
      if (!msg) {
        const noResults = document.createElement('p');
        noResults.className = 'no-results';
        noResults.textContent = 'No posts match your filters.';
        blogContainer.appendChild(noResults);
      }
    } else if (msg) {
      msg.remove();
    }
  };

  if (categorySelect) categorySelect.addEventListener('change', filterBlogs);
  if (bookSelect) bookSelect.addEventListener('change', filterBlogs);

  filterBlogs();
});



