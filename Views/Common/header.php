<div id="headerBurgerMenu" class="hidden">
    <?php if (Auth::isLogged()) : ?>
        <a href="/logout">Logout|<?= Auth::getUsername() ?></a>
    <?php else : ?>
        <a href="/login">Login</a>
    <?php endif; ?>
    <a href="/">Home</a>
    <a href="/logements">Logement</a>
    <a href="/planning">Planning</a>
    <a href="/gestion">Gestion</a>

</div>
<header>
    <link rel="stylesheet" href="/css/header.css">
    <div id="headerTop">
        <div id="headerBurgerButton"> 🟰 </div>
        <h1 id="headerTitle"><?= $data['title'] ?? 'Titre de la page non fournis' ?></h1>
    </div>

    <script src="/js/header.js"></script>
</header>