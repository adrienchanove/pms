<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha256-PI8n5gCcz9cQqQXm3PEtDuPG8qx9oFsFctPg0S5zb8g=" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <title>PMS -- Reservation edit</title>

</head>

<body>
    <?php view('Common/header'); ?>

    <div id="app">
        <div class="container">
            <h1 class="text-center">Modifier une réservation</h1>
            <form action="/reservations/edit" method="post">
                <input type="hidden" name="id" value="<?= $data["id"] ?>">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Nom</label>
                            <input type="text" name="name" id="name" class="form-control" value="" v-model="name">
                        </div>
                        <div class="form-group">
                            <label for="nbPlaces">Nombre de places</label>
                            <input type="number" name="nbPlaces" id="nbPlaces" class="form-control" value="" v-model="nbPlaces">
                        </div>
                        <div class="form-group">
                            <label for="idHousing">Logement</label>
                            <select name="idHousing" id="idHousing" class="form-control" v-model="idHousing">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="startDate">Date de début</label>
                            <input type="date" name="startDate" id="startDate" class="form-control" value="" v-model="startDate">
                        </div>
                        <div class="form-group">
                            <label for="endDate">Date de fin</label>
                            <input type="date" name="endDate" id="endDate" class="form-control" value="" v-model="endDate">
                        </div>
                        <div class="form-group">
                            <label for="paid">Payé</label>
                            <input type="number" name="paid" id="paid" class="form-control" value="" v-model="paid">
                        </div>
                        <button class="btn btn-primary" @click="save">Enregistrer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="/js/reservation.js"></script>
</body>
</html>