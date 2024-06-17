<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha256-PI8n5gCcz9cQqQXm3PEtDuPG8qx9oFsFctPg0S5zb8g=" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <title>PMS -- Reservations</title>

</head>

<body>
    <?php view('Common/header'); ?>

    <div id="app">
        <!-- Liste reservations -->
        <div class="container">
            <!-- parametre de recharche -->
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center">Liste des réservations</h1>
                    <form action="/reservations" method="get">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" name="name" class="form-control" placeholder="Nom" value="<?= $params['name'] ?>" v-model="inputName">
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="house" class="form-control" placeholder="Maison" value="<?= $params['house'] ?>" v-model="inputHouse">
                            </div>
                            <div class="col-md-3">
                                <input type="date" name="startDate" class="form-control" placeholder="Date d'arrivée" value="<?= $params['startDate'] ?>" v-model="inputStartDate">
                            </div>
                            <div class="col-md-3">
                                <input type="date" name="endDate" class="form-control" placeholder="Date de départ" value="<?= $params['endDate'] ?>" v-model="inputEndDate">
                            </div>
                            <div class="col-md-3">
                                <button type="button" @click="search" class="btn btn-primary">Rechercher</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nom</th>
                                <th scope="col">Maison</th>
                                <th scope="col">Date d'arrivée</th>
                                <th scope="col">Date de départ</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="reservation in reservationsFiltered">
                                <td>{{ reservation.name }}</td>
                                <td>{{ reservation.house.name }}</td>
                                <td>{{ reservation.startDate }}</td>
                                <td>{{ reservation.endDate }}</td>
                                <td><a :href="'/reservations/' + reservation.id" class="btn btn-primary">Voir</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/reservations.js"></script>
</body>

</html>