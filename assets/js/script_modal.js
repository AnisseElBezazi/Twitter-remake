function openEditModal() {
  document.getElementById("edit-modal").style.display = "flex";
}

function closeEditModal() {
  document.getElementById("edit-modal").style.display = "none";
}

const avatarInput = document.getElementById("avatar-upload");
if (avatarInput) {
  avatarInput.addEventListener("change", function (event) {
    const file = event.target.files[0];
    if (file) {
      document.querySelector(".avatar-preview").src = URL.createObjectURL(file);
    }
  });
}

const bannerInput = document.getElementById("banner-upload");
if (bannerInput) {
  bannerInput.addEventListener("change", function (event) {
    const file = event.target.files[0];
    if (file) {
      document.querySelector(".banner-preview").src = URL.createObjectURL(file);
    }
  });
}
