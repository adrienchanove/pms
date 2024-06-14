<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha256-PI8n5gCcz9cQqQXm3PEtDuPG8qx9oFsFctPg0S5zb8g=" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <title>PMS</title>

</head>

<body>
    <?php view('Common/header'); ?>

    <div id="app">
        <!-- Liste des arrivants -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center">Liste Arrivées / Départs</h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>🛬 🛫</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Maison</th>
                                <th scope="col">Date d'arrivée</th>
                                <th scope="col">Date de départ</th>
                                <th></th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="reservation in reservationsStart">
                                <td>🛬</td>
                                <td>{{ reservation.name }}</td>
                                <td>{{ reservation.house.name }}</td>
                                <td>{{ reservation.startDate }}</td>
                                <td>{{ reservation.endDate }}</td>
                                <td><a :href="'/reservations/' + reservation.id" class="btn btn-primary">Check in</a></td>
                            </tr>
                            <tr v-for="reservation in reservationsEnd">
                                <td>🛫</td>
                                <td>{{ reservation.name }}</td>
                                <td>{{ reservation.house.name }}</td>
                                <td>{{ reservation.startDate }}</td>
                                <td>{{ reservation.endDate }}</td>
                                <td><a :href="'/reservations/' + reservation.id" class="btn btn-primary">Check out</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/index.js"></script>
</body>
</html>