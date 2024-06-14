new Vue({
    el: '#app',
    data: {
        login: '',
        password: '',
        error: false,
        errorMessages: []
    },
    methods: {
        loginClick() {
            console.log(this.login);
            fetch('/api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `username=${this.login}&password=${this.password}`
                })
                .then(response => response.json())
                .then(data => {
                    this.password = '';
                    console.log(data);
                    if (data.error) {
                        this.error = true;
                        this.errorMessages = data.errorMessages;
                        // show toast
                        let toast = document.getElementById('liveToast');
                        toast.classList.add('show');
                        setTimeout(() => {
                            toast.classList.remove('show');
                            toast.classList.add('hide');
                        }, 3000);
                        // close toast
                        toast.querySelector('.btn-close').addEventListener('click', () => {
                            toast.classList.remove('show');
                        });

                        toast.querySelector('.toast-body').innerHTML = this.errorMessages.join('<br>');



                    } else {
                        this.error = false;
                        this.errorMessages = [];
                        window.location.href = '/';
                    }
                }
            )
        }
    }
});