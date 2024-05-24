<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="/js/login.js"></script>
    <!-- vue cdn -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <title>Login</title>

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Login</h1>
                <form action="" id="login-form">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" x-model="username" name="username" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required </div>

                        <button class="btn btn-primary" x-on:click="tryLogin">Login</button>
                        <div class="alert alert-danger d-none" id="error-message" role="alert">
                            <ul>
                                
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


</body>





</html>