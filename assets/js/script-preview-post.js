const fileInput = document.getElementById('post-image');
const previewContainer = document.getElementById('preview-container');
const previewImage = document.getElementById('preview-image');
const removePreviewBtn = document.getElementById('remove-preview');

if (fileInput) {
  fileInput.addEventListener('change', function () {
    if (this.files && this.files[0]) {
      previewImage.src = URL.createObjectURL(this.files[0]);
      previewContainer.style.display = 'block';
    }
  });
}

if (removePreviewBtn) {
  removePreviewBtn.addEventListener('click', function () {
    fileInput.value = '';
    previewImage.src = '';
    previewContainer.style.display = 'none';
  });
}
