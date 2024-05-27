// Regex
// REGEX Email
let emailInput = document.getElementById('email');
let emailRegex = /^[a-zA-Z 0-9_\.\-]{2,40}@[a-zA-Z0-9_\-]{2,20}\.[a-zA-Z]{2,10}$/
let emailError = document.getElementById('emailError');

// REGEX mot de passe 
let passwordInput = document.getElementById('password');
let passwordRegex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/
let passwordError = document.getElementById('passwordError');

// REGEX nom d'utilisateur
let usernameInput = document.getElementById('name');
let usernameRegex = /^[a-zA-ZÀ-ÿ\s\-]{2,}$/
let usernameError = document.getElementById('nameError');

// REGEX Code postal
let pcInput = document.getElementById('postalCode');
let pcRegex = /^\d{5}$/
let pcError = document.getElementById('pcError');

// REGEX Url
let urlInput = document.getElementById('linkedinUrl');
let urlRegex = /^https?:\/\/[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}.*$/
let urlError = document.getElementById('urlError');

emailInput.addEventListener('input', () => {
    if (!emailRegex.test(emailInput.value)) {
        emailInput.classList.add('error');
        emailError.textContent = "L'adresse e-mail n'est pas valide.";
    } else {
        emailInput.classList.remove('error');
        emailError.textContent = "";
    }
});

passwordInput.addEventListener('input', () => {
    passwordError.textContent = "";
    if (passwordRegex.test(passwordInput.value)) {
        passwordInput.classList.remove('error');
        passwordError.textContent = "";
    } else {
        passwordInput.classList.add('error');
        passwordError.textContent = "Le mot de passe doit contenir au moins 8 caractères, au moins une lettre majuscule, au moins une lettre minuscule, au moins un chiffre et au moins un caratére spécial parmis les suivants:@$!%*?& ";
    }

});

usernameInput.addEventListener('input', () => {
    if (usernameRegex.test(usernameInput.value)) {
        usernameInput.classList.remove('error');
        usernameError.textContent = "";
    } else {
        usernameInput.classList.add('error');
        usernameError.textContent = "Le nom d'utilisateur doit contenir au moins 2 caractéres et ne peut contenir que des lettres alphabétique.";
    }
});

pcInput.addEventListener('input', () => {
    if (pcRegex.test(pcInput.value)) {
        pcInput.classList.remove('error');
        pcError.textContent = "";
    } else {
        pcInput.classList.add('error');
        pcError.textContent = "le code postal contient 5 chiffres";
    }
});

urlInput.addEventListener('input', () => {
    if (urlRegex.test(urlInput.value)) {
        urlInput.classList.remove('error');
        urlError.textContent = "";
    } else {
        urlInput.classList.add('error');
        urlError.textContent = "URL invalide: https:// ou http://...";
    }
});
// afficher ou cacher MDP 
document.getElementById('togglePassword').addEventListener('click', function (e) {
    this.classList.toggle('fa-eye')
    this.classList.toggle('fa-eye-slash')
    const passwordField = document.getElementById('password');
    const togglePassword = document.getElementById('togglePassword');

    // modifie le type
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);
});
