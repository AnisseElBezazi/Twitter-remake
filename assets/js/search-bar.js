document.addEventListener('DOMContentLoaded', () => {
  const searchInput = document.querySelector('.research');
  const movieCards = document.querySelectorAll('.card-link');

  searchInput.addEventListener('input', (e) => {
    const searchTerm = e.target.value.toLowerCase().trim();

    movieCards.forEach((card) => {
      const titleElement = card.querySelector('.title');
      if (titleElement) {
        const title = titleElement.textContent.toLowerCase();
        if (title.includes(searchTerm)) {
          card.style.display = '';
        } else {
          card.style.display = 'none';
        }
      }
    });

    let visibleCount = 0;
    movieCards.forEach((card) => {
      if (card.style.display !== 'none') {
        visibleCount++;
      }
    });

    let noResultMsg = document.querySelector('.no-result-msg');
    if (visibleCount === 0 && searchTerm !== '') {
      if (!noResultMsg) {
        noResultMsg = document.createElement('p');
        noResultMsg.className = 'no-result-msg msg-vide';
        noResultMsg.textContent = 'Aucun salon ne correspond à votre recherche.';
        document.querySelector('.list-film').appendChild(noResultMsg);
      } else {
        noResultMsg.style.display = 'block';
      }
    } else if (noResultMsg) {
      noResultMsg.style.display = 'none';
    }
  });
});
