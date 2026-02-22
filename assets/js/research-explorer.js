const searchInput = document.getElementById('research-explorer');
const posts = document.querySelectorAll('.post');

if (searchInput) {
  searchInput.addEventListener('input', function () {
    const query = this.value.toLowerCase().trim();

    posts.forEach((post) => {
      const name = post.querySelector('.name')
        ? post.querySelector('.name').textContent.toLowerCase()
        : '';
      const pseudo = post.querySelector('.real-name')
        ? post.querySelector('.real-name').textContent.toLowerCase()
        : '';
      const salon = post.querySelector('.time')
        ? post.querySelector('.time').textContent.toLowerCase()
        : '';
      const message = post.querySelector('.message')
        ? post.querySelector('.message').textContent.toLowerCase()
        : '';

      if (
        name.includes(query) ||
        pseudo.includes(query) ||
        salon.includes(query) ||
        message.includes(query)
      ) {
        post.style.display = 'flex';
      } else {
        post.style.display = 'none';
      }
    });
  });
}
