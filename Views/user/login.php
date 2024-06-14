<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha256-PI8n5gCcz9cQqQXm3PEtDuPG8qx9oFsFctPg0S5zb8g=" crossorigin="anonymous">
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
        </div>
    </div>
    <div class="toast-container position-fixed  top-0 start-50 translate-middle-x">
        <div id="liveToast" class="toast fade" style="background-color: red;" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="/favicon.ico" class="rounded me-2" style="width:30px; height:auto;" alt="icon PMS">
                <strong class="me-auto">PMS</strong>
                <small>now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Login failed
            </div>
        </div>
    </div>
    <script src="/js/login.js"></script>
</body>

</html>