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