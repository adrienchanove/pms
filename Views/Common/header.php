<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">PMS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <?php
                $navList = [
                    'Home' => '/',
                    'Réservations' => '/reservations',
                    'Maisons' => '/houses',
                    'Saisons' => '/seasons',
                    'Tarifs' => '/prices',
                    'Factures' => '/invoices',


                ];
                ?>
                <ul class="navbar-nav me-auto">
                    <?php foreach ($navList as $key => $value) : ?>
                        <li class="nav-item">
                            <a class="nav-link <?= strpos($_SERVER['REQUEST_URI'], $value) !== false ? 'active' : '' ?>" aria-current="page" href="<?= $value ?>"><?= $key ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <!-- <li class="nav-item">
                            <a class="nav-link" href="/login">Login</a>
                        </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>