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
    
    window.history.back();
}

document.getElementById('loginForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    const role = document.getElementById('role').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    let url = 'http://127.0.0.1:8000/api/login';
    if (role === 'AdminLigue') {
        url += '/AdminLigue';
    } else if (role === 'AdminEquipe') {
        url += '/AdminEquipe';
    }

    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ email, password })
        });

        const data = await response.json();

        if (response.ok) {
            if (role === 'AdminLigue') {
                window.location.href = "/ligue/matchs";
            } else if (role === 'AdminEquipe') {
                window.location.href = "/import/players";
            } else {
                window.location.href = "/dashboard";
            }
        } else {
            alert(data.message || "Échec de connexion");
        }
    } catch (error) {
        console.error('Erreur:', error);
        alert("Une erreur s'est produite");
    }
});
