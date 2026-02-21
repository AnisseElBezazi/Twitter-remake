const fileInput = document.getElementById('post-image');
const previewContainer = document.getElementById('preview-container');
const previewImage = document.getElementById('preview-image');
const removePreviewBtn = document.getElementById('remove-preview');

// Afficher la preview quand une image est sélectionnée
if (fileInput) {
  fileInput.addEventListener('change', function () {
    if (this.files && this.files[0]) {
      previewImage.src = URL.createObjectURL(this.files[0]);
      previewContainer.style.display = 'block';
    }
  });
}

// Supprimer l'image et cacher la preview au clic sur X
if (removePreviewBtn) {
  removePreviewBtn.addEventListener('click', function () {
    fileInput.value = ''; // Vide l'input
    previewImage.src = '';
    previewContainer.style.display = 'none';
  });
}
