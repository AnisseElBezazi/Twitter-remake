const emailInput = document.getElementById('email');
const nameInput = document.getElementById('name');
const pseudoInput = document.getElementById('pseudo');

const loginForm = document.getElementById('login-form');
const registerForm = document.getElementById('register-form');

if (emailInput && localStorage.getItem('savedEmail')) {
  emailInput.value = localStorage.getItem('savedEmail');
}
if (nameInput && localStorage.getItem('savedName')) {
  nameInput.value = localStorage.getItem('savedName');
}
if (pseudoInput && localStorage.getItem('savedPseudo')) {
  pseudoInput.value = localStorage.getItem('savedPseudo');
}

if (loginForm) {
  loginForm.addEventListener('submit', () => {
    if (emailInput) localStorage.setItem('savedEmail', emailInput.value);
  });
}

if (registerForm) {
  registerForm.addEventListener('submit', () => {
    if (emailInput) localStorage.setItem('savedEmail', emailInput.value);
    if (nameInput) localStorage.setItem('savedName', nameInput.value);
    if (pseudoInput) localStorage.setItem('savedPseudo', pseudoInput.value);
  });
}
