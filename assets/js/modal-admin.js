document.addEventListener('DOMContentLoaded', function() {
  fetch('process/is_admin.php')
    .then(r => r.json())
    .then(data => {
      if (data.is_admin) {
        const btn = document.createElement('button');
        btn.textContent = '+ Ajouter film/série';
        btn.className = 'admin-add-movie-btn';
        btn.style = 'margin: 16px 0 0 0; background: #e50914; color: #fff; border: none; border-radius: 6px; padding: 8px 18px; font-size: 1rem; cursor: pointer;';
        btn.onclick = openAddMovieModal;
        document.getElementById('admin-add-movie-btn-container').appendChild(btn);

        document.querySelectorAll('.admin-delete-movie-btn').forEach(btn => {
          btn.style.display = 'flex';
          btn.addEventListener('click', function(e) {
            e.preventDefault(); 
            window.location.href = 'process/delete_movie_process.php?id=' + this.getAttribute('data-id');
          });
        });
      }
    });
});

function openAddMovieModal() {
  document.getElementById('add-movie-modal').style.display = 'flex';
}
function closeAddMovieModal() {
  document.getElementById('add-movie-modal').style.display = 'none';
}

document.addEventListener('keydown', function(e) {
  const modal = document.getElementById('add-movie-modal');
  if (modal && modal.style.display === 'flex' && (e.key === 'Escape' || e.key === 'Esc')) {
    closeAddMovieModal();
  }
});