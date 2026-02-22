function openPostModal() {
  document.getElementById('post-modal').style.display = 'flex';
}

function closePostModal() {
  document.getElementById('post-modal').style.display = 'none';
}

window.onclick = function (event) {
  const modal = document.getElementById('post-modal');
  if (event.target == modal) {
    closePostModal();
  }
};

const modalPostImage = document.getElementById('modal-post-image');
if (modalPostImage) {
  modalPostImage.addEventListener('change', function () {
    const file = this.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        document.getElementById('modal-preview-image').src = e.target.result;
        document.getElementById('modal-preview-container').style.display = 'block';
      };
      reader.readAsDataURL(file);
    }
  });
}

const modalRemovePreview = document.getElementById('modal-remove-preview');
if (modalRemovePreview) {
  modalRemovePreview.addEventListener('click', function () {
    document.getElementById('modal-post-image').value = '';
    document.getElementById('modal-preview-container').style.display = 'none';
    document.getElementById('modal-preview-image').src = '';
  });
}
