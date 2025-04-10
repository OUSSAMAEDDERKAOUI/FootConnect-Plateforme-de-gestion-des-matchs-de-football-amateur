document.getElementById('togglePassword').addEventListener('click', function () {
    const passwordInput = document.getElementById('password');
    const icon = this.querySelector('i');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
});



if (document.cookie.split('; ').filter((item) => item.startsWith('Access-Token=')).length > 0) {
// alert(0)
window.location.href = "/matchs"; 
}

document.getElementById('loginForm').addEventListener('submit', async function (e) {
e.preventDefault();
// alert(1);
const email = document.getElementById('email').value;
const password = document.getElementById('password').value;

try {
    // alert(2);

    const response = await fetch('http://127.0.0.1:8000/api/login/AdminLigue', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({ email, password })
    });
    // alert(3);

    const data = await response.json();
// alert(data);
    if (response.ok) {
// alert(4);
    //   localStorage.setItem('token', data.authorisation.token);

        alert('Connexion réussie !');
        window.location.href = "/matchs"; 
    } else {
        // alert(5);

        alert(data.message || "Échec de connexion");
    }
} catch (error) {
    console.error('Erreur:', error);
    alert("Une erreur s'est produite");
}
});
