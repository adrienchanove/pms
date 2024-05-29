<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>

    <!-- vue cdn -->
    <title>Login</title>

</head>

<body>
    <div id="app">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <h1 class="text-center">Login</h1>
                    <form @submit.prevent="loginClick">
                        <div class="form-group">
                            <label for="login">Login</label>
                            <input type="text" v-model="login" class="form-control" id="login" aria-describedby="loginHelp" placeholder="Enter login">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" v-model="password" class="form-control" id="password" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <!-- Error -->
                <div class="col-md-6 offset-md-3">
                    <div v-if="error" class="alert alert-danger" role="alert">
                        <ul>
                            <li v-for="message in errorMessages">{{message}}</li>
                        </ul>
                    </div>
                </div>  
            </div>
        </div>
    </div>
    <script>
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
                                // window.location.href = '/';
                            }
                        }
                    )
                }
            }
        });





    </script>
</body>
</html>