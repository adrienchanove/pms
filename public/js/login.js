
function tryLogin(e) {
    console.log(e);
    e.preventDefault();
    let form = e.target;
    console.log(username, password);
    // post form data to /api/login
    fetch('/api/login', {
        method: 'POST',
        body: new URLSearchParams(new FormData(form)),
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        }
    })
        .then(response => {
            return response.json()})
        .then(data => {
            console.log(data);
            if (data.error) {
                // show error message 
                let container = document.getElementById('error-message');
                let ul = container.getElementsByTagName('ul')[0];
                ul.innerHTML = '';
                for (errorMessage of data.errorMessages) {
                    let li = document.createElement('li');
                    li.textContent = errorMessage;
                    ul.appendChild(li);
                }
                container.classList.remove('d-none');
            } else {
                window.location.href = '/';
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}


// on loaded
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('login-form').addEventListener('submit', tryLogin);
});
