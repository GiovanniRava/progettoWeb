
<header>
    <div class="logo">
        <?php if(isset($_SESSION['tipo_utente']) && $_SESSION['tipo_utente'] === "studente"): ?>
            <a href="paginaPrincipale_studente.php">
                <img src="upload/uniboLogo.png" alt="Logo Alma Aule">
            </a>
        <?php endif; ?>
        <?php if(isset($_SESSION['tipo_utente']) && $_SESSION['tipo_utente'] === "admin"): ?>
        <a href="paginaPrincipale_amministratore.php">
            <img src="upload/uniboLogo.png" alt="Logo Alma Aule">
        </a>
        <?php endif; ?>
    </div>
    <div class="title">
        <h1>Alma Aule</h1>
    </div>
    <div class="menu-container">
        <a href="menu.php" style="text-decoration: none; font-size: 35px; color: #333333; line-height: 1;">
            &#9776;
        </a>
    </div>
</header>
<?php if(isset($_SESSION['tipo_utente']) && $_SESSION['tipo_utente'] === "studente"): ?>
<nav class="menu-pc">
    <ul>
        <li><a href="cercaAula_studente.php">AULE</a></li>
        <li><a href="cercaLaboratorio_studente.php">LABORATORI</a></li>
        <li><a href="polivalente.php">POLIVALENTE</a></li>
        <li><a href="eventi_studente.php">EVENTI</a></li>
        <li><a href="prenotazioni_studente.php">PRENOTAZIONI</a></li>
    </ul>
</nav>
<?php endif; ?>
<?php if(isset($_SESSION['tipo_utente']) && $_SESSION['tipo_utente'] === "admin"): ?>
<nav class="menu-pc">
    <ul>
        <li><a href="listaPrenotazioni_admin.php">PRENOTAZIONI</a></li>
        <li><a href="richieste_admin.php">RICHIESTE IN CORSO</a></li>
        <li><a href="eventi_admin.php">EVENTI</a></li>
    </ul>
</nav>
<?php endif; ?>