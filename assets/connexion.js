const inputSubmit = document.getElementById('connexion');
const inputEmail = document.getElementById('inputEmail');
const inputPassword = document.getElementById('inputPassword');

inputSubmit.addEventListener('click', stockCredentials)

function stockCredentials() {
    localStorage.setItem('email', inputEmail.value);
    localStorage.setItem('mdp', inputPassword.value);
}